<?php

declare(strict_types=1);

require_once __DIR__ . '/database.php';
require_once __DIR__ . '/helpers.php';

function cv_static_nav_items(): array
{
    return [
        ['hash' => 'ringkasan', 'label' => 'Ringkasan'],
        ['hash' => 'keterampilan', 'label' => 'Keterampilan'],
        ['hash' => 'pengalaman', 'label' => 'Pengalaman'],
        ['hash' => 'pendidikan', 'label' => 'Pendidikan'],
        ['hash' => 'portofolio', 'label' => 'Portofolio'],
        ['hash' => 'sertifikasi', 'label' => 'Sertifikasi'],
        ['hash' => 'organisasi', 'label' => 'Organisasi'],
        ['hash' => 'kontak', 'label' => 'Kontak'],
    ];
}

function loadCvData(): array
{
    $meta = db_fetch_one('SELECT * FROM cv_meta WHERE id = 1 LIMIT 1');
    if ($meta === null) {
        throw new RuntimeException('Data CV belum diinstal. Jalankan wizard instalasi terlebih dahulu.');
    }

    $keterampilanRows = db_fetch_all('SELECT id, judul, deskripsi FROM cv_keterampilan ORDER BY urutan ASC, id ASC');
    $keterampilanItems = [];
    foreach ($keterampilanRows as $row) {
        $keterampilanItems[] = [
            'id' => (int) $row['id'],
            'judul' => $row['judul'],
            'deskripsi' => $row['deskripsi'],
        ];
    }

    $pengalamanRows = db_fetch_all('SELECT * FROM cv_pengalaman ORDER BY urutan ASC, id ASC');
    $pengalamanItems = [];
    foreach ($pengalamanRows as $row) {
        $poinRows = db_fetch_all(
            'SELECT teks FROM cv_pengalaman_poin WHERE pengalaman_id = ? ORDER BY urutan ASC, id ASC',
            [(int) $row['id']]
        );
        $poin = array_column($poinRows, 'teks');
        $pengalamanItems[] = [
            'id' => (int) $row['id'],
            'judul' => $row['judul'],
            'mulai' => ['datetime' => $row['mulai_datetime'], 'label' => $row['mulai_label']],
            'selesai' => ['datetime' => $row['selesai_datetime'], 'label' => $row['selesai_label']],
            'poin' => $poin,
        ];
    }

    $pendidikanRows = db_fetch_all('SELECT * FROM cv_pendidikan ORDER BY urutan ASC, id ASC');
    $pendidikanItems = [];
    foreach ($pendidikanRows as $row) {
        $pendidikanItems[] = [
            'id' => (int) $row['id'],
            'jenjang' => $row['jenjang'],
            'institusi' => $row['institusi'],
            'program' => $row['program'],
            'periodeSegments' => buildEducationPeriodeSegments(
                $row['mulai_datetime'],
                $row['mulai_label'],
                $row['selesai_label']
            ),
        ];
    }

    $portofolioRows = db_fetch_all('SELECT * FROM cv_portofolio ORDER BY urutan ASC, id ASC');
    $portofolioItems = [];
    foreach ($portofolioRows as $row) {
        $portofolioItems[] = [
            'id' => (int) $row['id'],
            'judul' => $row['judul'],
            'linkHref' => $row['link_href'],
            'linkText' => $row['link_text'],
        ];
    }

    $sertifikasiRows = db_fetch_all('SELECT * FROM cv_sertifikasi ORDER BY urutan ASC, id ASC');
    $sertifikasiItems = [];
    foreach ($sertifikasiRows as $row) {
        $sertifikasiItems[] = [
            'id' => (int) $row['id'],
            'nama' => $row['nama'],
            'tahun' => $row['tahun'],
            'datetime' => $row['datetime'],
        ];
    }

    $organisasiRows = db_fetch_all('SELECT * FROM cv_organisasi ORDER BY urutan ASC, id ASC');
    $organisasiItems = [];
    foreach ($organisasiRows as $row) {
        $organisasiItems[] = [
            'id' => (int) $row['id'],
            'teks' => $row['teks'],
            'periodeSegments' => buildOrganisasiPeriodeSegments(
                $row['mulai_datetime'],
                $row['mulai_label'],
                $row['akhir_teks']
            ),
        ];
    }

    return [
        'documentTitle' => $meta['document_title'],
        'metaDescription' => $meta['meta_description'] ?? '',
        'person' => [
            'name' => $meta['person_name'],
            'role' => $meta['person_role'],
            'location' => $meta['person_location'],
            'email' => $meta['person_email'],
            'phoneE164' => $meta['person_phone_e164'],
            'phoneDisplay' => $meta['person_phone_display'],
            'website' => $meta['person_website'],
            'address' => $meta['person_address'] ?? '',
        ],
        'navItems' => cv_static_nav_items(),
        'ringkasan' => [
            'heading' => $meta['ringkasan_heading'],
            'text' => $meta['ringkasan_text'] ?? '',
        ],
        'keterampilan' => [
            'heading' => $meta['keterampilan_heading'],
            'items' => $keterampilanItems,
        ],
        'pengalaman' => [
            'heading' => $meta['pengalaman_heading'],
            'items' => $pengalamanItems,
        ],
        'pendidikan' => [
            'heading' => $meta['pendidikan_heading'],
            'caption' => $meta['pendidikan_caption'],
            'rows' => $pendidikanItems,
        ],
        'portofolio' => [
            'heading' => $meta['portofolio_heading'],
            'items' => $portofolioItems,
        ],
        'sertifikasi' => [
            'heading' => $meta['sertifikasi_heading'],
            'items' => $sertifikasiItems,
        ],
        'organisasi' => [
            'heading' => $meta['organisasi_heading'],
            'items' => $organisasiItems,
        ],
        'kontak' => [
            'heading' => $meta['kontak_heading'],
            'intro' => $meta['kontak_intro'] ?? '',
        ],
        'footer' => [
            'year' => (int) $meta['footer_year'],
            'text' => $meta['footer_text'],
        ],
    ];
}

function updateProfil(array $fields): void
{
    db_execute(
        'UPDATE cv_meta SET
            document_title = ?, meta_description = ?,
            person_name = ?, person_role = ?, person_location = ?,
            person_email = ?, person_phone_e164 = ?, person_phone_display = ?,
            person_website = ?, person_address = ?,
            footer_year = ?, footer_text = ?
         WHERE id = 1',
        [
            $fields['documentTitle'],
            $fields['metaDescription'],
            $fields['name'],
            $fields['role'],
            $fields['location'],
            $fields['email'],
            $fields['phoneE164'],
            $fields['phoneDisplay'],
            $fields['website'],
            $fields['address'],
            (int) $fields['footer_year'],
            $fields['footer_text'],
        ]
    );
}

function updateRingkasan(string $heading, string $text): void
{
    db_execute(
        'UPDATE cv_meta SET ringkasan_heading = ?, ringkasan_text = ? WHERE id = 1',
        [$heading, $text]
    );
}

function updateKontak(string $heading, string $intro): void
{
    db_execute(
        'UPDATE cv_meta SET kontak_heading = ?, kontak_intro = ? WHERE id = 1',
        [$heading, $intro]
    );
}

function saveKeterampilan(?int $id, string $heading, string $judul, string $deskripsi): void
{
    db_execute('UPDATE cv_meta SET keterampilan_heading = ? WHERE id = 1', [$heading]);
    if ($id !== null) {
        if (!db_item_exists('cv_keterampilan', $id)) {
            throw new RuntimeException('Item tidak ditemukan.');
        }
        db_execute(
            'UPDATE cv_keterampilan SET judul = ?, deskripsi = ? WHERE id = ?',
            [$judul, $deskripsi, $id]
        );
        return;
    }
    $urutan = cv_next_urutan('cv_keterampilan');
    db_execute(
        'INSERT INTO cv_keterampilan (judul, deskripsi, urutan) VALUES (?, ?, ?)',
        [$judul, $deskripsi, $urutan]
    );
}

function deleteKeterampilan(int $id): void
{
    if (!db_item_exists('cv_keterampilan', $id)) {
        throw new RuntimeException('Item tidak ditemukan.');
    }
    db_execute('DELETE FROM cv_keterampilan WHERE id = ?', [$id]);
}

function savePengalaman(?int $id, string $heading, array $fields): void
{
    db_execute('UPDATE cv_meta SET pengalaman_heading = ? WHERE id = 1', [$heading]);
    $poin = parsePoinText($fields['poin']);

    if ($id !== null) {
        if (!db_item_exists('cv_pengalaman', $id)) {
            throw new RuntimeException('Item tidak ditemukan.');
        }
        db_execute(
            'UPDATE cv_pengalaman SET judul = ?, mulai_datetime = ?, mulai_label = ?, selesai_datetime = ?, selesai_label = ? WHERE id = ?',
            [
                $fields['judul'],
                $fields['mulai_datetime'],
                $fields['mulai_label'],
                $fields['selesai_datetime'],
                $fields['selesai_label'],
                $id,
            ]
        );
        db_execute('DELETE FROM cv_pengalaman_poin WHERE pengalaman_id = ?', [$id]);
        cv_insert_pengalaman_poin($id, $poin);
        return;
    }

    $urutan = cv_next_urutan('cv_pengalaman');
    db_execute(
        'INSERT INTO cv_pengalaman (judul, mulai_datetime, mulai_label, selesai_datetime, selesai_label, urutan)
         VALUES (?, ?, ?, ?, ?, ?)',
        [
            $fields['judul'],
            $fields['mulai_datetime'],
            $fields['mulai_label'],
            $fields['selesai_datetime'],
            $fields['selesai_label'],
            $urutan,
        ]
    );
    $newId = db_last_insert_id();
    cv_insert_pengalaman_poin($newId, $poin);
}

function cv_insert_pengalaman_poin(int $pengalamanId, array $poin): void
{
    foreach ($poin as $i => $teks) {
        db_execute(
            'INSERT INTO cv_pengalaman_poin (pengalaman_id, teks, urutan) VALUES (?, ?, ?)',
            [$pengalamanId, $teks, $i + 1]
        );
    }
}

function deletePengalaman(int $id): void
{
    if (!db_item_exists('cv_pengalaman', $id)) {
        throw new RuntimeException('Item tidak ditemukan.');
    }
    db_execute('DELETE FROM cv_pengalaman WHERE id = ?', [$id]);
}

function savePendidikan(?int $id, string $heading, string $caption, array $fields): void
{
    db_execute(
        'UPDATE cv_meta SET pendidikan_heading = ?, pendidikan_caption = ? WHERE id = 1',
        [$heading, $caption]
    );

    if ($id !== null) {
        if (!db_item_exists('cv_pendidikan', $id)) {
            throw new RuntimeException('Baris tidak ditemukan.');
        }
        db_execute(
            'UPDATE cv_pendidikan SET jenjang = ?, institusi = ?, program = ?, mulai_datetime = ?, mulai_label = ?, selesai_label = ? WHERE id = ?',
            [
                $fields['jenjang'],
                $fields['institusi'],
                $fields['program'],
                $fields['mulai_datetime'],
                $fields['mulai_label'],
                $fields['selesai_label'],
                $id,
            ]
        );
        return;
    }

    $urutan = cv_next_urutan('cv_pendidikan');
    db_execute(
        'INSERT INTO cv_pendidikan (jenjang, institusi, program, mulai_datetime, mulai_label, selesai_label, urutan)
         VALUES (?, ?, ?, ?, ?, ?, ?)',
        [
            $fields['jenjang'],
            $fields['institusi'],
            $fields['program'],
            $fields['mulai_datetime'],
            $fields['mulai_label'],
            $fields['selesai_label'],
            $urutan,
        ]
    );
}

function deletePendidikan(int $id): void
{
    if (!db_item_exists('cv_pendidikan', $id)) {
        throw new RuntimeException('Baris tidak ditemukan.');
    }
    db_execute('DELETE FROM cv_pendidikan WHERE id = ?', [$id]);
}

function savePortofolio(?int $id, string $heading, string $judul, string $linkHref, string $linkText): void
{
    db_execute('UPDATE cv_meta SET portofolio_heading = ? WHERE id = 1', [$heading]);
    if ($id !== null) {
        if (!db_item_exists('cv_portofolio', $id)) {
            throw new RuntimeException('Item tidak ditemukan.');
        }
        db_execute(
            'UPDATE cv_portofolio SET judul = ?, link_href = ?, link_text = ? WHERE id = ?',
            [$judul, $linkHref, $linkText, $id]
        );
        return;
    }
    $urutan = cv_next_urutan('cv_portofolio');
    db_execute(
        'INSERT INTO cv_portofolio (judul, link_href, link_text, urutan) VALUES (?, ?, ?, ?)',
        [$judul, $linkHref, $linkText, $urutan]
    );
}

function deletePortofolio(int $id): void
{
    if (!db_item_exists('cv_portofolio', $id)) {
        throw new RuntimeException('Item tidak ditemukan.');
    }
    db_execute('DELETE FROM cv_portofolio WHERE id = ?', [$id]);
}

function saveSertifikasi(?int $id, string $heading, string $nama, string $tahun, string $datetime): void
{
    db_execute('UPDATE cv_meta SET sertifikasi_heading = ? WHERE id = 1', [$heading]);
    $dt = $datetime !== '' ? $datetime : $tahun;
    if ($id !== null) {
        if (!db_item_exists('cv_sertifikasi', $id)) {
            throw new RuntimeException('Item tidak ditemukan.');
        }
        db_execute(
            'UPDATE cv_sertifikasi SET nama = ?, tahun = ?, datetime = ? WHERE id = ?',
            [$nama, $tahun, $dt, $id]
        );
        return;
    }
    $urutan = cv_next_urutan('cv_sertifikasi');
    db_execute(
        'INSERT INTO cv_sertifikasi (nama, tahun, datetime, urutan) VALUES (?, ?, ?, ?)',
        [$nama, $tahun, $dt, $urutan]
    );
}

function deleteSertifikasi(int $id): void
{
    if (!db_item_exists('cv_sertifikasi', $id)) {
        throw new RuntimeException('Item tidak ditemukan.');
    }
    db_execute('DELETE FROM cv_sertifikasi WHERE id = ?', [$id]);
}

function saveOrganisasi(?int $id, string $heading, string $teks, array $periode): void
{
    db_execute('UPDATE cv_meta SET organisasi_heading = ? WHERE id = 1', [$heading]);
    if ($id !== null) {
        if (!db_item_exists('cv_organisasi', $id)) {
            throw new RuntimeException('Item tidak ditemukan.');
        }
        db_execute(
            'UPDATE cv_organisasi SET teks = ?, mulai_datetime = ?, mulai_label = ?, akhir_teks = ? WHERE id = ?',
            [
                $teks,
                $periode['mulai_datetime'],
                $periode['mulai_label'],
                $periode['akhir_teks'],
                $id,
            ]
        );
        return;
    }
    $urutan = cv_next_urutan('cv_organisasi');
    db_execute(
        'INSERT INTO cv_organisasi (teks, mulai_datetime, mulai_label, akhir_teks, urutan) VALUES (?, ?, ?, ?, ?)',
        [
            $teks,
            $periode['mulai_datetime'],
            $periode['mulai_label'],
            $periode['akhir_teks'],
            $urutan,
        ]
    );
}

function deleteOrganisasi(int $id): void
{
    if (!db_item_exists('cv_organisasi', $id)) {
        throw new RuntimeException('Item tidak ditemukan.');
    }
    db_execute('DELETE FROM cv_organisasi WHERE id = ?', [$id]);
}

function cv_next_urutan(string $table): int
{
    $allowed = [
        'cv_keterampilan',
        'cv_pengalaman',
        'cv_pendidikan',
        'cv_portofolio',
        'cv_sertifikasi',
        'cv_organisasi',
    ];
    if (!in_array($table, $allowed, true)) {
        throw new RuntimeException('Tabel tidak diizinkan.');
    }
    $row = db_fetch_one("SELECT COALESCE(MAX(urutan), 0) + 1 AS next_urutan FROM {$table}");
    return (int) ($row['next_urutan'] ?? 1);
}

function cv_truncate_all(): void
{
    db_execute('SET FOREIGN_KEY_CHECKS = 0');
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
        db_execute("TRUNCATE TABLE {$table}");
    }
    db_execute('SET FOREIGN_KEY_CHECKS = 1');
}
