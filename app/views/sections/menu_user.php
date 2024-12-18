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

                        <?php
                        // Función que determina si la URL actual corresponde a la página activa
                        function isActive($page)
                        {
                            return (strpos($_SERVER['REQUEST_URI'], $page) !== false) ? 'active-link' : '';
                        }
                        ?>


                    <div>
                        <h3 class="sidebar__title">MANAGE</h3>

                        <div class="sidebar__list">
                        <a href="<?php echo URL; ?>dashboard" class="sidebar__link <?php echo isActive('dashboard'); ?>">
                                <i class="ri-pie-chart-2-fill"></i>
                                <span>Dashboard</span>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="sidebar__actions" style="margin-top: 55vh;">
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