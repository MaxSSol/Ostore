<?php

namespace src\Controller;

use Framework\Core\View;

class MainController
{
    public string $route;
    public object $view;
    public array $getParam;
    public function __construct($route, $getParam)
    {
        $this->route = $route;
        $this->getParam = $getParam;
        $this->view = new View($this->route);
    }
    public function indexAction(): void
    {
        $this->view->render('Home', ['css' => 'style/main.css']);
    }
}
