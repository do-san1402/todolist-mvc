<?php

namespace App\App;

/**
 * Class App
 *
 * A simple registry and dependency injection container.
 */
class App
{
    /**
     * The registry that holds all bound instances.
     *
     * @var array
     */
    protected static $registry = [];

    /**
     * Bind a value into the registry.
     *
     * @param string $key The key to bind the value to.
     * @param mixed $val The value to be bound.
     */
    public static function bind(string $key, $val)
    {
        static::$registry[$key] = $val;
    }

    /**
     * Retrieve a bound value from the registry.
     *
     * @param string $key The key of the value to retrieve.
     * @return mixed The value bound to the given key.
     * @throws \Exception If the requested key does not exist in the registry.
     */
    public static function get(string $key)
    {
        if (!array_key_exists($key, static::$registry)) {
            throw new \Exception("No {$key} is bound in the container.");
        }

        return static::$registry[$key];
    }
}
