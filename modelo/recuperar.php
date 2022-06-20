<?PHP
    include 'conexion.php';

    $preparada = $conexion->prepare("SELECT contrasena FROM restaurantes WHERE correo = :correo");
    $preparada->bindValue(":correo", $_POST["correo"]);
    if(!$preparada->execute()){
        exit();
    }
    if(!$preparada->rowCount()){
        exit();
    }
    echo "0";
    //mail($_POST["correo"],"Cominet recuperación de cuenta","Tu contraseña es: " . $preparada->fetch(PDO::FETCH_ASSOC)["contrasena"]);
?>