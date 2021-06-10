<section class="product mb-5">
    <div class="product-name">
        <p class="h3"><?= $product->getTitle();?></p>
    </div>
    <div class="product-inner d-flex justify-content-between align-items-center">
        <div class="product-img">
            <img src="https://www.kstools.com/media/image/10/79/56/FOT_GES_ALG_917-0797-GB_SALL_AING_V15c91d4e3dd32e_600x600.jpg" alt="tools"/>
        </div>
        <div class="product-info">
            <p class="product-price" align="center">Price: $<?= $product->getPrice();?></p>
            <p class="product-amount" align="center">In stock: <?= $product->getAmount();?></p>
            <a class="btn btn-primary me-2" href="/order">Checkout</a>
            <a class="btn btn-primary" href="/cart/add">Add to Cart</a>
        </div>
    </div>
</section>
<section class="description">
    <div class="description-inner">
        <p class="fs-3 title">Description</p>
        <p class="description-title" align="justify"><?= $product->getDescription();?></p>
    </div>
</section>

