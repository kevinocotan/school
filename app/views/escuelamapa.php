<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include_once "app/views/sections/css.php"; ?>
    <link rel="shortcut icon" href="<?php echo URL; ?>public_html/images/logotransparente.png" type="image/x-icon">
    <title>Detalle de Escuela - MyControl School</title>
</head>

<body>

    <div class="main container" id="main">
        <!-- Todos los elementos del encabezado -->
        <section id="encabezado">
            <?php include_once "app/views/sections/header.php"; ?>
        </section>

        <!-- Opciones de menu -->
        <section id="menu">
            <?php include_once "app/views/sections/menu.php"; ?>
        </section>

        <!-- Contenido principal -->
        <section id="contenido">
            <!-- Nombre de la escuela -->
            <h2 id="nombreEscuela" style="text-align: center; color: #333; font-size: 24px; margin-bottom: 16px;"></h2>

            <!-- Imagen de la escuela -->
            <img id="imagenEscuela" class="img-fluid" alt="Imagen de la Escuela" style="display: block; margin: 0 auto; max-width: 100%; height: auto; max-height: 150px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);">
            <br>
            <!-- Mapa de la escuela y alumnos -->

            <section id="mapa">
                <div id="map" style="height: 400px; max-width: 800px; margin: 0 auto;"></div>
            </section>

            <!-- Leyenda -->
            <div class="legend">
                <div class="legend-item">
                    <div class="color-box color-blue"></div>
                    <span>Escuelas</span>
                </div>
                <div class="legend-item">
                    <div class="color-box color-red"></div>
                    <span>Alumnos</span>
                </div>
            </div>


            <!-- Tabla de alumnos -->
            <table id="tablaAlumnos" class="table table-bordered" style="margin-top: 20px;">
                <thead>
                    <tr>
                        <th>Nombre del Alumno</th>
                        <th>Latitud</th>
                        <th>Longitud</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Los datos de los alumnos se agregarán dinámicamente aquí -->
                </tbody>
            </table>
        </section>


        <!-- Pie de página -->
        <section id="pie">
            <?php include_once "app/views/sections/footer.php"; ?>
        </section>
    </div>

    <?php include_once "app/views/sections/scripts.php"; ?>
    <script src="<?php echo URL; ?>public_html/customjs/escuelas.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAWwqxbdlZ1vNfD5TUTTcIs0I8QFbljJ8k&callback=initMap" async defer></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Asegúrate de que los datos de la escuela existan
            const escuelaData = JSON.parse(localStorage.getItem("escuelaData"));
            if (!escuelaData) {
                console.error("No se encontraron datos de la escuela en localStorage");
                return;
            }

            // Cargar nombre de la escuela
            const nombreEscuela = document.getElementById('nombreEscuela');
            nombreEscuela.textContent = escuelaData.nombre_escuela || "Nombre de la escuela no disponible";

            // Cargar imagen
            const imagenEscuela = document.getElementById('imagenEscuela');
            imagenEscuela.src = escuelaData.url_imagen;

            // Cargar alumnos en la tabla
            const tablaAlumnos = document.getElementById('tablaAlumnos').getElementsByTagName('tbody')[0];
            const alumnos = escuelaData.alumnos || [];

            alumnos.forEach((alumno) => {
                const row = tablaAlumnos.insertRow();
                row.insertCell(0).textContent = alumno.nombre_alumno || "Sin alumnos registrados a esta escuela";
                row.insertCell(1).textContent = alumno.latitud_alumno || "No disponible";
                row.insertCell(2).textContent = alumno.longitud_alumno || "No disponible";
            });

            // Espera a que Google Maps esté listo antes de inicializar el mapa
            const checkGoogleMaps = setInterval(() => {
                if (typeof google !== 'undefined' && google.maps) {
                    clearInterval(checkGoogleMaps);
                    initMap(escuelaData);
                }
            }, 100);
        });

        function initMap(data) {
            const schoolLocation = {
                lat: parseFloat(data.latitud),
                lng: parseFloat(data.longitud),
            };

            const map = new google.maps.Map(document.getElementById("map"), {
                zoom: 10,
                center: schoolLocation,
            });

            // Marcador de la escuela
            new google.maps.Marker({
                position: schoolLocation,
                map: map,
                title: "Escuela",
                icon: "http://maps.google.com/mapfiles/ms/icons/blue-dot.png",
            });

            // Marcadores de los alumnos
            const alumnos = data.alumnos || [];
            alumnos.forEach((alumno) => {
                const alumnoLocation = {
                    lat: parseFloat(alumno.latitud_alumno),
                    lng: parseFloat(alumno.longitud_alumno),
                };

                new google.maps.Marker({
                    position: alumnoLocation,
                    map: map,
                    title: alumno.nombre_alumno,
                    icon: "http://maps.google.com/mapfiles/ms/icons/red-dot.png",
                });
            });

        }
    </script>
</body>

</html>