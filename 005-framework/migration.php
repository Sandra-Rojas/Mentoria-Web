<?php

//envez de incluir el archivo con require 
require_once __DIR__ .'/vendor/autoload.php';

//usando application.php
use app\core\Application;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

print_r($_ENV);
// echo 'dns: ' . $_ENV['DSN']."\n";
// echo 'user: ' . $_ENV['USER']."\n";
// echo 'username: ' . $_ENV["USERNAME"]."\n";
// echo 'usuario: ' . $_ENV["USUARIO"]."\n";
// echo 'password: ' . $_ENV['PASSWORD']."\n";
// echo 'USER1: ' . $_ENV['USER1']."\n";
// echo 'USERNAME1: ' . $_ENV['USERNAME1']."\n";
// echo 'oso:' .$_ENV['OSO'] . "\n";
$config = [
    'db' => [
        'dsn'=> $_ENV['DSN'],
        //'user'=> $_ENV['USERNAME'],
        'user'=> $_ENV['USUARIO'],
        'password'=> $_ENV['PASSWORD'],
    ]
];

echo "en migration.php \n";
//Application :inicializacion de componente bases de framework
//$app = new app\core\Application();
$app = new Application(__DIR__, $config);
$app->db->applyMigrations();

