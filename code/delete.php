<?php

    echo 'borrar ...';
    require "util/db.php";
    $db = connectDB();
    $sql = "DELETE FROM users 
            WHERE id= :id ";
    $stmt = $db->prepare($sql); 
    $stmt->bindParam(":id",$_GET['id']);
    $stmt->execute();

    //echo '<script>alert("ELIMINADO")</script> ';
    header("location: index.php");

?>
