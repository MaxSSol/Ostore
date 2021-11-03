<?php

declare(strict_types=1);

namespace Framework\Router;

use Exception;

class Router
{
    private array $routes;
    private function getMethod(): string
    {
        return $_SERVER['REQUEST_METHOD'];
    }
    private function isGet(): bool
    {
        return $this->getMethod() === 'GET';
    }
    private function isPost(): bool
    {
        return $this->getMethod() === 'POST';
    }
    private function getUrl(): string
    {
        $url = $_SERVER['REQUEST_URI'];
        $param = strpos($url, '?');
        return is_int($param) ? substr($url, 0, $param) : $url;
    }
    public function get(string $path, $handler): void
    {
        $path = '#^' . $path . '$#';
        $this->routes['GET'][$path] = $handler;
    }
    public function post(string $path, $handler): void
    {
        $path = '#^' . $path . '$#';
        $this->routes['POST'][$path] = $handler;
    }
    public function getBody(): array
    {
        $body = [];
        if ($this->isGet()) {
            $url = parse_url($_SERVER['REQUEST_URI']);
            if (isset($url['query'])) {
                parse_str($url['query'], $body);
            }
            return $body;
        }
        if ($this->isPost()) {
            foreach ($_POST as $key => $value) {
                $body[$key] = $value;
            }
            return $body;
        }
        return $body;
    }

    /**
     * @throws Exception
     */
    public function checkHandler(): array
    {
        $url = $this->getUrl();
        $method = $this->getMethod();
        $routes = $this->routes[$method];
        foreach ($routes as $pattern => $handler) {
            if (preg_match($pattern, $url, $matches)) {
                return $handler;
            }
        }
        throw new Exception('Page not found');
    }

    /**
     * @return false|mixed
     */
    public function run(): ?callable
    {
        try {
            $handler = $this->checkHandler();
            $handler[0] = new $handler[0]($this->getBody());
            return call_user_func($handler);
        } catch (Exception $e) {
            echo $e->getMessage();
            return null;
        }
    }
}
