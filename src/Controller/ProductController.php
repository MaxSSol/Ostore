<?php

declare(strict_types=1);

namespace src\Controller;

use Framework\Core\View;

class ProductController
{
    public array $params;
    private View $view;
    public function __construct(array $params = [])
    {
        $this->params = $params;
        $this->view = new View();
    }
    public function viewAction()
    {
        $this->view->render('show/show', 'Products', ['css' => 'style/show.css']);
    }
}
