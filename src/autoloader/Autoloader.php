<?php


class Autoloader
{
    public function load($className)
    {
        try{
            spl_autoload_register($this->checkLoad($className));
        }catch (Exception $e){
            $e->getMessage();
        }
    }
    protected function checkLoad($className)
    {
        $parts = explode('\\',$className);
        $path = __DIR__.'/../../'.implode('/',$parts).'.php';
        if(file_exists($path)){
            require_once $path;
        }else{
            throw new Exception('Class not found');
        }
    }
}
