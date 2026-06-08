<?php

declare(strict_types=1);

namespace App\Models;

use App\Support\CvFormatter;

class CvModel
{
    private string $dataFile;

    public function __construct(?string $dataFile = null)
    {
        $this->dataFile = $dataFile ?? CV_DATA_FILE;
    }

    public function load(): array
    {
        if (!is_file($this->dataFile)) {
            throw new \RuntimeException('Berkas data CV tidak ditemukan: ' . $this->dataFile);
        }

        $raw = file_get_contents($this->dataFile);
        if ($raw === false) {
            throw new \RuntimeException('Gagal membaca berkas data CV.');
        }

        $data = json_decode($raw, true);
        if (!is_array($data)) {
            throw new \RuntimeException('Format JSON data CV tidak valid.');
        }

        if (!$this->isValid($data)) {
            throw new \RuntimeException('Struktur data CV tidak lengkap.');
        }

        return $data;
    }

    public function save(array $data): void
    {
        if (!$this->isValid($data)) {
            throw new \RuntimeException('Data CV tidak valid, tidak dapat disimpan.');
        }

        $json = json_encode(
            $data,
            JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR
        );

        $dir = dirname($this->dataFile);
        if (!is_dir($dir) && !mkdir($dir, 0775, true) && !is_dir($dir)) {
            throw new \RuntimeException('Folder data CV tidak dapat dibuat.');
        }

        $written = file_put_contents($this->dataFile, $json . "\n", LOCK_EX);
        if ($written === false) {
            throw new \RuntimeException('Gagal menulis berkas data CV.');
        }
    }

    public function updateProfil(array $fields): void
    {
        $cv = $this->load();
        $cv['documentTitle'] = $fields['documentTitle'];
        $cv['metaDescription'] = $fields['metaDescription'];
        $cv['person']['name'] = $fields['name'];
        $cv['person']['role'] = $fields['role'];
        $cv['person']['location'] = $fields['location'];
        $cv['person']['email'] = $fields['email'];
        $cv['person']['phoneE164'] = $fields['phoneE164'];
        $cv['person']['phoneDisplay'] = $fields['phoneDisplay'];
        $cv['person']['website'] = $fields['website'];
        $cv['person']['address'] = $fields['address'];
        $cv['footer']['year'] = (int) $fields['footer_year'];
        $cv['footer']['text'] = $fields['footer_text'];
        $this->save($cv);
    }

    public function updateRingkasan(string $heading, string $text): void
    {
        $cv = $this->load();
        $cv['ringkasan']['heading'] = $heading;
        $cv['ringkasan']['text'] = $text;
        $this->save($cv);
    }

    public function updateKontak(string $heading, string $intro): void
    {
        $cv = $this->load();
        $cv['kontak']['heading'] = $heading;
        $cv['kontak']['intro'] = $intro;
        $this->save($cv);
    }

    public function saveKeterampilan(?int $id, string $heading, string $judul, string $deskripsi): void
    {
        $cv = $this->load();
        $cv['keterampilan']['heading'] = $heading;
        $item = ['judul' => $judul, 'deskripsi' => $deskripsi];
        if ($id !== null && isset($cv['keterampilan']['items'][$id])) {
            $cv['keterampilan']['items'][$id] = $item;
        } else {
            $cv['keterampilan']['items'][] = $item;
        }
        $this->save($cv);
    }

    public function deleteKeterampilan(int $id): void
    {
        $cv = $this->load();
        if (!isset($cv['keterampilan']['items'][$id])) {
            throw new \RuntimeException('Item tidak ditemukan.');
        }
        array_splice($cv['keterampilan']['items'], $id, 1);
        $this->save($cv);
    }

    public function savePengalaman(?int $id, string $heading, array $fields): void
    {
        $cv = $this->load();
        $cv['pengalaman']['heading'] = $heading;
        $item = [
            'judul' => $fields['judul'],
            'mulai' => ['datetime' => $fields['mulai_datetime'], 'label' => $fields['mulai_label']],
            'selesai' => ['datetime' => $fields['selesai_datetime'], 'label' => $fields['selesai_label']],
            'poin' => CvFormatter::parsePoinText($fields['poin']),
        ];
        if ($id !== null && isset($cv['pengalaman']['items'][$id])) {
            $cv['pengalaman']['items'][$id] = $item;
        } else {
            $cv['pengalaman']['items'][] = $item;
        }
        $this->save($cv);
    }

    public function deletePengalaman(int $id): void
    {
        $cv = $this->load();
        if (!isset($cv['pengalaman']['items'][$id])) {
            throw new \RuntimeException('Item tidak ditemukan.');
        }
        array_splice($cv['pengalaman']['items'], $id, 1);
        $this->save($cv);
    }

    public function savePendidikan(?int $id, string $heading, string $caption, array $fields): void
    {
        $cv = $this->load();
        $cv['pendidikan']['heading'] = $heading;
        $cv['pendidikan']['caption'] = $caption;
        $row = [
            'jenjang' => $fields['jenjang'],
            'institusi' => $fields['institusi'],
            'program' => $fields['program'],
            'periodeSegments' => CvFormatter::buildEducationPeriodeSegments(
                $fields['mulai_datetime'],
                $fields['mulai_label'],
                $fields['selesai_label']
            ),
        ];
        if ($id !== null && isset($cv['pendidikan']['rows'][$id])) {
            $cv['pendidikan']['rows'][$id] = $row;
        } else {
            $cv['pendidikan']['rows'][] = $row;
        }
        $this->save($cv);
    }

    public function deletePendidikan(int $id): void
    {
        $cv = $this->load();
        if (!isset($cv['pendidikan']['rows'][$id])) {
            throw new \RuntimeException('Baris tidak ditemukan.');
        }
        array_splice($cv['pendidikan']['rows'], $id, 1);
        $this->save($cv);
    }

    public function savePortofolio(?int $id, string $heading, string $judul, string $linkHref, string $linkText): void
    {
        $cv = $this->load();
        $cv['portofolio']['heading'] = $heading;
        $item = ['judul' => $judul, 'linkHref' => $linkHref, 'linkText' => $linkText];
        if ($id !== null && isset($cv['portofolio']['items'][$id])) {
            $cv['portofolio']['items'][$id] = $item;
        } else {
            $cv['portofolio']['items'][] = $item;
        }
        $this->save($cv);
    }

    public function deletePortofolio(int $id): void
    {
        $cv = $this->load();
        if (!isset($cv['portofolio']['items'][$id])) {
            throw new \RuntimeException('Item tidak ditemukan.');
        }
        array_splice($cv['portofolio']['items'], $id, 1);
        $this->save($cv);
    }

    public function saveSertifikasi(?int $id, string $heading, string $nama, string $tahun, string $datetime): void
    {
        $cv = $this->load();
        $cv['sertifikasi']['heading'] = $heading;
        $item = [
            'nama' => $nama,
            'tahun' => $tahun,
            'datetime' => $datetime !== '' ? $datetime : $tahun,
        ];
        if ($id !== null && isset($cv['sertifikasi']['items'][$id])) {
            $cv['sertifikasi']['items'][$id] = $item;
        } else {
            $cv['sertifikasi']['items'][] = $item;
        }
        $this->save($cv);
    }

    public function deleteSertifikasi(int $id): void
    {
        $cv = $this->load();
        if (!isset($cv['sertifikasi']['items'][$id])) {
            throw new \RuntimeException('Item tidak ditemukan.');
        }
        array_splice($cv['sertifikasi']['items'], $id, 1);
        $this->save($cv);
    }

    public function saveOrganisasi(?int $id, string $heading, string $teks, array $periode): void
    {
        $cv = $this->load();
        $cv['organisasi']['heading'] = $heading;
        $item = [
            'teks' => $teks,
            'periodeSegments' => CvFormatter::buildOrganisasiPeriodeSegments(
                $periode['mulai_datetime'],
                $periode['mulai_label'],
                $periode['akhir_teks']
            ),
        ];
        if ($id !== null && isset($cv['organisasi']['items'][$id])) {
            $cv['organisasi']['items'][$id] = $item;
        } else {
            $cv['organisasi']['items'][] = $item;
        }
        $this->save($cv);
    }

    public function deleteOrganisasi(int $id): void
    {
        $cv = $this->load();
        if (!isset($cv['organisasi']['items'][$id])) {
            throw new \RuntimeException('Item tidak ditemukan.');
        }
        array_splice($cv['organisasi']['items'], $id, 1);
        $this->save($cv);
    }

    private function isValid(mixed $data): bool
    {
        return is_array($data)
            && isset($data['documentTitle'], $data['person'])
            && is_string($data['documentTitle'])
            && is_array($data['person'])
            && isset($data['person']['name'])
            && is_string($data['person']['name']);
    }
}
