<?php

namespace App\presentation\router;

use App\domain\interfaces\HttpServer;
use App\shared\container\Container;

class Router
{
    public function __construct(private HttpServer $http_server) {}

    public function register(Container $container)
    {
        [
            "creator_user_controller" => $creator_user,
            "findor_user_controller" => $findor_user
        ] = $container->dependecies();

        $this->http_server->on("post", "/", [$creator_user, "execute"]);
        $this->http_server->on("get", "/", [$findor_user, "execute"]);
    }
}
