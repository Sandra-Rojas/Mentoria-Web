<<?php


$target_dir = "uploads/";
//imagen es el nombre de archivo a subir
$target_file = $target_dir . basename($_FILES["imagen"]["name"]);

//mueve el arhivo desde la direccion temporal del servidor a carpeta uploads
//tmp_name tiene la direccion temporal de archivo servidor
print_r($_FILES["imagen"]);
if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $target_file)) {
    echo "The file  has been uploaded.";
  } else {
    echo "Sorry, there was an error uploading your file.";
  }

?>