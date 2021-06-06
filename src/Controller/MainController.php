<?php

declare(strict_types=1);

namespace src\Controller;

use Framework\Core\View;

class MainController
{
    public View $view;
    private array $params;
    public function __construct(array $params = [])
    {
        $this->params = $params;
        $this->view = new View();
    }
    public function indexAction(): void
    {
        $this->view->render('main/index', 'Home', ['css' => 'style/main.css']);
    }
}
