<?php

namespace Core;

class Router {
    protected static array $routes = [];

    public static function get($uri, $controller) {
        self::$routes['GET'][$uri] = $controller;
    }
    public static function post($uri, $controller) {
        self::$routes['POST'][$uri] = $controller;
    }

    public static function dispatch() {
        $uri = $_SERVER['REQUEST_URI'];
        $uri = trim($uri, '/');

        $method = $_SERVER['REQUEST_METHOD'];

        if (isset(self::$routes[$method][$uri])) {
            $controller = self::$routes[$method][$uri];

            [$class, $method] = explode('@', $controller);
            
            $class = "App\\Controllers\\" . $class;
            $controllerInstance = new $class();
            $controllerInstance->$method();
        } else {
            header('Location: /not-found');
            exit;
        }
    }
}
