<?php
/**
 * router.php for PHP Built-in Server
 */

$uri = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

// 1. If it's a file in the project root or public folder, serve it
if ($uri !== '/' && file_exists(__DIR__ . $uri) && !is_dir(__DIR__ . $uri)) {
    return false;
}

// 2. If it's a file relative to 'public', serve it
if ($uri !== '/' && file_exists(__DIR__ . '/public' . $uri) && !is_dir(__DIR__ . '/public' . $uri)) {
    // We need to serve it manually or redirect
    // Actually, returning false only works if the file is where PHP thinks it is.
    // Let's just return false and let PHP try to find it.
    return false;
}

// 3. Route everything else to public/index.php
$_GET['url'] = ltrim($uri, '/');
require_once __DIR__ . '/public/index.php';
