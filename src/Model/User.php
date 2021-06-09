<?php

namespace src\Model;

class User
{
    public ?int $id;
    public string $firstName;
    public string $lastName;
    public string $email;
    public string $login;
    public string $password;
    public string $city;
    public string $address;
    public string $createdAt;
    public string $updateAt;

    /**
     * User constructor.
     * @param int|null $id
     * @param string $firstName
     * @param string $lastName
     * @param string $email
     * @param string $login
     * @param string $password
     * @param string $city
     * @param string $address
     * @param string $createdAt
     * @param string $updateAt
     */
    public function __construct(
        ?int $id,
        string $firstName,
        string $lastName,
        string $email,
        string $login,
        string $password,
        string $city,
        string $address,
        string $createdAt = '',
        string $updateAt = ''
    ) {
        $this->id = $id;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->login = $login;
        $this->password = $password;
        $this->city = $city;
        $this->address = $address;
        if ($createdAt == '' && $updateAt == '') {
            $this->createdAt = (string) date('Y-m-d H:i:s');
            $this->updateAt = (string) date('Y-m-d H:i:s');
        } else {
            $this->createdAt = $createdAt;
            $this->updateAt = $updateAt;
        }
    }

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
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     */
    public function setFirstName(string $firstName): void
    {
        $this->firstName = $firstName;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     */
    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getLogin(): string
    {
        return $this->login;
    }

    /**
     * @param string $login
     */
    public function setLogin(string $login): void
    {
        $this->login = $login;
    }

    /**
     * @return string
     */
    public function getHashpass(): string
    {
        return $this->hashpass;
    }

    /**
     * @param string $hashpass
     */
    public function setHashpass(string $hashpass): void
    {
        $this->hashpass = $hashpass;
    }

    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * @param string $city
     */
    public function setCity(string $city): void
    {
        $this->city = $city;
    }

    /**
     * @return string
     */
    public function getAddress(): string
    {
        return $this->address;
    }

    /**
     * @param string $address
     */
    public function setAddress(string $address): void
    {
        $this->address = $address;
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

    public static function getDataFromUserMapper(array $data): self
    {
        if (isset($data)) {
            return new self(
                $data['id'],
                $data['first_name'],
                $data['last_name'],
                $data['email'],
                $data['login'],
                $data['password'],
                $data['city'],
                $data['address'],
                $data['created_at'],
                $data['update_at']
            );
        }
    }
}
