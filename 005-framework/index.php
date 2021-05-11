<?php

//envez de incluir el archivo con require 
require_once __DIR__ .'/vendor/autoload.php';

//usando application.php
use app\core\Application;

//echo "Hello Framework";
//Application :inicializacion de componente bases de framework
//$app = new app\core\Application();
$app = new Application();

//definiciones , crear rutas
//$router= new Router();

//se define funcion() anonima llamada callback
//esto se puede mejorar con "Composicion" (una clase puede componer a otra clase)
// por lo que cambia a $app->router->get
//y ya no se necesita la definicion de crear ruta 
//router->get('/', function(){
$app->router->get('/005-framework/', function(){
    return "Hola Mundo";
});

$app->router->get('/005-framework/contact', function(){
    return "Contact";
});

/*$app->$router->post('/contact', function(){
    return "Contact";
});*/

//ejecuta todo lo que tienen framework
$app->run();

//$app->request