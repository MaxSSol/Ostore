<?php

declare(strict_types=1);

namespace src\Controller;

use Framework\Core\Controller;
use Framework\DataMapper\ProductMapper;

class MainController extends Controller
{
    private array $params;
    private ProductMapper $productMapper;
    public function __construct(array $params = [])
    {
        parent::__construct();
        $this->params = $params;
        $this->productMapper = new ProductMapper();
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
