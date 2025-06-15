<?php

namespace App\application\DTO;

class RequestCreatorUserDTO
{
    public function __construct(public string $name, public int $age) {}
}
