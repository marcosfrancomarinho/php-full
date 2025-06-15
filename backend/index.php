<?php
require_once __DIR__ . "/vendor/autoload.php";
set_error_handler(function ($severity, $message, $file, $line) {
    throw new ErrorException($message, 0, $severity, $file, $line);
});

use App\infrastructure\http\HttpServerSlim;
use App\presentation\router\Router;
use App\shared\container\Container;

function main(): void
{
    $container = new Container();
    $http_server = new HttpServerSlim();
    $router = new Router($http_server);
    $router->register($container);
    $http_server->listen();
}

main();
