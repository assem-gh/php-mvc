<?php

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

require "src/Router.php";
$router = new Router();

$router->add('/home/index', ['controller' => 'HomeController', 'action' => 'index']);
$router->add('/', ['controller' => 'HomeController', 'action' => 'index']);
$router->add('/products/index', ['controller' => 'ProductsController', 'action' => 'index']);

$params = $router->match($path);

if ($params === false) {
    http_response_code(404);
    die('404 Not Found');
}

$controller = $params['controller'];
$action = $params['action'];

require "src/controllers/$controller.php";

$controller_obj = new $controller;
$controller_obj->$action();