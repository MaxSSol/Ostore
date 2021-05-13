<?php
use Framework\autoloader\Autoloader;
use Framework\Router\Router;
require_once __DIR__ . '/../Framework/autoloader/Autoloader.php';
$obj = new Autoloader();
$obj->load('Framework\\Router\\Router');
$Router = new Router();
$Router->run();

