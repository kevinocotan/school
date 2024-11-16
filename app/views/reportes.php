<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include_once "app/views/sections/css.php"; ?>
    <link rel="shortcut icon" href="<?php echo URL; ?>public_html/images/logotransparente.png" type="image/x-icon">
    <title>Reportes - MyControl School</title>
</head>

<body>

    <!-- NO HAY NECESIDAD DE QUE ESTO DE ARRIBA SE REPITA POR CADA ARCHIVO -->

    <div class="main container" id="main">
        <!--Todos los elementos del encabezado-->
        <section id="encabezado">
            <?php include_once "app/views/sections/header.php"; ?>
        </section>
        <!--Opciones de menu-->
        <section id="menu">
            <?php include_once "app/views/sections/menu.php"; ?>
        </section>
        <!-- Todos los elementos que varian-->
        <section id="contenido">
            <!-- listado de usuarios -->


        <section id="contenido">
            <form class="row gy-2 gx-3 align-items-center">
                <div class="col-auto d-flex">
                    <label class="col-form-label" for="autoSizingInput">Autor</label>
                    <select name="id_autor" id="id_autor" class="form-select">

                    </select>
                </div>
                <div class="col-auto d-flex">
                    <label class="col-form-label" for="autoSizingInput">Categoría</label>
                    <select name="id_cate" id="id_cate" class="form-select">

                    </select>
                </div>
                <div class="col-auto">
                    <button type="button" class="btn btn-primary" id="btnViewReport">Ver Reporte</button>
                </div>
            </form>
            <div class="row">
                <iframe src="" frameborder="0" width="100%" height="400" id="framereporte"></iframe>
            </div>
        </section>
    <!--Todos los elementos del pie del sitio-->
        <section id="pie">
            <?php include_once "app/views/sections/footer.php"; ?>
        </section>
    </div>
    <?php include_once "app/views/sections/scripts.php"; ?>
    <script src="<?php echo URL;?>public_html/customjs/reportes.js"></script>
</body>
</html>