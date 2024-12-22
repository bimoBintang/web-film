<?php
    // session_start();
    // if (!isset($_SESSION['admin'])) {
    //     header('Location: ../auth/sign-in.php');
    //     exit();
    // }
    include __DIR__ . '/../../../lib/dataCount.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div class="d-flex">
        <?php include 'sidebar.php'; ?> 
        <!-- Main Content -->
        <div class="content">
            <div class="container-fluid">
                <h1 class="mt-4">Welcome to Admin Dashboard</h1>
                <p>Manage your e-commerce platform efficiently.</p>
                <div class="row">
                    <!-- Cards -->
                    <?php 
                        if (isset($resultUsers) && $resultUsers->num_rows > 0) {
                            $user = $resultUsers->fetch_assoc();
                            echo '<div class="col-md-3">';
                            echo '<div class="card bg-primary text-white mb-4">';
                            echo '<div class="card-body">';
                            echo '<h5 class="card-title">Users</h5>';
                            echo '<p class="card-text">' . htmlspecialchars($user['total_users']) . '</p>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                        } else {
                            echo '<p>No users available at the moment.</p>';
                        }
                        if (isset($resultMovies) && $resultMovies->num_rows > 0) {
                            $movie = $resultMovies->fetch_assoc();
                            echo '<div class="col-md-3">';
                            echo '<div class="card bg-success text-white mb-4">';
                            echo '<div class="card-body">';
                            echo '<h5 class="card-title">Movies</h5>';
                            echo '<p class="card-text">' . htmlspecialchars($movie['total_movies']) . '</p>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                        } else {
                            echo '<p>No movies available at the moment.</p>';
                        }
                    ?>
                </div>
                <!-- Select and Charts -->
                <div class="mt-4">
                    <label for="dataSelectorUser" class="form-label">Select User Data:</label>
                    <select id="dataSelectorUser" class="form-select mb-3">
                        <option value="yearUser">Users per Year</option>
                        <option value="monthUser">Users per Month</option>
                    </select>
                    <canvas id="chartUser" class="my-4 w-100" width="900" height="380"></canvas>
                    
                    <label for="dataSelectorMovie" class="form-label">Select Movie Data:</label>
                    <select id="dataSelectorMovie" class="form-select mb-3">
                        <option value="yearMovie">Movies per Year</option>
                        <option value="monthMovie">Movies per Month</option>
                    </select>
                    <canvas id="chartMovie" class="my-4 w-100" width="900" height="380"></canvas>
                </div>

                <?php 
                    $dataYearUser = [];
                    $dataMonthUser = [];
                    $dataYearMovie = [];
                    $dataMonthMovie = [];

                    if (isset($resultYearUsers) && $resultYearUsers->num_rows > 0) {
                        while ($row = $resultYearUsers->fetch_assoc()) {
                            $dataYearUser[] = $row;
                        }
                    }

                    if (isset($resultMonthUser) && $resultMonthUser->num_rows > 0) {
                        while ($row = $resultMonthUser->fetch_assoc()) {
                            $dataMonthUser[] = $row;
                        }
                    }

                    if (isset($resultYearMovie) && $resultYearMovie->num_rows > 0) {
                        while ($row = $resultYearMovie->fetch_assoc()) {
                            $dataYearMovie[] = $row;
                        }
                    }

                    if (isset($resultMonthMovie) && $resultMonthMovie->num_rows > 0) {
                        while ($row = $resultMonthMovie->fetch_assoc()) {
                            $dataMonthMovie[] = $row;
                        }
                    }
                ?>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const dataYearUser = <?php echo json_encode($dataYearUser); ?>;
        const dataMonthUser = <?php echo json_encode($dataMonthUser); ?>;
        const dataYearMovie = <?php echo json_encode($dataYearMovie); ?>;
        const dataMonthMovie = <?php echo json_encode($dataMonthMovie); ?>;

        const labelsYearUser = dataYearUser.map(item => item.year);
        const valuesYearUser = dataYearUser.map(item => item.total);

        const labelsMonthUser = dataMonthUser.map(item => item.month);
        const valuesMonthUser = dataMonthUser.map(item => item.total);

        const labelsYearMovie = dataYearMovie.map(item => item.year);
        const valuesYearMovie = dataYearMovie.map(item => item.total);

        const labelsMonthMovie = dataMonthMovie.map(item => item.month);
        const valuesMonthMovie = dataMonthMovie.map(item => item.total);

        const ctxUser = document.getElementById('chartUser').getContext('2d');
        const ctxMovie = document.getElementById('chartMovie').getContext('2d');
        let chartUser;
        let chartMovie;

        function renderUserChart(labels, data, label) {
            if (chartUser) {
                chartUser.destroy();
            }
            chartUser = new Chart(ctxUser, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: label,
                        data: data,
                        backgroundColor: 'rgba(54, 162, 235, 0.5)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: { position: 'top' },
                        title: { display: true, text: label }
                    }
                }
            });
        }

        function renderMovieChart(labels, data, label) {
            if (chartMovie) {
                chartMovie.destroy();
            }
            chartMovie = new Chart(ctxMovie, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: label,
                        data: data,
                        backgroundColor: 'rgba(75, 192, 192, 0.5)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: { position: 'top' },
                        title: { display: true, text: label }
                    }
                }
            });
        }

        document.getElementById('dataSelectorUser').addEventListener('change', (e) => {
            const value = e.target.value;
            if (value === 'yearUser') {
                renderUserChart(labelsYearUser, valuesYearUser, 'Users per Year');
            } else if (value === 'monthUser') {
                renderUserChart(labelsMonthUser, valuesMonthUser, 'Users per Month');
            }
        });

        document.getElementById('dataSelectorMovie').addEventListener('change', (e) => {
            const value = e.target.value;
            if (value === 'yearMovie') {
                renderMovieChart(labelsYearMovie, valuesYearMovie, 'Movies per Year');
            } else if (value === 'monthMovie') {
                renderMovieChart(labelsMonthMovie, valuesMonthMovie, 'Movies per Month');
            }
        });

        // Default render
        renderUserChart(labelsYearUser, valuesYearUser, 'Users per Year');
        renderMovieChart(labelsYearMovie, valuesYearMovie, 'Movies per Year');
    </script>
</body>
</html>
