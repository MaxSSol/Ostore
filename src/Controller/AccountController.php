<?php

namespace src\Controller;

use Framework\Authentication\Auth;
use Framework\Core\View;

class AccountController
{
    public array $route;
    public object $view;
    protected object $auth;

    public function __construct($route)
    {
        $this->route = $route;
        $this->view = new View($route);
        $this->auth = new Auth();
    }

    public function loginAction(): void
    {
        if ($this->checkUser() == false) {
            $this->checkUserData();
            $this->view->render('Sign In', ['css' => 'style/login.css'], 'auth');
        }
    }

    public function registrationAction(): void
    {
        $this->view->render('Sign Up', ['css' => 'style/registration.css'], 'auth');
    }

    public function checkUser(): bool
    {
        if ($this->auth->isAuth() == true) {
            header('Location:/');
            return true;
        }
        return false;
    }
    public function logoutAction(): void
    {
        $this->auth->logOut();
    }
    public function checkUserData(): void
    {
        if (isset($_POST['login']) && isset($_POST['pass'])) {
            if ($this->auth->auth($_POST['login'], $_POST['pass'])) {
                header('Location:/');
            }
        }
    }
}
