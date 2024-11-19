<?php
include_once "app/models/db.class.php";
include_once "app/models/alumnos.php";
include_once "app/models/escuelas.php";

$alumnoModel = new Alumnos();
$alumnoActual = $alumnoModel->getAlumnoActual($_SESSION["id_usr"]);

if (empty($alumnoActual)) {
    echo "Error: No se encontró información del alumno.";
    exit;
}

// Obtener datos del alumno
$alumno = $alumnoActual[0]; // Accedemos al primer (y único) elemento del arreglo

// Obtener la escuela del alumno
$escuelaModel = new Escuelas();
$datosEscuela = $escuelaModel->getOneEscuela($alumno["id_school"]); // Asegúrate de que id_school esté presente en $alumno

if (!empty($datosEscuela)) {
    $nombreEscuela = $datosEscuela[0]["nombre"];
    $direccionEscuela = $datosEscuela[0]["direccion"];
    $latitudEscuela = $datosEscuela[0]["latitud"];
    $longitudEscuela = $datosEscuela[0]["longitud"];
} else {
    $nombreEscuela = "No disponible";
    $direccionEscuela = "No disponible";
    $latitudEscuela = null;
    $longitudEscuela = null;
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include_once "app/views/sections/css.php"; ?>
    <link rel="shortcut icon" href="<?php echo URL; ?>public_html/images/logotransparente.png" type="image/x-icon">
    <title>Dashboard Usuario - MyControl School</title>

    <!-- Incluir Google Maps API -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAWwqxbdlZ1vNfD5TUTTcIs0I8QFbljJ8k&"></script> <!-- Reemplaza YOUR_API_KEY con tu clave de API -->
</head>

<body>

    <div class="main container" id="main">
        <!-- Menú lateral -->
        <?php include_once "app/views/sections/menu_user.php"; ?>

        <!-- Contenido principal -->
        <section id="contenido">
            <h4>Estudiante: <?php echo $alumno["nombre_completo"]; ?></h4>

            <div class="perfil">

                <!-- Mostrar imagen de la escuela -->
                <div class="escuela-imagen" style="text-align: center; margin-top: 20px;">
                    <?php if (!empty($datosEscuela[0]["foto"])): ?>
                        <img src="<?php echo $datosEscuela[0]["foto"]; ?>" alt="Imagen de <?php echo $nombreEscuela; ?>" style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);">
                    <?php else: ?>
                        <p>No hay imagen disponible para esta escuela.</p>
                    <?php endif; ?>
                </div>


                <br>
                <p><strong>Escuela:</strong> <?php echo $nombreEscuela; ?></p>
                <p><strong>Grado:</strong> <?php echo $alumno["nombre_grado"]; ?></p>
                <p><strong>Sección:</strong> <?php echo $alumno["nombre_seccion"]; ?></p>
                <p><strong>Dirección Escuela:</strong> <?php echo $direccionEscuela; ?></p>

                <p><strong>Ubicación Escuela:</strong></p>
            </div>



            <!-- Contenedor para el mapa -->
            <div id="map" style="height: 300px; width: 100%;"></div>
        </section>
    </div>

    <script src="public_html/js/main.js"></script>

    <script>
        function initMap() {
            // Usar las coordenadas de la escuela
            var escuelaLocation = {
                lat: <?php echo $latitudEscuela; ?>,
                lng: <?php echo $longitudEscuela; ?>
            };

            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 17,
                center: escuelaLocation
            });

            var marker = new google.maps.Marker({
                position: escuelaLocation,
                map: map,
                title: '<?php echo $nombreEscuela; ?>'
            });
        }

        google.maps.event.addDomListener(window, 'load', initMap);
    </script>
</body>

</html>