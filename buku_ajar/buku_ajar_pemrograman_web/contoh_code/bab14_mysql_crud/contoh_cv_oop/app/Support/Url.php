<?php

declare(strict_types=1);

namespace App\Support;

class Url
{
    public static function admin(string $script): string
    {
        return '/admin/' . ltrim($script, '/');
    }

    public static function cvIndex(): string
    {
        return '/index.php';
    }
}
