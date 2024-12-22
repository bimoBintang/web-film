<head>
    <style>
        .sidebar {
            position: fixed;
            height: 100%;
            width: 250px;
            top: 0;
            left: 0;
            background-color: #343a40;
            color: white;
            padding-top: 20px;
        }
        .sidebar a {
            color: #adb5bd;
            text-decoration: none;
            padding: 10px 20px;
            display: block;
            border-radius: 5px;
        }
        .sidebar a:hover {
            background-color: #495057;
            color: white;
        }
        .content {
            margin-left: 250px;
            padding: 20px;
        }
    </style>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
</head>
<nav class="sidebar">
    <h4 class="text-center text-white mb-4">Admin Panel</h4>
    <a href="/dashboard"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
    <a href="/dashboard/user"><i class="fas fa-users"></i> Users</a>
    <a href="/dashboard/movie"><i class="fas fa-box"></i> Movies</a>
    <a href="/dashboard/order"><i class="fas fa-shopping-cart"></i> Orders</a>
    <a href="#settings"><i class="fas fa-cogs"></i> Settings</a>
    <a href="#logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
</nav>