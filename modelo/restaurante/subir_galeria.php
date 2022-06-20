<?php
    include '../sesion_iniciada.php';
    
    if(!getimagesize($_FILES["imagen"]["tmp_name"])){
        exit();
    }
    if($_FILES["imagen"]["size"] > 52428800){
        exit();
    }
    $extension = pathinfo(basename($_FILES["imagen"]["name"]),PATHINFO_EXTENSION);
    $nombre = basename($_FILES["imagen"]["name"],".".$extension);
    $ruta = "c:/xampp/htdocs/modelo/restaurante/" . $preparada->fetch(PDO::FETCH_ASSOC)["id"] . "/galeria/";
    $ubicacion = $ruta . basename($_FILES["imagen"]["name"]);
    $num = 0;
    while(file_exists($ubicacion)){
        $ubicacion = $ruta . $nombre . "_" . $num . "." . $extension;
        $num++;
    }
    if(!move_uploaded_file($_FILES["imagen"]["tmp_name"], $ubicacion)){
        exit();
    }
    echo basename($ubicacion);
?>