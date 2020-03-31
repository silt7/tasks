<?php

/**
 * route short summary.
 *
 * route description.
 *
 * @version 1.0
 * @author 79523
 */
use Config;

class Route
{
    public function run(){
        $urn = explode('?', $_SERVER['REQUEST_URI']);
        $routes = Config::get('ROUTES');
        $key = $urn[0];
        if (!empty($routes[$key])){
            $controller = explode('@', $routes[$key]);
            $class  = '\\Controllers\\'.$controller[0];
            $action = $controller[1];
            $call = new $class;
            $call -> $action();
        }
        else{
            header('HTTP/1.1 404 Not Found');
            die('404');
        }
    }
}