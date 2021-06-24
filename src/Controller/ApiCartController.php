<?php

namespace src\Controller;

use Framework\Authentication\Auth;
use Framework\DataMapper\CartMapper;
use Framework\DataMapper\UserMapper;

class ApiCartController
{
    private CartMapper $cartMapper;
    private array $params;
    private Auth $auth;
    private UserMapper $userMapper;
    public function __construct(array $params)
    {
        $this->cartMapper = new CartMapper();
        $this->auth = new Auth();
        $this->userMapper = new UserMapper();
        $this->params = $params;
    }
    public function getCartList(): void
    {
        if ($this->auth->isAuth()) {
            header("Access-Control-Allow-Origin: *");
            header("Content-Type: application/json; charset=UTF-8");
            $user = $this->userMapper->getUserByColumns(['login' => $this->auth->getLogin()]);
            $cart = $this->cartMapper->getCartByUserId($user->getId());
            $jsonCart = [];
            foreach ($cart as $item) {
                $jsonCart[] = [
                    'id' => $item->getId(),
                    'productId' => $item->getProductId(),
                    'productTitle' => $item->getProductTitle(),
                    'price' => $item->getProductPrice(),
                    'quantity' => $item->getQuantity(),
                ];
            }
            echo json_encode($jsonCart);
        } else {
            header('Location:/account/login');
        }
    }
}