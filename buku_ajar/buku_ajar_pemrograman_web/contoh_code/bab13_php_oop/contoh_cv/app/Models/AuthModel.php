<?php

declare(strict_types=1);

namespace App\Models;

use App\Support\Url;

class AuthModel
{
    private const ADMIN_USER = 'admin';
    private const ADMIN_PASS = '123456';

    public function isLoggedIn(): bool
    {
        return !empty($_SESSION['cv_admin']);
    }

    public function attemptLogin(string $username, string $password): bool
    {
        if ($username === self::ADMIN_USER && $password === self::ADMIN_PASS) {
            $_SESSION['cv_admin'] = true;
            return true;
        }
        return false;
    }

    public function requireLogin(): void
    {
        if (!$this->isLoggedIn()) {
            header('Location: ' . Url::admin('login.php'));
            exit;
        }
    }

    public function logout(): void
    {
        unset($_SESSION['cv_admin']);
    }
}
