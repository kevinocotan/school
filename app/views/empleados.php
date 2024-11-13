<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include_once "app/views/sections/css.php"; ?>
    <link rel="shortcut icon" href="<?php echo URL;?>public_html/images/logotransparente.png" type="image/x-icon">
    <title>Empleados - Iveth´s Beauty Salón Spa & Nails</title>
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
            <!-- listado de Empleados -->
            <div id="contentList" class="mt-3">
                <h4>
                    <i class="bi bi-people-fill"></i>
                    Empleados
                    <button type="button" class="btn btn-dark btncolor float-end" id="btnAgregar">
                        <i class="bi bi-plus-circle"></i>
                        Agregar Empleado
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
                                <th>Código de Empleado</th>
                                <th>Nombres</th>
                                <th>Apellidos</th>
                                <th>Teléfono</th>
                                <th>Dirección</th>
                                <th>DUI</th>
                                <th>Sueldo</th>
                                <th>Nacimiento</th>
                                <th>Correo</th>
                                <th>Cargo</th>
                                <th>Usuario</th>
                                <th>&nbsp;</th>
                            </thead>
                            <tbody>
                                <td>1</td>
                                <td>Joaquín</td>
                                <td>Polanco</td>
                                <td>7471 2660</td>
                                <td>Santa Ana</td>
                                <td>1245638-9</td>
                                <td>$250</td>
                                <td>12/09/1990</td>
                                <td>joaquin@gmail.com</td>
                                <td>Empleado</td>
                                <td>empleado</td>
                                <td>
                                    <button type="button" class="btn btn-dark btncolor"><i class="bi bi-pencil-square"></i></button>
                                    <button type="button" class="btn btn-danger btncolor"><i class="bi bi-trash"></i></button>
                                </td>
                            </tbody>
                        </table>
                    </div>
                <!-- Fin de la tabla empleados-->
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
            <!-- Fin del listado de empleados -->
            <!--Incio de formulario de empleados -->
            <div id="contentForm" class="mt-3 d-none">
                <h4>
                    <i class="bi bi-people-fill"></i>
                    Empleados
                </h4>
                <hr>
                <form id="formEmpleado" enctype="multipart/form-data">
                    <div class="row mb-3">
                        <label for="nombres" class="col-sm-2 col-form-label">Nombres:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nombres" name="nombres" required>
                            <input type="hidden" name="id_empleado" id="id_empleado" value="0">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="apellidos" class="col-sm-2 col-form-label">Apellidos:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="apellidos" name="apellidos" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="telefono" class="col-sm-2 col-form-label">Teléfono:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="telefono" name="telefono" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="direccion" class="col-sm-2 col-form-label">Dirección:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="direccion" name="direccion" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="dui" class="col-sm-2 col-form-label">DUI:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="dui" name="dui" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="sueldo" class="col-sm-2 col-form-label">Sueldo:</label>
                        <div class="col-sm-10">
                            <input type="number" step="0.01" min="0" class="form-control" name="sueldo" id="sueldo" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="fecha_nacimiento" class="col-sm-2 col-form-label">Fecha de Nacimiento:</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="correo" class="col-sm-2 col-form-label">Correo:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="correo" name="correo" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="cargo" class="col-sm-2 col-form-label">Cargo:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="cargo" name="cargo" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="id_usuario" class="col-sm-2 col-form-label">Usuario:</label>
                        <div class="col-sm-10">
                            <select class="form-select" aria-label="Default select example" name="id_usr" id="id_usr">
                                
                            </select>
                        </div>
                    </div>
                    
                    <button type="button" class="btn btn-secondary" id="btnCancelar"><i class="bi bi-x-circle-fill"></i> Cancelar</button>
                    <button type="submit" class="btn btn-primary"><i class="bi bi-hdd"></i> Guardar</button>
                </form>
            </div>
            <!--Fin de formulario de empleados -->
        </section>
    <!--Todos los elementos del pie del sitio-->
        <section id="pie">
            <?php include_once "app/views/sections/footer.php"; ?>
        </section>
    </div>
    <?php include_once "app/views/sections/scripts.php"; ?>
    <script src="<?php echo URL;?>public_html/customjs/empleados.js"></script>
</body>
</html>