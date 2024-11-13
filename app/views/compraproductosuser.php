<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include_once "app/views/sections/css.php"; ?>
    <link rel="shortcut icon" href="<?php echo URL;?>public_html/images/logotransparente.png" type="image/x-icon">
    <title>Compras de Productos - Iveth´s Beauty Salón Spa & Nails</title>
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
                <i class="bi bi-cart-plus-fill"></i>
                    Compras de Productos
                    <button type="button" class="btn btn-dark float-end btncolor" id="btnAgregar">
                        <i class="bi bi-plus-circle"></i>
                        Agregar Compra de Producto
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
                                <th>Código de Compra</th>
                                <th>Fecha de Compra</th>
                                <th>Producto</th>
                                <th>Proveedor</th>
                                <th>Descripción de Compra</th>
                                <th>Cantidad</th>
                                <th>Precio</th>
                                <th>Total de Compra</th>
                                <th>&nbsp;</th>
                            </thead>
                            <tbody>
                                <td>1</td>
                                <td>Shampoo Argan</td>
                                <td>Argan Inc</td>
                                <td>10</td>
                                <td>5</td>
                                <td>50</td>
                                <td>10-11-2022</td>                          
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
                <i class="bi bi-cart-plus-fill"></i>
                    Compras de Productos
                </h4>
                <hr>
                <form id="formCompraProducto" enctype="multipart/form-data">    
                    <div class="row mb-3">
                        <label for="fecha_compra" class="col-sm-2 col-form-label">Fecha de Compra:</label>
                        <div class="col-sm-10">             
                        <input type="date" class="form-control" id="fecha_compra" name="fecha_compra" required>
                        <input type="hidden" name="id_compra" id="id_compra" value="0">
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
                        <label for="id_proveedor" class="col-sm-2 col-form-label">Proveedor:</label>
                        <div class="col-sm-10">
                            <select class="form-select" aria-label="Default select example" name="id_proveedor" id="id_proveedor">                          
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="descripcion_compra" class="col-sm-2 col-form-label">Descripción de Compra:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="descripcion_compra" id="descripcion_compra" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="cantidad" class="col-sm-2 col-form-label">Cantidad:</label>
                        <div class="col-sm-10">
                            <input type="number" min="0" class="form-control" name="cantidad" id="cantidad" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="precio" class="col-sm-2 col-form-label">Precio:</label>
                        <div class="col-sm-10">
                            <input type="number" step="0.01" min="0" class="form-control" name="precio" id="precio" required>
                        </div>
                    </div>
                    <!-- <div class="row mb-3">
                        <label for="total_compra" class="col-sm-2 col-form-label">Total Compra:</label>
                        <div class="col-sm-10">
                            <input type="number" step="0.01" min="0" class="form-control" name="total_compra" id="total_compra" required>
                        </div>
                    </div> -->                  
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
    <script src="<?php echo URL;?>public_html/customjs/compraproductosuser.js"></script>
</body>
</html>