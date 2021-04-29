<?php

    //echo 'borrar ...';
    require "util/db.php";
    $db = connectDB();
    $sql = "DELETE FROM users 
            WHERE id= :id ";
    $stmt = $db->prepare($sql); 
    $stmt->bindParam(":id",$_GET['id']);
    $stmt->execute();

    //echo '<script>alert("ELIMINADO")</script> ';
    //Implementa mensajes con variable de session
    session_start();
    $_SESSION["msg-delete"] = "Registro eliminado correctamente";
    header("location: index.php");

?>
