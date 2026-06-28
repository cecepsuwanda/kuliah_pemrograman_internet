<?php

declare(strict_types=1);

require_once __DIR__ . '/../config.php';

/** @var PDO|mysqli|null */
$GLOBALS['cv_db_connection'] = null;

function db_driver(): string
{
    $driver = cv_load_config()['driver'] ?? 'pdo';
    if (!in_array($driver, ['pdo', 'mysqli'], true)) {
        throw new RuntimeException('Driver database tidak valid: ' . $driver);
    }
    return $driver;
}

function db_driver_label(): string
{
    return db_driver() === 'mysqli' ? 'MySQLi' : 'PDO';
}

/**
 * @return PDO|mysqli
 */
function db_connection(bool $forceNew = false)
{
    if (!$forceNew && $GLOBALS['cv_db_connection'] !== null) {
        return $GLOBALS['cv_db_connection'];
    }

    $cfg = cv_load_config();
    $conn = db_connect_with_config($cfg, db_driver());
    if (!$forceNew) {
        $GLOBALS['cv_db_connection'] = $conn;
    }
    return $conn;
}

/**
 * @return PDO|mysqli
 */
function db_connect_with_config(array $cfg, string $driver)
{
    $host = $cfg['host'] ?? 'localhost';
    $dbname = $cfg['dbname'] ?? 'cv_portfolio';
    $user = $cfg['user'] ?? 'root';
    $pass = $cfg['pass'] ?? '';

    if ($driver === 'pdo') {
        if (!extension_loaded('pdo_mysql')) {
            throw new RuntimeException('Ekstensi pdo_mysql belum aktif.');
        }
        $dsn = "mysql:host={$host};dbname={$dbname};charset=utf8mb4";
        $pdo = new PDO($dsn, $user, $pass, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ]);
        return $pdo;
    }

    if (!extension_loaded('mysqli')) {
        throw new RuntimeException('Ekstensi mysqli belum aktif.');
    }
    $mysqli = new mysqli($host, $user, $pass, $dbname);
    if ($mysqli->connect_error) {
        throw new RuntimeException('Koneksi MySQLi gagal: ' . $mysqli->connect_error);
    }
    $mysqli->set_charset('utf8mb4');
    return $mysqli;
}

/**
 * @return PDO|mysqli
 */
function db_connect_server(array $cfg, string $driver)
{
    $host = $cfg['host'] ?? 'localhost';
    $user = $cfg['user'] ?? 'root';
    $pass = $cfg['pass'] ?? '';

    if ($driver === 'pdo') {
        $dsn = "mysql:host={$host};charset=utf8mb4";
        return new PDO($dsn, $user, $pass, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]);
    }

    $mysqli = new mysqli($host, $user, $pass);
    if ($mysqli->connect_error) {
        throw new RuntimeException('Koneksi MySQLi gagal: ' . $mysqli->connect_error);
    }
    $mysqli->set_charset('utf8mb4');
    return $mysqli;
}

function db_execute(string $sql, array $params = [], PDO|mysqli|null $conn = null): void
{
    db_query($sql, $params, $conn);
}

/** @return list<array<string, mixed>> */
function db_fetch_all(string $sql, array $params = [], PDO|mysqli|null $conn = null): array
{
    return db_query($sql, $params, $conn);
}

/** @return array<string, mixed>|null */
function db_fetch_one(string $sql, array $params = [], PDO|mysqli|null $conn = null): ?array
{
    $rows = db_query($sql, $params, $conn);
    return $rows[0] ?? null;
}

/** @return list<array<string, mixed>> */
function db_query(string $sql, array $params = [], PDO|mysqli|null $conn = null): array
{
    $conn ??= db_connection();

    if ($conn instanceof PDO) {
        $stmt = $conn->prepare($sql);
        $stmt->execute($params);
        if (stripos(ltrim($sql), 'SELECT') === 0) {
            return $stmt->fetchAll();
        }
        return [];
    }

    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        throw new RuntimeException('Prepare gagal: ' . $conn->error);
    }
    db_mysqli_bind($stmt, $params);
    if (!$stmt->execute()) {
        throw new RuntimeException('Execute gagal: ' . $stmt->error);
    }
    if (stripos(ltrim($sql), 'SELECT') === 0) {
        $result = $stmt->get_result();
        return $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
    }
    return [];
}

function db_last_insert_id(PDO|mysqli|null $conn = null): int
{
    $conn ??= db_connection();
    if ($conn instanceof PDO) {
        return (int) $conn->lastInsertId();
    }
    return (int) $conn->insert_id;
}

function db_run_sql_file(string $path, PDO|mysqli $conn): void
{
    $sql = file_get_contents($path);
    if ($sql === false) {
        throw new RuntimeException('Gagal membaca berkas SQL: ' . $path);
    }

    if ($conn instanceof PDO) {
        foreach (db_split_sql($sql) as $statement) {
            if ($statement !== '') {
                $conn->exec($statement);
            }
        }
        return;
    }

    foreach (db_split_sql($sql) as $statement) {
        if ($statement !== '' && !$conn->query($statement)) {
            throw new RuntimeException('Eksekusi SQL gagal: ' . $conn->error);
        }
    }
}

/** @return list<string> */
function db_split_sql(string $sql): array
{
    $parts = preg_split('/;\s*\R/u', $sql) ?: [];
    $statements = [];
    foreach ($parts as $part) {
        $lines = preg_split('/\R/u', $part) ?: [];
        $filtered = [];
        foreach ($lines as $line) {
            if (str_starts_with(ltrim($line), '--')) {
                continue;
            }
            $filtered[] = $line;
        }
        $statement = trim(implode("\n", $filtered));
        if ($statement !== '') {
            $statements[] = $statement;
        }
    }
    return $statements;
}

function db_mysqli_bind(mysqli_stmt $stmt, array $params): void
{
    if ($params === []) {
        return;
    }
    $types = '';
    $values = [];
    foreach ($params as $param) {
        if (is_int($param)) {
            $types .= 'i';
        } elseif (is_float($param)) {
            $types .= 'd';
        } else {
            $types .= 's';
        }
        $values[] = $param;
    }
    $stmt->bind_param($types, ...$values);
}

function db_item_exists(string $table, int $id): bool
{
    $allowed = [
        'cv_keterampilan',
        'cv_pengalaman',
        'cv_pendidikan',
        'cv_portofolio',
        'cv_sertifikasi',
        'cv_organisasi',
    ];
    if (!in_array($table, $allowed, true)) {
        throw new RuntimeException('Tabel tidak diizinkan.');
    }
    $row = db_fetch_one("SELECT id FROM {$table} WHERE id = ? LIMIT 1", [$id]);
    return $row !== null;
}

function findCvItemById(array $items, int $id): ?array
{
    foreach ($items as $item) {
        if ((int) ($item['id'] ?? 0) === $id) {
            return $item;
        }
    }
    return null;
}
