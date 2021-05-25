<?php

//definir namespace
namespace app\core;

class Application
{
    //esteatributo solo puede tener instancias de la clase Router
    public static string $ROOT_DIR;
    public Router $router;
    public Request $request;
    public Response $response;

    public static Application $app;

    public function __construct($rootPath)
    {
        self::$ROOT_DIR = $rootPath;
        self::$app = $this;
        $this->request = new Request();
        $this->response = new Response();
        $this->router = new Router($this->request, $this->response);
    }

    //run resuelve la ruta a ejecutar
    public function run()
    {
        //$this->router->resolve();
        echo $this->router->resolve();

    }
}