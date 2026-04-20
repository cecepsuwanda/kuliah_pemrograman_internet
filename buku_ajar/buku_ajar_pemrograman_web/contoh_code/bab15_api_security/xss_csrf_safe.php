<?php
session_start();

// 1. SIMULASI PERTAHANAN CSRF (Cross-Site Request Forgery)
// Buat token pertahanan ke session yang tidak bisa diakses dari web penyerang
if (empty($_SESSION['token_csrf'])) {
    // Generate Token Cryptographically Secure
    $_SESSION['token_csrf'] = bin2hex(random_bytes(32)); 
}

$pesan = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verifikasi Token terkirim vs Token Session (Pengecekan CSRF)
    if (!hash_equals($_SESSION['token_csrf'], $_POST['token_rahasia'])) {
        die("Validasi gagal! Terindikasi CSRF (Aksi Ilegal).");
    }
    
    // 2. SIMULASI PERTAHANAN XSS (Cross-Site Scripting)
    /* 
       Jika tidak disanitasi, attacker bisa memasukkan:
       <script>alert('HACKED!');</script>
       
       Maka WAJIB pakai htmlspecialchars() saat menerima atau saat mau output.
    */
    $komentar_masuk = trim($_POST['komentar']);
    
    // Lakukan sanitasi kuat, ubah tag bahaya (< >) jadi entity HTML aman (&lt; &gt;)
    $komentar_aman = htmlspecialchars($komentar_masuk, ENT_QUOTES, 'UTF-8');
    
    // Set pesan output
    $pesan = "Komentar berhasil diproses! Hasil Sanitasi: <br><br> {$komentar_aman}";
}

?>

<!DOCTYPE html>
<html>
<head><title>Form Aman CSRF dan XSS</title></head>
<body>
    <h2>Form Tambah Komentar (Sangat Aman)</h2>
    
    <?php if($pesan != "") echo "<div style='color:green; padding:10px; border:1px solid lightgreen; margin-bottom:10px'>$pesan</div>"; ?>

    <form method="POST">
        <!-- Token rahasia dikirim tak terlihat (Hidden) -->
        <input type="hidden" name="token_rahasia" value="<?= $_SESSION['token_csrf']; ?>">
        
        <label>Tulis Poin Pendapat Anda (Coba isikan tag &lt;script&gt; di dalam ini!):</label><br>
        <textarea name="komentar" rows="4" cols="40" required></textarea><br><br>
        
        <button type="submit">Kirim Komentar</button>
    </form>
</body>
</html>
