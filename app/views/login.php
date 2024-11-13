<!DOCTYPE html>
<html class=''>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="<?php echo URL;?>public_html/css/login.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Great+Vibes&display=swap" rel="stylesheet">
<title>Iveth´s Beauty Salón Spa & Nails</title>
</head>
<body>
<div class="wrapper1">
    <div class="container1">
      
        <h1>Iveth´s Beauty Salón Spa & Nails</h1>
        
        <form action="login.php" id="formlogin">
            <input type="text" class="form-control" id="floatingInput" placeholder="Usuario" name="usuario">
            <input type="password" class="form-control" id="floatingPassword" placeholder="Contraseña" name="password">

                <div class="alert alert-danger mt-5 d-none" role="alert" id="mensaje">
                        Bienvenido
                </div>
                
            <button class="btn btn-success" type="submit">Iniciar Sesión</button> 

            
        </form>
        <p class="text-muted text-center mt-5">
                    Copyright &copy; 2022
        </p>
        

    </div>
    <ul class="bg-bubbles">
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
    </ul>
</div>


<script src="<?php echo URL; ?>public_html/customjs/api.js"></script>
<script src="<?php echo URL; ?>public_html/customjs/login.js"></script>

</body>
</html>

