<?php

namespace src\Controller;

use Framework\Authentication\Auth;
use Framework\Core\View;
use Monolog\Logger;
use src\lib\Bot;

class AccountController
{
    public string $route;
    public object $view;
    protected object $auth;
    protected Logger $logger;
    protected array $getParam;
    public function __construct($route, $getParam)
    {
        $this->getParam = $getParam;
        $this->route = $route;
        $this->view = new View($route);
        $this->auth = new Auth();
        $this->logger = new Logger('Ostore.com|Auth');
        $this->view = new View($this->route);
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
                $this->logger->pushHandler(
                    new Bot(
                        '1783253669:AAEaIT7tdG7DnOuKrmn2t-NpbpQUrB5bq6M',
                        '@composerlogger',
                        Logger::INFO
                    )
                );
                $this->logger->info(
                    'User: ' . $_POST['login'] . ' is authorized ',
                    ['ua' => $_SERVER['HTTP_USER_AGENT']]
                );
                header('Location:/');
            }
        }
    }
}
