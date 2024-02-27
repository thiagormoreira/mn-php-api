<?php

namespace Core\Classes;

use Exception;

class Bind
{
    private static array $container = [];

    public static function bind(string $key, mixed $value): void
    {
        if(!isset(static::$container[$key])) {
            static::$container[$key] = $value;
        }
    }

    /**
     * @throws Exception
     */
    public static function resolve(string $key): object
    {
        if(!isset(static::$container[$key])) {
            throw new Exception("Binding {$key} not found");
        }

        return (object) static::$container[$key];
    }
}