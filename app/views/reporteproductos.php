<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include_once "app/views/sections/css.php"; ?>
    <link rel="shortcut icon" href="<?php echo URL;?>public_html/images/logotransparente.png" type="image/x-icon">
    <title>Reporte de Ingresos - Iveth´s Beauty Salón Spa & Nails</title>
</head>
<body>
    <div class="container">
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
            <form class="row gy-2 gx-3 align-items-center mt-3 mb-3">
                <div class="col-auto d-flex">
                    <label class="col-form-label mx-3" for="autoSizingInput">Filtrar</label>
                    <select name="filtro" id="filtro" class="form-select">
                        <option value="1">Por día</option>
                        <option value="2">Por mes</option>
                    </select>
                </div>
                <div class="col-auto d-flex filtrodia">
                    <label class="col-form-label mx-3" for="autoSizingInput">Fecha</label>
                    <select name="id_ingreso" id="id_ingreso" class="form-select">
                    </select>
                </div>
                <div class="col-auto d-flex filtromes d-none">
                    <label class="col-form-label mx-3" for="autoSizingInput">Mes</label>
                    <select name="mes" id="mes" class="form-select">
                        <option value="1">Enero</option>
                        <option value="2">Febrero</option>
                        <option value="3">Marzo</option>
                        <option value="4">Abril</option>
                        <option value="5">Mayo</option>
                        <option value="6">Junio</option>
                        <option value="7">Julio</option>
                        <option value="8">Agosto</option>
                        <option value="9">Septiembre</option>
                        <option value="10">Octubre</option>
                        <option value="11">Noviembre</option>
                        <option value="12">Diciembre</option>
                    </select>
                </div>
                <div class="col-auto d-flex filtromes d-none">
                    <label class="col-form-label mx-3" for="autoSizingInput">Año</label>
                    <input class="form-control" type="number" name="anio" id="anio">
                </div>
                <div class="col-auto d-flex">
                    <label class="col-form-label mx-3" for="autoSizingInput">Empleado</label>
                    <select name="id_empleado" id="id_empleado" class="form-select">

                    </select>
                </div>
                <div class="col-auto">
                    <button type="button" class="btn btn-dark btncolor" id="btnViewReport">Ver Reporte</button>
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
    <script src="<?php echo URL;?>public_html/customjs/reporteproductos.js"></script>
</body>
</html>