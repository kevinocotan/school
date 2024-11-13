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
<body>
    <div class="container">
        <!--Todos los elementos del encabezado-->
        <section id="encabezado">
            <?php include_once "app/views/sections/headercliente.php"; ?>
        </section>
        <!--Opciones de menu-->
        <section id="menu">
            <?php include_once "app/views/sections/menucliente.php"; ?>
        </section>
        <!-- Todos los elementos que varian-->
        <section id="contenido">
                <div class="container">

                <div class="row mt-5">
                <div class="col-sm-4">		
    <h3 class="text-center"> Servicios </h3>	
    <p style="text-align: justify;">
        En Iveth's Beauty Salon Spa & Nails, nos enorgullece ofrecer un amplio abanico de servicios de alta calidad. Nuestro equipo de expertos profesionales está comprometido en brindarte una experiencia de primera clase, desde cortes y peinados vanguardistas hasta tratamientos faciales y corporales rejuvenecedores. Nuestro objetivo es superar tus expectativas y asegurarnos de que te sientas mimado y satisfecho en cada visita.
    </p>
    </div>
        <div class="col-sm-4">		
            <h3 class="text-center"> Productos </h3>	
            <p style="text-align: justify;">
                En Iveth's Beauty Salon Spa & Nails, solo utilizamos productos de belleza de la más alta calidad. Nos asociamos con marcas reconocidas y confiables para asegurarnos de que recibas tratamientos y servicios excepcionales. Desde productos para el cuidado del cabello hasta cosméticos para el cuidado de la piel, seleccionamos cuidadosamente cada artículo para garantizar que tu experiencia sea completamente satisfactoria y que puedas mantener y realzar tu belleza incluso después de salir de nuestro salón.
            </p>
    </div>
        <div class="col-sm-4">		
            <h3 class="text-center"> Spa </h3>	
            <p style="text-align: justify;">
                Nuestro spa en Iveth's Beauty Salon Spa & Nails es un refugio de tranquilidad y relajación. Aquí, puedes escapar del estrés diario y disfrutar de un ambiente sereno mientras nuestros terapeutas altamente capacitados te brindan masajes terapéuticos y tratamientos corporales revitalizantes. Utilizamos técnicas especializadas y productos de spa de alta calidad para proporcionarte una experiencia indulgente que rejuvenece tanto tu cuerpo como tu mente. Permítenos cuidar de ti mientras te sumerges en un mundo de calma y bienestar.
            </p>
        </div>

            </div>	
            <br>
            <h2>Contactanos</h2>
            <br>
            <style>
    /* Estilos para los botones responsivos */
    .contacto {
        text-align: center;
    }

    .contacto table {
        margin: 0 auto;
    }

    .contacto th {
        font-size: 18px;
        font-weight: bold;
        padding-bottom: 10px;
    }

    .contacto td {
        padding: 5px;
    }

    .contacto td i {
        vertical-align: middle;
    }

    .contacto .btn-whatsapp,
    .contacto .btn-facebook,
    .contacto .btn-instagram {
        display: inline-block;
        width: 150px;
        margin: 1px; 
        text-align: center;
        text-decoration: none;
        border: none;
        border-radius: 5px;
        padding: 5px;
        color: #fff;
        font-weight: bold;
    }
    

    .contacto .btn-whatsapp {
        background-color:  #075E54;
    }

    .contacto .btn-facebook {
        background-color: #1877F2;
    }

    .contacto .btn-instagram {
        background-color: #E4405F;
    }

    .contacto .btn-whatsapp i,
    .contacto .btn-facebook i,
    .contacto .btn-instagram i {
        margin-right: 1px;
    }

    @media (max-width: 576px) {
        .contacto .btn-whatsapp,
        .contacto .btn-facebook,
        .contacto .btn-instagram {
            width: 100%;
        }
    }

    @media (min-width: 577px) and (max-width: 992px) {
        .contacto table {
            justify-content: space-between;
        }
    }

    @media (min-width: 993px) {
        .contacto .btn-whatsapp,
        .contacto .btn-facebook,
        .contacto .btn-instagram {
            width: 150px;
        }
    }
    </style>
        <div class="contacto">
        <h3>Chalchuapa - Santa Ana</h3>
        <table>
            <tr>
            <td><i class="bi bi-pin-map-fill"></i></td>
            <td style="vertical-align: middle;">Tercera Avenida Sur Casa #4 entre Calle Ramón Flores y Primera Calle Oriente, Chalchuapa</td>
            </tr>
            <tr>
            <td><i class="bi bi-telephone-fill"></i></td>
            <td style="vertical-align: middle;">7870-9429</td>
            </tr>
            <tr>
                <td>
                <br>
                    <a href="https://wa.me/78709429?text=¡Estoy+interesado!" target="_blank" class="btn-whatsapp">
                        <i class="bi bi-whatsapp"></i> WhatsApp
                    </a>
                </td>
                <td>
                <br>
                    <a href="https://www.facebook.com/IvethBeautySalonSpaNails" target="_blank" class="btn-facebook">
                        <i class="bi bi-facebook"></i> Facebook
                    </a>
                </td>
                <td>
                <br>
                    <a href="https://www.instagram.com/iveth_beauty_salon/" target="_blank" class="btn-instagram">
                        <i class="bi bi-instagram"></i> Instagram
                    </a>
                </td>
        </table>
        </div>                
    </div>
        </section>
    <!--Todos los elementos del pie del sitio-->
        <section id="pie">
            <?php include_once "app/views/sections/footercliente.php"; ?>
        </section>
    </div>
    <?php include_once "app/views/sections/scriptscliente.php"; ?>
</body>
</html>