<?php


namespace Framework\Exception;
use Exception;

class ViewException extends \Exception
{
    public $code = 404;
    public $message = 'Page not found';
}