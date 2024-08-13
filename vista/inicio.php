<?php
session_start();
if (!empty($_SESSION['id_usuario'])) {
    echo 'llego hasta vista/inicio/if';
    echo $_SESSION["rol"];

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>

    <body>
        <div class="containerproyectos">
            <h1>Mis proyectos</h1>
            <div id="listProyectos">

            </div>
        </div>
        <!-- <form action="../controlador/conectar_proyecto.php" method="post">
        <div class="input-div">
            <h5>Inserte nombre del proyecto</h5>
            <input type="text" name="name_pro" class="input">
        </div>
        <input type="submit" class="btn" value="ingresar">
    </form> -->
        <script src="../js/jquery.min.js"></script>
        <script src="../js/gestion_proyectos.js"></script>
    </body>

    </html>

<?php
} else {

    header('location: ../vista/index.php');
}
echo 'llego hasta vista/inicio';
?>