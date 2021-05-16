<?php

namespace src\Controller;

use Framework\Core\View;

class MainController
{
    public array $route;
    public object $view;

    public function __construct($route)
    {
        $this->route = $route;
        $this->view = new View($route);
    }

    public function indexAction(): void
    {
        $this->view->render('Home', ['css' => 'style/main.css']);
    }
}
