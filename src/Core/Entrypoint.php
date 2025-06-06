<?php

class Entrypoint
{

    public function __construct(private array $routes){

    }
    public function handleRequest()
    {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $verb = $_SERVER['REQUEST_METHOD'];

        if(isset($this->routes[$uri])){
            $route = $this->routes[$uri][$verb];
            $controller = new $route['controller'];
            $method = new $route['method'];

            if(method_exists($controller, $method)){
                //$controller->$method();
            } else {
                $this->sendHttpMessage(405);
            }
        } else {
            $this->sendHttpMessage(404);
        }
    }

    private function sendHttpMessage(int $num)
    {
        header('Location: https://http.cat/' . $num);
        exit;
    }
}