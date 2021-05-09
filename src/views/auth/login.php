<!Doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign In</title>
    <link rel="stylesheet" href="../../../public/style/login.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
</head>
<body>
<main class="main text-center d-flex justify-content-center align-items-center">
    <div class="form">
        <form action="/" method="POST">
            <p class="h3 mb-4">Please Sign in</p>
            <input type="email" class="form-control mb-2" placeholder="Email" name="email">
            <input type="password" class="form-control mb-3" placeholder="Password" name="pass">
            <button type="button" class="btn btn-primary">Sign In</button>
        </form>
    </div>
</main>
</body>
</html>