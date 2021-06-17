<?php

namespace src\Model;

class CategoryProduct
{
    private ?int $id;
    private int $categoryId;
    private string $categoryTitle;
    private int $productId;
    private string $productPhoto;
    private int $productPrice;
    private string $productTitle;
    private string $createdAt;
    private string $updateAt;


    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     */
    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getCategoryId(): int
    {
        return $this->categoryId;
    }

    /**
     * @param int $categoryId
     */
    public function setCategoryId(int $categoryId): void
    {
        $this->categoryId = $categoryId;
    }

    /**
     * @return int
     */
    public function getProductId(): int
    {
        return $this->productId;
    }

    /**
     * @param int $productId
     */
    public function setProductId(int $productId): void
    {
        $this->productId = $productId;
    }

    /**
     * @return int
     */
    public function getProductPrice(): int
    {
        return $this->productPrice;
    }

    /**
     * @param int $productPrice
     */
    public function setProductPrice(int $productPrice): void
    {
        $this->productPrice = $productPrice;
    }

    /**
     * @return string
     */
    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    /**
     * @param string $createdAt
     */
    public function setCreatedAt(string $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return string
     */
    public function getUpdateAt(): string
    {
        return $this->updateAt;
    }

    /**
     * @param string $updateAt
     */
    public function setUpdateAt(string $updateAt): void
    {
        $this->updateAt = $updateAt;
    }
    /**
     * @return string
     */
    public function getCategoryTitle(): string
    {
        return $this->categoryTitle;
    }

    /**
     * @param string $categoryTitle
     */
    public function setCategoryTitle(string $categoryTitle): void
    {
        $this->categoryTitle = $categoryTitle;
    }

    /**
     * @return string
     */
    public function getProductTitle(): string
    {
        return $this->productTitle;
    }

    /**
     * @param string $productTitle
     */
    public function setProductTitle(string $productTitle): void
    {
        $this->productTitle = $productTitle;
    }

    /**
     * @return string
     */
    public function getProductPhoto(): string
    {
        return $this->productPhoto;
    }

    /**
     * @param string $productPhoto
     */
    public function setProductPhoto(string $productPhoto): void
    {
        $this->productPhoto = $productPhoto;
    }

    public function mapDataFromCategoryProductMapper(array $data): CategoryProduct
    {
        $categoryProduct = new CategoryProduct();
        if (isset($data['id'])) {
            $categoryProduct->setId($data['id']);
        }
        if (isset($data['category_id'])) {
            $categoryProduct->setCategoryId($data['category_id']);
        }
        if (isset($data['title'])) {
            $categoryProduct->setCategoryTitle($data['category_title']);
        }
        if (isset($data['product_id'])) {
            $categoryProduct->setProductId($data['product_id']);
        }
        if (isset($data['price'])) {
            $categoryProduct->setProductPrice($data['price']);
        }
        if (isset($data['title'])) {
            $categoryProduct->setProductTitle($data['title']);
        }
        if (isset($data['photo'])) {
            $categoryProduct->setProductPhoto($data['photo']);
        }
        if (isset($data['created_at'])) {
            $categoryProduct->setCreatedAt($data['created_at']);
        }
        if (isset($data['update_at'])) {
            $categoryProduct->setCreatedAt($data['update_at']);
        }
        if (isset($data['photo'])) {
            $categoryProduct->setProductPhoto($data['photo']);
        }
        return $categoryProduct;
    }
}