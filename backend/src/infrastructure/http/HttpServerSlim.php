<?php

namespace App\infrastructure\http;

use App\domain\interfaces\HttpServer;
use Slim\App;
use Slim\Factory\AppFactory;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

class HttpServerSlim implements HttpServer
{
    private App $app;
    public function __construct()
    {
        $this->app = AppFactory::create();
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        header("Access-Control-Allow-Headers: Content-Type, Authorization");
    }
    public function listen(): void
    {
        $this->app->run();
    }
    public function on(string $method, string $path, callable $handler): void
    {
        $this->app->$method($path, function (Request $request, Response $response) use ($handler) {
            $http_context = new HttpContextSlim($request, $response);
            return $handler($http_context);
        });
    }
}
