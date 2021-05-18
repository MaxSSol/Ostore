<?php

namespace Framework\Session;

class Session
{
    public function setName($name): void
    {
        if (isset($name)) {
            session_name($name);
        }
    }

    public function getName(): string
    {
        if (session_name() !== null) {
            return session_name();
        }
    }

    public function setId($id): void
    {
        if (isset($id)) {
            session_id($id);
        }
    }

    public function cookieExists(): bool
    {
        if (isset($_COOKIE[$this->getName()])) {
            return true;
        }
        return false;
    }

    public function sessionExists(): bool
    {
        return isset($_SESSION);
    }

    public function start(): bool
    {
        if ($this->sessionExists() !== true) {
            session_start();
            return true;
        }
    }

    public function destroy(): void
    {
        if ($this->sessionExists()) {
            unset($_COOKIE);
            unset($_SESSION);
            setcookie($this->getName(), null, -1, '/');
            session_destroy();
        }
    }

    public function setSavePath($savePath): void
    {
        if ($this->sessionExists() !== true) {
            $path = __DIR__ . '/../../' . $savePath;
            if (!is_dir($path)) {
                mkdir("$path", '1777');
                ini_set("session.save_path", "$path");
            }
            ini_set("session.save_path", "$path");
        }
    }

    public function set($key, $value): void
    {
        if (isset($key) && isset($value)) {
            $_SESSION[$key] = $value;
        }
    }

    public function get($key): ?string
    {
        if ($this->contains($key) == true) {
            return $_SESSION[$key];
        }
        return null;
    }

    public function contains($key): bool
    {
        return isset($_SESSION[$key]);
    }

    public function delete($key): void
    {
        if ($this->contains($key)) {
            unset($_SESSION[$key]);
        }
    }
}
