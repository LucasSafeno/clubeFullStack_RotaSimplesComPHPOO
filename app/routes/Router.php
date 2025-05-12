<?php

namespace app\routes;

class Router
{

    public static function load(string $controller, string $method)
    {

    }

    public static function routes(array $routes)
    {
        return [
            'get' => [
                '/' => self::load('HomeController', 'index'),
                '/contact' => self::load('ContactController', 'index')

            ],
            'post' => [
                '/contact' => self::load('ContactController', 'store')
            ],
        ];
    }
}