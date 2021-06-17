<?php

namespace Framework\DataMapper;

use Framework\DataMapper\DataMapper;
use src\Model\CategoryProduct;

class CategoryProductMapper extends DataMapper
{
    private CategoryProduct $categoryProduct;
    public function __construct()
    {
        parent::__construct();
        $this->categoryProduct = new CategoryProduct();
    }
    public function getProductsByCategory(string $category): array
    {
        $sql = "SELECT cP.id,p.title,p.price,cP.product_id,c.title AS category_title,pP.photo FROM categoryProduct cP
        JOIN products p on p.id = cP.product_id 
        JOIN categories c on c.id = cP.category_id 
        JOIN productPhotos pP on p.id = pP.product_id 
        WHERE c.title =:category AND pP.position = 'main'";
        $productArr = [];
        $result = $this->db->query($sql, [':category'=>$category]);
        for ($i = 0; $i < count($result); $i++) {
            $productArr[] = $this->mapToCategoryProduct($result[$i]);
        }
        return $productArr;
    }
    public function insert(CategoryProduct $categoryProduct): void
    {
        $paramToDb = [];
        $paramToQuery = [];
        $valueToQuery = [];
        $param = [
            $this->transformToNormalFormat('categoryId') => $categoryProduct->getCategoryId(),
            $this->transformToNormalFormat('productId') => $categoryProduct->getProductId(),
        ];
        foreach ($param as $key => $value) {
            $paramToQuery[] = $key;
            $bindParam = ':' . $key;
            $valueToQuery[] = $bindParam;
            $paramToDb[$bindParam] = $value;
        }
        $sql = 'INSERT INTO ' .
            $this->getTableName() .
            '(' .
            implode(',', $paramToQuery) .
            ') VALUES (' .
            implode(',', $valueToQuery) .
            ')';
        $this->db->query($sql, $paramToDb);
    }
    public function update(CategoryProduct $categoryProduct): void
    {
        $paramToDb = [];
        $paramToQuery = [];
        $param = [
            $this->transformToNormalFormat('categoryId') => $categoryProduct->getCategoryId(),
            $this->transformToNormalFormat('productId') => $categoryProduct->getProductId()
        ];
        foreach ($param as $key => $value) {
            $bindParam = ':' . $key;
            $paramToQuery[] = $key . '=' . $bindParam;
            $paramToDb[$bindParam] = $value;
        }
        $paramToDb[':id'] = $categoryProduct->getId();
        $sql = 'UPDATE ' .
            $this->getTableName() .
            ' SET ' .
            implode(',', $paramToQuery) .
            ' WHERE id=:id';
        $this->db->query($sql, $paramToDb);
    }
    public function delete(CategoryProduct $categoryProduct): void
    {
        if (!empty($categoryProduct->getId())) {
            $paramToDb[':id'] = $categoryProduct->getId();
            $sql = 'DELETE FROM ' .
                $this->getTableName() .
                ' WHERE id=:id';
            $this->db->query($sql, $paramToDb);
        }
    }
    private function getTableName(): string
    {
        return 'categoryProduct';
    }
    private function mapToCategoryProduct($rows): CategoryProduct
    {
        return $this->categoryProduct->mapDataFromCategoryProductMapper($rows);
    }
    private function transformToNormalFormat(string $str): string
    {
        return strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $str));
    }
}
