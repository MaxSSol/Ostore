<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

use Dotenv\Dotenv;
use Framework\Router\Router;
use Framework\Session\Session;
use src\Controller\AccountController;
use src\Controller\CartController;
use src\Controller\MainController;
use src\Controller\ProductController;

require_once __DIR__ . '/../vendor/autoload.php';

//$envName = getenv('APP_ENV') === 'testing' ? '.env.testing' : '.env';
$envName = '.env.testing';
$dotenv = Dotenv::createImmutable(__DIR__ . '/../', $envName);
$dotenv->load();

$session = new Session();
$session->setSavePath('/src/config/Session/');
if ($session->cookieExists() !== false) {
    $session->start();
}
$router = new Router();
$router->get('/', [MainController::class, 'indexAction']);
$router->get('/account/login', [AccountController::class, 'loginAction']);
$router->post('/account/login', [AccountController::class, 'loginAction']);
$router->get('/account/registration', [AccountController::class, 'registrationAction']);
$router->post('/account/registration', [AccountController::class, 'registrationAction']);
$router->get('/account/logout', [AccountController::class, 'logoutAction']);
$router->get('/products', [ProductController::class, 'viewAction']);
$router->get('/products/category', [ProductController::class, 'viewProductByCategory']);
$router->get('/product', [ProductController::class, 'viewProductAction']);
$router->get('/cart', [CartController::class, 'viewCartAction']);
$router->get('/cart/add', [CartController::class, 'addProductToCart']);
$router->get('/cart/d', [CartController::class, 'deleteProductFromCart']);
$router->get('/order', [\src\Controller\OrderController::class, 'orderAction']);
$router->post('/order', [\src\Controller\OrderController::class, 'orderAction']);
$router->get('/get/products', [\src\Controller\ApiProductController::class, 'getProductsList']);
$router->get('/get/product', [\src\Controller\ApiProductController::class, 'getProduct']);
$router->run();
