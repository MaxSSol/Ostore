<div class="container">
    <header class="d-flex flex-wrap justify-content-center align-items-center py-3 mb-5 border-bottom">
        <a class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none fs-2" href="/"><b>Ostore</b></a>
        <ul class="nav nav-pills">
            <li class="nav-item">
                <a class="nav-link" href="/">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/products">Products</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/contacts"> Contacts</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/about">About Us</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/cart">Cart</a>
            </li>
        </ul>
        <?php if (isset($_SESSION['login'])): ?>
            <a class="btn btn-primary me-2 p-2" href="/account/profile" role="button"><?= $_SESSION['login']?></a>
            <a class="btn btn-primary p-2" href="/account/logout" role="button">Logout</a>
        <?php else: ?>
            <a class="btn btn-primary me-2 p-2" href="/account/login" role="button">Sign In</a>
            <a class="btn btn-primary p-2" href="/account/registration" role="button">Sign Up</a>
        <?php endif; ?>
    </header>
</div>