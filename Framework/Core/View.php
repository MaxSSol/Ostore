<?php

namespace Framework\Core;

use Framework\Exception\ViewException;

class View
{
    public function render(string $pathToView, string $title, array $params = [], string $layout = 'default')
    {
        try {
            if (isset($params)) {
                extract($params);
            }
            $path = __DIR__ . '/../../src/View/' . $pathToView . '.php';
            if (file_exists($path)) {
                ob_start();
                require_once $path;
                $content = ob_get_clean();
                require_once __DIR__ . '/../../src/View/layouts/' . $layout . '.php';
            } else {
                throw new ViewException();
            }
        } catch (ViewException $e) {
            $errorView = new View();
            $errorView->render(
                'error/error404',
                'Error',
                ['code' => $e->getCode(),
                    'message' => $e->getMessage()],
                'error'
            );
        }
    }
}
