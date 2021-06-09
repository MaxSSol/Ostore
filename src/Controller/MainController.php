<?php

declare(strict_types=1);

namespace src\Controller;

use Framework\Core\View;
use Framework\DataMapper\ProductMapper;

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
        $productMapper = new ProductMapper();
        $product = $productMapper->getProductById(1);
        $this->view->render('main/index', 'Home', ['css' => 'style/main.css', 'product' => $product]);
    }
}