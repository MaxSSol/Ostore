<?php

namespace Framework\DataMapper;

use src\Model\Cart;

class CartMapper extends DataMapper
{
    private Cart $cart;
    public function __construct()
    {
        parent::__construct();
        $this->cart = new Cart();
    }

    public function getCartByUserId(int $userId): array
    {
        $params = [':user_id' => $userId];
        $sql = 'select cart.id,p.title,p.price,product_id,quantity from cart 
        JOIN products p on p.id = cart.product_id WHERE user_id=:user_id';
        $result = $this->db->query($sql, $params);
        $productArr = [];
        for ($i = 0; $i < count($result); $i++) {
            $productArr[$i] = $this->mapToCart($result[$i]);
        }
        return $productArr;
    }
    public function getTotalPrice(int $userId): Cart
    {
        $paramToDb = [$this->transformToNormalFormat(':userId') => $userId];
        $sql = 'SELECT SUM(p.price) AS total_price FROM cart 
        JOIN products p on p.id = cart.product_id WHERE user_id=:user_id';
        $result = $this->db->query($sql, $paramToDb);
        return $this->mapToCart($result[0]);
    }
    public function getCartList(): array
    {
        $sql = 'SELECT * FROM ' . $this->getTableName();
        $result = $this->db->query($sql);
        $productArr = [];
        for ($i = 0; $i < count($result); $i++) {
            $productArr[] = $this->mapToCart($result[$i]);
        }
        return $productArr;
    }
    public function insert(Cart $cart): void
    {
        $paramToDb = [
            $this->transformToNormalFormat(':userId') => $cart->getUserId(),
            $this->transformToNormalFormat(':productId') => $cart->getProductId(),
            $this->transformToNormalFormat(':quantity') => $cart->getQuantity(),
        ];
        $sql = 'INSERT INTO ' .
            $this->getTableName() .
            '(user_id,product_id,quantity)VALUES(:user_id,:product_id,:quantity)';
        $this->db->query($sql, $paramToDb);
    }
    public function update(Cart $cart): void
    {
        $paramToDb = [];
        $id = $cart->getId();
        $paramToDb = [
            ':id' => $id,
            $this->transformToNormalFormat(':quantity') => $cart->getQuantity()
            ];
        $sql = 'UPDATE ' .
            $this->getTableName() .
            ' SET quantity=:quantity WHERE id=:id';
        $this->db->query($sql, $paramToDb);
    }
    public function deleteProductFromCartByColumn(array $column, int $userId)
    {
        if (!empty($column)) {
            $paramToQuery = [];
            $paramToDb = [];
            foreach ($column as $key => $value) {
                $paramToQuery[] = $key . '=:' . $key;
                $bindParam = ':' . $key;
                $paramToDb[$bindParam] = $value;
            }
            $paramToDb[':user_id'] = $userId;
            $sql = 'DELETE FROM ' .
                $this->getTableName() .
                ' WHERE user_id=:user_id AND ' .
                implode(',', $paramToQuery);
            var_dump($paramToDb);
            $this->db->query($sql, $paramToDb);
        }
    }
    public function deleteRecordById(int $id): void
    {
        if (!empty($id)) {
            $paramToDb[':id'] = $id;
            $sql = 'DELETE FROM ' .
                $this->getTableName() .
                ' WHERE id=:id';
            $this->db->query($sql, $paramToDb);
        }
    }
    private function getTableName(): string
    {
        return 'cart';
    }
    private function mapToCart($rows)
    {
        return $this->cart->mapDataFromCartMapper($rows);
    }
    private function transformToNormalFormat(string $str): string
    {
        return strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $str));
    }
}
