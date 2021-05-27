<?php

namespace app\controllers;
use app\core\Application;

class SiteController
{
    public function home()
    {
        return Application::$app->router->renderView('home');
    }
    
    public function contact()
    {
        return Application::$app->router->renderView('contact');
    }

    //se ejecuta con POST
    public function handleContact()
    {
        return "Procesando información";
    }
}