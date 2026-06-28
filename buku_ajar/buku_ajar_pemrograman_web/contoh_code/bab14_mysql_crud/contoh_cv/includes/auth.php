<?php

declare(strict_types=1);

// Contoh pembelajaran: kredensial hardcoded. Produksi harus pakai password_hash().
const CV_ADMIN_USER = 'admin';
const CV_ADMIN_PASS = '123456';

function isLoggedIn(): bool
{
    return !empty($_SESSION['cv_admin']);
}

function attemptLogin(string $username, string $password): bool
{
    if ($username === CV_ADMIN_USER && $password === CV_ADMIN_PASS) {
        $_SESSION['cv_admin'] = true;
        return true;
    }
    return false;
}

function requireLogin(): void
{
    if (!isLoggedIn()) {
        redirect('login.php');
    }
}

function logoutAdmin(): void
{
    unset($_SESSION['cv_admin']);
}
