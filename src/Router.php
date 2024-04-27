<?php

class Router
{
    private array $routes = [];

    public function add(string $path, array $parameters): void
    {
        $this->routes[] = [
            'path' => $path,
            'parameters' => $parameters
        ];
    }

    public function match(string $path): array|bool
    {
        foreach ($this->routes as $route) {
            if ($route['path'] === $path) {
                return $route['parameters'];
            }
        }
        return false;
    }
}