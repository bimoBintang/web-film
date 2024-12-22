<?php
include __DIR__ . '/../../../../lib/dataMovie.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <style>
        .sidebar {
            width: 250px;
            min-height: 100vh;
        }
        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                position: relative;
            }
            .content {
                margin-top: 20px;
            }
        }
        .movie-image {
            max-width: 100px;
            height: auto;
        }
        .pagination .page-item.active .page-link {
            background-color: #007bff;
            border-color: #007bff;
        }
    </style>
</head>
<body>
    <div class="d-flex flex-column flex-lg-row">
        <!-- Sidebar -->
        <?php include __DIR__ . '/../sidebar.php'; ?> 

        <!-- Main Content -->
        <div class="content flex-grow-1 p-4">
            <h2 class="mb-4"><i class="fa-solid fa-film me-2"></i>Movie Dashboard</h2>

            <!-- Filter and Search Form -->
            <form class="row mb-4" method="GET" id="filterForm">
                <div class="col-md-4">
                    <input type="text" name="search" class="form-control" placeholder="Search by title or description" value="<?= htmlspecialchars($search) ?>" oninput="document.getElementById('filterForm').submit()">
                </div>
                <div class="col-md-3">
                    <select name="genre" class="form-select" onchange="document.getElementById('filterForm').submit()">
                        <option value="">All Genres</option>
                        <?php while ($row = $genresResult->fetch_assoc()): ?>
                            <option value="<?= htmlspecialchars($row['genre']) ?>" <?= $genre === $row['genre'] ? 'selected' : '' ?>>
                                <?= htmlspecialchars($row['genre']) ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div class="col-md-2">
                    <a href="?" class="btn btn-secondary w-100"><i class="fa-solid fa-rotate-left"></i> Reset</a>
                </div>
            </form>

            <a href="create.php" class="btn btn-primary mb-3"><i class="fa-solid fa-plus me-1"></i>Add New Movie</a>

            <!-- Movies Table -->
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Genre</th>
                            <th>Image</th>
                            <th>Description</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($resultMovie && $resultMovie->num_rows > 0): ?>
                            <?php while ($movie = $resultMovie->fetch_assoc()): ?>
                                <tr>
                                    <td><?= htmlspecialchars($movie['movie_id']) ?></td>
                                    <td><?= htmlspecialchars($movie['title']) ?></td>
                                    <td><?= htmlspecialchars($movie['genre']) ?></td>
                                    <td>
                                        <?php if (!empty($movie['image'])): ?>
                                            <img src="<?= htmlspecialchars($movie['image']) ?>" alt="Movie Image" class="movie-image">
                                        <?php else: ?>
                                            No Image
                                        <?php endif; ?>
                                    </td>
                                    <td><?= htmlspecialchars($movie['description']) ?></td>
                                    <td>
                                        <a href="/dashboard/movie/edit?id=<?= htmlspecialchars($movie['movie_id']) ?>" class="btn btn-warning btn-sm"><i class="fa-solid fa-pen"></i> Edit</a>
                                        <a href="?id=<?= htmlspecialchars($movie['movie_id']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')"><i class="fa-solid fa-trash"></i> Delete</a>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="text-center">No movies found</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <nav>
                <ul class="pagination justify-content-center">
                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                        <li class="page-item <?= $i == $page ? 'active' : '' ?>">
                            <a class="page-link" href="?page=<?= $i ?>&search=<?= htmlspecialchars($search) ?>&genre=<?= htmlspecialchars($genre) ?>">
                                <?= $i ?>
                            </a>
                        </li>
                    <?php endfor; ?>
                </ul>
            </nav>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
