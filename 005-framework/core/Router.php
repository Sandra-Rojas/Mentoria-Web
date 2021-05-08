<?php
namespace app\core;

class Router
{
    protected array $routes =[];
    /**
     * [
     *      '/' => callback (function)
     *      '/users' => callback
     *  * ]
     *  
     */

    public function get($path, $callback)
    {
        $this->routes['get'][$path] =$callback;

    }

    public function resolve()
    {
        //da formato a lo que sigue
        echo "<pre>";
        var_dump($_SERVER);
        echo "chao";
        echo "</pre>";
        exit;

    }

}
