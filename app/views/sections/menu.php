<?php
// Inicia la sesión
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Verifica si el usuario está logueado y si es un administrador
if (!isset($_SESSION['usuario']) || $_SESSION['tipo'] !== 'Administrador') {
    // Redirige a la página de acceso denegado o a su propia página
    header('Location: ' . URL . 'dashboarduser');
    exit;
}
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--=============== REMIXICONS ===============-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.2.0/remixicon.css">

    <!--=============== CSS ===============-->
    <link rel="stylesheet" href="public_html/css/styles-sidebar.css">

    <title>Responsive Sidebar Menu | Dark/Light Mode </title>


</head>

<body>
    <!--=============== HEADER ===============-->
    <header class="header" id="header">
        <div class="header__container">
            <a href="<?php echo URL; ?>dashboard" class="header__logo">
                <span>MyControl School</span>
                <i class="ri-school-line"></i>
            </a>

            <button class="header__toggle" id="header-toggle">
                <i class="ri-menu-line"></i>
            </button>
        </div>
    </header>



    <!--=============== MAIN ===============-->
    <main class="main container" id="main">

        <!--=============== SIDEBAR ===============-->
        <nav class="sidebar" id="sidebar">
            <div class="sidebar__container">
                <div class="sidebar__user">
                    <div class="sidebar__img">
                        <img src="<?php echo $_SESSION["foto"]; ?>" alt="User Image">
                    </div>

                    <div class="sidebar__info">
                        <!-- Display the username dynamically -->
                        <h3><?php echo $_SESSION["nuser"]; ?></h3>
                        <span><?php echo $_SESSION["usuario"]; ?>@gmail.com</span> <!-- Or customize this as needed -->
                    </div>
                </div>

                <div class="sidebar__content">
                    <div>
                        <h3 class="sidebar__title">MANAGE</h3>

                        <?php
                        // Función que determina si la URL actual corresponde a la página activa
                        function isActive($page)
                        {
                            return (strpos($_SERVER['REQUEST_URI'], $page) !== false) ? 'active-link' : '';
                        }
                        ?>

                        <div class="sidebar__list">
                            <a href="<?php echo URL; ?>dashboard" class="sidebar__link <?php echo isActive('dashboard'); ?>">
                                <i class="ri-pie-chart-2-fill"></i>
                                <span>Dashboard</span>
                            </a>

                            <a href="<?php echo URL; ?>usuarios" class="sidebar__link <?php echo isActive('usuarios'); ?>">
                                <i class="ri-group-fill"></i>
                                <span>Usuarios</span>
                            </a>

                            <!-- SUB MENU ESCUELAS -->

                            <a href="<?php echo URL; ?>escuelas" class="sidebar__link <?php echo isActive('escuelas'); ?>" id="escuelas-link">
                                <i class="ri-school-fill"></i>
                                <span>Escuelas</span>
                                <i class="ri-arrow-down-s-line" id="toggle-submenu"></i>
                            </a>


                            <div id="escuelas-submenu" class="sidebar__submenu">
                                <a href="<?php echo URL; ?>grados" class="sidebar__link <?php echo isActive('grados'); ?>">
                                    <i class="ri-number-1"></i>
                                    <span>Grados</span>
                                </a>
                                <a href="<?php echo URL; ?>secciones" class="sidebar__link <?php echo isActive('secciones'); ?>">
                                    <i class="ri-font-family"></i>
                                    <span>Secciones</span>
                                </a>
                            </div>

                            <!-- FIN SUB MENU ESCUELAS -->

                            <!-- SUB MENU PADRES -->

                            <a href="<?php echo URL; ?>padres" class="sidebar__link <?php echo isActive('padres'); ?>" id="padres-link">
                                <i class="ri-user-fill"></i>
                                <span>Padres</span>
                                <i class="ri-arrow-down-s-line" id="toggle-submenu-padres"></i>
                            </a>

                            <!-- Submenú para los subenlaces de Padres -->
                            <div id="padres-submenu" class="sidebar__submenu">
                                <a href="<?php echo URL; ?>parentescos" class="sidebar__link <?php echo isActive('parentescos'); ?>">
                                    <i class="ri-group-3-line"></i>
                                    <span>Parentescos</span>
                                </a>
                            </div>
                            <!-- FIN SUB MENU PADRES -->

                            <a href="<?php echo URL; ?>alumnos" class="sidebar__link <?php echo isActive('alumnos'); ?>">
                                <i class="ri-graduation-cap-fill"></i>
                                <span>Alumnos</span>
                            </a>
                        </div>
                    </div>

                    <div>
                        <h3 class="sidebar__title">INFORMES</h3>

                        <div class="sidebar__list">
                            <a href="<?php echo URL; ?>reportes" class="sidebar__link <?php echo isActive('reportes'); ?>">
                                <i class="ri-file-pdf-2-line"></i>
                                <span>Reportes</span>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="sidebar__actions">
                    <button>
                        <i class="ri-moon-clear-fill sidebar__link sidebar__theme" id="theme-button">
                            <span>Tema</span>
                        </i>
                    </button>

                    <!-- Log Out button linked to logout URL -->
                    <a href="<?php echo URL; ?>login/cerrar" class="sidebar__link">
                        <i class="ri-logout-box-r-fill"></i>
                        <span>Cerrar Sesión</span>
                    </a>
                </div>
            </div>
        </nav>

    </main>

    <!--=============== MAIN JS ===============-->
    <script src="public_html/js/main.js"></script>
</body>

</html>