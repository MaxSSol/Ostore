<section class="products mb-5">
    <div class="row">
        <?php foreach ($products as $product): ?>
        <div class="col-3">
            <div class="card">
                <img width="200px" height="200px" src="https://inlnk.ru/WRppd"/>
                <div class="card-body">
                    <p class="card-text"><?= $product->getTitle();?></p>
                    <p class="card-text">Price: $<?= $product->getPrice();?></p>
                    <div class="card-btn d-flex justify-content-center align-items-center">
                        <a class="btn btn-primary me-2" href="/product?id=<?= $product->getId();?>">View product</a>
                        <a class="btn btn-primary px-4" href="/card/add?id=<?= $product->getId();?>">Add to cart</a>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
    </div>
    <div class="products-button d-flex justify-content-center">
        <button type="button" class="btn btn-primary me-2">1</button>
        <button type="button" class="btn btn-outline-primary me-2">2</button>
        <button type="button" class="btn btn-outline-primary me-2">3</button>
        <button type="button" class="btn btn-outline-primary me-2">4</button>
        <button type="button" class="btn btn-outline-primary">-></button>
    </div>
</section>
