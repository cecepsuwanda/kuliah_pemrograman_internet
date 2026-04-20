<?php
/*
  PDO (PHP Data Objects) Connection Script
*/

$host = 'localhost';
$dbname = 'belajar_crud';
$user = 'root'; // default xampp
$pass = '';     // default empty di local

try {
    // String Koneksi DSN
    $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";
    
    // Opsi handling untuk koneksi (Sangat penting mencegah injeksi)
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Lempar exeptions jika error
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // Ambil data dalam format asosiatif
        PDO::ATTR_EMULATE_PREPARES   => false,                  // Gunakan prepared statements murni database
    ];

    // Buat Objek PDO
    $pdo = new PDO($dsn, $user, $pass, $options);
    
} catch (PDOException $e) {
    // Berhenti total bila tidak bisa konek
    die("Koneksi Database Gagal: " . $e->getMessage());
}
?>
