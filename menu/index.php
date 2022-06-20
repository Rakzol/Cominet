<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link href="../vista/fontawesome/css/all.css" rel="stylesheet">
    <link rel="icon" href="../icono.png" >
    <title>
        <?php
            include '../modelo/conexion.php';
            $preparada = $conexion->prepare("SELECT nombre, direccion, telefono, descripcion, apertura_lunes, cierre_lunes, apertura_martes, cierre_martes, apertura_miercoles, cierre_miercoles, apertura_jueves, cierre_jueves, apertura_viernes, cierre_viernes, apertura_sabado, cierre_sabado, apertura_domingo, cierre_domingo FROM restaurantes WHERE id = :id");
            $preparada->bindValue(":id", $_GET["id"]);
            $preparada->execute();
            $restaurante = $preparada->fetch(PDO::FETCH_ASSOC);
            echo $restaurante["nombre"];
        ?>
    </title>
    <style>
        *{
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
        }

        .invisible{
            display: none;
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

        /* Titulo */
        .titulo{
            text-align: center;
            font-size: 2rem;
            margin: 0.5rem 2rem 0.5rem 2rem;
        }

        /* Categoria */
        #categoria{
            text-align: center;
            margin: 0.5rem 2rem 0.5rem 2rem;
        }
        #categoria > p{
            display: inline;
            font-size: 1.25rem;
        }
        select{
            font-size: 1.25rem;
        }

        /* Galeria */
        .galeria{
            margin: 0.5rem 2rem 0.5rem 2rem;
            display: grid;
            gap: 0.5rem;
            grid-template-columns: repeat(auto-fill, minmax(min(100%, 15rem), 1fr));    
        }
        .item > .contenedor > img {
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
        }
        .contenedor {
            position: relative;
            width: 100%;
        }
        .contenedor:after {
            content: "";
            display: block;
            padding-bottom: 100%;
        }
        .item > *{
            margin-bottom: 0.5rem;
        }
        .item > h3{  
            font-size: 1.25rem;
        }
        .item > p{  
            font-size: 1rem;
        }
        .dinero{  
            color: #66bb6a;
        }
        .dinero::before{  
            content: "$ ";
        }

        /* Horario */
        #horario{
            display: grid;
            gap: 0.5rem;
            grid-template-columns: repeat(auto-fit, minmax(min(100%, 5rem), 1fr));
            text-align: center;
            margin: 0.5rem 2rem 0.5rem 2rem;
        }
        #horario p{
            font-size: 1rem;
        }

        /* Direccion telefono */
        .datos{
            text-align: center;
            font-size: 1rem;
            margin: 1.5rem 2rem 1.5rem 2rem;
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
    </style>
</head>
<body>
    <div id="cabecera">
        <a href="../index.php">Cominet<i class="fa-light fa-burger"></i></a>
        <a href="../registrar.php"><i class="fa-light fa-store"></i>Registrar Menú</a>
    </div>

    <h1 class="titulo" >
        <?php
            echo $restaurante["nombre"];
        ?>
    </h1>

    <div id="categoria" >
        <p>Categoría</p>
        <select name="categoria">
            <?php
                $preparada = $conexion->prepare("SELECT categoria FROM platillos WHERE id_restaurante = :id GROUP BY categoria ORDER BY categoria");
                $preparada->bindValue(":id", $_GET["id"]);
                $preparada->execute();
                $categorias = $preparada->fetchAll(PDO::FETCH_ASSOC);
                echo '<option value="Todas">Todas</option>';
                foreach($categorias as $categoria){
                    echo '<option value="'. $categoria["categoria"] .'">' . $categoria["categoria"] . '</option>';
                }
            ?>
        </select>
    </div>

    <div class="galeria" >
        <?php
            $preparada = $conexion->prepare("SELECT id, nombre, categoria, descripcion, precio FROM platillos WHERE id_restaurante = :id ORDER BY nombre");
            $preparada->bindValue(":id", $_GET["id"]);
            $preparada->execute();
            $platillos = $preparada->fetchAll(PDO::FETCH_ASSOC);
            foreach($platillos as $platillo){
                echo '<div data-categoria="'.$platillo["categoria"].'" class="item" ><div class="contenedor" ><img src="../modelo/restaurante/'.$_GET["id"].'/platillos/'.$platillo["id"].'"></div><h3>'.$platillo["nombre"].'</h3><p class="dinero" >'.$platillo["precio"].'</p><p>'.$platillo["descripcion"].'</p></div>';
            }
        ?>
        <!-- <div class="item" >
            <div class="contenedor" >
                <img src="">
            </div>
            <h3>Ay papus que ricolino Xddd</h3>
            <p class="dinero" >6969</p>
            <p>Descripcion de algo muy sabroso la verdad owo</p>
        </div> -->
    </div>

    <h1 class="titulo" >Galería</h1>

    <div class="galeria" >
        <?php
            $galeria = array_diff(scandir("../modelo/restaurante/".$_GET["id"]."/galeria"), array('..', '.'));
            foreach($galeria as $imagen){
                echo '<div class="item" ><div class="contenedor" ><img src="../modelo/restaurante/'.$_GET["id"].'/galeria/'.$imagen.'"></div></div>';
            }
        ?>
        <!-- <div class="item" >
            <div class="contenedor" >
                <img src="">
            </div>
        </div> -->
    </div>

    <h1 class="titulo" >Información</h1>

    <div id="horario" >
        <div>
            <p>Lunes</p>
            <p><?php echo date("h:i a", strtotime($restaurante["apertura_lunes"])); ?></p>
            <p><?php echo date("h:i a", strtotime($restaurante["cierre_lunes"])); ?></p>
        </div>
        <div>
            <p>Martes</p>
            <p><?php echo date("h:i a", strtotime($restaurante["apertura_martes"])); ?></p>
            <p><?php echo date("h:i a", strtotime($restaurante["cierre_martes"])); ?></p>
        </div>
        <div>
            <p>Miercoles</p>
            <p><?php echo date("h:i a", strtotime($restaurante["apertura_miercoles"])); ?></p>
            <p><?php echo date("h:i a", strtotime($restaurante["cierre_miercoles"])); ?></p>
        </div>
        <div>
            <p>Jueves</p>
            <p><?php echo date("h:i a", strtotime($restaurante["apertura_jueves"])); ?></p>
            <p><?php echo date("h:i a", strtotime($restaurante["cierre_jueves"])); ?></p>
        </div>
        <div>
            <p>Viernes</p>
            <p><?php echo date("h:i a", strtotime($restaurante["apertura_viernes"])); ?></p>
            <p><?php echo date("h:i a", strtotime($restaurante["cierre_viernes"])); ?></p>
        </div>
        <div>
            <p>Sabado</p>
            <p><?php echo date("h:i a", strtotime($restaurante["apertura_sabado"])); ?></p>
            <p><?php echo date("h:i a", strtotime($restaurante["cierre_sabado"])); ?></p>
        </div>
        <div>
            <p>Domingo</p>
            <p><?php echo date("h:i a", strtotime($restaurante["apertura_domingo"])); ?></p>
            <p><?php echo date("h:i a", strtotime($restaurante["cierre_domingo"])); ?></p>
        </div>
    </div>

    <p class="datos"><?php echo $restaurante["direccion"]; ?></p>

    <p class="datos"><?php echo $restaurante["telefono"]; ?></p>

    <!-- <h1 class="titulo" >Descripcion</h1> -->

    <p class="datos" ><?php echo $restaurante["descripcion"]; ?></p>

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
    <script>
        let selector = document.getElementsByName("categoria")[0];

        window.addEventListener("load",()=>{
            selector.addEventListener("change",()=>{
                if(selector.value == "Todas"){
                    document.querySelectorAll("[data-categoria]").forEach((elemento)=>{
                        elemento.classList.remove("invisible");
                    });
                }else{
                    document.querySelectorAll("[data-categoria]:not([data-categoria='"+selector.value+"'])").forEach((elemento)=>{
                        elemento.classList.add("invisible");
                    });
                    document.querySelectorAll("[data-categoria='"+selector.value+"']").forEach((elemento)=>{
                        elemento.classList.remove("invisible");
                    });
                }
            });
        });
    </script>
</html>