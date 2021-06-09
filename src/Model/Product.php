<?php

namespace src\Model;

class Product
{
    public ?int $id;
    public string $title;
    public string $description;
    public int $price;
    public int $amount;
    public int $producerId;
    public string $createdAt;
    public string $updateAt;

    /**
     * Product constructor.
     * @param int $id
     * @param string $title
     * @param string $description
     * @param int $price
     * @param int $amount
     * @param int $producerId
     * @param string $createdAt
     * @param string $updateAt
     */
    public function __construct(
        string $title,
        string $description,
        int $price,
        int $amount,
        int $producerId,
        int $id = null,
        string $createdAt = '',
        string $updateAt = ''
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->price = $price;
        $this->amount = $amount;
        $this->producerId = $producerId;
        if ($createdAt == '' && $updateAt == '') {
            $this->createdAt = (string) date('Y-m-d H:i:s');
            $this->updateAt = (string) date('Y-m-d H:i:s');
        } else {
            $this->createdAt = $createdAt;
            $this->updateAt = $updateAt;
        }
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
    public function getTitle(): string
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
    public function getDescription(): string
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
    public function getPrice(): int
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
    public function getAmount(): int
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

    public static function getDataFromProductMapper(array $data): self
    {
        if (isset($data)) {
            return new self(
                $data['title'],
                $data['description'],
                $data['price'],
                $data['amount'],
                $data['producer_id'],
                $data['id'],
                $data['created_at'],
                $data['update_at']
            );
        }
    }
}
