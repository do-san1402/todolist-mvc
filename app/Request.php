<?php

namespace App\App;

/**
 * Class Request
 *
 * A simple utility class for handling HTTP requests.
 */
class Request
{
    /**
     * Get the URI of the current request.
     *
     * @return string The URI of the current request.
     */
    public static function uri()
    {
        return trim(
            parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH),
            '/'
        );
    }

    /**
     * Get the HTTP method of the current request.
     *
     * @return string The HTTP method of the current request (e.g., GET, POST).
     */
    public static function method()
    {
        return $_SERVER['REQUEST_METHOD'];
    }
}
