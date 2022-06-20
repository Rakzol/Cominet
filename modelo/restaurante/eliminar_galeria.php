<?php
    include '../sesion_iniciada.php';
    
    unlink("c:/xampp/htdocs/modelo/restaurante/" . $preparada->fetch(PDO::FETCH_ASSOC)["id"] . "/galeria/" . $_POST["imagen"]);
    echo "0";
?>