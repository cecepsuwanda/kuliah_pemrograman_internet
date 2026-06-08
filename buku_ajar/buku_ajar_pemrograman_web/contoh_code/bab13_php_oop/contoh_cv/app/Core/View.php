<?php

declare(strict_types=1);

namespace App\Core;

class View
{
    public static function render(string $name, array $data = []): void
    {
        extract($data, EXTR_SKIP);
        $path = CV_APP_ROOT . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . str_replace('/', DIRECTORY_SEPARATOR, $name) . '.php';
        if (!is_file($path)) {
            throw new \RuntimeException('View tidak ditemukan: ' . $name);
        }
        require $path;
    }
}
