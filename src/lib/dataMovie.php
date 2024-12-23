<?php
    include __DIR__ . '/../lib/db.php';

    
    $search = isset($_GET['search']) ? $conn->real_escape_string($_GET['search']) : '';
    $genre = isset($_GET['genre']) ? $conn->real_escape_string($_GET['genre']) : '';
    $page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
    $limit = 10; 
    $offset = ($page - 1) * $limit;

    
    $genresQuery = "SELECT DISTINCT genre FROM movies";
    $genresResult = $conn->query($genresQuery);

    if (!$genresResult) {
        die("Error fetching genres: " . $conn->error);
    }

    
    $whereClauses = [];
    if (!empty($search)) {
        $whereClauses[] = "(title LIKE '%$search%' OR description LIKE '%$search%')";
    }
    if (!empty($genre)) {
        $whereClauses[] = "genre = '$genre'";
    }
    $whereSql = $whereClauses ? 'WHERE ' . implode(' AND ', $whereClauses) : '';

    $totalQuery = "SELECT COUNT(*) as total FROM movies $whereSql";
    $totalResult = $conn->query($totalQuery);

    if (!$totalResult) {
        die("Error fetching total rows: " . $conn->error);
    }

    $totalRows = $totalResult->fetch_assoc()['total'];

    $query = "SELECT * FROM movies $whereSql LIMIT $limit OFFSET $offset";
    $resultMovie = $conn->query($query);

    if (!$resultMovie) {
        die("Error fetching movies: " . $conn->error);
    }

    
    $totalPages = ceil($totalRows / $limit);
?>
