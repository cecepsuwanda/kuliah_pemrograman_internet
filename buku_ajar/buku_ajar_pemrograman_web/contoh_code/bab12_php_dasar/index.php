<?php
// Mengintegrasikan file header.php ke dalam file ini (Modularisasi PHP)
// Akan menghasilkan error fatal dan berhenti jika file header.php tidak ditemukan
require 'header.php';

// Konsep Variabel, Tipe Data, dan Array
$nama = "Mahasiswa Web";
$nilai_tugas = [80, 85, 90];
$rata_rata = array_sum($nilai_tugas) / count($nilai_tugas);
?>

<h3>Selamat Datang, <?php echo $nama; ?>!</h3>
<p>Rata-rata nilai tugas Anda saat ini adalah: <strong><?= $rata_rata; ?></strong></p>

<!-- Konsep Logika Kondisional Dasar -->
<?php if($rata_rata >= 85): ?>
    <p style="color: green;">Predikat Anda: SANGAT BAIK</p>
<?php else: ?>
    <p style="color: red;">Terus Tingkatkan Belajarmu!</p>
<?php endif; ?>

<hr>

<h3>Simulasi Pemrosesan Form (Method POST)</h3>
<form action="proses.php" method="POST">
    <label>Nama Barang:</label><br>
    <input type="text" name="barang" required><br><br>
    
    <label>Harga Satuan:</label><br>
    <input type="number" name="harga" required><br><br>
    
    <button type="submit">Kirim Form (POST)</button>
</form>

</body>
</html>
