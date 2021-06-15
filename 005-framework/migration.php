<?php

//envez de incluir el archivo con require 
require_once __DIR__ .'/vendor/autoload.php';

//usando application.php
use app\core\Application;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$config = [
    'db' => [
        'dsn'=> $_ENV['DSN'],
        'username'=> $_ENV['USERNAME'],
        'password'=> $_ENV['PASSWORD'],
    ]
];
//echo "Hello Framework";
//Application :inicializacion de componente bases de framework
//$app = new app\core\Application();
$app = new Application(__DIR__, $config);
$app->db->applyMigrations();

