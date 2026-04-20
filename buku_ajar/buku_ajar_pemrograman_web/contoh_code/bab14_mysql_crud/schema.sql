-- Buat Database
CREATE DATABASE IF NOT EXISTS belajar_crud;
USE belajar_crud;

-- Buat Tabel Mahasiswa
CREATE TABLE IF NOT EXISTS mahasiswa (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    nim VARCHAR(15) NOT NULL UNIQUE,
    nama VARCHAR(100) NOT NULL,
    jurusan VARCHAR(50) NOT NULL,
    tanggal_dibuat TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Masukkan Data Dummy (Opsional)
INSERT INTO mahasiswa (nim, nama, jurusan) VALUES 
('112233', 'Ali Kurniawan', 'Informatika'),
('445566', 'Siti Rahma', 'Sistem Informasi');
