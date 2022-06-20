<?php
    include '../sesion_iniciada.php';
    $id_restaurante = $preparada->fetch(PDO::FETCH_ASSOC)["id"];
    if($_POST["categoria"] == "Todas"){
        $preparada = $conexion->prepare("SELECT id, nombre, categoria, descripcion, precio FROM platillos WHERE id_restaurante = :id_restaurante ORDER BY nombre");
    }else{
        $preparada = $conexion->prepare("SELECT id, nombre, categoria, descripcion, precio FROM platillos WHERE id_restaurante = :id_restaurante AND categoria = :categoria ORDER BY nombre");
        $preparada->bindValue(":categoria", $_POST["categoria"]);
    }
    $preparada->bindValue(":id_restaurante", $id_restaurante);
    if(!$preparada->execute()){
        exit();
    }
    echo json_encode($preparada->fetchAll(PDO::FETCH_ASSOC), JSON_UNESCAPED_UNICODE);
?>