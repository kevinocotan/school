<!DOCTYPE html>
<html lang="es">

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

            <form class="row gy-2 gx-3 align-items-center mt-3 mb-3">
                <div class="col-auto d-flex">
                    <label class="col-form-label mx-3" for="autoSizingInput">Filtrar</label>
                    <select name="filtro" id="filtro" class="form-select">
                        <option value="1">Por Escuela</option>
                        <option value="2">Por Alumnos</option>
                    </select>
                </div>

                <div class="col-auto d-flex filtroescuelas">
                    <label class="col-form-label mx-3" for="autoSizingInput">Escuelas</label>
                    <select name="id_school" id="id_school" class="form-select">
                    </select>
                </div>

                <div class="col-auto d-flex filtroalumnos d-none">
                    <label class="col-form-label mx-3" for="autoSizingInput">Alumnos</label>
                    <select name="id_alumno" id="id_alumno" class="form-select">
                    </select>
                </div>

                <div class="col-auto">
                    <button type="button" class="btn btn-dark btncolor" id="btnViewReport">Ver Reporte</button>
                </div>
            </form>
            <div class="row">
                <iframe src="" frameborder="0" width="100%" height="650" id="framereporte"></iframe>
            </div>
        </section>
        <!--Todos los elementos del pie del sitio-->
        <section id="pie">
            <?php include_once "app/views/sections/footer.php"; ?>
        </section>
    </div>
    <?php include_once "app/views/sections/scripts.php"; ?>
    <script src="<?php echo URL; ?>public_html/customjs/reportes.js"></script>
</body>

</html>