<?php

namespace App\domain\interfaces;

use App\domain\entities\User;

interface CreatorUserRepository
{
    function create(User $user): User;
}
