<?php

    require "util/db.php";
    $db=connectDB();
    $sql = "SELECT * FROM users";

    //Statement, conectarse a BD con PDO
    $stmt = $db->prepare($sql); 
    $stmt->execute(); 
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    session_start();
    If(isset($_SESSION["msg-delete"])){
        $msg = $_SESSION["msg-delete"];
        //limpia variable de session
        unset($_SESSION["msg-delete"]);
        // también limpia variable de sesion
        //$_SESSION["msg-delete"]="";
    }
    session_start();
    If(isset($_SESSION["msg-create"])){
        $msg = $_SESSION["msg-create"];
        unset($_SESSION["msg-create"]);
    }

    session_start();
    If(isset($_SESSION["msg-update"])){
        $msg = $_SESSION["msg-update"];
        unset($_SESSION["msg-update"]);
    }

?>

<!doctype html>
<html lang="en" class="h-100">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <!--meta charset="utf8mb4_unicode_ci"-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="shortcut icon" href="assets/img/favicon.ico" type="image/x-icon">

    <title>Lista de Usuario</title>

    <style>
		.msg-form{
			margin:1em;
			color: red
		}
    </style>
  </head>
 
  <body class="d-flex flex-column h-100">
    
    <!-- Implementa mensaje para delete, create, update-->
    <?php if (isset($msg)): ?>
        <p class="msg-form"><?= $msg ?></p>
    <?php endif; ?>
    <!-------------->

    <div class="container pt-4 pb-4">
        <nav class="navbar navbar-expand-lg navbar-light bg-light rounded">
            <a class="navbar-brand" href="#">HTML CRUD Template</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample09" aria-controls="navbarsExample09" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
    
            <div class="collapse navbar-collapse" id="navbarsExample09">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
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
            <h1>Lista de Usuario</h1>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Id</th>
                    <th scope="col">Nombre Completo</th>
                    <th scope="col">Correo</th>
                    <th scope="col">Nombre de Usuario</th>
                    </tr>
                </thead>
                <tbody>
                  <!---comentario-->
                    <?php foreach ($users as $key => $user): ?>
                         <!--?php $i=$i+1; ?-->
                         <tr>
                            <th scope="row"><?= $key = $key + 1  ?> </th>
                            <td><?=  $user['id'] ?> </td>
                            <td><?=  $user['full_name'] ?? 'Sin Nombre Completo' ?> </td>
                            <td><?=  $user['email'] ?? 'Sin Correo' ?></td>
                            <td><?=  $user['user_name'] ?? 'Sin nombre de usuario' ?></td>
                            
                            <td>
                                <!--a href="view.php"><button class="btn btn-primary btn-sm">View</button></a>-->
                                <a href="view.php?id=<?= $user['id'] ?>"><button class="btn btn-primary btn-sm">Ver</button></a>
                                <a href="edit.php?id=<?= $user['id'] ?>"><button class="btn btn-outline-primary btn-sm">Editar</button></a>
                                
                                <!--button class="btn btn-sm">Delete</button-->
                                <!-- Implementa estilo a link delete-->
                                <a href="delete.php?id=<?= $user['id'] ?>" class="btn btn-outline-primary btn-sm" >Borrar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>    
                </tbody>
            </table>
        </div>
        <div class="container">
        <!--Implementa subir archivo-->
        <form action="up.php" method="post" enctype="multipart/form-data">
                <input type="file" name ="imagen" >
                <input type="submit" value ="Enviar" >
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