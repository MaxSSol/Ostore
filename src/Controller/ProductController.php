<?php

declare(strict_types=1);

namespace src\Controller;

use Framework\Core\View;
use Framework\DataMapper\CategoryMapper;
use Framework\DataMapper\CategoryProductMapper;
use Framework\DataMapper\ProductMapper;
use Framework\DataMapper\ProductPhotoMapper;

class ProductController
{
    private ProductMapper $productMapper;
    private CategoryMapper $categoryMapper;
    private CategoryProductMapper $categoryProductMapper;
    public array $params;
    private View $view;
    public function __construct(array $params = [])
    {
        $this->categoryProductMapper = new CategoryProductMapper();
        $this->categoryMapper = new CategoryMapper();
        $this->productMapper = new ProductMapper();
        $this->params = $params;
        $this->view = new View();
    }

    public function viewAction(): void
    {
        $products = $this->productMapper->getProductList();
        $categories = $this->categoryMapper->getCategoriesList();
        $this->view->render(
            'show/show',
            'Products',
            ['css' => 'style/showProducts.css', 'products' => $products, 'categories' => $categories]
        );
    }
    public function viewProductAction(): void
    {
        if ($this->checkParams()) {
            $id = (int)$this->params['id'];
            $product = $this->productMapper->getProductById($id);
            $this->view->render(
                'show/product',
                'Product',
                ['css' => 'style/product.css', 'product' => $product]
            );
        } else {
            echo 'Product not found';
        }
    }
    public function viewProductByCategory()
    {
        if(isset($this->params['category'])) {
            $products = $this->categoryProductMapper->getProductsByCategory(ucfirst($this->params['category']));
            $categories = $this->categoryMapper->getCategoriesList();
            $this->view->render(
                'show/category',
                'Products',
                ['css' => '../style/category.css', 'products' => $products, 'categories' => $categories]
            );
        }
    }
    private function checkParams(): bool
    {
        return $this->params !== [];
    }
}
