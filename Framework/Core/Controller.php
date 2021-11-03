<?php

namespace Framework\Core;

use Framework\Core\View;

class Controller
{
    protected View $view;
    public function __construct()
    {
        $this->view = new View();
    }
}