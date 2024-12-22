<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Netflix Clone</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <style>
        body {
        margin: 0;
        font-family: Arial, sans-serif;
        background-color: #000;
        color: #fff;
        }

        /* Header Styles */
        header {
            background-color: rgba(0, 0, 0, 0.8);
            display: flex;
            gap: 24rem;
            align-items: center;
            margin: 15px;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
        }

        .logo {
            font-size: 1.5rem;
            font-weight: bold;
            color: #e50914;
            text-decoration: none;
        }

        .nav-links {
            list-style: none;
            display: flex;
            gap: 20px;
        }

        .nav-links li a {
            color: #fff;
            text-decoration: none;
            font-size: 1rem;
            transition: color 0.3s ease;
        }

        .nav-links li a:hover {
            color: #e50914;
        }

        .login-btn {
            color: white;
            background-color: #e50914;
            border: none;
            padding: 8px 15px;
            border-radius: 3px;
            cursor: pointer;
            font-size: 1rem;
            transition: background-color 0.3s ease;
        }

        .login-btn:hover {
            background-color: #f40612;
        }

        /* Hero Section */
        .hero {
            height: 100vh;
            background-image: url('https://assets.nflxext.com/ffe/siteui/vlv3/9e5b08e2-f9d8-4f87-a8a4-dad46dc9729d/66c0c5e5-e964-4f3a-babe-e74e1fb47dc3/ID-en-20231002-popsignuptwoweeks-perspective_alpha_website_small.jpg');
            background-size: cover;
            background-position: center;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 20px;
        }

        .hero h1 {
            font-size: 3rem;
            margin-bottom: 20px;
        }

        .hero p {
            font-size: 1.2rem;
            margin-bottom: 20px;
        }

        .hero button {
            font-size: 1rem;
            color: white;
            background-color: #e50914;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 3px;
            transition: background-color 0.3s ease;
        }

        .hero button:hover {
            background-color: #f40612;
        }

        /* Movie Sections */
        .section {
            margin: 50px 20px;
        }

        .section h2 {
            font-size: 1.5rem;
            margin-bottom: 10px;
        }

        .movies {
            display: grid;
            grid-template-columns: repeat(6, 1fr);
            gap: 10px;
            padding-bottom: 10px;
        }

        .movies::-webkit-scrollbar {
            display: none;
        }

        .movie {
            height: 240px;
            background-color: #333;
            border-radius: 5px;
            overflow: hidden;
            position: relative;
            cursor: pointer;
            transition: transform 0.3s ease;
        }

        .movie img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .movie:hover {
            transform: scale(1.05);
        }

        @media (max-width: 768px) {
            .movies {
                grid-template-columns: repeat(2, 1fr); /* 2 kolom */
            }
        }

        /* Responsive - 1 kolom pada layar lebih kecil */
        @media (max-width: 480px) {
            .movies {
                grid-template-columns: 1fr; /* 1 kolom */
            }
        }
    </style>
</head>
<body>
    <header>
        <a href="#" class="logo">Netflix</a>
        <ul class="nav-links">
            <li><a href="#">Home</a></li>
            <li><a href="#">TV Shows</a></li>
            <li><a href="#">Movies</a></li>
            <li><a href="#">New & Popular</a></li>
        </ul>
        <a href="/auth/sign-in" class="login-btn">Login</a>
    </header>
    <div class="hero">
        <h1>Unlimited movies, TV shows, and more.</h1>
        <p>Watch anywhere. Cancel anytime.</p>
        <button>Get Started</button>
    </div>
        <?php
            require_once __DIR__ . '/../../../lib/db.php';
            $query = "SELECT title, video, image, rating, duration FROM movies";
            $result = $conn->query($query);

            if ($result && $result->num_rows > 0) {
                while ($movie = $result->fetch_assoc()) {
                    echo '<div class="movie">';
                    
                
                    if (!empty($movie['image'])) {
                        echo '<img src="' . htmlspecialchars($movie['image']) . '" alt="Movie Image">';
                    } else {
                        echo '<img src="path/to/default-image.jpg" alt="Default Image">';
                    }

                    echo '<h2>' . htmlspecialchars($movie['title']) . '</h2>';
                    echo '<p>Rating: ' . htmlspecialchars($movie['rating']) . '/10</p>';
                    echo '<p>Duration: ' . htmlspecialchars($movie['duration']) . ' minutes</p>';
                    echo '</div>';
                }
            } else {
                echo '<p>No movies available at the moment.</p>';
            }
        ?>

        </div>
    </div> -->

    <div class="section">
        <h2>Popular on Netflix</h2>
        <div class="movies">
            <?php
            foreach ($result as $movie) {
                echo '<div class="movie">';
            
                if (!empty($movie['image'])) {
                    echo '<img src="' . htmlspecialchars($movie['image']) . '" width="320" height="240" alt="Movie Image">';
                } else {
                    echo '<img src="path/to/default-image.jpg" width="320" height="240" alt="Default Image">';
                }
                
                echo '<h2>' . htmlspecialchars($movie['title']) . '</h2>'; 
                echo '<p>' . htmlspecialchars($movie['rating']) . '/10</p>'; 
                echo '<p>' . htmlspecialchars($movie['duration']) . ' minutes</p>';
                echo '</div>';
            }
            ?>
        </div>
    </div>
</body>
</html>
