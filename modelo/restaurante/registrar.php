<?PHP
    include '../conexion.php';

    $preparada = $conexion->prepare("SELECT id FROM restaurantes WHERE correo = :correo");
    $preparada->bindValue(":correo", $_POST["correo"]);
    if(!$preparada->execute()){
        exit();
    }
    if($preparada->rowCount()){
        exit();
    }

    $preparada = $conexion->prepare("INSERT INTO restaurantes VALUES (NULL, :nombre, :direccion, :telefono, :descripcion, :correo, :contrasena, '08:00', '20:00', '08:00', '20:00', '08:00', '20:00', '08:00', '20:00', '08:00', '20:00', '08:00', '20:00', '08:00', '20:00')");
    foreach($_POST as $llave => $valor){
        $preparada->bindValue(":".$llave, $valor);
    }
    if(!$preparada->execute()){
        exit();
    }
    echo "0";
    session_start();
    $_SESSION["correo"] = $_POST["correo"];
    $_SESSION["contrasena"] = $_POST["contrasena"];
    mkdir($conexion->lastInsertId());
    mkdir($conexion->lastInsertId()."/galeria");
    mkdir($conexion->lastInsertId()."/platillos");

    include('../qr/qrlib.php');
    QRcode::png("127.0.0.1/".$conexion->lastInsertId(),$conexion->lastInsertId()."/QR.png", QR_ECLEVEL_L, 20, 4); 
?>