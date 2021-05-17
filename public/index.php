<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

use Framework\Router\Router;
use Framework\Session\Session;

require_once __DIR__ . '/../vendor/autoload.php';
//checkCookies
$Router = new Router();
$Router->run();
