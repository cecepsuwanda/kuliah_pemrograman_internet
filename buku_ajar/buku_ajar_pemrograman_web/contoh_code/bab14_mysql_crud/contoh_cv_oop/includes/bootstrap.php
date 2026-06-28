<?php

declare(strict_types=1);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

define('CV_APP_ROOT', dirname(__DIR__));

require_once CV_APP_ROOT . '/config.php';

spl_autoload_register(static function (string $class): void {
    $prefix = 'App\\';
    if (!str_starts_with($class, $prefix)) {
        return;
    }
    $relative = str_replace('\\', DIRECTORY_SEPARATOR, substr($class, strlen($prefix)));
    $file = CV_APP_ROOT . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . $relative . '.php';
    if (is_file($file)) {
        require_once $file;
    }
});

require_once __DIR__ . '/helpers.php';

function cv_require_installed(): void
{
    if (!cv_is_installed()) {
        $script = basename($_SERVER['SCRIPT_NAME'] ?? '');
        if ($script !== 'install.php' && $script !== 'router.php') {
            header('Location: /install.php');
            exit;
        }
        $path = parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH) ?? '';
        if ($path !== '/install.php' && !str_starts_with($path, '/install')) {
            header('Location: /install.php');
            exit;
        }
    }
}

function cv_boot_app(): void
{
    cv_require_installed();
    require_once __DIR__ . '/database.php';
    require_once __DIR__ . '/cv_repository.php';
}

function admin_url(string $script): string
{
    return \App\Support\Url::admin($script);
}
