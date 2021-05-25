<?php

namespace Framework\Core;

use Framework\Exception\ViewException;

class View
{
    protected string $route;

    public function __construct(string $route)
    {
        $this->route = $route;
    }

    public function render(string $title, array $params = [], string $layout = 'default')
    {
        try {
            if (isset($params)) {
                extract($params);
            }

            //$path = __DIR__.'/../View/'.$this->route.'.php'; include route
//            $path = __DIR__ . '/../../src/View/' . $this->route['controller'] . '/' . $this->route['action'] . '.php';
            $path = __DIR__ . '/../../src/View/' . $this->route . '.php';
            if (file_exists($path)) {
                ob_start();
                require_once $path;
                $content = ob_get_clean();
                require_once __DIR__ . '/../../src/View/layouts/' . $layout . '.php';
            } else {
                throw new ViewException();
            }
        } catch (ViewException $e) {
            $errorView = new View('error/error404');
            $errorView->render('Error', ['code' => $e->getCode(), 'message' => $e->getMessage()], 'error');
        }
    }
}
