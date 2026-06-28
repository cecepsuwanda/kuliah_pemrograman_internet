<?php

declare(strict_types=1);

class SeedData
{
    /**
     * @return array{meta:int,keterampilan:int,pengalaman:int,pendidikan:int,portofolio:int,sertifikasi:int,organisasi:int}
     */
    public static function seedFromJson(string $jsonPath, PDO|mysqli $conn, bool $truncate = true): array
    {
        if (!is_file($jsonPath)) {
            throw new RuntimeException('Berkas seed JSON tidak ditemukan: ' . $jsonPath);
        }

        $raw = file_get_contents($jsonPath);
        if ($raw === false) {
            throw new RuntimeException('Gagal membaca berkas seed JSON.');
        }

        $data = json_decode($raw, true);
        if (!is_array($data)) {
            throw new RuntimeException('Format JSON seed tidak valid.');
        }

        if ($truncate) {
            self::truncateAll($conn);
        }

        self::insertMeta($conn, $data);

        $counts = [
            'meta' => 1,
            'keterampilan' => self::insertKeterampilan($conn, $data),
            'pengalaman' => self::insertPengalaman($conn, $data),
            'pendidikan' => self::insertPendidikan($conn, $data),
            'portofolio' => self::insertPortofolio($conn, $data),
            'sertifikasi' => self::insertSertifikasi($conn, $data),
            'organisasi' => self::insertOrganisasi($conn, $data),
        ];

        return $counts;
    }

    public static function truncateAll(PDO|mysqli $conn): void
    {
        self::exec($conn, 'SET FOREIGN_KEY_CHECKS = 0');
        foreach ([
            'cv_pengalaman_poin',
            'cv_pengalaman',
            'cv_keterampilan',
            'cv_pendidikan',
            'cv_portofolio',
            'cv_sertifikasi',
            'cv_organisasi',
            'cv_meta',
        ] as $table) {
            self::exec($conn, "TRUNCATE TABLE {$table}");
        }
        self::exec($conn, 'SET FOREIGN_KEY_CHECKS = 1');
    }

    private static function insertMeta(PDO|mysqli $conn, array $data): void
    {
        $person = $data['person'];
        $footer = $data['footer'];
        self::execute(
            $conn,
            'INSERT INTO cv_meta (
                id, document_title, meta_description,
                person_name, person_role, person_location, person_email,
                person_phone_e164, person_phone_display, person_website, person_address,
                ringkasan_heading, ringkasan_text,
                keterampilan_heading, pengalaman_heading,
                pendidikan_heading, pendidikan_caption,
                portofolio_heading, sertifikasi_heading, organisasi_heading,
                kontak_heading, kontak_intro, footer_year, footer_text
            ) VALUES (
                1, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?
            )',
            [
                $data['documentTitle'],
                $data['metaDescription'] ?? '',
                $person['name'],
                $person['role'],
                $person['location'],
                $person['email'],
                $person['phoneE164'],
                $person['phoneDisplay'],
                $person['website'],
                $person['address'] ?? '',
                $data['ringkasan']['heading'],
                $data['ringkasan']['text'],
                $data['keterampilan']['heading'],
                $data['pengalaman']['heading'],
                $data['pendidikan']['heading'],
                $data['pendidikan']['caption'],
                $data['portofolio']['heading'],
                $data['sertifikasi']['heading'],
                $data['organisasi']['heading'],
                $data['kontak']['heading'],
                $data['kontak']['intro'],
                (int) $footer['year'],
                $footer['text'],
            ]
        );
    }

    private static function insertKeterampilan(PDO|mysqli $conn, array $data): int
    {
        $count = 0;
        foreach ($data['keterampilan']['items'] as $i => $item) {
            self::execute(
                $conn,
                'INSERT INTO cv_keterampilan (judul, deskripsi, urutan) VALUES (?, ?, ?)',
                [$item['judul'], $item['deskripsi'], $i + 1]
            );
            $count++;
        }
        return $count;
    }

    private static function insertPengalaman(PDO|mysqli $conn, array $data): int
    {
        $count = 0;
        foreach ($data['pengalaman']['items'] as $i => $item) {
            self::execute(
                $conn,
                'INSERT INTO cv_pengalaman (judul, mulai_datetime, mulai_label, selesai_datetime, selesai_label, urutan)
                 VALUES (?, ?, ?, ?, ?, ?)',
                [
                    $item['judul'],
                    $item['mulai']['datetime'],
                    $item['mulai']['label'],
                    $item['selesai']['datetime'],
                    $item['selesai']['label'],
                    $i + 1,
                ]
            );
            $pengalamanId = self::lastInsertId($conn);
            foreach ($item['poin'] as $j => $teks) {
                self::execute(
                    $conn,
                    'INSERT INTO cv_pengalaman_poin (pengalaman_id, teks, urutan) VALUES (?, ?, ?)',
                    [$pengalamanId, $teks, $j + 1]
                );
            }
            $count++;
        }
        return $count;
    }

    private static function insertPendidikan(PDO|mysqli $conn, array $data): int
    {
        $count = 0;
        foreach ($data['pendidikan']['rows'] as $i => $row) {
            [$mulaiDt, $mulaiLabel, $selesaiLabel] = self::parseEducationPeriode($row);
            self::execute(
                $conn,
                'INSERT INTO cv_pendidikan (jenjang, institusi, program, mulai_datetime, mulai_label, selesai_label, urutan)
                 VALUES (?, ?, ?, ?, ?, ?, ?)',
                [
                    $row['jenjang'],
                    $row['institusi'],
                    $row['program'],
                    $mulaiDt,
                    $mulaiLabel,
                    $selesaiLabel,
                    $i + 1,
                ]
            );
            $count++;
        }
        return $count;
    }

    private static function insertPortofolio(PDO|mysqli $conn, array $data): int
    {
        $count = 0;
        foreach ($data['portofolio']['items'] as $i => $item) {
            self::execute(
                $conn,
                'INSERT INTO cv_portofolio (judul, link_href, link_text, urutan) VALUES (?, ?, ?, ?)',
                [$item['judul'], $item['linkHref'], $item['linkText'], $i + 1]
            );
            $count++;
        }
        return $count;
    }

    private static function insertSertifikasi(PDO|mysqli $conn, array $data): int
    {
        $count = 0;
        foreach ($data['sertifikasi']['items'] as $i => $item) {
            self::execute(
                $conn,
                'INSERT INTO cv_sertifikasi (nama, tahun, datetime, urutan) VALUES (?, ?, ?, ?)',
                [$item['nama'], $item['tahun'], $item['datetime'], $i + 1]
            );
            $count++;
        }
        return $count;
    }

    private static function insertOrganisasi(PDO|mysqli $conn, array $data): int
    {
        $count = 0;
        foreach ($data['organisasi']['items'] as $i => $item) {
            [$mulaiDt, $mulaiLabel, $akhirTeks] = self::parseOrganisasiPeriode($item);
            self::execute(
                $conn,
                'INSERT INTO cv_organisasi (teks, mulai_datetime, mulai_label, akhir_teks, urutan) VALUES (?, ?, ?, ?, ?)',
                [$item['teks'], $mulaiDt, $mulaiLabel, $akhirTeks, $i + 1]
            );
            $count++;
        }
        return $count;
    }

    /** @return array{0:string,1:string,2:string} */
    private static function parseEducationPeriode(array $row): array
    {
        $mulaiDatetimeVal = '';
        $mulaiLabelVal = '';
        $selesaiLabelVal = '';

        foreach ($row['periodeSegments'] as $seg) {
            if (($seg['type'] ?? '') === 'time' && $mulaiLabelVal === '') {
                $mulaiDatetimeVal = $seg['datetime'] ?? '';
                $mulaiLabelVal = $seg['label'] ?? '';
            } elseif (($seg['type'] ?? '') === 'time' && $mulaiLabelVal !== '') {
                $selesaiLabelVal = $seg['label'] ?? '';
            } elseif (($seg['type'] ?? '') === 'text' && str_contains($seg['value'] ?? '', 'Sekarang')) {
                $selesaiLabelVal = 'Sekarang';
            }
        }

        return [$mulaiDatetimeVal, $mulaiLabelVal, $selesaiLabelVal];
    }

    /** @return array{0:string,1:string,2:string} */
    private static function parseOrganisasiPeriode(array $item): array
    {
        $mulaiDatetimeVal = '';
        $mulaiLabelVal = '';
        $akhirTeksVal = 'Sekarang';

        foreach ($item['periodeSegments'] as $seg) {
            if (($seg['type'] ?? '') === 'time') {
                $mulaiDatetimeVal = $seg['datetime'] ?? '';
                $mulaiLabelVal = $seg['label'] ?? '';
            } elseif (($seg['type'] ?? '') === 'text' && str_contains($seg['value'] ?? '', '–')) {
                if (preg_match('/–\s*(.+)\)/', $seg['value'], $m)) {
                    $akhirTeksVal = trim($m[1]);
                }
            }
        }

        return [$mulaiDatetimeVal, $mulaiLabelVal, $akhirTeksVal];
    }

    private static function exec(PDO|mysqli $conn, string $sql): void
    {
        if ($conn instanceof PDO) {
            $conn->exec($sql);
            return;
        }
        if (!$conn->query($sql)) {
            throw new RuntimeException('Eksekusi SQL gagal: ' . $conn->error);
        }
    }

    private static function execute(PDO|mysqli $conn, string $sql, array $params): void
    {
        if ($conn instanceof PDO) {
            $stmt = $conn->prepare($sql);
            $stmt->execute($params);
            return;
        }

        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            throw new RuntimeException('Prepare gagal: ' . $conn->error);
        }
        self::mysqliBind($stmt, $params);
        if (!$stmt->execute()) {
            throw new RuntimeException('Execute gagal: ' . $stmt->error);
        }
    }

    private static function lastInsertId(PDO|mysqli $conn): int
    {
        if ($conn instanceof PDO) {
            return (int) $conn->lastInsertId();
        }
        return (int) $conn->insert_id;
    }

    private static function mysqliBind(mysqli_stmt $stmt, array $params): void
    {
        if ($params === []) {
            return;
        }
        $types = '';
        foreach ($params as $param) {
            $types .= is_int($param) ? 'i' : (is_float($param) ? 'd' : 's');
        }
        $stmt->bind_param($types, ...$params);
    }
}
