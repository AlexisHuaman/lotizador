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
                    <option value="3">Ingreso</option>
                </select>
            </div>

            <!-- Botón flotante para crear una nueva categoría -->
            <button id="crearCategoriaBtn" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4">
                Crear nueva categoría
            </button>

            <!-- Formulario para crear nueva categoría -->
            <div id="nuevaCategoriaForm" class="mt-4 p-4 bg-gray-100 rounded" style="display: none;">
                <h3 class="text-lg font-semibold">Nueva Categoría</h3>

                <div class="form-group col mt-2">
                    <label for="nombreCategoria" class="col-form-label">Nombre de la categoría</label>
                    <input type="text" id="nombreCategoria" class="form-control" placeholder="Nombre" required>
                </div>

                <div class="form-group col mt-2">
                    <label for="tipoCategoria" class="col-form-label">Tipo de transacción</label>
                    <select id="tipoCategoria" class="form-control" required>
                        <option value="1">Inversión</option>
                        <option value="2">Gasto</option>
                        <option value="3">Ingreso</option>
                    </select>
                </div>

                <button id="submitCategoria" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 mt-4">
                    Crear Categoría
                </button>
            </div>


            <div id="categoriasContainer" class="flex flex-col text-center">
                <!-- El contenedor donde se llenarán las categorías -->
            </div>

            <div id="graficoContainer" class="fixed top-0 right-0 bg-gray-100 p-4 hidden">
            <!-- Aquí se imprimirá el gráfico -->
            <canvas id="graficoCanvas"></canvas>
            </div>

            <!-- Cargamos la librería Chart.js -->
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


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