
<?php

    session_start();
    if(!isset($_SESSION['nombre'])) {
        header("Location: index.php");
    }


?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main</title>
</head>    
<body>
    <?= "Hola," . $_SESSION['nombre']; ?>
    <a href="logout.php">(Salir)</a>
</body>
</html>