<?php

//envez de incluir el archivo con require 
require_once __DIR__ .'/vendor/autoload.php';

//usando application.php
use app\core\Application;

//echo "Hello Framework";
//inicializacion de componente
//$app = new app\core\Application();
$app = new Application();

//$router= new Router();

$app->router->get('/', function(){
    return "Hola Mundo";
});

$app->router->get('/contact', function(){
    return "Contact";
});

/*$app->$router->post('/contact', function(){
    return "Contact";
});*/

$app->run();