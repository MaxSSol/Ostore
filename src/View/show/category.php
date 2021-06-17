<section class="categories">
    <ul class="list-unstyled">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarScrollingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Category
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
                <?php foreach($categories as  $category): ?>
                    <li><a class="dropdown-item" href="/products/category?category=<?=strtolower($category->getTitle());?>"><?=$category->getTitle();?></a></li>
                <?php endforeach;?>
            </ul>
        </li>
    </ul>
</section>
<section class="products mb-5">
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3">
        <?php foreach($products as $product): ?>
            <div class="col">
                <div class="card">
                    <img src="<?= $product->getProductPhoto();?>" alt="<?=$product->getProductTitle();?>"/>
                    <div class="card-body">
                        <p class="card-text"><?= $product->getProductTitle();?></p>
                        <p class="card-text">Price: $<?= $product->getProductPrice();?></p>
                        <div class="card-btn d-flex justify-content-center align-items-center">
                            <a class="btn btn-primary me-2" href="/product?id=<?= $product->getProductId();?>">View product</a>
                            <a class="btn btn-primary px-4" href="/cart/add?id=<?= $product->getProductId();?>">Add to cart</a>
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