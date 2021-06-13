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
    public function getProducts(): void
    {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        $products = $this->productMapper->getProductList();
        $json = [];
        foreach ($products as $product) {
            $json[] = $product;
        }
        echo json_encode($json);
    }
    public function getProduct()
    {
        if ($this->checkParams() !== false) {
            header("Access-Control-Allow-Origin: *");
            header("Content-Type: application/json; charset=UTF-8");
            $id = (int)$this->params['id'];
            $product = $this->productMapper->getProductById($id);
            $jsonProduct = [];
            foreach ($product as $key => $param) {
                $jsonProduct[$key] = $param;
            }
            echo json_encode($jsonProduct);
        }
    }
    public function viewAction(): void
    {
        $this->view->render(
            'show/show',
            'Products',
            ['css' => 'style/showProducts.css','js' => 'js/products.js']
        );
    }
    public function viewProductAction(): void
    {
        $this->view->render(
            'show/product',
            'Product',
            ['css' => 'style/product.css', 'js' => 'js/product.js']
        );
    }
    private function checkParams(): bool
    {
        return $this->params !== [];
    }
}
