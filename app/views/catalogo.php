<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include_once "app/views/sections/css.php"; ?>
    <link rel="shortcut icon" href="<?php echo URL;?>public_html/images/logotransparente.png" type="image/x-icon">
    <title>Iveth´s Beauty Salón Spa & Nails</title>
    <style>
        .container {
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Todos los elementos del encabezado -->
        <section id="encabezado">
            <?php include_once "app/views/sections/headercliente.php"; ?>
        </section>
        <!-- Opciones de menu -->
        <section id="menu">
            <?php include_once "app/views/sections/menucliente.php"; ?>
        </section>
        <!-- Todos los elementos que varian -->
        <section id="contenido">
            <div class="container" id="contenedor">
            </div>
        </section>
        <!-- Todos los elementos del pie del sitio -->
        <section id="pie">
            <?php include_once "app/views/sections/footercliente.php"; ?>
        </section>
    </div>
    <?php include_once "app/views/sections/scriptscliente.php"; ?>
    <script type="text/javascript">
        const ID=<?php echo $_GET["id"];?>;
    </script>
    <script src="<?php echo URL;?>public_html/customjs/catalogo.js"></script>
</body>
</html>
