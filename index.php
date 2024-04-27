<?php

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

spl_autoload_register(function ($class) {
    require 'src/' . str_replace('\\', '/', $class) . '.php';
});

$router = new Framework\Router();

$router->add('/home/index', ['controller' => 'HomeController', 'action' => 'index']);
$router->add('/', ['controller' => 'HomeController', 'action' => 'index']);
$router->add('/products/index', ['controller' => 'ProductsController', 'action' => 'index']);

$params = $router->match($path);

if ($params === false) {
    http_response_code(404);
    die('404 Not Found');
}

$controller = 'App\Controllers\\' . ucwords($params['controller']);
$action = $params['action'];


$controller_obj = new $controller;
$controller_obj->$action();