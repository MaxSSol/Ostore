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
    public function addCategory(Category $category)
    {
        $paramToQuery = ['title'];
        $valueToQuery = [':title'];
        $paramToDb = [':title' => $category->getTitle()];
        $sql = 'INSERT INTO ' .
        $this->getTableName() .
        '(' .
        implode(',', $paramToQuery) .
        ') VALUES (' .
        implode(',', $valueToQuery) .
        ')';
        $this->db->query($sql, $paramToDb);
    }
    public function updateCategory(Category $category)
    {
        $paramToQuery = ['title=:title'];
        $paramToDb = [':title' => $category->getTitle()];
        $paramToDb[':id'] = $category->getId();
        $sql = 'UPDATE ' .
            $this->getTableName() .
            ' SET ' .
            implode(',', $paramToQuery) .
            ' WHERE id=:id';
        $this->db->query($sql, $paramToDb);
    }
    public function deleteCategory(Category $category)
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
    private function transformToDbFormat(string $str): string
    {
        return strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $str));
    }
}
