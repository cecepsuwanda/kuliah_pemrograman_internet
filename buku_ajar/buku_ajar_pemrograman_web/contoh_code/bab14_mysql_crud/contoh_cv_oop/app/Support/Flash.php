<?php

declare(strict_types=1);

namespace App\Support;

class Flash
{
    public static function set(string $type, string $message): void
    {
        $_SESSION['cv_flash'] = ['type' => $type, 'message' => $message];
    }

    public static function pull(): ?array
    {
        if (!isset($_SESSION['cv_flash'])) {
            return null;
        }
        $flash = $_SESSION['cv_flash'];
        unset($_SESSION['cv_flash']);
        return $flash;
    }
}
