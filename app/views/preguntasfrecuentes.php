<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include_once "app/views/sections/css.php"; ?>
    <link rel="shortcut icon" href="<?php echo URL;?>public_html/images/logotransparente.png" type="image/x-icon">
    <title>Iveth´s Beauty Salon Spa & Nails</title>
</head>
<style>
    table {
      width: 100%;
      border-collapse: collapse;
      border: 1px solid #ddd;
    }
    th, td {
      padding: 8px;
      text-align: left;
      border-bottom: 1px solid #ddd;
      border-right: 1px solid #ddd;
    }
    th {
      background-color: #f2f2f2;
      text-align: center;
    }
    td:last-child {
      border-right: none;
    }
    .question {
      text-align: center;
    }
    .centered {
      text-align: center;
    }
    .container {
        margin-top: 20px;
        margin-bottom: 20px;
    }
  </style>
<body>
    <div class="container">
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
        <div class="container">

            <table>
            <tr>
            <th>Pregunta</th>
            <th>Respuesta</th>
            </tr>
            <tr>
            <td class="question">¿Cómo puedo acceder al sistema de información?</td>
            <td>Para acceder al sistema de información, debes seguir los siguientes pasos:
                <ol>
                <li>Visita la página de inicio del sistema de información.</li>
                <li>Ingresa tu nombre de usuario y contraseña en los campos correspondientes.</li>
                <li>Haz clic en el botón "Iniciar sesión" o una opción similar.</li>
                <li>Si los datos de inicio de sesión son correctos, serás redirigido al panel principal del sistema de información, donde podrás comenzar a utilizar sus funciones y características.</li>
                </ol>
            </td>
            </tr>
            <tr>
            <td class="question">¿Cómo puedo buscar información específica en el sistema?</td>
            <td >
            Para buscar información específica en el sistema, utiliza la función de búsqueda ubicada generalmente en la parte superior o en el menú principal. Ingresa las palabras clave relacionadas con la información que estás buscando y presiona Enter o haz clic en el botón de búsqueda. El sistema mostrará los resultados relevantes.
            </td>
            </tr>
            <tr>
            <td class="question">¿Puedo acceder al sistema de información desde mi dispositivo móvil?</td>
            <td >
            Sí, muchos sistemas de información ofrecen aplicaciones o versiones móviles optimizadas de su plataforma. Puedes buscar la aplicación en la tienda de aplicaciones correspondiente a tu dispositivo móvil o acceder al sistema a través del navegador web de tu dispositivo.
            </td>
            </tr>
            <tr>
            <td class="question">¿Cuáles son los requisitos técnicos para utilizar el sistema de información?</td>
            <td >
            Los requisitos técnicos pueden variar según el sistema de información en particular. Por lo general, necesitarás un dispositivo con acceso a Internet, como una computadora, tablet o teléfono inteligente. Además, es posible que se requiera un navegador web actualizado, como Google Chrome, Mozilla Firefox o Safari, y es posible que se necesite tener habilitadas las cookies y JavaScript en el navegador.
            </td>
            </tr>
            <tr>
            <td class="question">¿Cómo puedo obtener ayuda o soporte técnico si tengo algún problema con el sistema de información?</td>
            <td >
            Para obtener ayuda o soporte técnico, busca la opción de "Soporte" o "Ayuda" en el sistema de información. Allí encontrarás información de contacto, como un número de teléfono o una dirección de correo electrónico, a través de la cual podrás comunicarte con el equipo de soporte técnico. También puedes consultar la documentación o los tutoriales disponibles en el sistema para obtener respuestas a preguntas comunes.
           </td>
            </tr>
            <tr>
            <td class="question">¿Cuál es el límite de capacidad de almacenamiento del sistema de información?</td>
            <td >
            El límite de capacidad de almacenamiento puede variar según el sistema de información específico y la infraestructura que lo respalda. Algunos sistemas pueden tener límites predefinidos, mientras que otros pueden escalar y adaptarse a medida que se necesita más espacio de almacenamiento. Es recomendable consultar con los administradores del sistema para obtener información precisa sobre el límite de capacidad.
            </td>
            </tr>
            <tr>
            <td class="question">¿Cómo puedo generar informes personalizados en el sistema de información?</td>
            <td >
            Para generar informes personalizados, generalmente puedes acceder a la sección de "Informes" o "Reportes" en el sistema. Desde allí, puedes seleccionar las variables, filtros y criterios de búsqueda específicos para generar un informe que se ajuste a tus necesidades. Si el sistema admite personalización avanzada de informes, es posible que puedas arrastrar y soltar elementos, aplicar fórmulas o utilizar herramientas de diseño para ajustar el formato y la presentación del informe.
            </td>
            </tr>
            <tr>
            <td class="question">¿Cómo se realiza el respaldo y la recuperación de datos en el sistema de información?</td>
            <td >
            El respaldo y la recuperación de datos son procesos críticos en un sistema de información. Por lo general, se establecen políticas de respaldo programadas que copian y almacenan los datos en una ubicación segura, como discos duros externos o servidores de respaldo. Si se produce una pérdida de datos, el sistema de información puede utilizar esos respaldos para restaurar la información. Es recomendable seguir las mejores prácticas de respaldo y recuperación de datos establecidas por los administradores del sistema.
            </td>
            </tr>
            <tr>
            <td class="question">¿Qué medidas de seguridad se implementan en el sistema de información para proteger los datos?</td>
            <td >
            Los sistemas de información suelen implementar medidas de seguridad, como el cifrado de datos, autenticación de usuarios, control de acceso basado en roles y auditorías de actividad. Además, se pueden aplicar firewalls, sistemas de detección de intrusos y otras medidas de protección para prevenir accesos no autorizados y salvaguardar la integridad de los datos. El nivel de seguridad puede variar según el sistema y los requisitos de la organización. Es importante seguir las políticas de seguridad establecidas y utilizar contraseñas seguras para acceder al sistema.
            </td>
            </tr>
        </table>
        </div>
        </section>
    <!--Todos los elementos del pie del sitio-->
        <section id="pie">
            <?php include_once "app/views/sections/footer.php"; ?>
        </section>
    </div>
    <?php include_once "app/views/sections/scripts.php"; ?>
</body>
</html>