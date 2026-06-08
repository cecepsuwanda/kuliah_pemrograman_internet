<?php

declare(strict_types=1);

/**
 * Router untuk PHP built-in server (php -S ... router.php).
 * Menggantikan folder admin/ — semua URL admin didefinisikan di App\Core\Router.
 */

require_once __DIR__ . '/includes/bootstrap.php';

$uri = $_SERVER['REQUEST_URI'] ?? '/';

if (\App\Core\Router::dispatch($uri)) {
    return true;
}

$path = parse_url($uri, PHP_URL_PATH) ?? '';
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
