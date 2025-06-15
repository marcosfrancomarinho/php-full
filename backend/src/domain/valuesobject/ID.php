<?php

namespace App\domain\valuesobject;

use Exception;

class ID
{
    private function __construct(private int $id) {}

    public static function create(int $id): ID
    {
        self::validate($id);
        return new ID($id);
    }

    public  static function validate(int $id): void
    {
        if ($id < 0)  throw new Exception("id invalid.");
    }
    public function getValue(): int
    {
        return $this->id;
    }
}
