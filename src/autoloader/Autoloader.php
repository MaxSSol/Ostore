<?php
namespace src\autoloader;
use Exception;
class Autoloader
{
    public function load($className)
    {
        try {
            var_dump($className);
            $parts = explode('\\', $className);
            $path = __DIR__ . '/../../' . implode('/', $parts) . '.php';
            if (file_exists($path)) {
                require_once $path;
            } else {
                throw new Exception('Class not found');
            }
        }catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
