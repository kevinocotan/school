<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include_once "app/views/sections/css.php"; ?>
    <link rel="stylesheet" href="<?php echo URL; ?>public_html/css/menulateral.css">
    <link rel="stylesheet" href="<?php echo URL; ?>public_html/css/menuprincipal.css">
    <link rel="shortcut icon" href="<?php echo URL; ?>public_html/images/school.jpg" type="image/x-icon">
    <title>Escuela-alumnos</title>
</head>

<body>
    <section id="menu">
        <?php
        if ($_SESSION["tipo"] == "Administrador") {
            include_once "app/views/sections/menulateral.php";
        } else {
            include_once "app/views/sections/menulateraluser.php";
        }
        ?>
    </section>

    <div class="content">
        <div>
            <h4 class="welcomestext text-end">Bienvenido/a: <?php echo $_SESSION["nuser"]; ?> </h4>
        </div>
        <section id="contenido">
            <!-- Imagen cargada dinámicamente con JavaScript -->
            <img id="imagenEscuela" class="img-fluid" alt="Imagen de la Escuela" width="300" style="display: block; margin: 0 auto;">
        </section>

        <div>
            <p>El marcador de la escuela es <span style="color: blue;">azul</span>.</p>
            <p>Los marcadores de los alumnos son <span style="color: red;">rojos</span>.</p>
        </div>
        <br>
        <section id="mapa">
            <div id="map" style="height: 400px; max-width: 800px; margin: 0 auto;"></div>
        </section>
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

            // Cargar imagen
            const imagenEscuela = document.getElementById('imagenEscuela');
            imagenEscuela.src = escuelaData.url_imagen;

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