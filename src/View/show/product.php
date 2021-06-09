
<section class="bread-link mb-5">
    <div class="bread-link-btn d-flex text-decoration-none">
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Tools</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Name Brand</a>
            </li>
        </ul>
    </div>
</section>
<section class="product mb-5">
    <div class="product-name">
        <p class="h3"><?= $product->getTitle();?></p>
    </div>
    <div class="product-inner d-flex justify-content-between align-items-center">
        <div class="product-img">
            <img src="https://www.kstools.com/media/image/10/79/56/FOT_GES_ALG_917-0797-GB_SALL_AING_V15c91d4e3dd32e_600x600.jpg" alt="tools"/>
        </div>
        <div class="product-info">
            <p><?= $product->getPrice();?></p>
            <p><?= $product->getDescription();?></p>
            <button type="button" class="btn btn-primary me-2">Checkout</button>
            <button type="button" class="btn btn-primary">Add to Cart</button>
        </div>
    </div>
</section>
<section class="description">
    <div class="description-inner d-flex justify-content-center align-items-center">
        <p class="description-title m-0">Description</p>
    </div>
</section>

