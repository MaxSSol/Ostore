<?php

namespace src\Controller;

use Framework\Authentication\Auth;
use Framework\Core\View;
use Framework\DataMapper\CartMapper;
use Framework\DataMapper\ProductMapper;
use Framework\DataMapper\UserMapper;
use src\Model\Cart;

class CartController
{
    private CartMapper $cartMapper;
    private UserMapper $userMapper;
    private Auth $auth;
    public array $params;
    private View $view;

    public function __construct(array $params = [])
    {
        $this->userMapper = new UserMapper();
        $this->auth = new Auth();
        $this->cartMapper = new CartMapper();
        $this->params = $params;
        $this->view = new View();
    }

    public function viewCartAction()
    {
        $cart = $this->cartMapper->getCartByUserId($this->getUser());
        $totalPrice = $this->cartMapper->getTotalPrice($this->getUser());
        $this->view->render(
            'cart/cart',
            'Cart',
            ['css' => 'style/cart.css', 'cart' => $cart, 'totalPrice' => $totalPrice]
        );
    }
    public function addProductToCart(): void
    {
        if (isset($this->params)) {
            $cart = new Cart();
            $cart->setUserId($this->getUser());
            $cart->setProductId((int)$this->params['id']);
            $cart->setQuantity(1);
            $this->cartMapper->insert($cart);
            header('Location:/products');
        }
    }
    public function deleteProductFromCart()
    {
        if (isset($this->params['id'])) {
            $this->cartMapper->deleteRecordById($this->params['id']);
            header('Location:/cart');
        }
    }
    private function getUser(): int
    {
        if ($this->auth->isAuth() !== true) {
            header('Location:/account/login');
        }
        $user = $this->userMapper->getUserByColumns(['login' => $this->auth->getLogin()]);
        return $user->getId();
    }
}
