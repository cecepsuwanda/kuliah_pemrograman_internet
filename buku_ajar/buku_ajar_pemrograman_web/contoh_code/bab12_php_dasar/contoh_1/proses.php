<?php
require 'header.php';
?>

<h3>Hasil Pemrosesan Form POST</h3>

<?php
// Pengecekan apakah data dikirim melalui HTTP POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Menangkap data dari $_POST dengan sedikit validasi keberadaan index element
    $barang = isset($_POST['barang']) ? $_POST['barang'] : 'Tidak diketahui';
    $harga = isset($_POST['harga']) ? (int)$_POST['harga'] : 0;
    
    // Fungsi bawaan PHP (number_format)
    $harga_format = number_format($harga, 0, ',', '.');
    
    echo "<p>Barang diterima: <b>$barang</b></p>";
    echo "<p>Harga yang disimpan: <b>Rp. {$harga_format}</b></p>";
    
} else {
    // Jika file diakses langsung (lewat GET), kembalikan atau tolak
    echo "<p style='color:red;'>Akses ditolak! Anda tidak submit form.</p>";
}
?>

<br><a href="index.php">Kembali ke Beranda</a>

</body>
</html>
