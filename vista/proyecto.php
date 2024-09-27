<?php
session_start();
//$proyectoId = $_GET['id'];
$proyectoId = $_SESSION['id_usuario'];

if (!empty($_SESSION['id_usuario'])) {
    $current_path = $_SERVER['REQUEST_URI'];
    $base_path = '/apibilletera/vista/';
    $parts = explode($base_path, $current_path);
?>
    <!DOCTYPE html>
    <html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/main.css">
        <link rel="stylesheet" href="../css/style.css">
        <link rel="stylesheet" href="../css/style_filtro.css">
        <script src="https://cdn.tailwindcss.com"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <style>
            /* Puedes agregar estilo para que la transición sea más suave */
            #editFormContainer {
                display: none;
                margin-top: 20px;
            }
        </style>

    </head>

    <body>
        <?php
        include_once("../components/layout.php")
        ?>
        <div class="w-full flex flex-col items-center justify-center my-10">
            <span id="proyecto_nombre" class="text-black text-2xl"></span>
            <img class="w-[1000px] h-[1000px] object-cover" src="../imagenes/proyecto_plano.png" alt="">
        </div>
    </body>
    <script src="../js/proyecto.js"></script>

    </html>
<?php
} else {
    header('location: ../vista/index.php');
}
?>