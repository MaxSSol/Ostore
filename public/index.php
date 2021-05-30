<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

use Framework\Router\Router;
use Framework\Session\Session;

require_once __DIR__ . '/../vendor/autoload.php';

$session = new Session();
$session->setSavePath('/src/config/Session/');
if ($session->cookieExists() !== false) {
    $session->start();
}
$Router = new Router();
$Router->run();
