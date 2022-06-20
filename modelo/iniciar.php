<?PHP
    include 'conexion.php';

    $preparada = $conexion->prepare("SELECT id FROM restaurantes WHERE correo = :correo AND contrasena = :contrasena");
    $preparada->bindValue(":correo", $_POST["correo"]);
    $preparada->bindValue(":contrasena", $_POST["contrasena"]);
    if(!$preparada->execute()){
        exit();
    }
    if(!$preparada->rowCount()){
        exit();
    }
    echo "0";
    session_start();
    $_SESSION["correo"] = $_POST["correo"];
    $_SESSION["contrasena"] = $_POST["contrasena"];
?>