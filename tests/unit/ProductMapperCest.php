<?php

use Framework\DataMapper\ProductMapper;
use src\Model\Product;

class ProductMapperCest
{
    private Product $product;
    private ProductMapper $productMapper;
    private int $lastInsertId;
    public function __construct()
    {
        $this->product = new Product();
        $this->productMapper = new ProductMapper();
    }
    // tests
    public function tryToTestAddProductToProducts(UnitTester $I)
    {
        $product = $this->product;
        $product->setTitle('Test');
        $product->setDescription('TEST DESC');
        $product->setPrice(150);
        $product->setAmount(10);
        $product->setProducerId(3);
        ($this->productMapper)->addProduct($product);
        $this->lastInsertId = $this->productMapper->getLastInsertId();
        $I->seeInDatabase(
            'products',
            ['title' => 'Test', 'description' => 'TEST DESC', 'price' => 150, 'amount' => 10, 'producer_id' => 3]
        );
    }
    public function tryToTestUpdateProductInProducts(UnitTester $I)
    {
        $product = $this->product;
        $product->setId($this->lastInsertId);
        $product->setTitle('Test');
        $product->setDescription('TEST DESC');
        $product->setPrice(1500);
        $product->setAmount(10);
        $product->setProducerId(3);
        ($this->productMapper)->updateProduct($product);
        $I->seeInDatabase(
            'products',
            [
                'id' => $this->lastInsertId,
                'title' => 'Test',
                'description' => 'TEST DESC',
                'price' => 1500, 'amount' => 10,
                'producer_id' => 3
            ]
        );
    }
    public function tryToTestDeleteProductFromProductsById(UnitTester $I)
    {
        $product = $this->product;
        $product->setId($this->lastInsertId);
        ($this->productMapper)->deleteProduct($product);
        $I->dontSeeInDatabase('products', ['id' => $this->lastInsertId]);
    }
}
