<?php

namespace Framework;

use ReflectionException;
use ReflectionMethod;

class Dispatcher
{
    public function __construct(
        private Router $router
    )
    {
    }

    /**
     * @throws ReflectionException
     */
    public function handle(string $path): void
    {
        $params = $this->router->match($path);

        if ($params === false) {
            http_response_code(404);
            die('404 Not Found');
        }

        $controller = 'App\Controllers\\' . ucwords($params['controller']) . 'Controller';
        $action = $params['action'];

        $args = $this->getActionArguments($controller, $action, $params);

        $controller_obj = new $controller;
        $controller_obj->$action(...$args);

    }

    /**
     * @throws ReflectionException
     */
    private function getActionArguments(string $controller, string $action, array $parameters): array
    {
        $args = [];
        $reflection = new ReflectionMethod($controller, $action);
        $methodParams = $reflection->getParameters();

        foreach ($methodParams as $param) {
            if (isset($param->name)) {
                $name = $param->name;
                $args[$name] = $parameters[$name] ?? null;
            }
        }
        return $args;
    }
}