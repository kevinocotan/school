<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">

<!-- Boxicons CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">

<!-- Otros estilos ya presentes -->
<link rel="stylesheet" href="<?php echo URL; ?>public_html/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
<link rel="stylesheet" href="public_html/css/style.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Great+Vibes&display=swap" rel="stylesheet">

<style>
    #map {
        height: 600px;
        width: 100%;
    }

    .legend {
        display: flex;
        align-items: center;
        justify-content: center;
        margin-top: 10px;
    }

    .legend-item {
        display: flex;
        align-items: center;
        margin-right: 20px;
    }

    .legend-item .color-box {
        width: 15px;
        height: 15px;
        margin-right: 5px;
        border-radius: 3px;
    }

    .color-red {
        background-color: red;
    }

    .color-blue {
        background-color: blue;
    }

    /* Estilo general de la tabla */
    table {
        width: 100%;
        table-layout: fixed;
        /* Esto asegura que las celdas tengan un ancho fijo */
        border-collapse: collapse;
    }

    /* Estilo para las celdas */
    table th,
    table td {
        padding: 8px;
        text-align: center;
        border: 1px solid #ddd;
    }

    /* CON LAS DOS SIGUIENTES ADAPTADO EL TEXTO A LA TABLA */

    /* Estilo para la columna de correo electrónico */
    table td {
        word-wrap: break-word;
        max-width: 200px;
    }

    table th {
        word-wrap: break-word;
        max-width: 200px;
    }

    /* Estilo para las celdas de los botones */
    table td:last-child {
        width: 120px;
        /* Ancho fijo para la columna de botones */
    }
    
</style>