<?php
// Atur zona waktu
date_default_timezone_set('Asia/Jakarta');

// Konstanta koneksi database
define('DB_MAIN_HOST', 'localhost');
define('DB_MAIN_USER', 'root');
define('DB_MAIN_PASS', '');
define('DB_MAIN_NAME', 'db_crud_praktikum');

// Membuat koneksi
$conn = mysqli_connect(DB_MAIN_HOST, DB_MAIN_USER, DB_MAIN_PASS, DB_MAIN_NAME);

// Periksa apakah koneksi berhasil
if ($conn->connect_error) {
    // Log error ke file, jangan tampilkan di layar
    error_log("Koneksi gagal: " . $conn->connect_error);
    die("Koneksi database bermasalah. Silakan coba lagi nanti.");
}


?>
