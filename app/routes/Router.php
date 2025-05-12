<?php

namespace app\routes;

use Exception;

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

            $controllerInstance->$method();



        } catch (\Throwable $th) {
            echo $th->getMessage();
        }
    }

    public static function routes(): array
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