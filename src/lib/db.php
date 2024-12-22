<?php

date_default_timezone_set('Asia/Jakarta');


define('DB_MAIN_HOST', 'localhost');
define('DB_MAIN_USER', 'root');
define('DB_MAIN_PASS', '');
define('DB_MAIN_NAME', 'db_crud_praktikum');


$conn = mysqli_connect(DB_MAIN_HOST, DB_MAIN_USER, DB_MAIN_PASS, DB_MAIN_NAME);


if ($conn->connect_error) {
    
    error_log("Koneksi gagal: " . $conn->connect_error);
    die("Koneksi database bermasalah. Silakan coba lagi nanti.");
}


?>
