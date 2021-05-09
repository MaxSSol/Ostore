<?php
use src\autoloader\Autoloader;
use src\core\View;
require_once __DIR__.'/../src/autoloader/Autoloader.php';
$obj = new Autoloader();
$obj->load('src\\core\\View');
$view = new View('main/index.php');
$view->render('Home',['css'=>'style/main.css'],'main/index');
