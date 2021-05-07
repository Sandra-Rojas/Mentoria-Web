<?php

//definir namespace
namespace app\core;

class Application
{
    //esteatributo solo puede tener instancias de la clase Router
    public Router $router;


    public function __construct()
    {
        $this->router = new Router();
    }

    //run resuelve la ruta a ejecutar
    public function run()
    {
        $this->router->resolve();

    }
}