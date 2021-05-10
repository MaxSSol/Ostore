<?php
namespace Framework\autoloader;

class Autoloader
{
    public function load($className)
    {
        spl_autoload_register(function ($className){
            $parts = explode('\\',$className);
            $path = __DIR__ . '/../../' .implode('/',$parts).'.php';
            if(file_exists($path)){
                require_once $path;
            }
        });
    }

}
