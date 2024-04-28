<?php

declare(strict_types=1);

use App\Database;
use Framework\Container;
use Framework\Dispatcher;
use Framework\Router;

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

spl_autoload_register(function ($class) {
    require 'src/' . str_replace('\\', '/', $class) . '.php';
});

$router = new Router();
$router->add('admin/{controller}/{action}', ['namespace' => 'Admin']);
$router->add('/home/index', ['controller' => 'Home', 'action' => 'index']);
$router->add('/', ['controller' => 'Home', 'action' => 'index']);
$router->add('/products', ['controller' => 'Products', 'action' => 'index']);
$router->add('/{controller}/{id:\d+}/{action}');
$router->add('/{controller}/{action}');

$container = new Container();
$container->set(Database::class, function () {
    return new Database("127.0.0.1", "admin", "password", "mvc",);
});

$dispatcher = new Dispatcher($router, $container);
$dispatcher->handle($path);