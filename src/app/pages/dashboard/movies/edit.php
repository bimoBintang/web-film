<?php
include __DIR__ . '/../../../../lib/db.php';

if (isset($_GET['movie_id'])) {
    $id = $_GET['movie_id'];

    if (is_numeric($id)) {
        $result = $conn->query("SELECT * FROM movies WHERE id=$id");
        if ($result) {
            $editMv = $result->fetch_assoc(); 
        } else {
            echo "Film tidak ditemukan.";
            exit;
        }
    } else {
        echo "ID film tidak valid.";
        exit;
    }
} else {
    echo "Parameter movie_id tidak ditemukan.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $genre = $_POST['genre'];
    $image = $_POST['image'];
    $release_year = $_POST['release_year'];
    $duration = $_POST['duration'];
    $rating = $_POST['rating'];
    $description = $_POST['description'];
    $video = $_POST['video'];

    $stmt = $conn->prepare("UPDATE movies SET 
        title=?, 
        genre=?, 
        image=?, 
        release_year=?, 
        duration=?, 
        rating=?, 
        description=?, 
        video=?   
        WHERE id=?");

    $stmt->bind_param("ssssssssi", 
        $title, 
        $genre, 
        $image, 
        $release_year, 
        $duration, 
        $rating, 
        $description, 
        $video, 
        $id);

    if ($stmt->execute()) {
        header("Location: /dashboard/movie/edit?id=$id");
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Film</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">Edit Film</h2>
    <form method="POST" action="">
        <div class="mb-3">
            <label for="title" class="form-label">Judul</label>
            <input type="text" class="form-control" id="title" name="title" value="<?= htmlspecialchars($editMv['title']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="genre" class="form-label">Genre</label>
            <input type="text" class="form-control" id="genre" name="genre" value="<?= htmlspecialchars($editMv['genre']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">URL Gambar</label>
            <input type="text" class="form-control" id="image" name="image" value="<?= htmlspecialchars($editMv['image']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="release_year" class="form-label">Tahun Rilis</label>
            <input type="number" class="form-control" id="release_year" name="release_year" value="<?= htmlspecialchars($editMv['release_year']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="duration" class="form-label">Durasi (menit)</label>
            <input type="number" class="form-control" id="duration" name="duration" value="<?= htmlspecialchars($editMv['duration']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="rating" class="form-label">Rating</label>
            <input type="number" class="form-control" id="rating" name="rating" value="<?= htmlspecialchars($editMv['rating']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Deskripsi</label>
            <textarea class="form-control" id="description" name="description" required><?= htmlspecialchars($editMv['description']) ?></textarea>
        </div>
        <div class="mb-3">
            <label for="video" class="form-label">URL Video</label>
            <input type="text" class="form-control" id="video" name="video" value="<?= htmlspecialchars($editMv['video']) ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Perbarui</button>
        <a href="/dashboard/movie" class="btn btn-secondary">Batal</a>
    </form>
</div>
</body>
</html>
