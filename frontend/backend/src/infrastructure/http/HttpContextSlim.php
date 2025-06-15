<?php

namespace App\infrastructure\http;

use App\domain\interfaces\HttpContext;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

class HttpContextSlim implements HttpContext
{
    public function __construct(private Request $request, private Response $response) {}

    public function request_body(): mixed
    {
        $body = $this->request->getBody();
        $body->rewind();
        $contents = $body->getContents();
        $datas = json_decode($contents, true);
        $name = $datas["name"] ?? "";
        $age = $datas["age"] ?? "";
        return ["name" => $name, "age" => $age];
    }
    public function send(int $status, mixed $data): mixed
    {
        $this->response->getBody()->write($data);
        return $this->response->withStatus($status)->withHeader("Content-Type", "application/json");
    }
    public function send_error(mixed $error): mixed
    {
        $this->response->getBody()->write($error);
        return $this->response->withStatus(400)->withHeader("Content-Type", "application/json");
    }
}
