<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Netflix Clone</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/home.css">
</head>
<body>
    <!-- Header -->
    <header>
        <a href="#" class="logo">Netflix</a>
        <ul class="nav-links">
            <li><a href="#">Home</a></li>
            <li><a href="#">TV Shows</a></li>
            <li><a href="#">Movies</a></li>
            <li><a href="#">New & Popular</a></li>
        </ul>
        <button class="login-btn">Sign In</button>
    </header>

    <!-- Hero Section -->
    <div class="hero">
        <h1>Unlimited movies, TV shows, and more.</h1>
        <p>Watch anywhere. Cancel anytime.</p>
        <button>Get Started</button>
    </div>

    <!-- Movie Sections -->
    <!-- <div class="section">
        <h2>Trending Now</h2>
        <div class="movies">
        <?php
            // Ambil data video dari database
            $conn = new mysqli('localhost', 'root', '', 'db_crud_praktikum');
            $result = $conn->query("SELECT title, video, image, rating, duration FROM movies");

            while ($row = $result->fetch_assoc()) {
                echo "<h3>" . htmlspecialchars($row['title']) . "</h3>";
                echo '<video width="320" height="240" controls>';
                echo '<source src="' . htmlspecialchars($row['video']) . '" type="video/mp4">';
                echo "Your browser does not support the video tag.";
                echo "</video>";
            }

            $conn->close();
        ?>

        </div>
    </div> -->

    <div class="section">
        <h2>Popular on Netflix</h2>
        <div class="movies">
            <?php
            foreach ($result as $movie) {
                echo '<div class="movie">';
            
                // Pastikan 'image' tersedia dan bukan null
                if (!empty($movie['image'])) {
                    echo '<img src="' . htmlspecialchars($movie['image']) . '" width="320" height="240" alt="Movie Image">';
                } else {
                    echo '<img src="path/to/default-image.jpg" width="320" height="240" alt="Default Image">';
                }
                
                echo '<h2>' . htmlspecialchars($movie['title']) . '</h2>'; // Judul film
                echo '<p>' . htmlspecialchars($movie['rating']) . '/10</p>'; // Rating film
                echo '<p>' . htmlspecialchars($movie['duration']) . ' minutes</p>';
                echo '</div>';
            }
            ?>
        </div>
    </div>
</body>
</html>
