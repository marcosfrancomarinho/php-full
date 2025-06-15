<?php

namespace App\domain\interfaces;

interface HttpServer
{
    function on(string $method, string $path, callable $handler): void;
    function listen(): void;
}
