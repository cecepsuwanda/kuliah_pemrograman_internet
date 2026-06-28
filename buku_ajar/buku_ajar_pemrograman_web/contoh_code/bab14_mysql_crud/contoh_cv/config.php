<?php

declare(strict_types=1);

function cv_app_root(): string
{
    return __DIR__;
}

function cv_load_config(): array
{
    static $config = null;
    if ($config !== null) {
        return $config;
    }

    $local = cv_app_root() . DIRECTORY_SEPARATOR . 'config.local.php';
    if (is_file($local)) {
        $loaded = require $local;
        if (!is_array($loaded)) {
            throw new RuntimeException('config.local.php harus mengembalikan array.');
        }
        $config = $loaded;
        return $config;
    }

    $sample = cv_app_root() . DIRECTORY_SEPARATOR . 'config.sample.php';
    if (is_file($sample)) {
        $loaded = require $sample;
        if (!is_array($loaded)) {
            throw new RuntimeException('config.sample.php harus mengembalikan array.');
        }
        $config = $loaded;
        return $config;
    }

    throw new RuntimeException('Konfigurasi database belum tersedia. Jalankan instalasi terlebih dahulu.');
}

function cv_is_installed(): bool
{
    return is_file(cv_app_root() . DIRECTORY_SEPARATOR . 'config.local.php');
}

function cv_config_path(): string
{
    return cv_app_root() . DIRECTORY_SEPARATOR . 'config.local.php';
}
