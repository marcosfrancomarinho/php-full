<?php

namespace App\application\usecase;

use App\application\DTO\ResponseFindorUserDTO;
use App\domain\interfaces\FindorUserRepository;
use App\domain\interfaces\FindorUserUseCase;

class FindorUserHandler implements FindorUserUseCase
{
    private array $found_users;
    public function __construct(private FindorUserRepository $findor_user_repository)
    {
        $this->found_users = [];
    }
    public function find_all(): array
    {
        $users = $this->findor_user_repository->find_all();

        foreach ($users as $key => $value) {
            $name = $value->getName();
            $id = $value->getID();
            $age = $value->getAge();
            array_push($this->found_users, new ResponseFindorUserDTO($name, $age, $id));
        }
        return $this->found_users;
    }
}
