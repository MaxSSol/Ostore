<?php

namespace src\Model;

class Cart
{
    private ?int $id;
    private int $userId;
    private int $productId;
    private int $quantity;
    private string $productTitle;
    private int $productPrice;
    private int $totalPrice;
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
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * @param int $userId
     */
    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }

    /**
     * @return int
     */
    public function getTotalPrice(): int
    {
        return $this->totalPrice;
    }

    /**
     * @param int $totalPrice
     */
    public function setTotalPrice(int $totalPrice): void
    {
        $this->totalPrice = $totalPrice;
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
    public function getQuantity(): int
    {
        return $this->quantity;
    }

    /**
     * @param int $quantity
     */
    public function setQuantity(int $quantity): void
    {
        $this->quantity = $quantity;
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
    public function mapDataFromCartMapper(array $data): Cart
    {
        $cart = new Cart();
        if (isset($data['id'])) {
            $cart->setId($data['id']);
        }
        if (isset($data['product_id'])) {
            $cart->setProductId($data['product_id']);
        }
        if (isset($data['user_id'])) {
            $cart->setUserId($data['user_id']);
        }
        if (isset($data['quantity'])) {
            $cart->setQuantity($data['quantity']);
        }
        if (isset($data['title'])) {
            $cart->setProductTitle($data['title']);
        }
        if (isset($data['price'])) {
            $cart->setProductPrice($data['price']);
        }
        if (isset($data['created_at'])) {
            $cart->setCreatedAt($data['created_at']);
        }
        if (isset($data['update_at'])) {
            $cart->setCreatedAt($data['update_at']);
        }
        if (isset($data['total_price'])) {
            $cart->setTotalPrice($data['total_price']);
        }
        return $cart;
    }
}
