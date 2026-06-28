<?php

declare(strict_types=1);

require_once __DIR__ . '/includes/bootstrap.php';

$uri = $_SERVER['REQUEST_URI'] ?? '/';
$path = parse_url($uri, PHP_URL_PATH) ?? '';

if ($path === '/install.php' || $path === '/install') {
    require __DIR__ . '/install.php';
    return true;
}

if (!cv_is_installed()) {
    header('Location: /install.php');
    exit;
}

cv_boot_app();

if (\App\Core\Router::dispatch($uri)) {
    return true;
}

$file = __DIR__ . rawurldecode($path);

if ($path !== '' && $path !== '/' && is_file($file)) {
    return false;
}

http_response_code(404);
echo '<!DOCTYPE html><html lang="id"><head><meta charset="UTF-8"><title>404</title></head><body>';
echo '<p>Halaman tidak ditemukan.</p>';
echo '<p>Panel admin: <a href="/admin/login.php">/admin/login.php</a></p>';
echo '</body></html>';

return true;
