<?php
namespace Storage\Routing;

use DI\Container;
use Slim\App;
use Slim\Interfaces\RouteGroupInterface;
use Slim\Interfaces\RouteInterface;

class Router
{
    private static ?App $app = null;

    /**
     * Registers the slim app instance with the router.
     */
    public static function registerSlimApp(App $app) : void
    {
        self::$app = $app;
    }

    /**
     * Registers a GET route.
     * 
     * @param string $url The URL of the route.
     * @param array|callable $args Either an array of class, method or a callable function/class.
     * @param array $middleware An array of middleware callables.
     * @return \Slim\Interfaces\RouteInterface
     */
    public static function get(string $url, $args, array $middleware = []) : RouteInterface
    {
        $route = self::$app->get($url, $args);

        if(count($middleware) > 0)
            self::registerMiddleware($route, $middleware);

        return $route;
    }

    /**
     * Registers a POST route.
     * 
     * @param string $url The URL of the route.
     * @param array|callable $args Either an array of class, method or a callable function/class.
     * @param array $middleware An array of middleware callables.
     * @return \Slim\Interfaces\RouteInterface
     */
    public static function post(string $url, $args, array $middleware = []) : RouteInterface
    {
        $route = self::$app->post($url, $args);

        if(count($middleware) > 0)
            self::registerMiddleware($route, $middleware);

        return $route;
    }

    /**
     * Registers a PUT route.
     * 
     * @param string $url The URL of the route.
     * @param array|callable $args Either an array of class, method or a callable function/class.
     * @param array $middleware An array of middleware callables.
     * @return \Slim\Interfaces\RouteInterface
     */
    public static function put(string $url, $args, array $middleware = []) : RouteInterface
    {
        $route = self::$app->put($url, $args);

        if(count($middleware) > 0)
            self::registerMiddleware($route, $middleware);

        return $route;
    }

    /**
     * Registers a DELETE route.
     * 
     * @param string $url The URL of the route.
     * @param array|callable $args Either an array of class, method or a callable function/class.
     * @param array $middleware An array of middleware callables.
     * @return \Slim\Interfaces\RouteInterface
     */
    public static function delete(string $url, $args, array $middleware = []) : RouteInterface
    {
        $route = self::$app->delete($url, $args);

        if(count($middleware) > 0)
            self::registerMiddleware($route, $middleware);

        return $route;
    }

    /**
     * Registers a OPTIONS route.
     * 
     * @param string $url The URL of the route.
     * @param array|callable $args Either an array of class, method or a callable function/class.
     * @param array $middleware An array of middleware callables.
     * @return \Slim\Interfaces\RouteInterface
     */
    public static function options(string $url, $args, array $middleware = []) : RouteInterface
    {
        $route = self::$app->options($url, $args);

        if(count($middleware) > 0)
            self::registerMiddleware($route, $middleware);

        return $route;
    }

    /**
     * Registers a PATCH route.
     * 
     * @param string $url The URL of the route.
     * @param array|callable $args Either an array of class, method or a callable function/class.
     * @param array $middleware An array of middleware callables.
     * @return \Slim\Interfaces\RouteInterface
     */
    public static function patch(string $url, $args, array $middleware = []) : RouteInterface
    {
        $route = self::$app->patch($url, $args);

        if(count($middleware) > 0)
            self::registerMiddleware($route, $middleware);

        return $route;
    }

    /**
     * Registers an 'any' route.
     * 
     * @param string $url The URL of the route.
     * @param array|callable $args Either an array of class, method or a callable function/class.
     * @param array $middleware An array of middleware callables.
     * @return \Slim\Interfaces\RouteInterface
     */
    public static function any(string $url, $args, array $middleware = []) : RouteInterface
    {
        $route = self::$app->any($url, $args);

        if(count($middleware) > 0)
            self::registerMiddleware($route, $middleware);

        return $route;
    }

    /**
     * Registers a route group.
     * 
     * @param string $url The URL of the route.
     * @param callable $handler A function that handles the group route.
     * @param array $middleware An array of middleware callables.
     * @return \Slim\Interfaces\RouteGroupInterface
     */
    public static function group(string $url, callable $handler, array $middleware = []) : RouteGroupInterface
    {
        $routeGroup = self::$app->group($url, $handler);

        if(count($middleware) > 0)
        {
            foreach($middleware as $classCallable)
            {
                $routeGroup->add($classCallable);
            }
        }

        return $routeGroup;
    }

    /**
     * Registers middleware to a specific route.
     * 
     * @param \Slim\Interfaces\RouteInterface $route A valid route class.
     * @param array $middlewareArray An array of class callables.
     * @return \Slim\Interfaces\RouteInterface
     */
    public static function registerMiddleware(RouteInterface $route, array $middlewareArray) : RouteInterface
    {
        if(count($middlewareArray) > 0)
        {
            foreach($middlewareArray as $middleware)
            {
                $route->add($middleware);
            }
        }

        return $route;
    }
}
