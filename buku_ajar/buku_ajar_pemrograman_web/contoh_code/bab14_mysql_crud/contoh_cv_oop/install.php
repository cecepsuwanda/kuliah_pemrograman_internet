<?php

declare(strict_types=1);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/includes/install_bootstrap.php';
require_once __DIR__ . '/includes/install/Installer.php';

$installed = cv_is_installed();
$step = max(1, min(6, (int) ($_GET['step'] ?? ($_POST['step'] ?? 1))));
$errors = [];
$success = null;
$testOk = null;

$defaults = Installer::defaultConfig();
$form = array_merge($defaults, $_SESSION['install_form'] ?? [], [
    'driver' => $_POST['driver'] ?? ($_SESSION['install_form']['driver'] ?? $defaults['driver']),
    'host' => trim((string) ($_POST['host'] ?? ($_SESSION['install_form']['host'] ?? $defaults['host']))),
    'user' => trim((string) ($_POST['user'] ?? ($_SESSION['install_form']['user'] ?? $defaults['user']))),
    'pass' => (string) ($_POST['pass'] ?? ($_SESSION['install_form']['pass'] ?? $defaults['pass'])),
    'dbname' => trim((string) ($_POST['dbname'] ?? ($_SESSION['install_form']['dbname'] ?? $defaults['dbname']))),
]);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    try {
        if ($action === 'reset_wizard') {
            unset($_SESSION['install_form']);
            header('Location: install.php?step=1');
            exit;
        }

        if ($action === 'test_connection') {
            $_SESSION['install_form'] = $form;
            Installer::testConnection($form, $form['driver']);
            $testOk = 'Koneksi berhasil. Database siap digunakan.';
            $step = 4;
        } elseif ($action === 'run_install') {
            if ($installed && empty($_POST['confirm_reinstall'])) {
                throw new RuntimeException('Centang konfirmasi instal ulang terlebih dahulu.');
            }
            $_SESSION['install_form'] = $form;
            $result = Installer::runInstall($form, $form['driver'], true);
            $_SESSION['install_result'] = $result;
            unset($_SESSION['install_form']);
            header('Location: install.php?step=6');
            exit;
        } elseif ($action === 'continue') {
            $_SESSION['install_form'] = $form;
            if ($step === 2 && !in_array($form['driver'], ['pdo', 'mysqli'], true)) {
                throw new RuntimeException('Pilih driver PDO atau MySQLi.');
            }
            header('Location: install.php?step=' . ($step + 1));
            exit;
        }
    } catch (Throwable $e) {
        $errors[] = $e->getMessage();
    }
}

$requirements = Installer::checkRequirements();
$result = $_SESSION['install_result'] ?? null;
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instalasi CV — Bab 14 MySQL</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
<div class="login-box" style="width:720px;max-width:95vw;">
    <div class="card card-outline card-primary">
        <div class="card-header text-center">
            <h1 class="h4 mb-0">Wizard Instalasi — contoh_cv_oop (Bab 14)</h1>
            <p class="mb-0 text-muted small">MySQL + PDO/MySQLi via browser</p>
        </div>
        <div class="card-body">
            <?php if ($installed && $step < 6): ?>
            <div class="alert alert-info">
                Aplikasi sudah terinstal.
                <a href="index.php">Buka CV publik</a> |
                <a href="admin/login.php">Admin</a>
            </div>
            <?php endif; ?>

            <?php foreach ($errors as $err): ?>
            <div class="alert alert-danger"><?= install_h($err) ?></div>
            <?php endforeach; ?>
            <?php if ($testOk): ?>
            <div class="alert alert-success"><?= install_h($testOk) ?></div>
            <?php endif; ?>

            <p class="text-muted">Langkah <?= $step ?> dari 6</p>

            <?php if ($step === 1): ?>
            <h2 class="h5">Prasyarat</h2>
            <ul class="list-group mb-3">
                <?php foreach ($requirements as $check): ?>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <?= install_h($check['label']) ?>
                    <span class="badge badge-<?= $check['ok'] ? 'success' : 'danger' ?>">
                        <?= install_h($check['detail']) ?>
                    </span>
                </li>
                <?php endforeach; ?>
            </ul>
            <form method="post">
                <input type="hidden" name="step" value="1">
                <input type="hidden" name="action" value="continue">
                <button type="submit" class="btn btn-primary">Lanjut</button>
            </form>

            <?php elseif ($step === 2): ?>
            <h2 class="h5">Pilih driver PHP–MySQL</h2>
            <form method="post">
                <input type="hidden" name="step" value="2">
                <input type="hidden" name="action" value="continue">
                <div class="form-group">
                    <div class="custom-control custom-radio">
                        <input class="custom-control-input" type="radio" id="driver_pdo" name="driver" value="pdo"
                            <?= $form['driver'] === 'pdo' ? 'checked' : '' ?> <?= extension_loaded('pdo_mysql') ? '' : 'disabled' ?>>
                        <label class="custom-control-label" for="driver_pdo">PDO (disarankan Bab 14)</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input class="custom-control-input" type="radio" id="driver_mysqli" name="driver" value="mysqli"
                            <?= $form['driver'] === 'mysqli' ? 'checked' : '' ?> <?= extension_loaded('mysqli') ? '' : 'disabled' ?>>
                        <label class="custom-control-label" for="driver_mysqli">MySQLi (OOP)</label>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Lanjut</button>
            </form>

            <?php elseif ($step === 3): ?>
            <h2 class="h5">Konfigurasi koneksi MySQL</h2>
            <form method="post">
                <input type="hidden" name="step" value="3">
                <input type="hidden" name="action" value="continue">
                <input type="hidden" name="driver" value="<?= install_h($form['driver']) ?>">
                <div class="form-group">
                    <label>Host</label>
                    <input type="text" class="form-control" name="host" value="<?= install_h($form['host']) ?>" required>
                </div>
                <div class="form-group">
                    <label>User</label>
                    <input type="text" class="form-control" name="user" value="<?= install_h($form['user']) ?>" required>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" name="pass" value="<?= install_h($form['pass']) ?>">
                </div>
                <div class="form-group">
                    <label>Nama database</label>
                    <input type="text" class="form-control" name="dbname" value="<?= install_h($form['dbname']) ?>" required>
                </div>
                <button type="submit" class="btn btn-primary">Lanjut ke tes koneksi</button>
            </form>

            <?php elseif ($step === 4): ?>
            <h2 class="h5">Tes koneksi</h2>
            <p>Driver: <strong><?= install_h(strtoupper($form['driver'])) ?></strong></p>
            <form method="post" class="mb-3">
                <input type="hidden" name="step" value="4">
                <input type="hidden" name="action" value="test_connection">
                <input type="hidden" name="driver" value="<?= install_h($form['driver']) ?>">
                <input type="hidden" name="host" value="<?= install_h($form['host']) ?>">
                <input type="hidden" name="user" value="<?= install_h($form['user']) ?>">
                <input type="hidden" name="pass" value="<?= install_h($form['pass']) ?>">
                <input type="hidden" name="dbname" value="<?= install_h($form['dbname']) ?>">
                <button type="submit" class="btn btn-info">Tes Koneksi</button>
            </form>
            <?php if ($testOk || !empty($_SESSION['install_form'])): ?>
            <form method="post">
                <input type="hidden" name="step" value="4">
                <input type="hidden" name="action" value="continue">
                <button type="submit" class="btn btn-primary">Lanjut ke instal</button>
            </form>
            <?php endif; ?>

            <?php elseif ($step === 5): ?>
            <h2 class="h5">Jalankan instalasi</h2>
            <p>Schema + seed dari <code>data/cv-data.json</code> akan diimport ke database <strong><?= install_h($form['dbname']) ?></strong>.</p>
            <form method="post">
                <input type="hidden" name="step" value="5">
                <input type="hidden" name="action" value="run_install">
                <input type="hidden" name="driver" value="<?= install_h($form['driver']) ?>">
                <input type="hidden" name="host" value="<?= install_h($form['host']) ?>">
                <input type="hidden" name="user" value="<?= install_h($form['user']) ?>">
                <input type="hidden" name="pass" value="<?= install_h($form['pass']) ?>">
                <input type="hidden" name="dbname" value="<?= install_h($form['dbname']) ?>">
                <?php if ($installed): ?>
                <div class="custom-control custom-checkbox mb-3">
                    <input type="checkbox" class="custom-control-input" id="confirm_reinstall" name="confirm_reinstall" value="1">
                    <label class="custom-control-label" for="confirm_reinstall">Ya, timpa instalasi sebelumnya</label>
                </div>
                <?php endif; ?>
                <button type="submit" class="btn btn-success">Instal Sekarang</button>
            </form>

            <?php elseif ($step === 6 && $result): ?>
            <h2 class="h5 text-success">Instalasi selesai</h2>
            <ul>
                <li>Driver: <strong><?= install_h(strtoupper((string) $result['driver'])) ?></strong></li>
                <li>Database: <strong><?= install_h((string) $result['dbname']) ?></strong></li>
                <li>Keterampilan: <?= (int) ($result['counts']['keterampilan'] ?? 0) ?> baris</li>
                <li>Pengalaman: <?= (int) ($result['counts']['pengalaman'] ?? 0) ?> baris</li>
            </ul>
            <a href="index.php" class="btn btn-primary">Buka CV publik</a>
            <a href="admin/login.php" class="btn btn-secondary">Login admin</a>
            <form method="post" class="mt-3">
                <input type="hidden" name="action" value="reset_wizard">
                <button type="submit" class="btn btn-link p-0">Instal ulang</button>
            </form>
            <?php unset($_SESSION['install_result']); ?>
            <?php else: ?>
            <div class="alert alert-warning">Sesi instalasi tidak lengkap. <a href="install.php?step=1">Mulai ulang</a></div>
            <?php endif; ?>
        </div>
    </div>
</div>
</body>
</html>
