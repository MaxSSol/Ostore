<?php

declare(strict_types=1);

namespace src\Controller;

use Framework\Core\Controller;

class MainController extends Controller
{
    private array $params;
    public function __construct(array $params = [])
    {
        parent::__construct();
        $this->params = $params;
    }
    public function indexAction(): void
    {
        $this->view->render(
            'main/index',
            'Home',
            ['css' => 'style/mainPage.css']
        );
    }
}
