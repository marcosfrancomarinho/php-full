<?php

namespace App\presentation\controller;

use App\application\DTO\RequestCreatorUserDTO;
use App\domain\interfaces\CreatorUserUseCase;
use App\domain\interfaces\HttpContext;
use App\domain\interfaces\HttpController;
use Exception;

class CreatorUserController implements HttpController
{
    public function __construct(private CreatorUserUseCase $creator_user_use_case) {}

    public function execute(HttpContext $http_context): mixed
    {
        try {
            ["name" => $name, "age" => $age] = $http_context->request_body();
            $input = new RequestCreatorUserDTO($name, $age);
            $output = $this->creator_user_use_case->create($input);
            $message = json_encode(["message" => $output->message, "userId" => $output->user_id]);
            return $http_context->send(201, $message);
        } catch (Exception $error) {
            $message_error = json_encode(["error" => $error->getMessage()]);
            return $http_context->send_error($message_error);
        }
    }
}
