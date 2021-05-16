<?php
use src\autoloader\Autoloader;
use src\core\View;
require_once __DIR__.'/../src/autoloader/Autoloader.php';
$autoloader = new Autoloader();
spl_autoload_register([$autoloader,'load'],false,true);
$view = new View('main/index.php');
$view->render('Home',['css'=>'style/main.css'],'main/index');

