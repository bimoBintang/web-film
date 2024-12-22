<?php
    // Koneksi ke database
    include __DIR__ . '/../lib/db.php'; // Pastikan file ini berisi koneksi ke database

    // Query untuk menghitung jumlah users
    $queryUsers = "SELECT COUNT(*) AS total_users FROM users";
    $resultUsers = $conn->query($queryUsers);

    $queryMovies = "SELECT COUNT(*) AS total_movies FROM movies";
    $resultMovies = $conn->query($queryMovies);

    $queryYearUser = "SELECT YEAR(created_at) as year, COUNT(*) as total FROM users GROUP BY YEAR(created_at)";
    $resultYearUsers = $conn->query($queryYearUser);

// Query untuk data pengguna per bulan (dalam satu tahun terakhir)
    $queryMonthUser = "SELECT DATE_FORMAT(created_at, '%Y-%m') as month, COUNT(*) as total FROM users GROUP BY DATE_FORMAT(created_at, '%Y-%m')";
    $resultMonthUser = $conn->query($queryMonthUser);
    
    $queryYearMovie = "SELECT YEAR(created_at) as year, COUNT(*) as total FROM users GROUP BY YEAR(created_at)";
    $resultYearMovie = $conn->query($queryYearMovie);

// Query untuk data pengguna per bulan (dalam satu tahun terakhir)
    $queryMonthMovie = "SELECT DATE_FORMAT(created_at, '%Y-%m') as month, COUNT(*) as total FROM users GROUP BY DATE_FORMAT(created_at, '%Y-%m')";
    $resultMonthMovie = $conn->query($queryMonthMovie);
?>