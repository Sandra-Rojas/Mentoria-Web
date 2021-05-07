<?php

function connectDB()
{
    $db_name = "registro";
    $db_user = "local";
    $db_pass = "local";
    //manejo de error
    try  { 
        $dsn = "mysql:host=localhost;dbname=$db_name";
        $db = new PDO($dsn, $db_user, $db_pass );
        return $db;
    } catch(PDOException $e){
        echo $e->getMessage();
    }
}