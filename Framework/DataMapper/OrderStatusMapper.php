<?php

namespace Framework\DataMapper;

use Framework\DataMapper\DataMapper;
use src\Model\OrderStatus;

class OrderStatusMapper extends DataMapper
{
    private OrderStatus $orderStatus;
    public function __construct()
    {
        parent::__construct();
        $this->orderStatus = new OrderStatus();
    }
    public function getOrder(array $data, int $userId, $status, $comment): array
    {
        $orderArr = [];
        $order = array_chunk($data, 2, true);
        for ($i = 0; $i < count($order); $i++) {
            foreach ($order[$i] as $key => $value) {
                if (preg_match('/product_id_([0-9]+)/', $key)) {
                    $orderArr[$i][$key] = $value ;
                }
                if (preg_match('/quantity_([0-9]+)/', $key)) {
                    $orderArr[$i][$key] = $value;
                    $orderArr[$i]['user_id'] = $userId;
                    $orderArr[$i]['status'] = $status;
                    $orderArr[$i]['comment'] = $comment;
                }
            }
        }
        $orderStatusArr = [];
        for ($i = 0; $i < count($orderArr); $i++) {
            $orderStatusArr[] = $this->mapToOrderStatus($orderArr[$i]);
        }
        return $orderStatusArr;
    }
    public function getOrderStatusList(int $userId): array
    {
        $paramToDb = [$this->transformToDbFormat(':userId') => $userId];
        $sql = 'SELECT oS.id,
        oS.product_id,
        oS.user_id,
        oS.created_at,
        oS.update_at,
        oS.status,
        oS.quantity,
        p.title AS product_title,
        p.price,
        oS.quantity
        FROM ' .
        $this->getTableName() .
        ' oS JOIN products p on p.id = oS.product_id WHERE oS.user_id=:user_id';
        $result = $this->db->query($sql, $paramToDb);
        $orderStatusArr = [];
        for ($i = 0; $i < count($result); $i++) {
            $orderStatusArr[] = $this->mapToOrderStatus($result[$i]);
        }
        return $orderStatusArr;
    }
    public function addOrder(OrderStatus $orderStatus)
    {
        $paramToQuery = [];
        $valueToQuery = [];
        $paramToDb = [];
        $param = [
            $this->transformToDbFormat('userId') => $orderStatus->getUserId(),
            $this->transformToDbFormat('productId') => $orderStatus->getProductId(),
            $this->transformToDbFormat('quantity') => $orderStatus->getProductQuantity(),
            $this->transformToDbFormat('comment') => $orderStatus->getComment(),
            $this->transformToDbFormat('status') => $orderStatus->getStatus()
        ];
        foreach ($param as $key => $value) {
            $paramToQuery[] = $key;
            $bindParam = ':' . $key;
            $valueToQuery[] = $bindParam;
            $paramToDb[$bindParam] = $value;
        }
        $sql = 'INSERT INTO ' .
            $this->getTableName() .
            '(' .
            implode(',', $paramToQuery) .
            ') VALUES (' .
            implode(',', $valueToQuery) .
            ')';
        $this->db->query($sql, $paramToDb);
    }
    public function updateOrder(OrderStatus $orderStatus)
    {
        $id = $orderStatus->getId();
        $param = [
            $this->transformToDbFormat('productId') => $orderStatus->getProductId(),
            $this->transformToDbFormat('quantity') => $orderStatus->getProductQuantity(),
            $this->transformToDbFormat('comment') => $orderStatus->getComment(),
            $this->transformToDbFormat('status') => $orderStatus->getStatus(),
        ];
        $paramToDb[':id'] = $id;
        $paramToQuery = [];
        foreach ($param as $key => $value) {
            $paramToQuery[] = $key . '=:' . $key;
            $bindParam = ':' . $key;
            $paramToDb[$bindParam] = $value;
        }
        $sql = 'UPDATE ' .
            $this->getTableName() .
            ' SET ' .
            implode(',', $paramToQuery) .
            ' WHERE id=:id';
        $this->db->query($sql, $paramToDb);
    }
    public function deleteOrder(OrderStatus $orderStatus)
    {
        if (!empty($orderStatus->getId())) {
            $paramToDb[':id'] = $orderStatus->getId();
            $sql = 'DELETE FROM ' .
                $this->getTableName() .
                ' WHERE id=:id';
            $this->db->query($sql, $paramToDb);
        }
    }
    private function getTableName(): string
    {
        return 'orderStatus';
    }
    private function mapToOrderStatus(array $rows): OrderStatus
    {
        return $this->orderStatus->getDataFromOrderStatusMapper($rows);
    }
    private function transformToDbFormat(string $str): string
    {
        return strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $str));
    }
}
