<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <style>
        /* Global Styles */
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
        }

        /* Sidebar */
        .sidebar {
            width: 250px;
            background-color: #2d2d37;
            height: 100vh;
            position: fixed;
            color: white;
            display: flex;
            flex-direction: column;
            padding: 20px;
        }

        .sidebar h2 {
            font-size: 1.5rem;
            margin-bottom: 30px;
        }

        .sidebar a {
            text-decoration: none;
            color: white;
            padding: 10px 15px;
            margin: 5px 0;
            border-radius: 5px;
            display: block;
            transition: background 0.3s;
        }

        .sidebar a:hover {
            background-color: #505050;
        }

        .sidebar a.active {
            background-color: #e50914;
        }

        /* Header */
        .header {
            margin-left: 250px;
            background-color: #fff;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #ddd;
        }

        .header h1 {
            font-size: 1.5rem;
            color: #333;
        }

        .header .search-box {
            display: flex;
            align-items: center;
        }

        .header .search-box input {
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-right: 10px;
        }

        .header .profile {
            display: flex;
            align-items: center;
        }

        .header .profile img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-left: 10px;
        }

        /* Main Content */
        .main-content {
            margin-left: 250px;
            padding: 20px;
        }

        .card {
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .stats {
            display: flex;
            gap: 20px;
            margin-bottom: 20px;
        }

        .stat-box {
            flex: 1;
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .stat-box h3 {
            font-size: 1.2rem;
            color: #333;
        }

        .stat-box p {
            font-size: 2rem;
            color: #e50914;
            margin: 10px 0;
        }

        /* Table */
        .table-container {
            margin-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            text-align: left;
            padding: 10px;
        }

        th {
            background-color: #f4f4f4;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: static;
            }

            .header {
                margin-left: 0;
            }

            .main-content {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <h2>Dashboard</h2>
        <a href="#" class="active">Analytics</a>
        <a href="#">Pages</a>
        <a href="#">Apps</a>
        <a href="#">Authentication</a>
        <a href="#">Settings</a>
    </div>

    <!-- Header -->
    <div class="header">
        <h1>Analytics</h1>
        <div class="search-box">
            <input type="text" placeholder="Search...">
            <i class="fas fa-search"></i>
        </div>
        <div class="profile">
            <span>Admin</span>
            <img src="https://via.placeholder.com/40" alt="Profile">
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Stats -->
        <div class="stats">
            <div class="stat-box">
                <h3>Users</h3>
                <p>2,300</p>
            </div>
            <div class="stat-box">
                <h3>Visits</h3>
                <p>4,500</p>
            </div>
            <div class="stat-box">
                <h3>Revenue</h3>
                <p>$12,400</p>
            </div>
        </div>

        <!-- Graph Placeholder -->
        <div class="card">
            <h3>Graph Section</h3>
            <p>Placeholder for graphs/charts.</p>
        </div>

        <!-- Table -->
        <div class="table-container">
            <h3>Top Selling Products</h3>
            <table>
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Sales</th>
                        <th>Revenue</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Product 1</td>
                        <td>1,200</td>
                        <td>$5,000</td>
                    </tr>
                    <tr>
                        <td>Product 2</td>
                        <td>900</td>
                        <td>$4,200</td>
                    </tr>
                    <tr>
                        <td>Product
