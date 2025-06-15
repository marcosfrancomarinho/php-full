<?php

namespace App\shared\container;

use App\application\usecase\CreatorUserHandler;
use App\application\usecase\FindorUserHandler;
use App\infrastructure\repository\CreatorUserSQLITE;
use App\infrastructure\repository\FindorUserSQLITE;
use App\presentation\controller\CreatorUserController;
use App\presentation\controller\FindorUserController;

class Container
{
    public function dependecies()
    {
        $creator_user_repository = new CreatorUserSQLITE();
        $creator_user_handler = new CreatorUserHandler($creator_user_repository);
        $creator_user_controller = new CreatorUserController($creator_user_handler);

        $findor_user_repository = new FindorUserSQLITE();
        $findor_user_handler = new FindorUserHandler($findor_user_repository);
        $findor_user_controller = new FindorUserController($findor_user_handler);

        return [
            "findor_user_controller" => $findor_user_controller,
            "creator_user_controller" => $creator_user_controller
        ];
    }
}
