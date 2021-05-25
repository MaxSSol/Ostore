<?php

namespace Framework\Router;

class Router
{
    protected array $routes = [];
    protected string $params;
    protected string $controllerName;
    protected string $actionName;
    protected array $getParameters = [];

    public function __construct()
    {
        $arr = require_once __DIR__ . '/../../src/config/routes.php';
        foreach ($arr as $route => $param) {
            $this->addRoute($route, $param);
        }
    }
    public function addRoute($route, $params)
    {
        $this->routes[$route] = $params;
    }
    public function checkMatch(): bool
    {
        $url = trim($_SERVER['REQUEST_URI']);
        foreach ($this->routes as $route => $param) {
            if (preg_match('#^' . $route . '$#', $url, $matches)) {
                if (count($matches) == 1) {
                    $this->internalUrl($route, $param, $url);
                    return true;
                } else {
                    $this->internalUrlWithParams($route, $param, $url);
                    return true;
                }
            }
        }
        return false;
    }
    public function internalUrl($route, $param, $url): void
    {
        $this->params = $param;
        $itemUrl = array_filter(explode('/', $param));
        $this->controllerName = ucfirst(array_shift($itemUrl)) . 'Controller';
        $this->actionName = array_shift($itemUrl) . 'Action';
    }
    public function internalUrlWithParams($route, $param, $url): void
    {
        $internalUrl = preg_replace('#^' . $route . '$#', $param, $url);
        $itemUrl = array_filter(explode('/', $internalUrl));
        $this->params = $itemUrl[1] . '/' . $itemUrl[2];
        $this->controllerName = ucfirst(array_shift($itemUrl)) . 'Controller';
        $this->actionName = array_shift($itemUrl) . 'Action';
        $parameters = $itemUrl;
        $this->getParameters = $itemUrl;
    }
    public function run(): bool
    {
        if ($this->checkMatch() !== false) {
            $path = 'src\Controller\\' . $this->controllerName;
            if (class_exists($path) && method_exists($path, $this->actionName)) {
                $action = $this->actionName;
                $controller = new $path($this->params, $this->getParameters);
                $controller->$action();
                return true;
            }
        } else {
            echo '<h1 style="text-align: center">Bad request, url not found!</h1>';
            return false;
        }
    }
}
