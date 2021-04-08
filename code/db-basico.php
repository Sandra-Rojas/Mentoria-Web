<?php

//echo "Este es el archivo básico DB.";
$dbname = "registro222222"; //modicar por valor no valido y comprobar try
$dbuser = "registro_user";
$dbpassword = "registro_user1";

try {$dsn = "mysql:host=localhost;dbname=$dbname";

    //objeto de conexion a la bd
    $db = new PDO($dsn, $dbuser, $dbpassword);
    
}catch(PDOException $e){
    echo $e->getMessage();

}