<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

use Framework\Router\Router;
use Framework\Session\Session;
use src\Controller\AccountController;
use src\Controller\MainController;
use src\Controller\ProductController;

require_once __DIR__ . '/../vendor/autoload.php';

$session = new Session();
$session->setSavePath('/src/config/Session/');
if ($session->cookieExists() !== false) {
    $session->start();
}
$router = new Router();
$router->get('/', [MainController::class, 'indexAction']);
$router->get('/account/login', [AccountController::class, 'loginAction']);
$router->post('/account/login', [AccountController::class, 'loginAction']);
$router->get('/account/logout', [AccountController::class, 'logoutAction']);
$router->get('/products', [ProductController::class, 'viewAction']);
$router->run();
