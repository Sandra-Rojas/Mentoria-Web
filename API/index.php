<?php


$dsn = "mysql:host=localhost;dbname=registro";
$username = "local";//"admin";
$password= "local";//"user1";
$pdo = new \PDO($dsn, $username, $password);

$sql = "SELECT * FROM users2";
$statement = $pdo->prepare($sql);
$statement->execute();

$rows = $statement->fetchAll(\PDO::FETCH_ASSOC);
//var_dump($rows);


//buena parctica definir el tipo de contenido que se esta devolviendo:json
//muestra al consumir la api que es un contenido de tipo Json
//si no se utiliza muestra un string de un arreglo
header('Content-Type: application/json');
//para solucionar problema de CORS por LiveServer
header('Access-Control-Allow-Origin: *');
//sin formato Content-Type: application/json',json_encode, muestra un  arreglo de datos
echo json_encode($rows);

