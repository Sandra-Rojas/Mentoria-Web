<?php

//definir namespace
namespace app\core;

class Application
{
    //esteatributo solo puede tener instancias de la clase Router
    public Router $router;
    public Request $request;

    public function __construct()
    {
        $this->request = new Request();
        $this->router = new Router($this->request);
    }

    //run resuelve la ruta a ejecutar
    public function run()
    {
        //$this->router->resolve();
        echo $this->router->resolve();

    }
}