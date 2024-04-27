<?php

namespace Framework;
class Router
{
    private array $routes = [];

    public function add(string $path, array $parameters = []): void
    {
        $this->routes[] = [
            'path' => $path,
            'parameters' => $parameters
        ];
    }

    public function match(string $path): array|bool
    {
        $path = urldecode($path);
        foreach ($this->routes as $route) {
            $pattern = $this->getPatternFromPath($route['path']);
            if (preg_match($pattern, $path, $matches)) {
                $matches = array_filter($matches, "is_string", ARRAY_FILTER_USE_KEY);
                return array_merge($route['parameters'], $matches);
            }
        }
        return false;

    }

    private function getPatternFromPath(string $path): string
    {
        $path = trim($path, '/');
        $segments = explode('/', $path);
        $segments = array_map(function (string $segment): string {
            if (preg_match("#^\{([a-z][a-z0-9]*)\}#", $segment, $matches)) {
                return "(?<" . $matches[1] . ">[^/]*)";
            }
            if (preg_match("#^\{([a-z][a-z0-9]*):(.*)\}#", $segment, $matches)) {
                return "(?<" . $matches[1] . ">" . $matches[2] . ")";
            }
            return $segment;
        }, $segments);
        return '#^/' . implode('/', $segments) . '$#iu';
    }
}