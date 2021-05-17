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
        if (session_id() !== null) {
            session_id($id);
        }
    }

    public function cookieExists(): bool
    {
        return isset($_COOKIE[$this->getName()]);
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
            setcookie($this->getName(), "", time() - 3600);
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

    public function get($key): void
    {
        if ($this->contains($key)) {
            echo $_SESSION[$key];
        }
    }

    public function contains($key): bool
    {
        if (isset($_SESSION[$key])) {
            return true;
        }
    }

    public function delete($key): void
    {
        if ($this->contains($key)) {
            unset($_SESSION[$key]);
        }
    }
}
