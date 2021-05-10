<?php
namespace Framework\Core;
class View
{
    protected $route;
    public function __construct($route)
    {
        $this->route = $route;

    }
    public function render(string $title,array $params = [],string $template,string $layout = 'default')
    {
        if(isset($params))
        {
            extract($params);
        }

        //$path = __DIR__.'/../View/'.$this->route.'.php'; include route
        $path = __DIR__ . '/../../src/View/' .$template.'.php';//$template = 'main/index.php' only!!!
        if(file_exists($path))
        {
            ob_start();
            require_once  $path;
            $content = ob_get_clean();
            require_once __DIR__ . '/../../src/View/layouts/' .$layout.'.php';
        }

    }
}
