<?php

include_once "app/models/db.class.php";
include_once "app/models/alumnos.php";

$alumnoModel = new Alumnos();
$alumnoActual = $alumnoModel->getAlumnoActual($_SESSION["id_usr"]);
if (empty($alumnoActual)) {
    echo "Error: No se encontró información del alumno.";
    exit;
}

// Datos del alumno
$nombreCompleto = $alumnoActual[0]["nombre_completo"];
$direccion = $alumnoActual[0]["direccion"];
$telefono = $alumnoActual[0]["telefono"];
$email = $alumnoActual[0]["email"];
$foto = $alumnoActual[0]["foto"];
$genero = $alumnoActual[0]["genero"];
$nombreGrado = $alumnoActual[0]["nombre_grado"];
$nombreSeccion = $alumnoActual[0]["nombre_seccion"];
$nombreEscuela = $alumnoActual[0]["nombre_escuela"];
$usuario = $alumnoActual[0]["usuario"];
$tipoUsuario = $alumnoActual[0]["tipo_usuario"];
$fotoUsuario = $alumnoActual[0]["foto_usuario"];
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include_once "app/views/sections/css.php"; ?>
    <link rel="shortcut icon" href="<?php echo URL; ?>public_html/images/logotransparente.png" type="image/x-icon">
    <title>Alumnos - MyControl School</title>
</head>

<body>

    <div class="main container" id="main">
        <!-- Menú lateral -->
        <?php include_once "app/views/sections/menu_user.php"; ?>

        <!-- Contenido principal -->
        <section id="contenido">
            <h1>Dashboard de Usuario</h1>
            <h2>Bienvenido, <?php echo $nombreCompleto; ?></h2>
            <div class="perfil">
                <img src="<?php echo $foto; ?>" alt="Foto de Alumno" width="100" height="100">
                <p><strong>Dirección:</strong> <?php echo $direccion; ?></p>
                <p><strong>Teléfono:</strong> <?php echo $telefono; ?></p>
                <p><strong>Email:</strong> <?php echo $email; ?></p>
                <p><strong>Género:</strong> <?php echo $genero; ?></p>
                <p><strong>Grado:</strong> <?php echo $nombreGrado; ?></p>
                <p><strong>Sección:</strong> <?php echo $nombreSeccion; ?></p>
                <p><strong>Escuela:</strong> <?php echo $nombreEscuela; ?></p>
            </div>
            <h3>Información del Usuario</h3>
            <p><strong>Usuario:</strong> <?php echo $usuario; ?></p>
            <p><strong>Tipo de Usuario:</strong> <?php echo $tipoUsuario; ?></p>
            <img src="<?php echo $fotoUsuario; ?>" alt="Foto de Usuario" width="50" height="50">
        </section>
    </div>

    <script src="public_html/js/main.js"></script>
</body>

</html>