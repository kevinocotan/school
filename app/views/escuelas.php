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
            <div id="contentList" class="mt-3">
                <h4>
                    <i class="ri-school-fill"></i>
                    Escuelas
                    <button type="button" class="btn btn-dark btncolor float-end" id="btnAgregar">
                        <i class="ri-add-large-fill"></i>
                        Agregar Escuela
                    </button>
                </h4>
                <hr>
                <!-- Cuadro de busqueda -->
                <div class="row">
                    <div class="col-md-4">
                        <div class="input-group mb-3">
                            <input type="search" class="form-control" aria-describedby="basic-addon2" id="txtSearch">
                            <span class="input-group-text" id="basic-addon2"><i class="bi bi-search"></i></span>
                        </div>
                    </div>
                </div>

                <div id="contentTable">
                    <table class="table">
                        <thead class="table-dark">
                            <th>Código de Escuela</th>
                            <th>Escuela</th>
                            <th>Direccion</th>
                            <th>Email</th>
                            <th>Latitud</th>
                            <th>Longitud</th>

                            <th>&nbsp;</th>
                        </thead>
                        <tbody>
                            <td>1</td>
                            <td>UNICAES</td>
                            <td>Santa Ana, El Salvador</td>
                            <td>catolica@catolica.edu.sv</td>
                            <td>40º 42' 46'</td>
                            <td>74º 0' 21''</td>
                            <td>
                                <button type="button" class="btn btn-dark btncolor"><i class="ri-edit-fill"></i></button>
                                <button type="button" class="btn btn-danger btncolor"><i class="ri-delete-bin-7-line"></i></button>
                            </td>
                        </tbody>
                    </table>
                </div>
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
            <div id="contentForm" class="mt-3 d-none">
                <h4>
                    <i class="ri-school-fill"></i>
                    Escuelas
                </h4>
                <hr>
                <form id="formEscuela" enctype="multipart/form-data">
                    <div class="row mb-3">
                        <label for="foto" class="col-sm-2 col-form-label">Foto:</label>
                        <div class="col-sm-10">
                            <div class="img-thumbnail" id="divfoto" style="width:200px; height:200px">

                            </div>
                            <span>
                                Haga click para seleccionar la foto.
                            </span>
                            <input type="file" name="foto" id="foto" class="d-none">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="nombre" class="col-sm-2 col-form-label">Escuela:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nombre" name="nombre" required>
                            <input type="hidden" name="id_school" id="id_school" value="0">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="direccion" class="col-sm-2 col-form-label">Direccion:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="direccion" name="direccion" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="email" class="col-sm-2 col-form-label">Email:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="email" name="email" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="latitud" class="col-sm-2 col-form-label">Latitud:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="latitud" name="latitud" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="longitud" class="col-sm-2 col-form-label">Longitud:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="longitud" name="longitud" required>
                        </div>
                    </div>

                    <div id="map" style="height: 400px; max-width: 600px; margin: 0 auto;"></div>


                    <br>
                    <button type="button" class="btn btn-secondary" id="btnCancelar"><i class="bi bi-x-circle-fill"></i> Cancelar</button>
                    <button type="submit" class="btn btn-primary"><i class="bi bi-hdd"></i> Guardar</button>
                </form>
            </div>

        </section>

        <section id="pie">
            <?php include_once "app/views/sections/footer.php"; ?>
        </section>

    </div>

    <?php include_once "app/views/sections/scripts.php"; ?>
    <script src="<?php echo URL; ?>public_html/customjs/escuelas.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAWwqxbdlZ1vNfD5TUTTcIs0I8QFbljJ8k&callback=initMap" async defer></script>

</body>

</html>