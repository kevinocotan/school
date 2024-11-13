
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ">

                    <li class="nav-item dropdown" >
                        <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Mantenimientos
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="<?php echo URL;?>citasuser">Citas</a></li>
                            <li><a class="dropdown-item" href="<?php echo URL;?>clientesuser">Clientes</a></li>
                            <li><a class="dropdown-item" href="<?php echo URL;?>serviciosuser">Servicios</a></li>                                                            
                        </ul>                     
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Productos
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="<?php echo URL;?>productosuser">Productos</a></li>                           
                            <li><a class="dropdown-item" href="<?php echo URL;?>categoriauser">Categoría de Producto</a></li>
                            <li><a class="dropdown-item" href="<?php echo URL;?>subcategoriauser">Subcategoría de Producto</a></li>
                            <li><hr class="dropdown-divider bg-white"></li>   
                            <li><a class="dropdown-item" href="<?php echo URL;?>compraproductosuser">Compras de Producto</a></li> 
                        </ul>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Registros
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="<?php echo URL;?>ingresosuser">Ingresos</a></li>
                            <li><a class="dropdown-item" href="<?php echo URL;?>egresosuser">Egresos</a></li>
                        </ul>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Ayuda
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="" onclick="mostrarPDF()">Manual de Usuario</a></li>
                            <script>
                        function mostrarPDF() {
                            window.open('pdf/Manual.pdf', '_blank');
                        }
                    </script>
                    <li><a class="dropdown-item" href="<?php echo URL;?>main/getPreguntasFrecuentesUser" tabindex="-1" aria-disabled="true">Preguntas Frecuentes</a></li>                       

                        </ul>
                </li>
                
                
                    <li class="nav-item">
                    <a class="nav-link" href="<?php echo URL;?>login/cerrar" tabindex="-1" aria-disabled="true">Cerrar sesión</a>
                    </li>
                </ul>
                </div>
            </div>
        </nav>