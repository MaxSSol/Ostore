<?php

namespace src\Controller;

use Framework\DataMapper\ProductMapper;

class ApiProductController
{
    private ProductMapper $productMapper;
    private array $params;
    public function __construct(array $params)
    {
        $this->params = $params;
        $this->productMapper = new ProductMapper();
    }
    public function getProductsList(): void
    {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        $products = $this->productMapper->getProductList();
        $jsonProducts = [];
        foreach ($products as $product) {
            $jsonProducts[] = [
                'id' => $product->getId(),
                'title' => $product->getTitle(),
                'price' => $product->getPrice(),
                'amount' => $product->getAmount(),
                'productPhoto' => $product->getProductPhoto()
                ];
        }
        echo json_encode($jsonProducts);
    }
    public function getProduct()
    {
        if ($this->checkParams() !== false) {
            header("Access-Control-Allow-Origin: *");
            header("Content-Type: application/json; charset=UTF-8");
            $id = (int)$this->params['id'];
            $product = $this->productMapper->getProductById($id);
            $jsonProduct = [];
            $jsonProduct[] = [
                    'id' => $product->getId(),
                    'title' => $product->getTitle(),
                    'description' => $product->getDescription(),
                    'price' => $product->getPrice(),
                    'amount' => $product->getAmount(),
                    'productPhoto' => $product->getProductPhoto()
                ];
            echo json_encode($jsonProduct);
        }
    }
    private function checkParams(): bool
    {
        return $this->params !== [];
    }
}
