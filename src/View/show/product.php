<section class="product mb-5">
    <div class="product-name">
        <p class="h3"><?= $product->getTitle();?></p>
    </div>
    <div class="product-inner d-flex justify-content-between align-items-center">
        <div class="product-img">
            <img src="<?php echo $product->getProductPhoto();?>" alt="<?= $product->getTitle();?>"/>
        </div>
        <div class="product-info">
            <p class="product-price" align="center">Price: $<?= $product->getPrice();?></p>
            <p class="product-amount" align="center">In stock: <?= $product->getAmount();?></p>
            <a class="btn btn-primary me-2" href="/order">Checkout</a>
            <a class="btn btn-primary" href="/cart/add?id=<?= $product->getId();?>">Add to Cart</a>
        </div>
    </div>
</section>
<section class="description">
    <div class="description-inner">
        <p class="fs-3 title">Description</p>
        <p class="description-title" align="justify"><?= $product->getDescription();?></p>
    </div>
</section>

