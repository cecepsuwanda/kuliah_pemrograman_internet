<?php
// Contoh Mengambil / Mengkonsumsi Rest API pihak ketiga (Publik API)

// Endpoint URL (Misal: API Placeholder untuk dummy JSON)
$apiUrl = "https://jsonplaceholder.typicode.com/users";

// Inisialisasi cURL
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $apiUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Supaya kembalian masuk ke variabel

// Eksekusi GET
$response = curl_exec($ch);

// Tutup koneksi
curl_close($ch);

// Konversi raw JSON String ke bentuk Array Rekursif di PHP
$semuaPengguna = json_decode($response, true);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Integrasi Data API</title>
</head>
<body>
    <h2>Data Pengguna dari REST API (JSON)</h2>
    <ul style="line-height:2;">
        <?php 
        // Lakukan iterasi Array
        if ($semuaPengguna) {
            foreach($semuaPengguna as $p) {
                // Ambil data dalam array dan filter sanitasi
                echo "<li><b>" . htmlspecialchars($p['name']) . "</b> - Email: <i>" . htmlspecialchars($p['email']). "</i></li>";
            }
        } else {
            echo "<li>Gagal mengambil data dari API.</li>";
        }
        ?>
    </ul>
</body>
</html>
