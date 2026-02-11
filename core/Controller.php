<?php

namespace core;

abstract class Controller {
    protected function view($view, $data = [], $layout = 'main') {
        extract($data);
        $viewFile = VIEWS . '/' . $view . '.php';
        if (file_exists($viewFile)) {
            if ($layout) {
                ob_start();
                require_once $viewFile;
                $content = ob_get_clean();
                require_once VIEWS . '/layouts/' . $layout . '.php';
            } else {
                require_once $viewFile;
            }
        } else {
            die("View $view not found.");
        }
    }

    protected function redirect($url) {
        if (strpos($url, 'http') !== 0) {
            $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
            $host = $_SERVER['HTTP_HOST'];
            $scriptName = $_SERVER['SCRIPT_NAME'];
            $base = (strpos($scriptName, 'index.php') !== false) ? str_replace('/public/index.php', '', $scriptName) : '';
            $url = $protocol . "://" . $host . $base . '/' . ltrim($url, '/');
        }
        header("Location: " . $url);
        exit;
    }

    protected function json($data) {
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }

    protected function isPost() {
        return $_SERVER['REQUEST_METHOD'] === 'POST';
    }
}
