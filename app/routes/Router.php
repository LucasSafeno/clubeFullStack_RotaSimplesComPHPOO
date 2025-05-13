<?php

namespace app\routes;

use Exception;
use app\helpers\Uri;
use app\helpers\Request;

class Router
{

    const CONTROLLER_NAMESPACE = 'app\\controllers';
    public static function load(string $controller, string $method)
    {
        try {

            $controllerNameSpace = self::CONTROLLER_NAMESPACE . '\\' . $controller;


            //* verificar se o controller existe
            if (!class_exists($controllerNameSpace)) {
                throw new Exception("O Controller {$controller} não existe");
            }

            $controllerInstance = new $controllerNameSpace;

            //* verificar se o method existe
            if (!method_exists($controllerInstance, $method)) {
                throw new Exception("O metodo {$method} não existe no controller {$controller}");
            }

            $controllerInstance->$method((object) $_REQUEST);



        } catch (\Throwable $th) {
            echo $th->getMessage();
        }
    }

    public static function routes(): array
    {
        return [
            'get' => [
                '/' => fn() => self::load('HomeController', 'index'),


            ],
            'post' => [

            ],
            'put' => [

            ],
            'delete' => [

            ],
        ];
    }

    public static function execute()
    {
        try {

            $routes = self::routes();
            $request = Request::get();
            $uri = Uri::get('path');


            if (!isset($routes[$request])) {
                throw new Exception('A rota não existe');
            }


            if (!array_key_exists($uri, $routes[$request])) {
                throw new Exception('A rota não existe');
            }

            $router = $routes[$request][$uri];

            if (!is_callable($router)) {
                throw new Exception("Route {$uri} is not a callable");
            }

            $router();



        } catch (\Throwable $th) {
            echo $th->getMessage();
        }
    }
}