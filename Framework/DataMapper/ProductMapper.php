<?php

namespace Framework\DataMapper;

use Framework\DataMapper\DataMapper;
use src\lib\Database;
use src\Model\Product;

class ProductMapper extends DataMapper
{
    public function getProductById(int $id): ?Product
    {
        $params = [':id' => $id];
        $sql = $this->query->select() .
            $this->query->from($this->getTableName()) .
            $this->query->where(['id'], '=');
        $result = $this->db->query($sql, $params);
        return $result ? $this->mapToProduct($result[0]) : null;
    }
    public function getProductList(): array
    {
        $sql = $this->query->select() .
        $this->query->from($this->getTableName());
        $result = $this->db->query($sql);
        $productArr = [];
        for ($i = 0; $i < count($result); $i++) {
            $productArr[] = Product::getDataFromProductMapper($result[$i]);
        }
        return $productArr;
    }
    public function insert(Product $product)
    {
        $paramToQuery = [];
        $valueToQuery = [];
        $paramToDb = [];
        array_filter((array)$product);
        foreach ($product as $key => $value) {
            if ($key !== 'id') {
                $param = $this->transformToNormalFormat($key);
                $paramKeyFormat = ':' . $param;
                $paramToQuery[] = $param;
                $valueToQuery[] = $paramKeyFormat;
                $paramToDb[$paramKeyFormat] = $value;
            }
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
        $paramToQuery = [];
        $valueToQuery = [];
        $paramToDb = [];
        $id = $product->getId();
        array_filter((array)$product);
        foreach ($product as $key => $value) {
            if ($key !== 'id' && $key !== 'createdAt') {
                $param = $this->transformToNormalFormat($key);
                $paramKeyFormat = ':' . $param;
                $paramToQuery[] = $param . '=' . $paramKeyFormat;
                $paramToDb[$paramKeyFormat] = $value;
            }
        }
        $paramToDb[':id'] = $id;
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
        return Product::getDataFromProductMapper($rows);
    }
    private function transformToNormalFormat(string $str): string
    {
        return strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $str));
    }
}
