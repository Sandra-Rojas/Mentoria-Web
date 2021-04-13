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

//insert masivo
/*$sql= "INSERT INTO users
            (full_name, email, user_name, password)
        values 
            (:full_name, :email, :user_name, :password)";

$stmt = $db->prepare($sql);

$full_name = 'Juan Perez';
$email = 'juan.perez@segic.cl';
$user_name='juan.perez';
//$password='juan123';
$password= password_hash('juan123', PASSWORD_DEFAULT);
//password_verify()

$stmt->bindParam (':full_name',$full_name);
$stmt->bindParam (':email',$email);
$stmt->bindParam (':user_name',$user_name);
$stmt->bindParam (':password',$password);

$stmt-> execute();
*/

//delete
/*$id=3;
$stmt = $db->prepare("DELETE FROM users WHERE id= :id");
$stmt->bindParam(':id',$id);
$stmt -> execute();
*/

//Insert utilizando arreglo forma1
/*$users =[
    ['Miguel Perez', 'miguel.perez@segic.cl', 'miguel.perez', 'miguel123'],
    ['Andrea Perez', 'andrea.perez@segic.usach.cl', 'andrea.perez', 'andrea123'],
];

$sql= "INSERT INTO users
            (full_name, email, user_name, password)
        values 
            (:full_name, :email, :user_name, :password)";

$stmt = $db->prepare($sql);

foreach($users as $user){
    $full_name = $user[0];
    $email = $user[1];
    $user_name=$user[2];;
    //$password='juan123';
    $password= password_hash($user[3], PASSWORD_DEFAULT);
    //password_verify()

    $stmt->bindParam (':full_name',$full_name);
    $stmt->bindParam (':email',$email);
    $stmt->bindParam (':user_name',$user_name);
    $stmt->bindParam (':password',$password);
    $stmt -> execute();
}
*/

//Insert utilizando arreglo forma2
/*$users =[
    [
    'name'=>'Miguel Perez',
    'email'=>'miguel.perez@segic.cl', 
    'username'=>'miguel.perez', 
    'password'=>'miguel123'
    ],
    [
    'name'=>'Andrea Perez', 
    'email'=>'andrea.perez@segic.usach.cl', 
    'username'=>'andrea.perez', 
    'password'=>'andrea123'
    ],
];

$sql= "INSERT INTO users
            (full_name, email, user_name, password)
        values 
            (:full_name, :email, :user_name, :password)";

$stmt = $db->prepare($sql);

foreach($users as $user){
    $full_name = $user['name'];
    $email = $user['email'];
    $user_name=$user['username'];;
    //$password='juan123';
    $password= password_hash($user['password'], PASSWORD_DEFAULT);
    //password_verify()

    $stmt->bindParam (':full_name',$full_name);
    $stmt->bindParam (':email',$email);
    $stmt->bindParam (':user_name',$user_name);
    $stmt->bindParam (':password',$password);
    $stmt -> execute();
}
*/


//querying data
$stmt = $db->prepare("SELECT * FROM users");
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

//imprimir nombres hacia abajo
foreach($users as $user){
    echo $user['id']. "<br>";
    echo $user['full_name']. "<br>";
}

