<?php

namespace App\infrastructure\repository;

use App\domain\entities\User;
use App\domain\interfaces\CreatorUserRepository;
use App\domain\valuesobject\ID;
use App\infrastructure\database\Connection;
use SQLite3;

class CreatorUserSQLITE implements CreatorUserRepository
{
    private SQLite3 $client;
    public function __construct()
    {
        $connection = new Connection();
        $this->client = $connection->client();
    }

    public function create(User $user): User
    {
        $sql = $this->client->prepare("INSERT INTO user (name, age) VALUES (:name, :age)");
        $sql->bindValue(":name", $user->getName(), SQLITE3_TEXT);
        $sql->bindValue(":age", $user->getAge(), SQLITE3_INTEGER);
        $sql->execute();

        $raw_id = $this->client->lastInsertRowID();
        $user_id = ID::create($raw_id);
        $user->setID($user_id);
        $this->client->close();
        return $user;
    }
}
