<?php
    include '../sesion_iniciada.php';
    
    $id_restaurante = $preparada->fetch(PDO::FETCH_ASSOC)["id"];

    if(!getimagesize($_FILES["imagen"]["tmp_name"])){
        exit();
    }
    if($_FILES["imagen"]["size"] > 52428800){
        exit();
    }

    $preparada = $conexion->prepare("INSERT INTO platillos VALUES (NULL, :id_restaurante, :nombre, :categoria, :descripcion, :precio)");
    foreach($_POST as $llave => $valor){
        $preparada->bindValue(":".$llave, $valor);
    }
    $preparada->bindValue(":id_restaurante", $id_restaurante);
    if(!$preparada->execute()){
        exit();
    }

    move_uploaded_file($_FILES["imagen"]["tmp_name"], "c:/xampp/htdocs/modelo/restaurante/" . $id_restaurante . "/platillos/" . $conexion->lastInsertId());

    echo $conexion->lastInsertId();
?>