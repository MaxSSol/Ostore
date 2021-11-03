<section class="categories">
    <ul class="list-unstyled">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle"
               href="#" id="navbarScrollingDropdown"
               role="button"
               data-bs-toggle="dropdown"
               aria-expanded="false">
                Category
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
                <?php foreach($categories as  $category): ?>
                <li>
                    <a class="dropdown-item"
                       href="/products/category?category=<?=strtolower($category->getTitle());?>">
                        <?=$category->getTitle();?>
                    </a>
                </li>
                <?php endforeach;?>
            </ul>
        </li>
    </ul>
</section>
<section class="products mb-5">
        <products-list></products-list>
</section>
