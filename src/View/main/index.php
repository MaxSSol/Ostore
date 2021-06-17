<section class="promo d-flex justify-content-center align-items-center mb-5">
    <div class="promo-inner w-100">
        <div id="carouselIndicators" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <a href="/products">
                    <img class="d-block w-100" src="https://i.imgur.com/WyH9fUs.png" alt="test1">
                    </a>
                </div>
                <div class="carousel-item">
                    <a href="/products">
                    <img class="d-block w-100" src="https://i.imgur.com/Aqsiuk0.png" alt="Tools">
                    </a>
                </div>
                <div class="carousel-item">
                    <a href="/products">
                    <img class="d-block w-100" src="https://i.imgur.com/ozrJHd4.png" alt="Tools">
                    </a>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselIndicators" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselIndicators" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
</section>
<section class="top-products mb-5">
    <p class="top-products-title d-flex justify-content-center mb-5">Only in Ostore</p>
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3">
        <?php for($i = 1; $i <= 8; $i++):?>
            <div class="col">
                <div class="card">
                    <img src="<?= $products[$i]->getProductPhoto();?>" alt="<?= $products[$i]->getTitle();?>"/>
                </div>
                <div class="card-body">
                    <p class="card-text"><?= $products[$i]->getTitle();?></p>
                    <p class="card-text"><?= 'Price: $' . $products[$i]->getPrice();?></p>
                    <div class="card-btn d-flex justify-content-center">
                        <a class="btn btn-primary me-3" href="/product?id=<?= $products[$i]->getId();?>" role="button">View</a>
                        <a class="btn btn-primary" href="/cart/add?id=<?= $products[$i]->getId();?>" role="button">Add to Cart</a>
                    </div>
                </div>
            </div>
        <?php endfor;?>
    </div>
</section>
