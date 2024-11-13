<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include_once "app/views/sections/css.php"; ?>
    <link rel="shortcut icon" href="<?php echo URL;?>public_html/images/logotransparente.png" type="image/x-icon">
    <title>Citas - Iveth´s Beauty Salón Spa & Nails</title>
</head>
<body>
    <div class="container">
        <!--Todos los elementos del encabezado-->
        <section id="encabezado">
            <?php include_once "app/views/sections/header_user.php"; ?>
        </section>
        <!--Opciones de menu-->
        <section id="menu">
            <?php include_once "app/views/sections/menu_user.php"; ?>
        </section>
        <!-- Todos los elementos que varian-->
        <section id="contenido">
            <!-- listado de libros -->
            <div id="contentList" class="mt-3">
                <h4>
                <i class="bi bi-calendar-date"></i>
                    Citas
                    <button type="button" class="btn btn-dark btncolor float-end" id="btnAgregar">
                        <i class="bi bi-plus-circle"></i>
                        Agregar Cita
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
                                <th>Código de Cita</th>
                                <th>Fecha</th>
                                <th>Hora</th>
                                <th>Nombres Empleado</th>
                                <th>Apellido Empleado</th>
                                <th>Nombre Cliente</th>
                                <th>Apellido Cliente</th>
                                <th>Asunto</th>
                                <th>&nbsp;</th>
                            </thead>
                            <tbody>
                                <td>1</td>
                                <td>Planchado</td>
                                <td>1989-04-30</td>
                                <td>09:00:00</td>
                                <td>Cristina</td>
                                <td>
                                    <button type="button" class="btn btn-dark btncolor"><i class="bi bi-pencil-square"></i></button>
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
                <!-- Fin de paginacion -->
            </div>
            <!-- Fin del listado de libros -->
            <!--Incio de formulario de libros -->
            <div id="contentForm" class="mt-3 d-none">
                <h4>
                <i class="bi bi-calendar-date"></i>
                    Citas
                </h4>
                <hr>
                <form id="formCita">
                    <div class="row mb-3">
                        <label for="id_empleado" class="col-sm-2 col-form-label">Empleado:</label>
                        <div class="col-sm-10">
                            <select name="id_empleado" id="id_empleado" class="form-select">

                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="id_cliente" class="col-sm-2 col-form-label">Cliente:</label>
                        <div class="col-sm-10">
                            <select name="id_cliente" id="id_cliente" class="form-select">

                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="descripcion" class="col-sm-2 col-form-label">Asunto:</label>
                        <div class="col-sm-10">
                            <textarea name="descripcion" id="descripcion" rows="3" class="form-control"></textarea>
                            <input type="hidden" name="id_cita" id="id_cita" value="0">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="fecha" class="col-sm-2 col-form-label">Fecha:</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control" id="fecha" name="fecha" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="hora" class="col-sm-2 col-form-label">Hora:</label>
                        <div class="col-sm-10">
                            <input type="time" class="form-control" id="hora" name="hora" required>
                        </div>
                    </div>
                    <button type="button" class="btn btn-secondary" id="btnCancelar"><i class="bi bi-x-circle-fill"></i> Cancelar</button>
                    <button type="submit" class="btn btn-primary"><i class="bi bi-hdd"></i> Guardar</button>
                </form>
            </div>
            <!--Fin de formulario de libros -->
        </section>
    <!--Todos los elementos del pie del sitio-->
        <section id="pie">
            <?php include_once "app/views/sections/footer_user.php"; ?>
        </section>
    </div>
    <?php include_once "app/views/sections/scripts_user.php"; ?>
    <script src="<?php echo URL;?>public_html/customjs/citasuser.js"></script>
</body>
</html>