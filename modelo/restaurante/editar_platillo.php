<?php
    include '../sesion_iniciada.php';
    
    $id_restaurante = $preparada->fetch(PDO::FETCH_ASSOC)["id"];

    //Si existe un archivo enviado con el input name imagen
    if($_FILES["imagen"]["size"]){
        //Si no es una imagen
        if(!getimagesize($_FILES["imagen"]["tmp_name"])){
            exit();
        }
        //Si es mayor a 50MB
        if($_FILES["imagen"]["size"] > 52428800){
            exit();
        }
        //Eliminamos la imagen anterior
        $ubicacion = "c:/xampp/htdocs/modelo/restaurante/" . $id_restaurante . "/platillos/" . $_POST["id"];
        unlink($ubicacion);
        //Si no se puedo guardar la imagen
        if(!move_uploaded_file($_FILES["imagen"]["tmp_name"], $ubicacion)){
            exit();
        }
    }

    $preparada = $conexion->prepare("UPDATE platillos SET nombre = :nombre, categoria = :categoria, descripcion = :descripcion, precio = :precio WHERE id = :id AND id_restaurante = :id_restaurante");
    foreach($_POST as $llave => $valor){
        $preparada->bindValue(":".$llave, $valor);
    }
    $preparada->bindValue(":id_restaurante", $id_restaurante);
    if(!$preparada->execute()){
        exit();
    }
    echo "0";
?>