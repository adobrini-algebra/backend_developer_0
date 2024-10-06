<?php

namespace Core;

class Router
{
    private array $routes = [];

    public function add(string $uri, array $action, string $method)
    {
        $this->routes[] = [
            'method' => $method,
            'uri' => $uri,
            'controller' => $action[0],
            'function' => $action[1],
            'auth' => $action[2] ?? null
        ];
    }

    public function get(string $uri, array $action)
    {
        $this->add($uri, $action, 'GET');
    }

    public function post(string $uri, array $action)
    {
        $this->add($uri, $action, 'POST');
    }

    public function put(string $uri, array $action)
    {
        $this->add($uri, $action, 'PUT');
    }

    public function patch(string $uri, array $action)
    {
        $this->add($uri, $action, 'PATCH');
    }

    public function delete(string $uri, array $action)
    {
        $this->add($uri, $action, 'DELETE');
        return $this;
    }

    public function with($middleware)
    {
        
    }

    public function route(string $uri, string $method)
    {
        foreach ($this->routes as $route) {
            if ($route['uri'] === $uri && $route['method'] === $method) {
                $classPath = $route['controller'];
                $function = $route['function'];

                if ($route['auth'] === 'auth' && Session::has('user') === false) {
                    redirect('/login');
                }

                if ($route['auth'] === 'guest' && Session::has('user') === true) {
                    redirect('/dashboard');
                }

                $controller = new $classPath();
                $controller->$function();
                exit();
            }
        }
        
       abort();
    }
}