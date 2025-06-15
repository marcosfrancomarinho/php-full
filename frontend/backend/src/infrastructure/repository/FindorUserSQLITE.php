<?php

namespace App\infrastructure\repository;

use App\domain\entities\User;
use App\domain\interfaces\FindorUserRepository;
use App\domain\valuesobject\Age;
use App\domain\valuesobject\ID;
use App\domain\valuesobject\Name;
use App\infrastructure\database\Connection;
use SQLite3;

class FindorUserSQLITE implements FindorUserRepository
{
    private SQLite3 $client;
    private array $users;
    public function __construct()
    {
        $connection = new Connection();
        $this->client = $connection->client();
        $this->users = [];
    }
    public function find_all(): array
    {
        $users_found = $this->client->query("SELECT id, name, age FROM user");

        while ($user = $users_found->fetchArray(SQLITE3_ASSOC)) {
            $name = Name::create($user["name"]);
            $age = Age::create($user["age"]);
            $id = ID::create($user["id"]);
            $user = User::create($name, $age);
            $user->setID($id);
            array_push($this->users, $user);
        }
        return $this->users;
    }
}
