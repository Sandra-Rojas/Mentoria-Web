<?php
function connectDB()
{
    $dbname = "registro"; //modicar por valor no valido y comprobar try
    $dbuser = "registro_user";
    $dbpassword = "registro_user1";

    try {
    
        $dsn = "mysql:host=localhost;dbname=$dbname";
        //objeto de conexion a la bd
        $db = new PDO($dsn, $dbuser, $dbpassword);
        return $db;
        
    }catch(PDOException $e){
        echo $e->getMessage();
}