<?php

namespace routes;

class Router
{

    public function run() :void
    {
        $path = $this->getPath();
        $routes = $this->getRoute();

        if(!array_key_exists($path, $routes)){
            header ('HTTP/1.0 404 Not Found');
            echo '404 Not Found';
            return;
        }

        $controller = new $routes[$path][0];
        $action = $routes[$path][1];

        if(!method_exists($controller, $action)){

            throw new \Exception("Action ({$action}) is not found in ({$routes[$path][0]})");
        }

        $controller->$action();
    }

    protected function getPath() :string
    {
        $requestUri = $_SERVER['REQUEST_URI'] ?? '';
        return '/' . trim(parse_url($requestUri, PHP_URL_PATH),  '/');
    }

    protected function getRoute() :array
    {
        return include 'web.php';
    }

}