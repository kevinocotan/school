<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include_once "app/views/sections/css.php"; ?>
    <link rel="shortcut icon" href="<?php echo URL;?>public_html/images/logotransparente.png" type="image/x-icon">
    <title>Servicios - MyControl School</title>
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
            <!-- listado de usuarios -->
            <div id="contentList" class="mt-3">
                <h4>
                    <i class="bi bi-scissors"></i>
                    Servicios
                    <button type="button" class="btn btn-dark btncolor float-end" id="btnAgregar">
                        <i class="bi bi-plus-circle"></i>
                        Agregar Servicio
                    </button>
                </h4>
                <hr>
                <!-- Cuadro de busqueda -->
                <div class="row">
                    <div class="col-md-4">
                        <div class="input-group mb-3">
                            <input type="search" class="form-control"  aria-describedby="basic-addon2" id="txtSearch">
                            <span class="input-group-text" id="basic-addon2"><i class="bi bi-search"></i></span>
                        </div>
                    </div>
                </div>
                <!-- Fin de cuadro de busqueda -->
                <!-- Inicio de la tabla-->
                    <div id="contentTable">
                        <table class="table">
                            <thead class="table-dark">
                                <th>Código de Servicio</th>
                                <th>Descripción</th>
                                <th>Precio</th>
                                <th>&nbsp;</th>
                            </thead>
                            <tbody>
                                <td>1</td>
                                <td>Tinte de cabello rojo</td>
                                <th>50</th>
                                <td>
                                    <button type="button" class="bbtn btn-dark btncolor"><i class="bi bi-pencil-square"></i></button>
                                    <button type="button" class="btn btn-danger btncolor"><i class="bi bi-trash"></i></button>
                                </td>
                            </tbody>
                        </table>
                    </div>
                <!-- Fin de la tabla -->
                <!--Paginacion -->
                <div class="row">
                    <nav aria-label="Page navigation example" class="d-flex justify-content-center">
                        <ul class="pagination">
                            <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">Next</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
            <!-- Fin de paginacion -->
            <!--Incio de formulario de usuarios -->
            <div id="contentForm" class="mt-3 d-none">
                <h4>
                <i class="bi bi-scissors"></i>
                    Servicios
                </h4>
                <hr>
                <form id="formServicio" enctype="multipart/form-data">
                    <div class="row mb-3">
                        <label for="descripcion" class="col-sm-2 col-form-label">Descripción: </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="descripcion" name="descripcion" required>
                            <input type="hidden" name="id_servicio" id="id_servicio" value="0">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="precios" class="col-sm-2 col-form-label">Precio: </label>
                        <div class="col-sm-10">
                            <input type="number" step="0.01" min="0" class="form-control" id="precios" name="precios" required>
                        </div>
                    </div>
                    <button type="button" class="btn btn-secondary" id="btnCancelar"><i class="bi bi-x-circle-fill"></i> Cancelar</button>
                    <button type="submit" class="btn btn-primary"><i class="bi bi-hdd"></i> Guardar</button>
                </form>
            </div>
            <!--Fin de formulario de usuarios -->
        </section>
    <!--Todos los elementos del pie del sitio-->
        <section id="pie">
            <?php include_once "app/views/sections/footer.php"; ?>
        </section>
    </div>
    <?php include_once "app/views/sections/scripts.php"; ?>
    <script src="<?php echo URL;?>public_html/customjs/servicios.js"></script>
</body>
</html>