<?php
    
    include __DIR__ . '/../lib/db.php'; 

    
    $queryUsers = "SELECT COUNT(*) AS total_users FROM users";
    $resultUsers = $conn->query($queryUsers);

    $queryMovies = "SELECT COUNT(*) AS total_movies FROM movies";
    $resultMovies = $conn->query($queryMovies);

    $queryYearUser = "SELECT YEAR(created_at) as year, COUNT(*) as total FROM users GROUP BY YEAR(created_at)";
    $resultYearUsers = $conn->query($queryYearUser);


    $queryMonthUser = "SELECT DATE_FORMAT(created_at, '%Y-%m') as month, COUNT(*) as total FROM users GROUP BY DATE_FORMAT(created_at, '%Y-%m')";
    $resultMonthUser = $conn->query($queryMonthUser);
    
    $queryYearMovie = "SELECT YEAR(created_at) as year, COUNT(*) as total FROM users GROUP BY YEAR(created_at)";
    $resultYearMovie = $conn->query($queryYearMovie);


    $queryMonthMovie = "SELECT DATE_FORMAT(created_at, '%Y-%m') as month, COUNT(*) as total FROM users GROUP BY DATE_FORMAT(created_at, '%Y-%m')";
    $resultMonthMovie = $conn->query($queryMonthMovie);
?>