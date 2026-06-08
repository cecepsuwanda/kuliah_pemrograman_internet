<?php

declare(strict_types=1);

function isValidCvData(mixed $data): bool
{
    return is_array($data)
        && isset($data['documentTitle'], $data['person'])
        && is_string($data['documentTitle'])
        && is_array($data['person'])
        && isset($data['person']['name'])
        && is_string($data['person']['name']);
}

function loadCvData(): array
{
    if (!is_file(CV_DATA_FILE)) {
        throw new RuntimeException('Berkas data CV tidak ditemukan: ' . CV_DATA_FILE);
    }

    $raw = file_get_contents(CV_DATA_FILE);
    if ($raw === false) {
        throw new RuntimeException('Gagal membaca berkas data CV.');
    }

    $data = json_decode($raw, true);
    if (!is_array($data)) {
        throw new RuntimeException('Format JSON data CV tidak valid.');
    }

    if (!isValidCvData($data)) {
        throw new RuntimeException('Struktur data CV tidak lengkap.');
    }

    return $data;
}

function saveCvData(array $data): void
{
    if (!isValidCvData($data)) {
        throw new RuntimeException('Data CV tidak valid, tidak dapat disimpan.');
    }

    $json = json_encode(
        $data,
        JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR
    );

    $dir = dirname(CV_DATA_FILE);
    if (!is_dir($dir) && !mkdir($dir, 0775, true) && !is_dir($dir)) {
        throw new RuntimeException('Folder data CV tidak dapat dibuat.');
    }

    $written = file_put_contents(CV_DATA_FILE, $json . "\n", LOCK_EX);
    if ($written === false) {
        throw new RuntimeException('Gagal menulis berkas data CV.');
    }
}
