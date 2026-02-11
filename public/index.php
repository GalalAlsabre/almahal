<?php
// public/index.php

// Define constants
define('ROOT', dirname(__DIR__));
define('APP', ROOT . '/app');
define('CORE', ROOT . '/core');
define('VIEWS', ROOT . '/views');

// Autoload classes (basic PSR-4 like)
spl_autoload_register(function ($class) {
    // Map namespace to directory
    $classPath = str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';

    // Attempt to load from ROOT (covers app/Controllers, app/Models, core/ etc.)
    $fullPath = ROOT . DIRECTORY_SEPARATOR . $classPath;

    if (file_exists($fullPath)) {
        require_once $fullPath;
    }
});

// Start session
session_start();

// Basic Routing
$urlPath = isset($_GET['url']) ? rtrim($_GET['url'], '/') : '';
if (empty($urlPath)) {
    $urlPath = 'dashboard';
}
$url = explode('/', $urlPath);

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
