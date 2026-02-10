<?php
// router.php for PHP built-in server
if (file_exists(__DIR__ . '/public' . $_SERVER['REQUEST_URI']) && !is_dir(__DIR__ . '/public' . $_SERVER['REQUEST_URI'])) {
    return false; // serve the requested resource as-is.
} else {
    $_GET['url'] = ltrim($_SERVER['REQUEST_URI'], '/');
    require_once __DIR__ . '/public/index.php';
}
