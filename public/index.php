<?php
// public/index.php

// Define constants
define('ROOT', dirname(__DIR__));
define('APP', ROOT . '/app');
define('CORE', ROOT . '/core');
define('VIEWS', ROOT . '/views');

// Autoload classes (basic)
spl_autoload_register(function ($class) {
    $class = str_replace('\\', DIRECTORY_SEPARATOR, $class);
    $paths = [
        ROOT . '/' . $class . '.php',
        CORE . '/' . $class . '.php',
        APP . '/Controllers/' . $class . '.php',
        APP . '/Models/' . $class . '.php',
    ];
    foreach ($paths as $path) {
        if (file_exists($path)) {
            require_once $path;
            return;
        }
    }
});

// Start session
session_start();

// Basic Routing
$url = isset($_GET['url']) ? rtrim($_GET['url'], '/') : 'dashboard';
$url = explode('/', $url);

$controllerName = 'app\\Controllers\\' . ucfirst($url[0]) . 'Controller';
$methodName = isset($url[1]) ? $url[1] : 'index';
$params = array_slice($url, 2);

if (class_exists($controllerName)) {
    $controller = new $controllerName();
    if (method_exists($controller, $methodName)) {
        call_user_func_array([$controller, $methodName], $params);
    } else {
        // 404
        header("HTTP/1.0 404 Not Found");
        echo "404 - Method not found";
    }
} else {
    // 404
    header("HTTP/1.0 404 Not Found");
    echo "404 - Controller not found: " . $controllerName;
}
