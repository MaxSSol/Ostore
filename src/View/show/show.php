<section>
    <div class="products mb-5">
        <div class="row">
            <?php for ($i = 0;$i < 50;$i++):?>
            <div class="col-3" id="product<?php echo $i;?>">
            </div>
        <?php endfor;?>
    </div>
    <div class="products-button d-flex justify-content-center">
        <button type="button" class="btn btn-primary me-2">1</button>
        <button type="button" class="btn btn-outline-primary me-2">2</button>
        <button type="button" class="btn btn-outline-primary me-2">3</button>
        <button type="button" class="btn btn-outline-primary me-2">4</button>
        <button type="button" class="btn btn-outline-primary">-></button>
    </div>
</section>