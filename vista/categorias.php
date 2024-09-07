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
        <link rel="stylesheet" type="text/css" href="../css/style_usuario.css">
        <link rel="stylesheet" href="../css/main.css">
        <script src="https://cdn.tailwindcss.com"></script>
        <title>Document</title>
    </head>

    <body>
        <div class="">
            <?php
            include_once("../components/layout.php");
            ?>

            <div class="form-group col">
                <label for="t_tipo" class="col-form-label">Tipo de transacción</label>
                <select id="t_tipo" class="form-control" required>
                    <option value="1">Inversión</option>
                    <option value="2">Gasto</option>
                    <option value="3">Venta</option>
                </select>
            </div>

            <div id="categoriasContainer" class="flex flex-col text-center">
                <!-- El contenedor donde se llenarán las categorías -->
            </div>


            <!-- Scripts -->
            <script src="../js/jquery.min.js"></script>
            <script src="../js/categorias.js"></script>

        </div>


        </div>
        </div>

    </body>

    </html>

<?php
} else {

    header('location: ../vista/index.php');
}
?>