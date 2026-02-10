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
