<?php

namespace App\domain\valuesobject;

use Exception;

class Age
{
    private function __construct(private int $age) {}

    public static function create(int $age): Age
    {
        self::validate($age);
        return new Age($age);
    }

    public  static function validate(int $age): void
    {
        if ($age <= 0 || $age > 100)  throw new Exception("age invalid.");
    }
    public function getValue(): int
    {
        return $this->age;
    }
}
