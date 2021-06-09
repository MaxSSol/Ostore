<section class="promo d-flex justify-content-center align-items-center mb-5">
    <div class="promo-inner w-100">
        <div id="carouselIndicators" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="d-block w-100" src="https://i.ibb.co/MZh9TRp/slider1.png" alt="test1">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="https://i.ibb.co/5hpkwm6/slider2.png" alt="test2">
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
        <?php for($i = 1; $i <= 1; $i++):?>
            <div class="col">
                <div class="card">
                    <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"></rect><text x="50%" y="50%" fill="#eceeef" dy=".3em">Product</text></svg>
                </div>
                <div class="card-body">
                    <p class="card-text"><?php echo $product->getTitle();?></p>
                    <p class="card-text"><?php echo 'Price: $' . $product->getPrice();?></p>
                    <div class="card-btn d-flex justify-content-center">
                        <a class="btn btn-primary" href="/product?id=<?= $product->getId();?>" role="button">View</a>
                        <a class="btn btn-primary" href="#" role="button">Add to Cart</a>
                    </div>
                </div>
            </div>
        <?php endfor;?>
    </div>
</section>
