<?php

namespace src\Controller;

use Framework\Authentication\Auth;
use Framework\DataMapper\CartMapper;
use Framework\DataMapper\OrderStatusMapper;
use Framework\DataMapper\UserMapper;
use Framework\Core\Controller;
use src\Model\Cart;

class OrderController extends Controller
{
    private array $params;
    private CartMapper $cartMapper;
    private OrderStatusMapper $orderStatusMapper;
    private UserMapper $userMapper;
    private Auth $auth;
    private Cart $cart;

    public function __construct(array $params)
    {
        parent::__construct();
        $this->cart = new Cart();
        $this->cartMapper = new CartMapper();
        $this->auth = new Auth();
        $this->userMapper = new UserMapper();
        $this->orderStatusMapper = new OrderStatusMapper();
        $this->params = $params;
    }
    public function orderAction(): void
    {
        if ($this->auth->isAuth()) {
            if ($this->params['button'] === 'Checkout' || $this->params['button'] === 'Buy') {
                if ($this->addOrder()) {
                    $productIdFromCart = $this->getOrderProductFromParams();
                    foreach ($productIdFromCart as $id) {
                        $this->cartMapper->deleteProductFromCartByColumn(['product_id' => $id], $this->getUserId());
                    }
                    header('Location:/cart');
                }
            }
            if ($this->params['button'] === 'Add to cart') {
                $cart = new Cart();
                $cart->setUserId($this->getUserId());
                $cart->setProductId((int)$this->params['product_id']);
                if (isset($this->params['quantity'])) {
                    $cart->setQuantity($this->params['quantity']);
                } else {
                    $cart->setQuantity(1);
                }
                $this->cartMapper->addProductsInCart($cart);
                header('Location:/products');
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
            $this->orderStatusMapper->addOrder($order);
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
                if ($key == 'product_id_' . $i || $key == 'product_id') {
                    $orderProductId[] = $param;
                }
            }
        }
        return $orderProductId;
    }
}