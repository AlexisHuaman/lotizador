<?php
session_start();
if (!empty($_SESSION['id_usuario'])) {
    $current_path = $_SERVER['REQUEST_URI'];
    $base_path = '/apibilletera/vista/';
    $parts = explode($base_path, $current_path);
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="../css/style.css">
        <link rel="stylesheet" href="../css/main.css">
        <script src="https://cdn.tailwindcss.com"></script>
        <title>Document</title>
    </head>

    <body>
        <div class="">
            <?php
            include_once("../components/layout.php")
            ?>
            <div class="containerproyectos">
                <h1 class="text-center">Mis proyectos</h1>
                <div id="proyectosContainer" class="flex flex-row text-center">
                    <script src="../js/jquery.min.js"></script>
                    <script src="../js/gestion_proyectos.js"></script>
                </div>
            </div>

            <div class="w-full flex flex-col padding-5 px-8" id="proyectosContainer"">
                <script src=" ../js/jquery.min.js">
                </script>
                <script src="../js/gestion_proyectos.js"></script>
            </div>
        </div>
    </body>

    </html>

<?php
} else {

    header('location: ../vista/index.php');
}
?>