<?php
require 'config.php';

// Menangani permintaan tambah data (CREATE / INSERT)
if(isset($_POST['tambah'])) {
    $nim = $_POST['nim'];
    $nama = $_POST['nama'];
    $jurusan = $_POST['jurusan'];
    
    // PREPARED STATEMENT: Mencegah SQL Injection!
    $sql = "INSERT INTO mahasiswa (nim, nama, jurusan) VALUES (:nim, :nama, :jurusan)";
    $stmt = $pdo->prepare($sql);
    
    // Bind parameter lalu eksekusi
    $stmt->execute([
        'nim' => $nim,
        'nama' => $nama,
        'jurusan' => $jurusan
    ]);
    
    // Refresh agar form dan request POST dibersihkan (Pattern Post-Redirect-Get)
    header("Location: index.php");
    exit();
}

// Menangani pengambilan data dari database (READ / SELECT)
$stmt_get = $pdo->query("SELECT * FROM mahasiswa ORDER BY tanggal_dibuat DESC");
// FetchAll mengambil semua baris hasil dalam bentuk Array
$semua_mhs = $stmt_get->fetchAll(); 

?>
<!DOCTYPE html>
<html>
<head><title>CRUD Dasar MySQL PDO</title></head>
<body>

    <h2>Aplikasi Data Mahasiswa (Mini Web-App)</h2>

    <h3>Tambah Baru</h3>
    <form method="POST">
        NIM: <input type="text" name="nim" required> 
        Nama: <input type="text" name="nama" required> 
        Jurusan: <input type="text" name="jurusan" required> 
        <button type="submit" name="tambah">Simpan</button>
    </form>
    
    <hr>
    
    <h3>Daftar Mahasiswa Terdaftar</h3>
    <table border="1" cellpadding="8" cellspacing="0">
        <tr>
            <th>ID</th>
            <th>NIM</th>
            <th>Nama</th>
            <th>Jurusan</th>
        </tr>
        <!-- Loop data menggunakan foreach foreach -->
        <?php foreach($semua_mhs as $mhs): ?>
        <tr>
            <td><?= $mhs['id']; ?></td>
            <td><?= htmlspecialchars($mhs['nim']); // Output Sanitization ?></td>
            <td><?= htmlspecialchars($mhs['nama']); ?></td>
            <td><?= htmlspecialchars($mhs['jurusan']); ?></td>
        </tr>
        <?php endforeach; ?>
    </table>

</body>
</html>
