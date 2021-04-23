<?php

//echo "Esta es la pagina principal del sistema y deberia estar protegida";

session_start();
if(!isset($_SESSION['nombre'])) {
    header("Location: index.php");
}

echo "Hola," . $_SESSION['nombre'];