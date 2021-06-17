<section class="cart">
    <form action="/order" method="post">
    <?php if (!empty($cart)): ?>
    <?php for ($i = 0; $i < count($cart); $i++): ?>
    <div class="cart-inner d-flex flex-column justify-content-center align-items-center">
        <div class="cart-product d-flex justify-content-between m-0 mb-3">
            <ul class="list-unstyled text-small d-flex justify-content-center align-items-center">
                <li>
                    <input class="me-4"
                           type="checkbox"
                           name="product_id_<?=$i;?>"
                           value="<?= $cart[$i]->getProductId();?>"
                           checked/>
                </li>
                <li class="cart-product-title">
                    <p><?= $cart[$i]->getProductTitle();?></p>
                </li>
                <li class="mx-5">
                    <p>Price: <br/>$<?= $cart[$i]->getProductPrice();?></p>
                    <p>Quantity</p>
                    <input class="cart-quantity"
                           type="number"
                           min="1"
                           max="50"
                           value="<?= $cart[$i]->getQuantity();?>"
                           name="quantity_<?=$i;?>"/>
                </li>
                <li>
                    <a class="btn btn-danger" href="/cart/d?id=<?=$cart[$i]->getId();?>">X</a>
                </li>
            </ul>
        </div>
        <?php endfor;?>
    </form>
        <p>Total price: $<?=$totalPrice->getTotalPrice();?></p>
        <button class="btn btn-primary px-5 py-2" type="submit">Buy</button>
        <?php else: ?>
        <div class="cart-empty d-flex justify-content-center align-items-center">
        <p>Cart is empty,go to <a href="/products"> products</a></p>
        </div>
        <?php endif;?>
    </div>
</section>

