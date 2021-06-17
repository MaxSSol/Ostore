<?php

namespace src\Controller;

use Framework\Authentication\Auth;
use Framework\DataMapper\CartMapper;
use Framework\DataMapper\OrderStatusMapper;
use Framework\DataMapper\UserMapper;
use src\Model\Cart;
use src\Model\OrderStatus;

class OrderController
{
    private array $params;
    private CartMapper $cartMapper;
    private OrderStatusMapper $orderStatusMapper;
    private UserMapper $userMapper;
    private Auth $auth;

    public function __construct(array $params)
    {
        $this->cartMapper = new CartMapper();
        $this->auth = new Auth();
        $this->userMapper = new UserMapper();
        $this->orderStatusMapper = new OrderStatusMapper();
        $this->params = $params;
    }
    public function orderAction(): void
    {
        if ($this->auth->isAuth()) {
            if ($this->addOrder()) {
                $productIdFromCart = $this->getOrderProductFromParams();
                foreach ($productIdFromCart as $id) {
                    $this->cartMapper->deleteProductFromCartByColumn(['product_id' => $id], $this->getUserId());
                }
                header('Location:/cart');
            }
        } else {
            header('Location:/account/login');
        }
    }
    public function addOrder(): bool
    {
        $userId = $this->userMapper->getUserByColumns(['login' => $this->auth->getLogin()]);
        $orders = $this->orderStatusMapper->getOrder($this->params, $userId->getId(), 'Processed', '');
        foreach ($orders as $order) {
            $this->orderStatusMapper->insert($order);
        }
        return true;
    }
    private function getUserId(): int
    {
        $user = $this->userMapper->getUserByColumns(['login' => $this->auth->getLogin()]);
        return $user->getId();
    }
    private function getOrderProductFromParams(): array
    {
        $orderProductId = [];
        for ($i = 0; $i < count($this->params); $i++) {
            foreach ($this->params as $key => $param) {
                if ($key == 'product_id_' . $i) {
                    $orderProductId[] = $param;
                }
            }
        }
        return $orderProductId;
    }
}
