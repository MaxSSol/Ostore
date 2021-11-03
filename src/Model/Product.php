<?php

namespace src\Model;

class Product
{
    protected ?int $id;
    protected string $title;
    protected string $description;
    protected int $price;
    protected int $amount;
    protected string $photo;
    protected int $producerId;
    protected string $createdAt;
    protected string $updateAt;
    /**
     * @return string
     */
    public function getProductPhoto(): string
    {
        return $this->photo;
    }

    /**
     * @param string $photo
     */
    public function setProductPhoto(string $photo): void
    {
        $this->photo = $photo;
    }

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return int
     */
    public function getPrice(): ?int
    {
        return $this->price;
    }

    /**
     * @param int $price
     */
    public function setPrice(int $price): void
    {
        $this->price = $price;
    }

    /**
     * @return int
     */
    public function getAmount(): ?int
    {
        return $this->amount;
    }

    /**
     * @param int $amount
     */
    public function setAmount(int $amount): void
    {
        $this->amount = $amount;
    }

    /**
     * @return int
     */
    public function getProducerId(): int
    {
        return $this->producerId;
    }

    /**
     * @param int $producerId
     */
    public function setProducerId(int $producerId): void
    {
        $this->producerId = $producerId;
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
    public function getDataFromProductMapper(array $data): Product
    {
        $product = new Product();
        if (isset($data['id'])) {
            $product->setId($data['id']);
        }
        if (isset($data['title'])) {
            $product->setTitle($data['title']);
        }
        if (isset($data['description'])) {
            $product->setDescription($data['description']);
        }
        if (isset($data['price'])) {
            $product->setPrice($data['price']);
        }
        if (isset($data['amount'])) {
            $product->setAmount($data['amount']);
        }
        if (isset($data['created_at'])) {
            $product->setCreatedAt($data['created_at']);
        }
        if (isset($data['update_at'])) {
            $product->setCreatedAt($data['update_at']);
        }
        if (isset($data['photo'])) {
            $product->setProductPhoto($data['photo']);
        }
        return $product;
    }
}
