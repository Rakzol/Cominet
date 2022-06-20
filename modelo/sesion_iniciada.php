<?php
    include 'conexion.php';

    session_start();
    $preparada = $conexion->prepare("SELECT id FROM restaurantes WHERE correo = :correo AND contrasena = :contrasena");
    $preparada->bindValue(":correo", $_SESSION["correo"]);
    $preparada->bindValue(":contrasena", $_SESSION["contrasena"]);
    if(!$preparada->execute()){
        exit();
    }
    if(!$preparada->rowCount()){
        exit();
    }
?>