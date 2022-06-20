<?php
    include '../sesion_iniciada.php';
    
    $id = $preparada->fetch(PDO::FETCH_ASSOC)["id"];
    $preparada = $conexion->prepare("UPDATE restaurantes SET nombre = :nombre, direccion = :direccion, telefono = :telefono, descripcion = :descripcion, apertura_lunes = :apertura_lunes, cierre_lunes = :cierre_lunes, apertura_martes = :apertura_martes, cierre_martes = :cierre_martes, apertura_miercoles = :apertura_miercoles, cierre_miercoles = :cierre_miercoles, apertura_jueves = :apertura_jueves, cierre_jueves = :cierre_jueves, apertura_viernes = :apertura_viernes, cierre_viernes = :cierre_viernes, apertura_sabado = :apertura_sabado, cierre_sabado = :cierre_sabado, apertura_domingo = :apertura_domingo, cierre_domingo = :cierre_domingo WHERE id = :id");
    foreach($_POST as $llave => $valor){
        $preparada->bindValue(":".$llave, $valor);
    }
    $preparada->bindValue(":id", $id);
    if(!$preparada->execute()){
        exit();
    }
    echo "0";
?>