<?php
// Wajib diletakkan di paling atas sebelum HTML ter-render jika menggunakan Session
session_start();

require 'User.php';

// Simulasi user valid
$userSistem = new User("admin", "administrator");

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $pengguna_diketik = filter_var($_POST['user'], FILTER_SANITIZE_STRING); // Validasi input / sanitasi

    if($userSistem->login($pengguna_diketik)) {
        // Set ke dalam variabel Session GLOBAL
        $_SESSION['login'] = true;
        $_SESSION['nama'] = $userSistem->getUsername();
        
        // Buat COOKIE jika Checkbox ingatkan saya dicentang (tersimpan 1 jam)
        if(isset($_POST['ingat'])) {
            setcookie('nama_user', $userSistem->getUsername(), time() + 3600);
        }
        
    } else {
        $error = "Username salah!";
    }
}

// Logika Logout
if(isset($_GET['logout'])) {
    session_destroy();
    setcookie('nama_user', '', time() - 3600); // Hapus cookie
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head><title>Login Session & Cookie OOP</title></head>
<body>
    <h2>Portal OOP Login</h2>

    <?php if(isset($_SESSION['login'])): ?>
        <p>Anda sudah login sebagai: <strong><?= $_SESSION['nama']; ?></strong></p>
        <p>Lihat Cookie yang tersimpan di browser: <?= isset($_COOKIE['nama_user']) ? $_COOKIE['nama_user'] : 'Tidak Ada Cookie'; ?></p>
        
        <a href="?logout=1"><button>Logout Cepat</button></a>
        
    <?php else: ?>
        <p style="color:red;"><?= isset($error) ? $error : ''; ?></p>
        <form method="POST">
            Username (Ketik: <i>admin</i>): <br><input type="text" name="user" required><br>
            <input type="checkbox" name="ingat" value="1"> Ingat saya (Cookie)<br><br>
            <button type="submit">Akses Sistem</button>
        </form>
    <?php endif; ?>

</body></html>
