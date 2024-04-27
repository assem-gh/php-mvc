<?php

$controllers = [
    'home' => 'HomeController',
    'products' => 'ProductsController',
];

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$segments = explode('/', $path);

$controller = $controllers[$segments[1]];
$action = $segments[2];

require "src/controllers/$controller.php";

$controller_obj = new $controller;
$controller_obj->$action();