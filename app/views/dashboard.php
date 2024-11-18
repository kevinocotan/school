<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include_once "app/views/sections/css.php"; ?>
    <link rel="shortcut icon" href="<?php echo URL; ?>public_html/images/logotransparente.png" type="image/x-icon">
    <title>Dashboard - MyControl School</title>
</head>

<body>

    <!-- NO HAY NECESIDAD DE QUE ESTO DE ARRIBA SE REPITA POR CADA ARCHIVO -->

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


            <?php include_once "app/views/sections/scripts.php"; ?>
            <script src="<?php echo URL; ?>public_html/customjs/escuelas.js"></script>
            <script>
                function initMap() {
                    var latitud_escuela = <?php echo isset($_GET['latitud']) ? $_GET['latitud'] : ''; ?>;
                    var longitud_escuela = <?php echo isset($_GET['longitud']) ? $_GET['longitud'] : ''; ?>;

                    var schoolLocation = {
                        lat: parseFloat(latitud_escuela),
                        lng: parseFloat(longitud_escuela)
                    };

                    var map = new google.maps.Map(document.getElementById('map'), {
                        zoom: 8,
                        center: schoolLocation
                    });

                    var marker = new google.maps.Marker({
                        position: schoolLocation,
                        map: map,
                        title: 'Escuela',
                        icon: 'http://maps.google.com/mapfiles/ms/icons/blue-dot.png'
                    });

                    var alumnos = <?php echo isset($_GET['alumnos']) ? $_GET['alumnos'] : '[]'; ?>;
                    for (var i = 0; i < alumnos.length; i++) {
                        var alumno = alumnos[i];
                        var alumnoLocation = {
                            lat: parseFloat(alumno.latitud_alumno),
                            lng: parseFloat(alumno.longitud_alumno)
                        };

                        var markerAlumno = new google.maps.Marker({
                            position: alumnoLocation,
                            map: map,
                            title: alumno.nombre_alumno,
                            icon: 'http://maps.google.com/mapfiles/ms/icons/red-dot.png'
                        });
                    }
                }
            </script>
            
            <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAWwqxbdlZ1vNfD5TUTTcIs0I8QFbljJ8k&callback=initMap" async defer></script>
    </div>
</body>

</html>