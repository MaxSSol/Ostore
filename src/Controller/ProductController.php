<?php

namespace src\Controller;

class ProductController
{
    private string $route;
    private array $params;
    public function __construct($route, $params)
    {
        $this->route = $route;
        $this->params = $params;
    }
    public function viewAction()
    {
        var_dump($this->route);
        echo '<br/>';
        var_dump($this->params);
    }
}
