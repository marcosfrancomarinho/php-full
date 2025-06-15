<?php

namespace App\domain\entities;

use App\domain\valuesobject\Age;
use App\domain\valuesobject\ID;
use App\domain\valuesobject\Name;
use Exception;

class User
{
    private function __construct(private Name $name, private Age $age, private ?ID $id = null) {}

    public static function create(Name $name, Age $age): User
    {
        return new User($name, $age);
    }


    public function getName(): string
    {
        return $this->name->getValue();
    }
    public function getAge(): int
    {
        return $this->age->getValue();
    }
    public function getID(): int
    {
        if (!$this->id) throw new Exception('non-existent id');
        return $this->id->getValue();
    }
    public function setID(ID $id): void
    {
        $this->id = $id;
    }
}
