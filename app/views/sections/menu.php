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
                            <li><a class="dropdown-item" href="<?php echo URL;?>usuarios">Usuarios</a></li>
                            <li><a class="dropdown-item" href="<?php echo URL;?>empleados">Empleados</a></li>
                            <li><hr class="dropdown-divider bg-white"></li>
                            <li><a class="dropdown-item" href="<?php echo URL;?>citas">Citas</a></li>
                            <li><a class="dropdown-item" href="<?php echo URL;?>clientes">Clientes</a></li>
                            <li><a class="dropdown-item" href="<?php echo URL;?>servicios">Servicios</a></li>
                            <li><a class="dropdown-item" href="<?php echo URL;?>proveedores">Proveedores</a></li>                                                                
                        </ul>                     
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Productos
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="<?php echo URL;?>productos">Productos</a></li>                           
                            <li><a class="dropdown-item" href="<?php echo URL;?>categoria">Categoría de Producto</a></li>
                            <li><a class="dropdown-item" href="<?php echo URL;?>subcategoria">Subcategoría de Producto</a></li>
                            <li><hr class="dropdown-divider bg-white"></li>   
                            <li><a class="dropdown-item" href="<?php echo URL;?>compraproductos">Compras de Producto</a></li> 
                        </ul>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Registros
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="<?php echo URL;?>ingresos">Ingresos</a></li>
                            <li><a class="dropdown-item" href="<?php echo URL;?>egresos">Egresos</a></li>
                        </ul>
                    </li>
                
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Reportes
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="<?php echo URL;?>reporteingresos">Reporte General de Ingresos</a></li>
                            <li><a class="dropdown-item" href="<?php echo URL;?>reporteegresos">Reporte de Egresos</a></li>
                            <!--<li><hr class="dropdown-divider bg-white"></li>
                            <li><a class="dropdown-item" href="<?php echo URL;?>reporteproductos">Reporte de Productos</a></li> 
                            <li><a class="dropdown-item" href="<?php echo URL;?>reporteservicios">Reporte de Servicios</a></li> -->
                            <!-- <li><a class="dropdown-item" href="<?php echo URL;?>reportediario">Reporte Diario</a></li> -->                        
                            <!-- <li><a class="dropdown-item" href="<?php echo URL;?>facturas">Facturación</a></li> -->                            
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
                             <li><a class="dropdown-item" href="<?php echo URL;?>main/getPreguntasFrecuentes" tabindex="-1" aria-disabled="true">Preguntas Frecuentes</a></li>                       
                        </ul>
                    </li>              
                    <li class="nav-item">
                    <a class="nav-link" href="<?php echo URL;?>login/cerrar" tabindex="-1" aria-disabled="true">Cerrar sesión</a>
                    </li>
                </ul>
                <img src="<?php echo URL;?>public_html/images/logotransparente.png" alt="" style="width:40px; margin-right:10px;">
                <span class="text-white"><?php echo $_SESSION["nuser"];?></span>
                </div>
            </div>
        </nav>