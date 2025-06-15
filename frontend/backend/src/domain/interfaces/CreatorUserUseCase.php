<?php

namespace   App\domain\interfaces;

use App\application\DTO\RequestCreatorUserDTO;
use App\application\DTO\ResponseCreatorUserDTO;

interface CreatorUserUseCase
{
    function create(RequestCreatorUserDTO $input): ResponseCreatorUserDTO;
}
