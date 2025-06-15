<?php

namespace App\presentation\controller;

use App\domain\interfaces\FindorUserUseCase;
use App\domain\interfaces\HttpContext;
use App\domain\interfaces\HttpController;
use Exception;

class FindorUserController implements HttpController
{
    public function __construct(private FindorUserUseCase $findor_user_use_case) {}
    public function execute(HttpContext $http_context): mixed
    {
        try {
            $output = $this->findor_user_use_case->find_all();
            $users = json_encode($output);
            return $http_context->send(200, $users);
        } catch (Exception $error) {
            $message_error = json_encode(["error" => $error->getMessage()]);
            return $http_context->send_error($message_error);
        }
    }
}
