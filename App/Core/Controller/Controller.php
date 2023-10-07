<?php

namespace App\Core\Controller;


class Controller {

    protected $viewPath;
    protected $template;

    public function render($view, ?array $params = []){
        
        $view = str_replace('.', '/', $view) . '.php';
        extract($params);
        ob_start();
        require $this->viewPath . $view;
        $content = ob_get_clean();
        require $this->viewPath . 'template' . DIRECTORY_SEPARATOR . $this->template . '.php';
    }

    protected function notFound()
    {
        header("HTTP/1.0 404 Not Found");
        die("Page non trouvée");
    }

    protected function forbidden()
    {
        header("Location: index.php?page=users.login");
        http_response_code(301);
        exit();
    }
}