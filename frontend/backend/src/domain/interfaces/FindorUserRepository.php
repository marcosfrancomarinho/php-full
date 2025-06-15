<?php

namespace App\domain\interfaces;

use App\application\DTO\ResponseFindorUserDTO;

interface FindorUserRepository
{
    function find_all(): array;
}
