<?php

    require "util/db.php";

    $i=0;


    if (isset($_POST['actualiza'])) {

        echo "Actualizar";
        //rescata valores enviado por url
        $id = $_GET['id'];
        //rescata valor de la pagina edit, caja texto
        $namefull = $_POST['namefull'];
        $username =$_POST['username'];
        $email  = $_POST['email'];
        echo "valor en Actualizar: " . $namefull . " Id: " . $id;

        $db=connectDB();
        $sql ="UPDATE users SET full_name=:namefull, email=:email, user_name=:username Where id=:id";
        $stmt=$db->prepare($sql);
        $stmt->bindParam(":namefull",$namefull);
        $stmt->bindParam(":email",$email);
        $stmt->bindParam(":username",$username);
        $stmt->bindParam(":id",$id);
        $stmt->execute();
        
        echo "Datos Actualizados: " . $namefull . " Id: " . $id;
             }
    else
    {
        echo "Ingreso la primera vez";
        //Recata datos de bd con id y los disponibiliza para utilizar en caja de texto
        $id= $_GET['Id'];
        
        $db=connectDB();
        $sql = "SELECT * FROM users WHERE id = '$id'";
        //Statement, conectarse a BD con PDO
        $stmt = $db->prepare($sql); 
        $stmt->execute(); 
        $users = $stmt->fetch(PDO::FETCH_ASSOC);
        print_r($users);

        $namefull = $users['full_name']; 
        $username = $users['user_name']; 
        $email  = $users['email']; 
        
    }
?>

<!doctype html>
<html lang="en" class="h-100">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <!--meta http-equiv="X-UA-Compatible" content="IE=edge"-->
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
            <form method="POST" action="edit.php">
                <div class="form-group">
                    <label for="name">Nombre Completo</label>
                    <!--Asigna valores, agrega name------------->
                    <input type="text" class="form-control" id="namefull" name="namefull" value=<?=$namefull ?> placeholder="Enter name">
                    <small class="form-text text-muted"></small>
                    <label for="name">Nombre Usuario</label>
                    <input type="text" class="form-control" id="username" name="username" value=<?=$username ?> placeholder="Enter name">
                    <small class="form-text text-muted"></small>
                    <label for="name">Email</label>
                    <input type="text" class="form-control" id="email" name="email" value=<?=$email ?> placeholder="Enter name">
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