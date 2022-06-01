<?php

// header("location: ./home.php");
$request = $_SERVER['REQUEST_URI'];

switch ($request) {
    case '/php-crud/home.php' :
        echo "Hello ";
        require __DIR__ . '/home';
        break;
    case '' :
        require __DIR__ . '/views/index.php';
        break;
    case '/about' :
        require __DIR__ . '/views/about.php';
        break;
    default:
        http_response_code(404);
        require __DIR__ . '/home.php';
        break;
}

?>