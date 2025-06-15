<?php

namespace App\application\DTO;

class ResponseCreatorUserDTO
{
    public function __construct(public string $message, public int $user_id) {}
}
