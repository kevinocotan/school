<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">

   <!--=============== REMIXICONS ===============-->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.2.0/remixicon.css">

   <!--=============== CSS ===============-->
   <link rel="stylesheet" href="css/styles-sidebar.css">  

   <title>Responsive Sidebar Menu | Dark/Light Mode - Bedimcode</title>
</head>
<body>
   <!--=============== HEADER ===============-->
   <header class="header" id="header">
      <div class="header__container">
         <a href="#" class="header__logo">
            <i class="ri-cloud-fill"></i>
            <span>Cloud</span>
         </a>
         
         <button class="header__toggle" id="header-toggle">
            <i class="ri-menu-line"></i>
         </button>
      </div>
   </header>

   <!--=============== SIDEBAR ===============-->
   <nav class="sidebar" id="sidebar">
      <div class="sidebar__container">
         <div class="sidebar__user">
            <div class="sidebar__img">
               <img src="assets/img/perfil.png" alt="User Image">
            </div>

            <div class="sidebar__info">
               <!-- Display the username dynamically -->
               <h3><?php echo $_SESSION["nuser"]; ?></h3>
               <span><?php echo $_SESSION["nuser"]; ?>@example.com</span> <!-- Or customize this as needed -->
            </div>
         </div>

         <div class="sidebar__content">
            <div>
               <h3 class="sidebar__title">MANAGE</h3>

               <div class="sidebar__list">
                  <a href="#" class="sidebar__link active-link">
                     <i class="ri-pie-chart-2-fill"></i>
                     <span>Dashboard</span>
                  </a>
                  
                  <a href="#" class="sidebar__link">
                     <i class="ri-wallet-3-fill"></i>
                     <span>Escuelas</span>
                  </a>

                  <a href="#" class="sidebar__link">
                     <i class="ri-calendar-fill"></i>
                     <span>Padres</span>
                  </a>

                  <a href="#" class="sidebar__link">
                     <i class="ri-arrow-up-down-line"></i>
                     <span>Alumnos</span>
                  </a>
               </div>
            </div>

            <div>
               <h3 class="sidebar__title">INFORMES</h3>

               <div class="sidebar__list">
                  <a href="#" class="sidebar__link">
                     <i class="ri-settings-3-fill"></i>
                     <span>Reportes</span>
                  </a>
               </div>
            </div>
         </div>

         <div class="sidebar__actions">
            <button>
               <i class="ri-moon-clear-fill sidebar__link sidebar__theme" id="theme-button">
                  <span>Theme</span>
               </i>
            </button>

            <!-- Log Out button linked to logout URL -->
            <a href="<?php echo URL;?>login/cerrar" class="sidebar__link">
               <i class="ri-logout-box-r-fill"></i>
               <span>Log Out</span>
            </a>
         </div>
      </div>
   </nav>

   <!--=============== MAIN ===============-->
   <main class="main container" id="main">
      <h1>Sidebar Menu</h1>
   </main>
   
   <!--=============== MAIN JS ===============-->
   <script src="js/main.js"></script>
</body>
</html>
