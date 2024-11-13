<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include_once "app/views/sections/css.php"; ?>
    <link rel="shortcut icon" href="<?php echo URL;?>public_html/images/logotransparente.png" type="image/x-icon">
    <title>Ingresos - Iveth´s Beauty Salón Spa & Nails</title>
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
            <!-- listado de Ingreso -->
            <div id="contentList" class="mt-3">
                <h4>
                    <i class="bi bi-cash"></i>
                    Ingresos
                    <button type="button" class="btn btn-dark float-end btncolor" id="btnAgregar">
                        <i class="bi bi-plus-circle"></i>
                        Agregar Ingreso
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
                                <th>Código de Ingreso</th>
                                <th>Fecha</th>
                                <th>Método de Pago</th>
                                <th>Empleado</th>
                                <th>Nombres Cliente</th>
                                <th>Apellidos Cliente</th>
                                <th>Servicio</th>
                                <th>Precio de Servicio</th>
                                <th>Producto</th>
                                <th>Cantidad del Producto</th>                        
                                <th>Precio de Producto</th>
                                <th>Subtotal del Producto</th>
                                <th>Comentario</th>
                                <th>&nbsp;</th>
                            </thead>
                            <tbody>
                                <td>1</td>
                                <td>25-09-1980</td>
                                <td>Efectivo</td>
                                <td>Sonia</td>
                                <td>Kevin Ernesto</td>
                                <td>Ocotán Polanco</td>
                                <td>Corte de Cabello</td>
                                <td>3</td>
                                <td>Crema Hidratante</td> 
                                <td>Comentario</td> 
                                <td>7.5</td>                          
                                <td>10</td>
                                <td>40</td>
                                <td>
                                    <button type="button" class="btn btn-dark btncolor"><i class="bi bi-pencil-square"></i></button>
                                    <button type="button" class="btn btn-danger"><i class="bi bi-trash"></i></button>
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
            <!-- Fin del listado de Ingresos -->
            <!--Incio de formulario de Ingresos -->
            <div id="contentForm" class="mt-3 d-none">
                <h4>
                <i class="bi bi-cash"></i>
                    Ingresos
                </h4>
                <hr>
                <form id="formIngresos" enctype="multipart/form-data">
                    <div class="row mb-3">
                        <label for="fecha" class="col-sm-2 col-form-label">Fecha:</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control" id="fecha" name="fecha" required>
                            <input type="hidden" name="id_ingreso" id="id_ingreso" value="0">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Método de Pago:</label>
                        <div class="col-sm-10">
                            <select class="form-select" aria-label="Default select example" name="metodopago" id="metodopago">
                                <option value="Efectivo">Efectivo</option>
                                <option value="Transacción">Transacción</option>
                                <option value="Tarjeta de Credito">Tarjeta de Credito</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="id_servicio" class="col-sm-2 col-form-label">Servicio:</label>
                        <div class="col-sm-10">
                            <select class="form-select" aria-label="Default select example" name="id_servicio" id="id_servicio">                          
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="id_producto" class="col-sm-2 col-form-label">Producto:</label>
                        <div class="col-sm-10">
                            <select class="form-select" aria-label="Default select example" name="id_producto" id="id_producto">                          
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="cantidad_producto" class="col-sm-2 col-form-label">Cantidad del Producto:</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="cantidad_producto" name="cantidad_producto" min="0" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="comentario" class="col-sm-2 col-form-label">Comentario:</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" rows="3" id="comentario" name="comentario"></textarea>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="id_empleado" class="col-sm-2 col-form-label">Empleado:</label>
                        <div class="col-sm-10">
                            <select class="form-select" aria-label="Default select example" name="id_empleado" id="id_empleado">                          
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="id_cliente" class="col-sm-2 col-form-label">Cliente:</label>
                        <div class="col-sm-10">
                            <select class="form-select" aria-label="Default select example" name="id_cliente" id="id_cliente">                          
                            </select>
                        </div>
                    </div>
                    <button type="button" class="btn btn-secondary" id="btnCancelar"><i class="bi bi-x-circle-fill"></i> Cancelar</button>
                    <button type="submit" class="btn btn-primary"><i class="bi bi-hdd"></i> Guardar</button>
                </form>
            </div>
            <!--Fin de formulario de Ingresos -->
        </section>
    <!--Todos los elementos del pie del sitio-->
        <section id="pie">
            <?php include_once "app/views/sections/footer_user.php"; ?>
        </section>
    </div>
    <?php include_once "app/views/sections/scripts_user.php"; ?>
    <script src="<?php echo URL;?>public_html/customjs/ingresosuser.js"></script>
</body>
</html>