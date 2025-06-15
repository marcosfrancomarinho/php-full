<?php

namespace App\domain\valuesobject;

use Exception;

class Name
{
    private function __construct(private string $name) {}

    public static function create(string $name): Name
    {
        self::validate($name);
        return new Name($name);
    }

    public  static function validate(string $name): void
    {
        if (empty($name))  throw new Exception("name invalid.");
        if (!preg_match("/^[\p{L} '-]+$/u", $name)) throw new Exception("name contains invalid characters.");
    }
    public function getValue(): string
    {
        return $this->name;
    }
}
