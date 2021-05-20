<?php
namespace app\core;

class Router
{
    public Request $request;
    protected array $routes =[];
    /**
     * [
     *      '/' => callback (function)
     *      '/users' => callback
     *  * ]
     *  
     */
    public function __construct(\app\core\Request $request)
    {
        $this->request = $request;
       
    }

    public function get($path, $callback)
    {
        $this->routes['get'][$path] =$callback;

    }

    public function resolve()
    {
        //da formato a lo que sigue
        /*echo "<pre>";
        var_dump($_SERVER);
        echo "chao";
        echo "</pre>";
        exit;*/
        $path = $this->request->getPath();
        $method = $this->request->getMethod();

        //$closure
        $callback = $this->routes[$method][$path] ?? false;
        echo "<pre>";
        echo 'De Router.php';
        echo "</pre>";
        echo "<pre>";
        echo '$path:';
        var_dump($path);
        echo '$method:';
        var_dump($method);
        //echo '$callback:'; . $callback ;
        echo "</pre>";

        If ($callback === false)
        {
            //echo "Not Found!";
            //exit;
            return "Not Found";
        }
        //principio SOLID  revisar

        if(is_string($callback)){
            return $this->renderView($callback);

        }

        //echo call_user_func($callback);
        return call_user_func($callback);
    }    
     
    public function renderView($view)
    {

        $layoutContent = $this->layoutContent();
        $viewContent = $this->renderOnlyView($view);    
        //interpolacion de variables
        //include_once Application::$ROOT_DIR . "/views/$view.php";

        return str_replace('{{content}}', $viewContent, $layoutContent);

    }

    public function layoutContent()
    {
        //envia a memoria
        ob_start();
        include_once Application::$ROOT_DIR . "/views/layouts/main.php";
        //devuelve contenido que tiene en memoria
        return ob_get_clean();
    }

    public function renderOnlyView($view)
    {
        //envia a memoria
        ob_start();
        include_once Application::$ROOT_DIR . "/views/$view.php";
        //devuelve contenido que tiene en memoria
        return ob_get_clean();
    }
    /*print_r($this->routes);    
    var_dump($path);
    var_dump($method);
    */
    
}

    


