<?php 

$routes = [
    [
        'method' => 'GET',
        'uri' => '/',
        'action' => function() {
            require_once(__DIR__ . '/../app/pages/Home/index.php');
        }
    ],
    [
        'method' => 'GET',
        'uri' => '/auth/sign-in',
        'action' => function() {
            require_once(__DIR__ . '/../app/pages/Auth/sign-in/index.php');
        }
    ],
    [
        'method' => 'GET',
        'uri' => '/auth/sign-up',
        'action' => function() {
            require_once(__DIR__ . '/../app/pages/Auth/sign-up/index.php');
        }
    ],
    [
        'method' => 'GET',
        'uri' => '/dashboard',
        'action' => function() {
            require_once(__DIR__ . '/../app/pages/dashboard/index.php');
        }
    ],
    [
        'method' => 'GET',
        'uri' => '/dashboard/user',
        'action' => function() {
            require_once(__DIR__ . '/../app/pages/dashboard/users/index.php');
        }
    ],
    [
        'method' => 'GET',
        'uri' => '/dashboard/movie',
        'action' => function() {
            require_once(__DIR__ . '/../app/pages/dashboard/movies/index.php');
        }
    ],
    [
        'method' => 'GET',
        'uri' => '/dashboard/movie/edit',
        'action' => function() {
            require_once(__DIR__ . '/../app/pages/dashboard/movies/edit.php');
        }
    ],
    [
        'method' => 'GET',
        'uri' => '/dashboard/order',
        'action' => function() {
            require_once(__DIR__ . '/../app/pages/dashboard/orders/index.php');
        }
    ],
    [
        'method' => 'GET',
        'uri' => '/404',
        'action' => function() {
            require_once(__DIR__ . '/../app/pages/errors/404.php');
        }
    ],
];

function handleRoute($routes) {
    $requestMethod = $_SERVER['REQUEST_METHOD'];
    $requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

    foreach ($routes as $route) {
        if ($route['method'] === $requestMethod && $route['uri'] === $requestUri) {
            $route['action']();
            return;
        }
    }

    header("HTTP/1.0 404 Not Found");
    require_once(__DIR__ . '/../app/pages/errors/404.php');
}

handleRoute($routes);
?>
