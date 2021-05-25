<?php

return [
    /**
     * url => '/' => controller(main)/action(index)
     * url => '/product' => controller(product)/action(show)
     * url => '/product/([a-z]+)/([0-9]+)' => controller(product)/action(view)/parameters($1)/$parameters($2)
     */
    '/' => 'main/index',
    '/account/login' => '/account/login',
    '/account/logout' => '/account/logout',
    '/product/([a-z]+)/([0-9]+)' => '/product/view/$1/$2'
];
