<?php

declare(strict_types=1);

namespace App\Core;

class Router
{
    /** @var array<string, array{0: class-string, 1: string}> */
    private static array $routes = [
        '/index.php' => [\App\Controllers\CvController::class, 'index'],
        '/admin/login.php' => [\App\Controllers\Admin\AuthController::class, 'loginForm'],
        '/admin/logout.php' => [\App\Controllers\Admin\AuthController::class, 'logout'],
        '/admin/index.php' => [\App\Controllers\Admin\DashboardController::class, 'index'],
        '/admin/profil.php' => [\App\Controllers\Admin\ProfilController::class, 'handle'],
        '/admin/ringkasan.php' => [\App\Controllers\Admin\RingkasanController::class, 'handle'],
        '/admin/keterampilan.php' => [\App\Controllers\Admin\KeterampilanController::class, 'handle'],
        '/admin/pengalaman.php' => [\App\Controllers\Admin\PengalamanController::class, 'handle'],
        '/admin/pendidikan.php' => [\App\Controllers\Admin\PendidikanController::class, 'handle'],
        '/admin/portofolio.php' => [\App\Controllers\Admin\PortofolioController::class, 'handle'],
        '/admin/sertifikasi.php' => [\App\Controllers\Admin\SertifikasiController::class, 'handle'],
        '/admin/organisasi.php' => [\App\Controllers\Admin\OrganisasiController::class, 'handle'],
        '/admin/kontak.php' => [\App\Controllers\Admin\KontakController::class, 'handle'],
    ];

    public static function dispatch(string $uri): bool
    {
        $path = self::normalizePath($uri);

        if (!isset(self::$routes[$path])) {
            return false;
        }

        [$class, $method] = self::$routes[$path];
        (new $class())->$method();

        return true;
    }

    private static function normalizePath(string $uri): string
    {
        $path = parse_url($uri, PHP_URL_PATH) ?? '/';
        $path = rawurldecode($path);

        if ($path === '' || $path === '/') {
            return '/index.php';
        }

        if (strlen($path) > 1 && str_ends_with($path, '/')) {
            $path = rtrim($path, '/');
        }

        if ($path === '/admin') {
            return !empty($_SESSION['cv_admin']) ? '/admin/index.php' : '/admin/login.php';
        }

        if (preg_match('#^/admin/([a-z_]+)$#i', $path, $matches)) {
            $candidate = '/admin/' . strtolower($matches[1]) . '.php';
            if (isset(self::$routes[$candidate])) {
                return $candidate;
            }
        }

        return $path;
    }
}
