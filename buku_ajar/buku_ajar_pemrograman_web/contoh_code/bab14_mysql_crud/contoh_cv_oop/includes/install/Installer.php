<?php

declare(strict_types=1);

require_once __DIR__ . '/../database.php';
require_once __DIR__ . '/SeedData.php';

class Installer
{
    public static function appRoot(): string
    {
        return dirname(__DIR__, 2);
    }

    /** @return list<array{label:string,ok:bool,detail:string}> */
    public static function checkRequirements(): array
    {
        $checks = [];
        $checks[] = [
            'label' => 'Versi PHP >= 8.1',
            'ok' => version_compare(PHP_VERSION, '8.1.0', '>='),
            'detail' => 'Saat ini: ' . PHP_VERSION,
        ];
        $checks[] = [
            'label' => 'Ekstensi pdo_mysql',
            'ok' => extension_loaded('pdo_mysql'),
            'detail' => extension_loaded('pdo_mysql') ? 'Tersedia' : 'Tidak ditemukan',
        ];
        $checks[] = [
            'label' => 'Ekstensi mysqli',
            'ok' => extension_loaded('mysqli'),
            'detail' => extension_loaded('mysqli') ? 'Tersedia' : 'Tidak ditemukan',
        ];
        $writable = is_writable(self::appRoot());
        $checks[] = [
            'label' => 'Folder proyek dapat ditulis',
            'ok' => $writable,
            'detail' => $writable ? self::appRoot() : 'Tidak dapat menulis config.local.php',
        ];
        $jsonPath = self::appRoot() . '/data/cv-data.json';
        $checks[] = [
            'label' => 'Berkas seed JSON',
            'ok' => is_file($jsonPath),
            'detail' => $jsonPath,
        ];

        return $checks;
    }

    public static function defaultConfig(): array
    {
        $sample = self::appRoot() . '/config.sample.php';
        if (is_file($sample)) {
            $cfg = require $sample;
            if (is_array($cfg)) {
                return $cfg;
            }
        }

        return [
            'driver' => 'pdo',
            'host' => 'localhost',
            'dbname' => 'cv_portfolio',
            'user' => 'root',
            'pass' => '',
        ];
    }

    public static function testConnection(array $config, string $driver): void
    {
        self::assertDriver($driver);
        $conn = db_connect_server($config, $driver);
        $dbname = $config['dbname'] ?? 'cv_portfolio';
        $safeDb = preg_replace('/[^a-zA-Z0-9_]/', '', $dbname) ?: 'cv_portfolio';
        self::execRaw($conn, "CREATE DATABASE IF NOT EXISTS `{$safeDb}` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
    }

    /**
     * @return array{counts:array<string,int>,driver:string,dbname:string}
     */
    public static function runInstall(array $config, string $driver, bool $forceReseed = true): array
    {
        self::assertDriver($driver);
        self::testConnection($config, $driver);

        $conn = db_connect_with_config($config, $driver);
        $schemaPath = self::appRoot() . '/schema.sql';
        db_run_sql_file($schemaPath, $conn);

        $jsonPath = self::appRoot() . '/data/cv-data.json';
        $counts = SeedData::seedFromJson($jsonPath, $conn, $forceReseed);

        $config['driver'] = $driver;
        $config['installed_at'] = date('c');
        self::writeConfigLocal($config);

        $GLOBALS['cv_db_connection'] = null;

        return [
            'counts' => $counts,
            'driver' => $driver,
            'dbname' => $config['dbname'] ?? 'cv_portfolio',
        ];
    }

    public static function writeConfigLocal(array $config): void
    {
        $path = self::appRoot() . '/config.local.php';
        $export = var_export([
            'driver' => $config['driver'] ?? 'pdo',
            'host' => $config['host'] ?? 'localhost',
            'dbname' => $config['dbname'] ?? 'cv_portfolio',
            'user' => $config['user'] ?? 'root',
            'pass' => $config['pass'] ?? '',
            'installed_at' => $config['installed_at'] ?? date('c'),
        ], true);

        $content = "<?php\n\ndeclare(strict_types=1);\n\nreturn {$export};\n";
        if (file_put_contents($path, $content) === false) {
            throw new RuntimeException('Gagal menulis config.local.php');
        }
    }

    private static function assertDriver(string $driver): void
    {
        if (!in_array($driver, ['pdo', 'mysqli'], true)) {
            throw new RuntimeException('Driver tidak valid.');
        }
        if ($driver === 'pdo' && !extension_loaded('pdo_mysql')) {
            throw new RuntimeException('Ekstensi pdo_mysql belum aktif.');
        }
        if ($driver === 'mysqli' && !extension_loaded('mysqli')) {
            throw new RuntimeException('Ekstensi mysqli belum aktif.');
        }
    }

    private static function execRaw(PDO|mysqli $conn, string $sql): void
    {
        if ($conn instanceof PDO) {
            $conn->exec($sql);
            return;
        }
        if (!$conn->query($sql)) {
            throw new RuntimeException('Eksekusi SQL gagal: ' . $conn->error);
        }
    }
}
