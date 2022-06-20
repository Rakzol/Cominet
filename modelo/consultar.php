<?php
    include 'conexion.php';

    if($_POST["categoria"] == "Todas"){
        $preparada = $conexion->prepare("SELECT nombre, categoria, descripcion, precio FROM platillos WHERE id_restaurante = :id ORDER BY nombre");
    }else{
        $preparada = $conexion->prepare("SELECT nombre, categoria, descripcion, precio FROM platillos WHERE id_restaurante = :id AND categoria = :categoria ORDER BY nombre");
        $preparada->bindValue(":categoria", $_POST["categoria"]);
    }
    $preparada->bindValue(":id", $_POST["id"]);
    if(!$preparada->execute()){
        exit();
    }
    echo json_encode($preparada->fetchAll(PDO::FETCH_ASSOC), JSON_UNESCAPED_UNICODE);
?>