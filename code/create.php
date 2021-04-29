<?php

//controla botón crear
if (isset($_POST["crear"])) {

    echo 'Crear ...';
    echo $_POST['password'];
    require "util/db.php";
    
    $pass= password_hash($_POST['password'], PASSWORD_DEFAULT);
    $db = connectDB();
    $sql = "INSERT INTO users 
            (full_name, email, user_name, password) 
            values
            (:fullname, :email, :username, :password)";
    $stmt = $db->prepare($sql); 
    $stmt->bindParam(":fullname",$_POST['fullname']); /*rescata valor de caja de texto*/
    $stmt->bindParam(":email",$_POST['email']); /*rescata valor de caja de texto*/
    $stmt->bindParam(":username",$_POST['username']); /*rescata valor de caja de texto*/
    $stmt->bindParam(":password",$pass); /*rescata valor de caja de texto*/
    $stmt->execute();

    header("location: index.php");
}    
?>

<!doctype html>
<html lang="en" class="h-100">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
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
                    <li class="nav-item active">
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
            <h1>Crear Nuevo Usuario</h1>
            <form action="" method="POST">
                <!--agrega name-->
                <div class="form-group">
                    <label for="name">Nombre Completo</label>
                    <input type="text" class="form-control" id="fullname" name ="fullname" placeholder="Ingrese Nombre Completo">
                    <small class="form-text text-muted"></small>
                </div>
                <!--agrega los otros campos y crea name-->
                <div class="form-group">
                    <label for="name">Nombre de Usuario</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Ingrese Nombre de Usuario">
                    <small class="form-text text-muted"></small>
                </div>
                <div class="form-group">
                    <label for="name">Email</label>
                    <input type="text" class="form-control" id="mail" name="email" placeholder="Ingrese Mail">
                    <small class="form-text text-muted"></small>
                </div>
                <div class="form-group">
                    <label for="name">Clave</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Ingrese Clave">
                    <small class="form-text text-muted"></small>
                </div>

                <!--Renombra botón y agrega name-->
                <button type="submit" class="btn btn-primary" name= "crear">Crear</button>
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