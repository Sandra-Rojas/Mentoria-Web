<?php

    require "util/db.php";

    $i=0;


    if (isset($_POST['btnactualiza'])) {

        $id = $_POST['id'];
        $namefull = $_POST['full_name'];
        echo "valor en Actualizar: " . $namefull . " Id: " . $id;

        $db=connectDB();
        $sql ="UPDATE users SET full_name=:var1 Where id=:var0";
        $stmt=$db->prepare($sql);
        $stmt->bindParam(":var1",$namefull);
        //$stmt->bindParam(":var2",$email);
        //$stmt->bindParam(":var3",$nameusu);
        $stmt->bindParam(":var0",$id);
        $stmt->execute();
        
        echo "Datos Actualizados: " . $namefull . " Id: " . $id;
         

    }
    else
    {
        $id= $_GET['var0'] ?? 'Sin Id';;
        $namefull = $_GET['var1'] ?? 'Sin Nombre Completo';
        $email = $_GET['var2'] ?? 'Sin correo';
        $nameusu = $_GET['var3'] ?? 'Sin Nombre Usuario';

        echo "No actualizado: " . $namefull . " Id: " . $id;
        ;
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
                    <input type="text" class="form-control" id="id" name="id" value=<?=$id ?> placeholder="Enter name">
                    <small class="form-text text-muted">Help message here.</small>
                    <input type="text" class="form-control" id="full_name" name="full_name" value=<?=$namefull ?> placeholder="Enter name">
                    <small class="form-text text-muted">Help message here.</small>
                </div>
                <!--Renombra botòn y asigna name------------->
                <button type="submit" class="btn btn-primary" name="btnActualiza">Actualizar</button>
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