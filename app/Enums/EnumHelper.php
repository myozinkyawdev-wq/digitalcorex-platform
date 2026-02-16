<?php

namespace App\Enums;

use InvalidArgumentException;


trait EnumHelper
{
    public static function toSelection(): array
    {
        return array_column(self::cases(), 'value', 'value');
    }

    public static function toArray(): array
    {
        return array_column(self::cases(), 'value');
    }

    public static function get($key)
    {
        return constant("self::{$key}")->value;
    }

    public static function getEnum(string $key)
    {
        $class = static::class;

        if (defined("$class::$key")) {
            return constant("$class::$key");
        }

        throw new InvalidArgumentException("Enum constant $class::$key not defined.");
    }

    public static function __callStatic($name, $arguments)
    {
        return constant("self::{$name}")->value;
    }
}