<?php
session_start();

require_once (__DIR__ . '/src/routes/init.php');


$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);


$requestMethod = $_SERVER['REQUEST_METHOD'];


$routeFound = false;
foreach ($routes as $route) {
    if ($route['method'] === $requestMethod && $route['uri'] === $requestUri) {
        $routeFound = true;
        call_user_func($route['action']);
        exit();
    }
}


if (!$routeFound) {
    require_once __DIR__ . '/src/app/pages/errors/404.php';
}
