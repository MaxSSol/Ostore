<?php

use Framework\DataMapper\OrderStatusMapper;
use src\Model\OrderStatus;

class OrderStatusMapperCest
{
    private OrderStatus $order;
    private OrderStatusMapper $orderStatusMapper;
    private int $lastInsertId;
    public function __construct()
    {
        $this->order = new OrderStatus();
        $this->orderStatusMapper = new OrderStatusMapper();
    }

    // tests
    public function tryToTestAddOrder(UnitTester $I)
    {
        $order = $this->order;
        $order->setProductId(22);
        $order->setUserId(2);
        $order->setProductQuantity(4);
        $order->setStatus('Processed');
        $order->setComment('empty');
        ($this->orderStatusMapper)->addOrder($order);
        $this->lastInsertId = $this->orderStatusMapper->getLastInsertId();
        $I->seeInDatabase(
            'order_status',
            [
                'product_id' => 22,
                'user_id' => 2,
                'quantity' => 4,
                'status' => 'Processed',
                'comment' => 'empty'
            ]
        );
    }
    public function tryToTestUpdateOrder(UnitTester $I)
    {
        $order = $this->order;
        $order->setId($this->lastInsertId);
        $order->setProductId(22);
        $order->setUserId(2);
        $order->setProductQuantity(5);
        $order->setStatus('Processed');
        $order->setComment('empty');
        ($this->orderStatusMapper)->updateOrder($order);
        $I->seeInDatabase(
            'order_status',
            [
                'id' => $this->lastInsertId,
                'product_id' => 22,
                'user_id' => 2,
                'quantity' => 5,
                'status' => 'Processed',
                'comment' => 'empty'
            ]
        );
    }
    public function tryToTestDeleteOrder(UnitTester $I)
    {
        $order = $this->order;
        $order->setId($this->lastInsertId);
        ($this->orderStatusMapper)->deleteOrder($order);
        $I->dontSeeInDatabase('order_status', ['id' => $this->lastInsertId]);
    }
}
