<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include_once "app/views/sections/css.php"; ?>
    <link rel="shortcut icon" href="<?php echo URL; ?>public_html/images/logotransparente.png" type="image/x-icon">
    <title>Escuelas - MyControl School</title>

</head>

<body>

    <style>
        #map {
            height: 600px;
            width: 100%;
        }
    </style>

    <div class="main container" id="main">
        <!--Todos los elementos del encabezado-->
        <section id="encabezado">
            <?php include_once "app/views/sections/header.php"; ?>
        </section>
        <!--Opciones de menu-->
        <section id="menu">
            <?php include_once "app/views/sections/menu_user.php"; ?>
        </section>
        <!-- Todos los elementos que varian-->
        <section id="contenido">


            <!DOCTYPE html>
            <html lang="es">

            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Información del Alumno</title>
                <!-- Puedes agregar aquí tu enlace a Bootstrap, FontAwesome, o cualquier otro framework -->
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> <!-- SweetAlert para alertas -->
                <script src="app.js"></script> <!-- Asegúrate de que este archivo se incluya al final -->
            </head>

            <body>
                <div>
                    <h4 >Bienvenido/a: <?php echo $_SESSION["nuser"]; ?> </h4>
                </div>
            </body>

            </html>

</body>

</html>