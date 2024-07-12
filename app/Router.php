<?php

namespace App\App;

/**
 * Class Router
 *
 * A simple router class responsible for mapping requests to their corresponding controllers and actions.
 */
class Router
{
    /**
     * The routes defined for different HTTP methods.
     *
     * @var array An associative array where keys are HTTP methods (GET, POST, etc.) and values are arrays of routes.
     */
    protected $routes = [
        'GET' => [],
        'POST' => [],
    ];

    /**
     * Load routes from a file and return an instance of Router.
     *
     * @param string $file The path to the file containing route definitions.
     * @return Router An instance of Router with loaded routes.
     */
    public static function load(string $file)
    {
        $router = new static();
        require $file;

        return $router;
    }

    /**
     * Define a route that responds to GET requests.
     *
     * @param string $uri The URI pattern to match.
     * @param string $controller The controller and method to call when the route matches.
     */
    public function get($uri, $controller)
    {
        $this->routes['GET'][$uri] = $controller;
    }

    /**
     * Define a route that responds to POST requests.
     *
     * @param string $uri The URI pattern to match.
     * @param string $controller The controller and method to call when the route matches.
     */
    public function post($uri, $controller)
    {
        $this->routes['POST'][$uri] = $controller;
    }

    /**
     * Directs the request to the appropriate controller and action based on the URI and HTTP method.
     *
     * @param string $uri The URI of the request.
     * @param string $method The HTTP method of the request (GET, POST, etc.).
     * @return mixed The result of calling the action method on the controller.
     */
    public function direct(string $uri, string $method)
    {
        if (array_key_exists($uri, $this->routes[$method])) {
            return $this->callAction(...explode('@', $this->routes[$method][$uri]));
        }

        return 'views/404.php';
    }

    /**
     * Calls the action method on the specified controller.
     *
     * @param string $controller The fully qualified name of the controller class.
     * @param string $action The name of the action method to call on the controller.
     * @return mixed The result of calling the action method.
     * @throws Exception If the action method does not exist on the controller.
     */
    protected function callAction($controller, $action)
    {
        $controller =  "App\\Controllers\\{$controller}";
        $controller = new $controller;

        if (!method_exists($controller, $action)) {
            throw new \Exception("{$controller} does not have {$action} method.");
        }

        return $controller->$action();
    }
}
