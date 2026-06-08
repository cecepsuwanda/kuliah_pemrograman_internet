<?php

declare(strict_types=1);

namespace App\Support;

class Request
{
    public static function method(): string
    {
        return $_SERVER['REQUEST_METHOD'] ?? 'GET';
    }

    public static function isPost(): bool
    {
        return self::method() === 'POST';
    }

    public static function postString(string $key, string $default = ''): string
    {
        return isset($_POST[$key]) ? trim((string) $_POST[$key]) : $default;
    }

    public static function getInt(string $key): ?int
    {
        return isset($_GET[$key]) ? (int) $_GET[$key] : null;
    }

    public static function postInt(string $key): ?int
    {
        return isset($_POST[$key]) ? (int) $_POST[$key] : null;
    }

    /** ID edit dari query (?id=) atau hidden field POST setelah validasi gagal. */
    public static function editId(): ?int
    {
        $fromGet = self::getInt('id');
        if ($fromGet !== null) {
            return $fromGet;
        }

        if (self::isPost() && isset($_POST['id']) && $_POST['id'] !== '') {
            return (int) $_POST['id'];
        }

        return null;
    }
}
