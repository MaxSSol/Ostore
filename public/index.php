<?php
use Framework\autoloader\Autoloader;
use Framework\Core\View;
require_once __DIR__ . '/../Framework/autoloader/Autoloader.php';
$obj = new Autoloader();
$obj->load('Framework\\Core\\View');
$view = new View('main/index.php');
$view->render('Home',['css'=>'style/main.css'],'main/index');
