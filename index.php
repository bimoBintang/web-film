<?php
session_start();
// Autoload atau include file yang diperlukan
require_once (__DIR__ . '/src/routes/init.php');

// Ambil URL yang diminta
$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Ambil metode HTTP
$requestMethod = $_SERVER['REQUEST_METHOD'];

// Jalankan router
$routeFound = false;
foreach ($routes as $route) {
    if ($route['method'] === $requestMethod && $route['uri'] === $requestUri) {
        $routeFound = true;
        call_user_func($route['action']);
        exit();
    }
}

// Jika rute tidak ditemukan, tampilkan halaman 404
if (!$routeFound) {
    require_once __DIR__ . '/src/app/pages/errors/404.php';
}
