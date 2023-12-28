<?php

/**
 * Holds the registered routes
 *
 * @var array $routes
 */
$routes = [];

/**
 * Register a new route
 *
 * @param $action string
 * @param \Closure $callback Called when current URL matches provided action
 */
function route($action, Closure $callback)
{
    global $routes;
    $action = trim($action, '/');
    $routes[$action] = $callback;
}

/**
 * Dispatch the router
 *
 * @param $action string
 */
function dispatch($action)
{
    global $routes;
    $action = trim($action, '/');

    if (!array_key_exists($action, $routes)) {
        $action = "404Error";
        if (!array_key_exists($action, $routes)) {
            // Handle the case where "404Error" route is not defined
            die('404 Not Found');
        }
    }

    $callback = $routes[$action];

    if (!is_callable($callback)) {
        // Handle the case where the callback is not a valid callable
        die('Invalid callback');
    }

    echo call_user_func($callback);
}

?>
