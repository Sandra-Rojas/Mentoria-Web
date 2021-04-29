<?php

    require "util/db.php";

    $i=0;

    $siempre123= password_hash("123",PASSWORD_DEFAULT);
    echo " siempre123:" . $siempre123;
    $siempre123= password_hash("123",PASSWORD_DEFAULT);
    echo " siempre123:" . $siempre123;
    $siempre123= password_hash("123",PASSWORD_DEFAULT);
    echo " siempre123:" . $siempre123;

    $id = $_GET['id'];

    if (isset($_POST["actualiza"])) {

        echo "**** Actualizar*****"  ;
        //si se agrega en form action edit.php, no es posible rescatar nuevamente valores de Id cuando hay 
        //ingreso de datos se pierde el valor de la variable por url
        
        //$id = $_GET['id'];
        
        //rescata valor de la pagina edit, caja texto
        $namefull = $_POST["namefull"];
        $username2 = $_POST["username"];
        $email  = $_POST["email"];
 
        //password que carga inicialmente esta encriptada hash
        $db=connectDB();
        $sql = "SELECT * FROM users WHERE id = '$id'";
        //Statement, conectarse a BD con PDO
        $stmt = $db->prepare($sql); 
        $stmt->execute(); 
        $users = $stmt->fetch(PDO::FETCH_ASSOC);
        $password = $users["password"]; 

        $hashpasswordbd= $password;
        echo "---clave de la bd hashpasswordbd: " . $hashpasswordbd;

        //la password que rescata de la caja de texto podria ser modificada
        //si esta modificada no es hash
        $newpassword = $_POST["password"];
        echo "---Clave ingresada por usuario newpassword: " . $newpassword;

        //if (password_verify('rasmuslerdorf', $hash)) {
        if ($hashpasswordbd == $newpassword){  
            echo "****Las password son iguales****";
            $password= $hashpasswordbd ; 
            }   else {
                        if (password_verify($newpassword, $hashpasswordbd)) {
                            $password= $hashpasswordbd ; 
                            echo "----- Password iguales, revisa con verify la nuevapassword vs la bd"; 
                        }
                        else{
                            $password= password_hash($_POST["password"], PASSWORD_DEFAULT);
                            echo "----- Password diferentes, encripta clave";
                        }
        }           
             
        echo  "ACTUALIZAR: Name Full: " . $namefull . " ---username: ". $username2 . " ----Email: " . $email  ." ---Id: " . $id . " ----Clave:" . $password;
        

        $db=connectDB();
        $sql ="UPDATE users 
                SET full_name=:namefull, 
                    email=:email, 
                    user_name=:username, 
                    password=:password 
                Where id=:id";
        $stmt=$db->prepare($sql);
        $stmt->bindParam(":namefull",$namefull);
        $stmt->bindParam(":email",$email);
        $stmt->bindParam(":username",$username2);
        $stmt->bindParam(":password",$password);
        $stmt->bindParam(":id",$id);
        $stmt->execute();
        
        //echo "Datos Actualizados: " . $namefull . " Id: " . $id;
        }
    else
    {
        echo "*****Ingreso la primera vez****";
        //Recata alor de id de url y los disponibiliza para utilizar en caja de texto

        //$id=$_GET['id'];
        
        echo " Id: " . $id . "----";

        $db=connectDB();
        $sql = "SELECT * FROM users WHERE id = '$id'";
        //Statement, conectarse a BD con PDO
        $stmt = $db->prepare($sql); 
        $stmt->execute(); 
        $users = $stmt->fetch(PDO::FETCH_ASSOC);
        echo " VALORES DE BD: ";
        print_r($users);
        echo " fin valores de BD********";
        $namefull = $users["full_name"]; 
        $username2 = $users["user_name"]; 
        $email  = $users["email"]; 
        $password = $users["password"]; 
        echo " VALOR de BD leyendo el contenido del array: username: " . $username2 . " password: " . $password;
        echo "**********";
    }
?>

<!doctype html>
<html lang="en" class="h-100">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="shortcut icon" href="assets/img/favicon.ico" type="image/x-icon">

    <title>List of User</title>
   
  </head>
  <body class="d-flex flex-column h-100">
    
    <div class="container pt-4 pb-4">
        <nav class="navbar navbar-expand-lg navbar-light bg-light rounded">
            <a class="navbar-brand" href="#">HTML-PHP CRUD Template</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample09" aria-controls="navbarsExample09" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
    
            <div class="collapse navbar-collapse" id="navbarsExample09">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="create.php">Create</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">FAQ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="https://pisyek.com/contact">Help</a>
                    </li>
                </ul>
                <form class="form-inline my-2 my-md-0">
                <input class="form-control" type="text" placeholder="Search" aria-label="Search">
                </form>
            </div>
        </nav>
    </div>
        
    <main role="main" class="flex-shrink-0">
        <div class="container">
            <h1>Actualización de Usuario</h1>
            <!-- importante agregar action= edit.php !! -->
            <form action="" method="POST">
                <div class="form-group">
                    <label for="name">Nombre Completo</label>
                    <!--Asigna valores, agrega name------------->
                    <input type="text" class="form-control" id="namefull" name="namefull" value=<?= trim($namefull) ?? "Sin Nombre Completo"?> >
                    <small class="form-text text-muted"></small>
                    <label for="name">Nombre Usuario</label>
                    <input type="text" class="form-control" id="username" name="username" value=<?= $username2 ?? "Sin_Nombre_de_Usuario"?> >
                    <small class="form-text text-muted"></small>
                    <label for="name">Email</label>
                    <input type="text" class="form-control" id="email" name="email" value=<?= trim($email) ?? "Sin Correo"?> >
                    <small class="form-text text-muted"></small>
                    <label for="name">Clave</label>
                    <input type="password" class="form-control" id="password" name="password" value=<?= $password ?? "Sin Clave"?> >
                    <small class="form-text text-muted"></small>
                   
                </div>
                <!--Renombra botòn y asigna name------------>
                <button type="submit" class="btn btn-primary" name="actualiza">Actualizar</button>
            </form>
        </div>
    </main>
      
    <footer class="footer mt-auto py-3">
        <div class="container pb-5">
            <hr>
            <span class="text-muted">
                    Copyright &copy; 2019 | <a href="https://pisyek.com">Pisyek.com</a>
            </span>
        </div>
    </footer>

    
    <script src="assets/js/jquery-3.3.1.slim.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
  </body>
</html>