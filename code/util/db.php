<?php

function connectDB()
{
    $db_name = "registro";
    $db_user = "registro_user";
    $db_pass = "registro_user1";
    //manejo de error
    try  { 
        $dsn = "mysql:host=localhost;dbname=$db_name";
        $db = new PDO($dsn, $db_pass, $db_user);
        return $db;
    } catch(PDOException $e){
        echo $e->getMessage();
    }
}