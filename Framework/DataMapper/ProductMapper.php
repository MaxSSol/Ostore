<?php

namespace Framework\DataMapper;

use Framework\DataMapper\DataMapper;
use ReflectionObject;
use src\Model\Product;

class ProductMapper extends DataMapper
{
    private Product $product;
    public function __construct()
    {
        parent::__construct();
        $this->product = new Product();
    }

    public function getProductById(int $id): ?Product
    {
        $params = [':id' => $id];
        $sql ="select p.id,title,p.description,price,amount,p.created_at,p.update_at, pP.photo FROM products p
        JOIN productPhotos pP on p.id = pP.product_id WHERE p.id=:id AND position = ''";
        $result = $this->db->query($sql, $params);
        return $result ? $this->mapToProduct($result[0]) : null;
    }
    public function getProductList(): array
    {
        $sql = "select p.id,title,price,amount,p.created_at,p.update_at, pP.photo FROM products p
        JOIN productPhotos pP on p.id = pP.product_id WHERE position = 'main'";
        $result = $this->db->query($sql);
        $productArr = [];
        for ($i = 0; $i < count($result); $i++) {
            $productArr[] = $this->mapToProduct($result[$i]);
        }
        return $productArr;
    }
    public function insert(Product $product)
    {
        $paramToQuery = [];
        $valueToQuery = [];
        $paramToDb = [];
        $param = [
            $this->transformToDbFormat('title') => $product->getTitle(),
            $this->transformToDbFormat('description') => $product->getDescription(),
            $this->transformToDbFormat('price') => $product->getPrice(),
            $this->transformToDbFormat('amount') => $product->getAmount(),
            $this->transformToDbFormat('producerId') => $product->getProducerId()
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
    public function update(Product $product)
    {
        $id = $product->getId();
        $param = [
            'title' => $product->getTitle(),
            'description' => $product->getDescription(),
            'price' => $product->getPrice(),
            'amount' => $product->getAmount(),
        ];
        $paramToDb[':id'] = $id;
        $paramToQuery = [];
        foreach ($param as $key => $value) {
            $paramToQuery[] = $key . '=:' . $key;
            $bindParam = ':' . $key;
            $paramToDb[$bindParam] = $value;
        }
        $sql = 'UPDATE ' .
        $this->getTableName() .
        ' SET ' .
        implode(',', $paramToQuery) .
        ' WHERE id=:id';
        $this->db->query($sql, $paramToDb);
    }
    public function delete(Product $product)
    {
        if (!empty($product->getId())) {
            $paramToDb[':id'] = $product->getId();
            $sql = 'DELETE FROM ' .
                $this->getTableName() .
                ' WHERE id=:id';
            $this->db->query($sql, $paramToDb);
        }
    }
    private function getTableName(): string
    {
        return 'products';
    }
    private function mapToProduct(array $rows): Product
    {
        return $this->product->getDataFromProductMapper($rows);
    }
    private function transformToDbFormat(string $str): string
    {
        return strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $str));
    }
}
