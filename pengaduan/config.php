<?php
// Deteksi apakah berjalan di localhost
$serverName = $_SERVER['SERVER_NAME'] ?? '';

// Konfigurasi berdasarkan lingkungan
if ($serverName === 'localhost' || $serverName === '127.0.0.1') {
    // ✅ Konfigurasi untuk LOKAL (Laragon/XAMPP)
    $host = 'localhost';
    $user = 'root';
    $pass = ''; // kosongkan kalau default Laragon
    $db   = 'laporan'; // pastikan database ini ADA di phpMyAdmin lokal
} else {
    // ✅ Konfigurasi untuk HOSTING (cPanel)
    $host = 'localhost';
    $user = 'lapor925_root';
    $pass = 'L=TEn?tleHpCZE9S';
    $db   = 'lapor925_laporan';
}

// Buat koneksi MySQL
$conn = mysqli_connect($host, $user, $pass, $db);

// Cek koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
