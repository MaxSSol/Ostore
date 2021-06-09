<section class="products mb-5 d-flex flex-wrap">
    <?php foreach ($products as $product): ?>
    <div class="products-inner">
        <div class="product-img"></div>
        <div class="product-body">
            <p><?=$product->getTitle();?></p>
            <p>Price: $<?=$product->getPrice();?></p>
        </div>
    </div>
    <?php endforeach; ?>
    <div class="products-button d-flex justify-content-center">
        <button type="button" class="btn btn-primary me-2">1</button>
        <button type="button" class="btn btn-outline-primary me-2">2</button>
        <button type="button" class="btn btn-outline-primary me-2">3</button>
        <button type="button" class="btn btn-outline-primary me-2">4</button>
        <button type="button" class="btn btn-outline-primary">-></button>
    </div>
</section>
