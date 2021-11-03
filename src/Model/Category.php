<?php

namespace src\Model;

class Category
{
    private ?int $id;
    private string $title;
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
    public function mapDataFromCategoryMapper(array $data): self
    {
        $category = new Category();
        if (isset($data['id'])) {
            $category->setId($data['id']);
        }
        if (isset($data['title'])) {
            $category->setTitle($data['title']);
        }
        if (isset($data['created_at'])) {
            $category->setCreatedAt($data['created_at']);
        }
        if (isset($data['update_at'])) {
            $category->setCreatedAt($data['update_at']);
        }
        return $category;
    }
}
