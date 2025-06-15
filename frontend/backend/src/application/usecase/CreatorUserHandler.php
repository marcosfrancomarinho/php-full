<?php

namespace App\application\usecase;

use App\application\DTO\RequestCreatorUserDTO;
use App\application\DTO\ResponseCreatorUserDTO;
use App\domain\entities\User;
use App\domain\interfaces\CreatorUserRepository;
use App\domain\interfaces\CreatorUserUseCase;
use App\domain\valuesobject\Age;
use App\domain\valuesobject\Name;

class CreatorUserHandler implements CreatorUserUseCase
{
    public function __construct(private CreatorUserRepository $creator_user_repository) {}
    public function create(RequestCreatorUserDTO $input): ResponseCreatorUserDTO
    {
        $name  = Name::create($input->name);
        $age = Age::create($input->age);
        $user = User::create($name, $age);
        $registered_user =  $this->creator_user_repository->create($user);
        $user_id = $registered_user->getID();
        $output = new ResponseCreatorUserDTO("register whit sucess", $user_id);
        return $output;
    }
}
