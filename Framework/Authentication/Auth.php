<?php

namespace Framework\Authentication;

use Framework\Session\Session;

class Auth
{
    protected object $session;
    protected string $login = 'login';
    protected string $pass = 'pass';
    public function __construct()
    {
        $this->session = new Session();
    }
    public function isAuth(): bool
    {
        if ($this->session->get('isAuth')) {
            return true;
        }
        return false;
    }
    public function auth($login, $pass): bool
    {
        if ($login == $this->login && $pass == $this->pass) {
            $this->session->start();
            $this->session->set('isAuth', true);
            $this->session->set('login', $login);
            return true;
        }
        return false;
    }
    public function getLogin(): string
    {
        return $this->session->get('login');
    }
    public function logOut(): void
    {
        $this->session->destroy();
        header('Location:/');
    }
}
