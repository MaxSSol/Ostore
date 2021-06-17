<main class="main text-center d-flex justify-content-center align-items-center">
    <div class="form">
        <form method="POST">
            <p class="h3 mb-4">Please Sign in</p>
            <input type="text" class="form-control mb-2" placeholder="Login" name="login">
            <input type="password" class="form-control mb-3" placeholder="Password" name="pass">
            <button type="submit" class="btn btn-primary">Sign In</button>
            <p>
            <?php if (isset($_SESSION['errorMessage'])) {
                echo $_SESSION['errorMessage'];
                unset($_SESSION['errorMessage']);
            }?>
            </p>
        </form>
    </div>
</main>
