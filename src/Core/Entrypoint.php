<?php

namespace App\Core;

use App\Repositories\NoteRepository;

class Entrypoint
{

    public function __construct(private array $routes, private NoteRepository $noteRepository){

    }
    public function handleRequest()
    {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $verb = $_SERVER['REQUEST_METHOD'];

        if(isset($this->routes[$uri])){
            $route = $this->routes[$uri][$verb];
            $controllerClass = $route['controller'];
            $method = $route['method'];

            $controller = new $controllerClass($this->noteRepository);

            if(method_exists($controller, $method)){
                $controller->$method();
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