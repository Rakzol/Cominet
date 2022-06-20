<?php
    include '../sesion_iniciada.php';

    $id_restaurante = $preparada->fetch(PDO::FETCH_ASSOC)["id"];
    $preparada = $conexion->prepare("DELETE FROM platillos WHERE id = :id AND id_restaurante = :id_restaurante");
    $preparada->bindValue(":id", $_POST["id"]);
    $preparada->bindValue(":id_restaurante", $id_restaurante);
    if(!$preparada->execute()){
        exit();
    }
    unlink("c:/xampp/htdocs/modelo/restaurante/" . $id_restaurante . "/platillos/" . $_POST["id"]);
    echo "0";
?>