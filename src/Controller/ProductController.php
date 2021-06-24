<?php

declare(strict_types=1);

namespace src\Controller;

use Framework\Core\Controller;
use Framework\DataMapper\CategoryMapper;
use Framework\DataMapper\CategoryProductMapper;
use Framework\DataMapper\ProductMapper;

class ProductController extends Controller
{
    private ProductMapper $productMapper;
    private CategoryMapper $categoryMapper;
    private CategoryProductMapper $categoryProductMapper;
    public array $params;
    public function __construct(array $params = [])
    {
        parent::__construct();
        $this->categoryProductMapper = new CategoryProductMapper();
        $this->categoryMapper = new CategoryMapper();
        $this->productMapper = new ProductMapper();
        $this->params = $params;
    }

    public function viewAction(): void
    {
        $categories = $this->categoryMapper->getCategoriesList();
        $this->view->render(
            'show/show',
            'Products',
            ['css' => 'style/showProducts.css','categories' => $categories]
        );
    }
    public function viewProductAction(): void
    {
        $this->view->render(
            'show/product',
            'Product',
            ['css' => 'style/product.css']
        );
    }
    public function viewProductByCategory(): void
    {
        if (isset($this->params['category'])) {
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