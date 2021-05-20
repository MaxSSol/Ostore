<?php

namespace src\Controller;

use Framework\Core\View;

class AccountController
{
    public array $route;
    public object $view;

    public function __construct($route)
    {
        $this->route = $route;
        $this->view = new View($route);
    }

    public function loginAction(): void
    {
        $this->view->render('Sign In', ['css' => 'style/login.css'], 'auth');
    }

    public function registrationAction(): void
    {
        $this->view->render('Sign Up', ['css' => 'style/registration.css'], 'auth');
    }
}
