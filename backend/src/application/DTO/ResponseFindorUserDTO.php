<?php

namespace App\application\DTO;

class ResponseFindorUserDTO
{
    public function __construct(public $name, public int $age, public int $user_id) {}
}
