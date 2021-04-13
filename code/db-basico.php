<?php

//echo "Este es el archivo básico DB.";
$dbname = "registro"; //modicar por valor no valido y comprobar try
$dbuser = "registro_user";
$dbpassword = "registro_user1";

try {$dsn = "mysql:host=localhost;dbname=$dbname";

    //objeto de conexion a la bd
    $db = new PDO($dsn, $dbuser, $dbpassword);
    
}catch(PDOException $e){
    echo $e->getMessage();

}
//preparar consulta
$sql= "INSERT INTO users
            (full_name, email, user_name, password)
        values 
            (:full_name, :email, :user_name, :password)";

//statement
$stmt = $db->prepare($sql);

$full_name = 'Juan Perez';
$email = 'juan.perez@segic.cl';
$user_name='juan.perez';
$password='juan123';

$stmt->bindParam (':full_name',$full_name);
$stmt->bindParam (':email',$email);
$stmt->bindParam (':user_name',$user_name);
$stmt->bindParam (':password',$password);

$stmt-> execute();


//delete
/*$id=3;
$stmt = $db->prepare("DELETE FROM users WHERE id= :id");
$stmt->bindParam(':id',$id);
$stmt -> execute();
*/


