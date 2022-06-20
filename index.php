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
    <title>Cominet</title>
    <style>
        *{
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
        }
        body{
            background: #000000;
        }

        /* Cabecera */
        #cabecera{
            background: #66bb6a;
            display: grid;
            text-align: center;
            grid-template-columns: repeat(3, 1fr);

            position: fixed;
            width: 100%;
            top: 0;
            left: 0;
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

        /* Pie */
        #pie{
            background: #66bb6a;
            display: grid;
            text-align: center;
            grid-template-columns: repeat(3, 1fr);

            position: fixed;
            width: 100%;
            bottom: 0;
            left: 0;
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

        video{
            position: absolute;
            z-index: -1;
            opacity: 0.7;
            width: 100%;
            height: 100vh;
            object-fit: cover;
        }

        h1{
            color: #ffffff;
            font-size: 4rem;
        }

        p{
            color: #ffffff;
            font-size: 2rem;
            padding: 1rem;
        }

        #contenedor{
            height: 100vh;
            width: 100%;
            display: flex;
            flex-wrap: wrap;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
        }
    </style>
</head>
<body>
    <div id="cabecera">
        <a href="index.php">Cominet<i class="fa-light fa-burger"></i></a>
        <a href="registrar.php"><i class="fa-light fa-store"></i>Registrar Menú</a>
    </div>

    <div id="contenedor" >
        <video muted autoplay loop>
            <source src="fondo.mp4" type="video/mp4">
        </video>

        <h1>COMINET</h1>
        <p>Mejora tu negocio con las nuevas tendencias tecnologias</p>
    </div>

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
</html>