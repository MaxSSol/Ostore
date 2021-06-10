<?php

declare(strict_types=1);

namespace src\Controller;

use Framework\Core\View;
use Framework\DataMapper\ProductMapper;

class ProductController
{
    private ProductMapper $productMapper;
    public array $params;
    private View $view;
    public function __construct(array $params = [])
    {
        $this->productMapper = new ProductMapper();
        $this->params = $params;
        $this->view = new View();
    }
    public function viewAction(): void
    {
        $products = $this->productMapper->getProductList();
        $this->view->render('show/show', 'Products', ['css' => 'style/showProducts.css', 'products' => $products]);
    }
    public function viewProductAction(): void
    {
        if ($this->checkParams()) {
            $id = (int)$this->params['id'];
            $product = $this->productMapper->getProductById($id);
            $this->view->render(
                'show/product',
                $product->getTitle(),
                ['css' => 'style/product.css', 'product' => $product]
            );
        } else {
            echo 'Product not found';
        }
    }
    private function checkParams(): bool
    {
        return $this->params !== [];
    }
}
