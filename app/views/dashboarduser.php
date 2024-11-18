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

    <style>
        #map {
            height: 600px;
            width: 100%;
        }
    </style>

    <div class="main container" id="main">
        <!--Todos los elementos del encabezado-->
        <section id="encabezado">
            <?php include_once "app/views/sections/header.php"; ?>
        </section>
        <!--Opciones de menu-->
        <section id="menu">
            <?php include_once "app/views/sections/menu_user.php"; ?>
        </section>
        <!-- Todos los elementos que varian-->
        <section id="contenido">


            <div class="container mt-2">

                <div id="map"></div>
            </div>

            <!-- SweetAlert2 -->
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <!-- Google Maps API -->
            <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAWwqxbdlZ1vNfD5TUTTcIs0I8QFbljJ8k&callback&callback=initMap"></script>
            <!-- Script principal -->
            <script>
                let map;

                // Inicializa el mapa de Google
                function initMap() {
                    const initialCoords = {
                        lat: 13.68935,
                        lng: -89.0976
                    }; // Cambia estas coordenadas según tu región
                    map = new google.maps.Map(document.getElementById("map"), {
                        zoom: 9,
                        center: initialCoords,
                    });

                    // Carga escuelas y alumnos en el mapa
                    cargarMapaConEscuelasYAlumnos();
                }

                // Carga escuelas y alumnos en el mapa
                function cargarMapaConEscuelasYAlumnos() {
                    fetch("escuelas/getEscuelasYAlumnos")
                        .then((response) => response.json())
                        .then((data) => {
                            if (data.success) {
                                data.records.forEach((item) => {
                                    const {
                                        tipo,
                                        nombre,
                                        latitud,
                                        longitud,
                                        direccion,
                                        nombre_escuela
                                    } = item;
                                    const coords = {
                                        lat: parseFloat(latitud),
                                        lng: parseFloat(longitud)
                                    };

                                    // Define el ícono según el tipo
                                    const icon = tipo === 'escuela' ?
                                        'http://maps.google.com/mapfiles/ms/icons/blue-dot.png' :
                                        'http://maps.google.com/mapfiles/ms/icons/red-dot.png';

                                    // Crear un marcador
                                    const marker = new google.maps.Marker({
                                        position: coords,
                                        map: map,
                                        title: nombre,
                                        icon: icon,
                                    });

                                    // Definir el contenido del marcador
                                    const content = tipo === 'escuela' ?
                                        `<strong>${nombre}</strong><br>Dirección: ${direccion}` :
                                        `<strong>${nombre}</strong><br>Escuela: ${nombre_escuela}`;

                                    // Información al hacer clic en el marcador
                                    const infoWindow = new google.maps.InfoWindow({
                                        content: content,
                                    });

                                    marker.addListener("click", () => {
                                        infoWindow.open(map, marker);
                                    });
                                });
                            } else {
                                Swal.fire("Error", "No se pudieron cargar los datos del mapa", "error");
                            }
                        })
                        .catch((error) => {
                            console.error("Error al cargar los datos del mapa:", error);
                        });
                }
            </script>
</body>

</html>