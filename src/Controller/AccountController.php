<?php

declare(strict_types=1);

namespace src\Controller;

use Framework\Authentication\Auth;
use Framework\Core\View;
use Monolog\Logger;
use src\lib\Bot;

class AccountController
{
    private array $params;
    public object $view;
    protected object $auth;
    protected Logger $logger;
    public function __construct(array $params = [])
    {
        $this->params = $params;
        $this->auth = new Auth();
        $this->logger = new Logger('Ostore.com|Auth');
        $this->view = new View();
    }

    public function loginAction(): void
    {
        if ($this->checkUser() == false) {
            $this->checkUserData();
            $this->view->render('account/login', 'Sign In', ['css' => 'style/login.css'], 'auth');
        }
    }

    public function registrationAction(): void
    {
        if ($this->checkUser() == false) {
            $this->registrationUser();
            $this->view->render('account/registration', 'Sign Up', ['css' => 'style/registration.css'], 'auth');
        }
    }

    private function checkUser(): bool
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
    private function registrationUser(): bool
    {
        if (isset($this->params)) {
            if ($this->auth->registration($this->params) == true) {
                header('Location:/account/profile');
                return true;
            }
            return false;
        }
        return false;
    }
    private function checkUserData(): void
    {
        if (isset($this->params)) {
            if ($this->auth->auth($this->params)) {
                $this->logger->pushHandler(
                    new Bot(
                        '1783253669:AAEaIT7tdG7DnOuKrmn2t-NpbpQUrB5bq6M',
                        '@composerlogger',
                        Logger::INFO
                    )
                );
                $this->logger->info(
                    'User: ' . $this->auth->getLogin() . ' is authorized ',
                    ['ua' => $_SERVER['HTTP_USER_AGENT']]
                );
                header('Location:/');
            }
        }
    }
}