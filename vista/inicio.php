<?php
session_start();
if (!empty($_SESSION['id_usuario'])) {
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="../css/style.css">
        
        <link rel="stylesheet" href="../css/main.css">
        <title>Document</title>
    </head>

    <body>
        <div class="containerproyectos">
            <h1>Mis proyectos</h1>
            <div id="proyectosContainer" class="btn btn-primary text-center">
                <script src="../js/jquery.min.js"></script>
                <script src="../js/gestion_proyectos.js"></script> 
            </div>
        </div>

        <ul class="navbar-nav2">
            <li>
                <a href="../controlador/logout.php" class="btn2 btn-logout">Cerrar Sesión</a>
            </li>
        </ul>

        <div id="usuarioContainer" class="usuario_datos">
            <h3>Usuario</h3>
            <div id="usuarioContainer" class="">
                <script src="../js/jquery.min.js"></script>
                <script src="../js/usuario.js"></script> 
            </div>
        </div>
    </body>

    </html>

<?php
} else {

    header('location: ../vista/index.php');
}
?>