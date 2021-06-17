<?php

declare(strict_types=1);

namespace src\Controller;

use Framework\Core\View;
use Framework\DataMapper\ProductMapper;

class MainController
{
    public View $view;
    private array $params;
    private ProductMapper $productMapper;
    public function __construct(array $params = [])
    {
        $this->params = $params;
        $this->productMapper = new ProductMapper();
        $this->view = new View();
    }
    public function indexAction(): void
    {
        $products = $this->productMapper->getProductList();
        $this->view->render(
            'main/index',
            'Home',
            ['css' => 'style/mainPage.css', 'products' => $products]
        );
    }
}
