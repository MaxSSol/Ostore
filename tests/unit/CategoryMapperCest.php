<?php

use Framework\DataMapper\CategoryMapper;
use src\Model\Category;

class CategoryMapperCest
{
    private Category $category;
    private CategoryMapper $categoryMapper;
    private int $lastInsertId;
    public function _before(UnitTester $I)
    {
        $this->category = new Category();
        $this->categoryMapper = new CategoryMapper();
    }
    // tests
    public function tryToTestAddCategory(UnitTester $I)
    {
        $category = $this->category;
        $category->setTitle('Test');
        ($this->categoryMapper)->addCategory($category);
        $this->lastInsertId = $this->categoryMapper->getLastInsertId();
        $I->seeInDatabase(
            'categories',
            ['title' => 'Test']
        );
    }
    public function tryToTestUpdateCategoryName(UnitTester $I)
    {
        $category = $this->category;
        $category->setId($this->lastInsertId);
        $category->setTitle('Test1');
        ($this->categoryMapper)->updateCategory($category);
        $I->seeInDatabase(
            'categories',
            [
                'id' => $this->lastInsertId,
                'title' => 'Test1',
            ]
        );
    }
    public function tryToTestDeleteCategory(UnitTester $I)
    {
        $category = $this->category;
        $category->setId($this->lastInsertId);
        ($this->categoryMapper)->deleteCategory($category);
        $I->dontSeeInDatabase('categories', ['id' => $this->lastInsertId]);
    }
}
