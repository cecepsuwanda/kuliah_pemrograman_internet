<?php

declare(strict_types=1);

namespace App\Models;

class CvModel
{
    public function load(): array
    {
        return \loadCvData();
    }

    public function updateProfil(array $fields): void
    {
        \updateProfil($fields);
    }

    public function updateRingkasan(string $heading, string $text): void
    {
        \updateRingkasan($heading, $text);
    }

    public function updateKontak(string $heading, string $intro): void
    {
        \updateKontak($heading, $intro);
    }

    public function saveKeterampilan(?int $id, string $heading, string $judul, string $deskripsi): void
    {
        \saveKeterampilan($id, $heading, $judul, $deskripsi);
    }

    public function deleteKeterampilan(int $id): void
    {
        \deleteKeterampilan($id);
    }

    public function savePengalaman(?int $id, string $heading, array $fields): void
    {
        \savePengalaman($id, $heading, $fields);
    }

    public function deletePengalaman(int $id): void
    {
        \deletePengalaman($id);
    }

    public function savePendidikan(?int $id, string $heading, string $caption, array $fields): void
    {
        \savePendidikan($id, $heading, $caption, $fields);
    }

    public function deletePendidikan(int $id): void
    {
        \deletePendidikan($id);
    }

    public function savePortofolio(?int $id, string $heading, string $judul, string $linkHref, string $linkText): void
    {
        \savePortofolio($id, $heading, $judul, $linkHref, $linkText);
    }

    public function deletePortofolio(int $id): void
    {
        \deletePortofolio($id);
    }

    public function saveSertifikasi(?int $id, string $heading, string $nama, string $tahun, string $datetime): void
    {
        \saveSertifikasi($id, $heading, $nama, $tahun, $datetime);
    }

    public function deleteSertifikasi(int $id): void
    {
        \deleteSertifikasi($id);
    }

    public function saveOrganisasi(?int $id, string $heading, string $teks, array $periode): void
    {
        \saveOrganisasi($id, $heading, $teks, $periode);
    }

    public function deleteOrganisasi(int $id): void
    {
        \deleteOrganisasi($id);
    }
}
