<?php
    session_start();
    if(!isset($_SESSION["correo"])){
        header("Location: registrar.php");
    }
    include 'modelo/conexion.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="icono.png" >
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link href="vista/fontawesome/css/all.css" rel="stylesheet">
    <title>Cominet Editar</title>
    <script>
        let restaurante = <?php
            $preparada = $conexion->prepare("SELECT id, nombre, direccion, telefono, descripcion, apertura_lunes, cierre_lunes, apertura_martes, cierre_martes, apertura_miercoles, cierre_miercoles, apertura_jueves, cierre_jueves, apertura_viernes, cierre_viernes, apertura_sabado, cierre_sabado, apertura_domingo, cierre_domingo FROM restaurantes WHERE correo = :correo AND contrasena = :contrasena");
            $preparada->bindValue(":correo", $_SESSION["correo"]);
            $preparada->bindValue(":contrasena", $_SESSION["contrasena"]);
            $preparada->execute();
            $restaurante = $preparada->fetch(PDO::FETCH_ASSOC);
            echo json_encode($restaurante, JSON_UNESCAPED_UNICODE);
        ?>;
        let platillos = <?php
            $preparada = $conexion->prepare("SELECT id, nombre, categoria, descripcion, precio FROM platillos WHERE id_restaurante = :id_restaurante ORDER BY nombre");
            $preparada->bindValue(":id_restaurante", $restaurante["id"]);
            $preparada->execute();
            echo json_encode($preparada->fetchAll(PDO::FETCH_ASSOC), JSON_UNESCAPED_UNICODE);
        ?>;
        let imagenes = <?php
            echo json_encode(array_values(array_diff(scandir("modelo/restaurante/".$restaurante["id"]."/galeria"), array('..', '.'))), JSON_UNESCAPED_UNICODE);
        ?>;
    </script>
    <style>
        *{
            font-family: 'Roboto', sans-serif;
            font-size: 1rem;
        }
        body{
            margin: 0;
        }
        .invisible{
            display: none;
        }
        #progreso{
            position: fixed;
            width: 30vw;
            top: 50vh;
            left: 35vw;
        }

        /* Cabecera */
        #cabecera{
            background: #66bb6a;
            display: grid;
            text-align: center;
            grid-template-columns: repeat(3, 1fr);
        }
        #cabecera > a{
            font-size: 1.25rem;
            display: flex;
            justify-content: center;
            align-items: center;
            column-gap: 1rem;
            color: #000000;
            padding: 1rem;
            text-decoration: none;
            transition: background 1s;
        }
        #cabecera i{
            font-size: 1.25rem;
        }
        #cabecera > a:hover{
            background: #98ee99;
        }
        #cabecera > a:nth-child(1){
            border-right: 1px solid #a5d6a7;
        }
        #cabecera > a:nth-child(2){
            grid-column: 3 / 4;
            border-left: 1px solid #a5d6a7;
        }

        .margen{
            margin: auto;
        }

        #platillos > form{
            display: grid;
            grid-template-columns: auto;
            grid-row-gap: 0.5rem;
        }

        #platillos{
            margin: 1rem;
            display: grid;
            grid-column-gap: 1.5rem;
            grid-row-gap: 1.5rem;
            justify-content: center;
        }

        .visualizacion {
            grid-column-start: 1;
            margin: auto;
        }

        #platillo{
            margin: 1rem;
            display: grid;
            grid-column-gap: 1.5rem;
            grid-row-gap: 0.5rem;
            justify-content: center;
        }

        #platillo > div > input, #platillo > div > textarea{
            display: block;
            margin-top: 0.5rem;
            width: 100%;
        }

        #categorias{
            margin-top: 1rem;
            display: grid;
            grid-template-columns: auto auto;
            justify-content: center;
            grid-gap: 1rem;
        }

        #galeria{
            margin-top: 1rem;
            margin-bottom: 1rem;
            display: grid;
            grid-template-columns: auto;
            justify-content: center;
        }

        #imagenes > div{
            display: grid;
            grid-template-columns: auto;
        }

        #imagenes{
            margin-top: 2rem;
            display: grid;
            justify-content: center;
            grid-gap: 1rem;
        }

        #descarga{
            margin-top: 1rem;
            display: grid;
            grid-template-columns: auto;
            justify-items: center;
        }

        #restaurante{
            margin-top: 1rem;
            display: grid;
            grid-column-gap: 1.5rem;
            grid-row-gap: 0.5rem;
            justify-content: center;
        }

        #restaurante > div > input, #restaurante > div > textarea{
            display: block;
            margin-top: 0.5rem;
            width: 100%;
        }

        #restaurante > div > div{
            margin-top: 0.5rem;
        }

        img {
            object-fit: cover;
        }

        @media only screen and (min-width: 1201px) {
            img {
                width: 290px;
                height: 290px;
            }
            #restaurante{
                grid-template-columns: auto auto auto auto;
            }
            #imagenes{
                grid-template-columns: auto auto auto auto;
            }
            #platillo{
                grid-template-columns: auto auto auto auto;
            }
            .visualizacion{
                grid-column-end: 5;
            }
            #platillos{
                grid-template-columns: auto auto auto auto;
            }
        }

        @media only screen and (max-width: 1200px) {
            img {
                width: 30vw;
                height: 30vw;
            }
            #restaurante{
                grid-template-columns: auto auto auto;
            }
            #imagenes{
                grid-template-columns: auto auto auto;
            }
            #platillo{
                grid-template-columns: auto auto auto;
            }
            .visualizacion{
                grid-column-end: 4;
            }
            #platillos{
                grid-template-columns: auto auto auto;
            }
        }

        @media only screen and (max-width: 900px) {
            img {
                width: 45vw;
                height: 45vw;
            }
            #restaurante{
                grid-template-columns: auto auto;
            }
            #imagenes{
                grid-template-columns: auto auto;
            }
            #platillo{
                grid-template-columns: auto auto;
            }
            .visualizacion{
                grid-column-end: 3;
            }
            #platillos{
                grid-template-columns: auto auto;
            }
        }

        @media only screen and (max-width: 600px) {
            img {
                width: 90vw;
                height: 90vw;
            }
            #restaurante{
                grid-template-columns: auto;
            }
            #imagenes{
                grid-template-columns: auto;
            }
            #platillo{
                grid-template-columns: auto;
            }
            .visualizacion{
                grid-column-end: 2;
            }
            #platillos{
                grid-template-columns: auto;
            }
        }

        /* Pie */
        #pie{
            background: #66bb6a;
            display: grid;
            text-align: center;
            grid-template-columns: repeat(3, 1fr);
        }
        #pie a{
            font-size: 1.25rem;
            padding: 0.25rem;
            color: #000000;
            text-decoration: none;
            transition: background 1s;
        }
        #pie > a{
            display: flex;
            justify-content: center;
            align-items: center;
        }
        #pie > div {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
        }
        #pie i{
            font-size: 1.25rem;
        }
        #pie a:hover{
            background: #98ee99;
        }
        #pie > div:nth-child(1){
            border-right: 1px solid #a5d6a7;
        }
        #pie > a:nth-child(2){
            border-right: 1px solid #a5d6a7;
        }

        h3{
            font-size: 2rem;
            text-align: center;
            margin: 1rem;
        }
    </style>
</head>
<body>

    <div id="cabecera">
        <a href="index.php">Cominet<i class="fa-light fa-burger"></i></a>
        <a href="modelo/cerrar.php"><i class="fa-light fa-arrow-right-from-bracket"></i>Cerrar Sesión</a>
    </div>

    <form id="restaurante" >

        <div>
            <label>Nombre</label>
            <input type="text" name="nombre" required>
        </div>

        <div>
            <label>Dirección</label>
            <input type="text" name="direccion" required>
        </div>

        <div>
            <label>Teléfono</label>
            <input type="tel" name="telefono" required>   
        </div>         

        <div>
            <label>Descripción</label>
            <textarea name="descripcion" required></textarea>
        </div>

        <div>
            <label>Lunes</label>
            <div>
                <input type="time" name="apertura_lunes" required>
                <label>a</label>
                <input type="time" name="cierre_lunes" required>
            </div>
        </div>

        <div>
            <label>Martes</label>
            <div>
                <input type="time" name="apertura_martes" required>
                <label>a</label>
                <input type="time" name="cierre_martes" required>
            </div>
        </div>

        <div>
            <label>Miércoles</label>
            <div>
                <input type="time" name="apertura_miercoles" required>
                <label>a</label>
                <input type="time" name="cierre_miercoles" required>
            </div>
        </div>

        <div>
            <label>Jueves</label>
            <div>
                <input type="time" name="apertura_jueves" required>
                <label>a</label>
                <input type="time" name="cierre_jueves" required>
            </div>
        </div>

        <div>
            <label>Viernes</label>
            <div>
                <input type="time" name="apertura_viernes" required>
                <label>a</label>
                <input type="time" name="cierre_viernes" required>
            </div>
        </div>

        <div>
            <label>Sábado</label>
            <div>
                <input type="time" name="apertura_sabado" required>
                <label>a</label>
                <input type="time" name="cierre_sabado" required>
            </div>
        </div>

        <div>
            <label>Domingo</label>
            <div>
                <input type="time" name="apertura_domingo" required>
                <label>a</label>
                <input type="time" name="cierre_domingo" required>
            </div>
        </div>

        <div>
            <input type="submit" value="Editar">
            <input type="reset" value="Cancelar">
        </div>
    </form>

    <a id="descarga" href="modelo/restaurante/<?php echo $restaurante["id"] ?>/QR.png" download >
        <img src="modelo/restaurante/<?php echo $restaurante["id"] ?>/QR.png">
        Descargar
    </a>

    <h3>Platillos</h3>

    <form id="categorias" >
        <label>Categoria</label>
        <select name="categoria"></select>
    </form>

    <div id="platillos" >
    </div>

    <h3>Registrar</h3>

    <form id="platillo" >
        <div class="visualizacion" >
            <img src="vista/subir.png" >
            <input type="file" name="imagen" required>
        </div>
        <div>
            <label>Nombre</label>
            <input type="text" name="nombre" required>
        </div>
        <div>
            <label>Categoria</label>
            <input type="text" name="categoria" required>
        </div>
        <div>
            <label>Descripción</label>
            <textarea name="descripcion"required></textarea>
        </div>
        <div>
            <label>Precio</label>
            <input type="number" name="precio" step="0.1" required>
        </div>
        <div>
            <input type="submit" value="Guardar">
            <input type="reset" value="Limpiar">
        </div>
    </form>

    <h3>Galería</h3>

    <div id="imagenes" >
    </div>

    <form id="galeria" >
        <input type="file" name="imagen">
    </form>

    <progress id="progreso" max="100" class="invisible" ></progress>

    <div id="pie">
        <div>
            <a href=""><i class="fa-brands fa-facebook"></i></a>
            <a href=""><i class="fa-brands fa-twitter"></i></a>
            <a href=""><i class="fa-brands fa-instagram"></i></a>
            <a href=""><i class="fa-brands fa-whatsapp"></i></a>
        </div>
        <a href="">email @ cominet.com</a>
        <a href="">Terminos y condiciones</a>
    </div>
</body>
    <script src="controlador/progreso.js"></script>
    <script src="controlador/categorias.js"></script>
    <script src="controlador/platillo.js"></script>
    <script src="controlador/platillos.js"></script>
    <script src="controlador/restaurante.js"></script>
    <script src="controlador/galeria.js"></script>
    <script src="controlador/carga.js"></script>
</html>