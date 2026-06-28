CREATE DATABASE IF NOT EXISTS cv_portfolio CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE cv_portfolio;

CREATE TABLE IF NOT EXISTS cv_meta (
    id TINYINT UNSIGNED NOT NULL PRIMARY KEY DEFAULT 1,
    document_title VARCHAR(255) NOT NULL,
    meta_description TEXT NULL,
    person_name VARCHAR(150) NOT NULL,
    person_role VARCHAR(150) NOT NULL DEFAULT '',
    person_location VARCHAR(150) NOT NULL DEFAULT '',
    person_email VARCHAR(150) NOT NULL DEFAULT '',
    person_phone_e164 VARCHAR(30) NOT NULL DEFAULT '',
    person_phone_display VARCHAR(50) NOT NULL DEFAULT '',
    person_website VARCHAR(255) NOT NULL DEFAULT '',
    person_address TEXT NULL,
    ringkasan_heading VARCHAR(150) NOT NULL DEFAULT '',
    ringkasan_text TEXT NULL,
    keterampilan_heading VARCHAR(150) NOT NULL DEFAULT '',
    pengalaman_heading VARCHAR(150) NOT NULL DEFAULT '',
    pendidikan_heading VARCHAR(150) NOT NULL DEFAULT '',
    pendidikan_caption VARCHAR(255) NOT NULL DEFAULT '',
    portofolio_heading VARCHAR(150) NOT NULL DEFAULT '',
    sertifikasi_heading VARCHAR(150) NOT NULL DEFAULT '',
    organisasi_heading VARCHAR(150) NOT NULL DEFAULT '',
    kontak_heading VARCHAR(150) NOT NULL DEFAULT '',
    kontak_intro TEXT NULL,
    footer_year SMALLINT UNSIGNED NOT NULL DEFAULT 2026,
    footer_text VARCHAR(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS cv_keterampilan (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    judul VARCHAR(150) NOT NULL,
    deskripsi TEXT NOT NULL,
    urutan INT UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS cv_pengalaman (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    judul VARCHAR(255) NOT NULL,
    mulai_datetime VARCHAR(20) NOT NULL DEFAULT '',
    mulai_label VARCHAR(80) NOT NULL DEFAULT '',
    selesai_datetime VARCHAR(20) NOT NULL DEFAULT '',
    selesai_label VARCHAR(80) NOT NULL DEFAULT '',
    urutan INT UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS cv_pengalaman_poin (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    pengalaman_id INT UNSIGNED NOT NULL,
    teks TEXT NOT NULL,
    urutan INT UNSIGNED NOT NULL DEFAULT 0,
    CONSTRAINT fk_pengalaman_poin FOREIGN KEY (pengalaman_id)
        REFERENCES cv_pengalaman(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS cv_pendidikan (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    jenjang VARCHAR(80) NOT NULL,
    institusi VARCHAR(150) NOT NULL,
    program VARCHAR(150) NOT NULL,
    mulai_datetime VARCHAR(20) NOT NULL DEFAULT '',
    mulai_label VARCHAR(80) NOT NULL DEFAULT '',
    selesai_label VARCHAR(80) NOT NULL DEFAULT '',
    urutan INT UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS cv_portofolio (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    judul VARCHAR(200) NOT NULL,
    link_href VARCHAR(500) NOT NULL DEFAULT '#',
    link_text VARCHAR(200) NOT NULL DEFAULT '',
    urutan INT UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS cv_sertifikasi (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(200) NOT NULL,
    tahun VARCHAR(20) NOT NULL DEFAULT '',
    datetime VARCHAR(20) NOT NULL DEFAULT '',
    urutan INT UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS cv_organisasi (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    teks VARCHAR(255) NOT NULL,
    mulai_datetime VARCHAR(20) NOT NULL DEFAULT '',
    mulai_label VARCHAR(80) NOT NULL DEFAULT '',
    akhir_teks VARCHAR(80) NOT NULL DEFAULT 'Sekarang',
    urutan INT UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
