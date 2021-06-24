<?php

use Framework\DataMapper\CartMapper;
use src\Model\Cart;

class CartMapperCest
{
    private Cart $cart;
    private CartMapper $cartMapper;
    private int $lastInsertId;
    public function __construct()
    {
        $this->cart = new Cart();
        $this->cartMapper = new CartMapper();
    }
    // tests
    public function tryToTestAddProductToCart(UnitTester $I)
    {
        $cart = $this->cart;
        $cart->setUserId(2);
        $cart->setProductId(21);
        $cart->setQuantity(3);
        ($this->cartMapper)->addProductsInCart($cart);
        $this->lastInsertId = $this->cartMapper->getLastInsertId();
        $I->seeInDatabase('cart', ['product_id' => 21, 'user_id' => 2, 'quantity' => 3]);
    }
    public function tryToTestUpdateProductInCart(UnitTester $I)
    {
        $cart = $this->cart;
        $cart->setId($this->lastInsertId);
        $cart->setUserId(2);
        $cart->setProductId(21);
        $cart->setQuantity(1);
        ($this->cartMapper)->updateCart($cart);
        $I->seeInDatabase(
            'cart',
            ['id' => $this->lastInsertId,'user_id' => 2, 'product_id' => '21', 'quantity' => '1']
        );
    }
    public function tryToTestDeleteProductFromCartById(UnitTester $I)
    {
        ($this->cartMapper)->deleteRecordById($this->lastInsertId);
        $I->dontSeeInDatabase('cart', ['id' => $this->lastInsertId]);
    }
}
