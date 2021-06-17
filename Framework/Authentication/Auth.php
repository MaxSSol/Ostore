<?php

namespace Framework\Authentication;

use Framework\Session\Session;
use Framework\DataMapper\UserMapper;
use src\Model\User;

class Auth
{
    protected object $session;
    protected string $login;
    protected string $password;
    protected object $userMapper;
    public function __construct()
    {
        $this->userMapper = new UserMapper();
        $this->session = new Session();
    }
    public function isAuth(): bool
    {
        if ($this->session->get('isAuth')) {
            return true;
        }
        return false;
    }
    public function auth(array $params): bool
    {
        if (isset($params['login']) && isset($params['pass'])) {
            $user = $this->userMapper->getUserByColumns(
                ['login' => $params['login'], 'password' => sha1($params['pass'])]
            );
            if (isset($user)) {
                $this->session->start();
                $this->session->set('isAuth', true);
                $this->session->set('login', $user->getLogin());
                return true;
            }
            $_SESSION['errorMessage'] = 'Check your data!';
            return false;
        }
        return false;
    }
    public function registration(array $params): bool
    {
        if ($params !== []) {
            if (
                preg_match('/^[A-Za-z]{4,50}$/', $params['firstName']) &&
                preg_match('/^[A-Za-z]{4,50}$/', $params['lastName']) &&
                preg_match('/^[A-Za-z0-9][A-Za-z0-9-_]+[A-Za-z0-9]$/is', $params['login']) &&
                preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[^\w\s]).{6,}/', $params['password']) &&
                preg_match('/^[A-Za-z]{4,50}$/', $params['city']) &&
                preg_match('/^[A-Za-z0-9]{4,50}$/', $params['city'])
            ) {
                $user = new User(
                    null,
                    $params['firstName'],
                    $params['lastName'],
                    $params['email'],
                    $params['login'],
                    sha1($params['password']),
                    $params['city'],
                    $params['address']
                );
                $result = $this->userMapper->insert($user);
                if ($result == null) {
                    $this->session->start();
                    $this->session->set('isAuth', true);
                    $this->session->set('login', $user->getLogin());
                    return true;
                }
            }
            $_SESSION['errorMessage'] = 'Invalid data';
            return false;
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