<!DOCTYPE html>
<html class=''>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URL; ?>public_html/css/login-styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.2.0/remixicon.css">
    <title>MyControl School</title>
</head>

<body>

    <div class="container" id="container">

        <div class="form-container sign-in">

            <form action="login.php" id="formlogin">
                <h1>Inicio de Sesión</h1>

                <div class="social-icons">
                    <a href="https://www.linkedin.com/in/kevin-ocotan/" target="_blank" class="icon">
                        <i class="ri-linkedin-fill"></i>
                    </a>
                    <a href="https://github.com/kevinocotan/" target="_blank" class="icon">
                        <i class="ri-github-fill"></i>
                    </a>
                </div>

                <span>o use su usuario y contraseña</span>

                <br>

                <input type="text" class="form-control" id="floatingInput" placeholder="Usuario" name="usuario">

                <input type="password" class="form-control" id="floatingPassword" placeholder="Contraseña" name="password">

                <br>

                <button class="btn btn-success" type="submit">Iniciar Sesión</button>
            </form>

        </div>

        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-right">
                    <h1>Hola, Usuario!</h1>
                    <p>Bienvenido al sistema de prueba técnica: MyControl School</p>
                </div>
            </div>
        </div>

    </div>

    <script src="<?php echo URL; ?>public_html/customjs/api.js"></script>
    <script src="<?php echo URL; ?>public_html/customjs/login.js"></script>
    <script src="public_html/js/login-script.php"></script>

</body>

</html>