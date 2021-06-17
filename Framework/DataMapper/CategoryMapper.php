<?php

namespace Framework\DataMapper;

use Framework\DataMapper\DataMapper;
use src\Model\Category;

class CategoryMapper extends DataMapper
{
    private Category $category;
    public function __construct()
    {
        parent::__construct();
        $this->category = new Category();
    }
    public function getCategoriesList(): array
    {
        $sql = 'SELECT * FROM ' . $this->getTableName();
        $result = $this->db->query($sql);
        $categoriesArr = [];
        for ($i = 0; $i < count($result); $i++) {
            $categoriesArr[] = $this->mapToCategories($result[$i]);
        }
        return $categoriesArr;
    }
    public function insert(Category $category)
    {
        $paramToQuery = [];
        $valueToQuery = [];
        $paramToDb = [];
        array_filter((array)$category);
        foreach ($category as $key => $value) {
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
    public function update(Category $category)
    {
        $paramToQuery = [];
        $valueToQuery = [];
        $paramToDb = [];
        $id = $category->getId();
        array_filter((array)$category);
        foreach ($category as $key => $value) {
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
    public function delete(Category $category)
    {
        if (!empty($category->getId())) {
            $paramToDb[':id'] = $category->getId();
            $sql = 'DELETE FROM ' .
                $this->getTableName() .
                ' WHERE id=:id';
            $this->db->query($sql, $paramToDb);
        }
    }
    private function getTableName(): string
    {
        return 'categories';
    }
    private function mapToCategories(array $rows): Category
    {
        return $this->category->mapDataFromCategoryMapper($rows);
    }
    private function transformToNormalFormat(string $str): string
    {
        return strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $str));
    }
}
