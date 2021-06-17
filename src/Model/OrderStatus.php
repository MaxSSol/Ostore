<?php

namespace src\Model;

class OrderStatus
{
    private ?int $id;
    private int $userId;
    private int $productId;
    private string $status;
    private string $comment;
    private string $createdAt;
    private string $updateAt;
    private string $productTitle;
    private string $productPrice;
    private string $productQuantity;

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
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    /**
     * @return string
     */
    public function getComment(): string
    {
        return $this->comment;
    }

    /**
     * @param string $comment
     */
    public function setComment(string $comment): void
    {
        $this->comment = $comment;
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
    public function getProductPrice(): string
    {
        return $this->productPrice;
    }

    /**
     * @param string $productPrice
     */
    public function setProductPrice(string $productPrice): void
    {
        $this->productPrice = $productPrice;
    }

    /**
     * @return string
     */
    public function getProductQuantity(): string
    {
        return $this->productQuantity;
    }

    /**
     * @param string $productQuantity
     */
    public function setProductQuantity(string $productQuantity): void
    {
        $this->productQuantity = $productQuantity;
    }

    public function getDataFromOrderStatusMapper(array $data): OrderStatus
    {
        $orderStatus = new OrderStatus();
        foreach ($data as $key => $value) {
            if ($key == 'id') {
                $orderStatus->setId($value);
            }
            if (preg_match('/product_id([_0-9]{0,9})/', $key)) {
                $orderStatus->setProductId($value);
            }
            if ($key == 'user_id') {
                $orderStatus->setUserId($value);
            }
            if ($key == 'comment') {
                $orderStatus->setComment($value);
            }
            if ($key == 'status') {
                $orderStatus->setStatus($value);
            }
            if ($key == 'created_at') {
                $orderStatus->setCreatedAt($value);
            }
            if ($key == 'update_at') {
                $orderStatus->setCreatedAt($value);
            }
            if ($key == 'product_title') {
                $orderStatus->setProductTitle($value);
            }
            if ($key == 'price') {
                $orderStatus->setProductPrice($value);
            }
            if (preg_match('/quantity([_0-9]{0,9})/', $key)) {
                $orderStatus->setProductQuantity($value);
            }
        }
        return $orderStatus;
    }
}
