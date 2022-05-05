<?php

namespace App\core;

class Router
{
    public function __construct()
    {
        // Get the required route (without query string) and remove trailing slashes
        $url = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?? '', '/');

        // $routes comes from 'routes.php' required here
        $routes = require_once '../app/routes.php';

        // If required route is not in $routes, return a 404 Page not found error
        if (!key_exists($url, $routes)) {
            header("HTTP/1.0 404 Not Found");
            echo '404 - Page not found';
            exit();
        }

        // Get the matching route in $routes array
        $matchingRoute = $routes[$url];

        // Get the FQCN of controller associated to the matching route
        $controller = 'App\\controllers\\' . $matchingRoute[0];

        // Get the method associated to the matching route
        $method = $matchingRoute[1];

        // Get the queryString values configured for the matching route (in $_GET superglobal).
        // If there are additional queryString parameters, they are ignored here, and should be
        // directly manage in the controller
        $parameters = [];
        foreach ($matchingRoute[2] ?? [] as $parameter) {
            if (isset($_GET[$parameter])) {
                $parameters[] = $_GET[$parameter];
            }
        }

        // instance the controller, call the method with given parameters
        // controller method will return a twig template (HTML string) which is displayed here
        try {
            // execute the controller
            echo (new $controller())->$method(...$parameters);
        } catch (\Exception $e) {
            header("HTTP/1.0 500 Internal Server Error");
            echo '500 - Internal Server Error';
            exit();
        }
    }
}
