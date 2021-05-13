<?php

namespace Framework\Router;

class Router
{
    public $routes = [];
    public $params = [];

    public function __construct()
    {
        $routes = require __DIR__.'/../../src/config/routes.php';
        foreach ($routes as $key => $param)
        {
            $this->addRoutes($key,$param);
        }
    }
    public function addRoutes($route,$params)
    {
        $route = '#^'.$route.'$#';//key => [#^/$#]
        $this->routes[$route] = $params;//arr => [#^/$#] => [controller/action]
    }
    public function checkMatch()
    {
        $url = trim($_SERVER['REQUEST_URI']);
        foreach ($this->routes as $route => $params)
        {
            if(preg_match($route,$url,$matches))
            {
                $this->params = $params;
                return true;
            }
        }
    }
    public function run()
    {
        if($this->checkMatch())
        {
            $path = 'src\\Controller\\'.ucfirst($this->params['controller']).'Controller';
            if(class_exists($path))
            {
                $action = $this->params['action'].'Action';
                if(method_exists($path,$action))
                {
                    $controller = new $path($this->params);
                    $controller->$action();
                }else{
                    //trow new RouterException
                }
            }else{
                //trow new RouterException
            }
        }else{
            //trow new RouterException
        }
    }
}