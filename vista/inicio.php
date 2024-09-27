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
        <div class="w-full">
            <!-- Nombre del proyecto -->
            <h1 class="text text-center">Transacciones</h1><br><br>
            <div id="chart-container"></div> <!-- Aquí se agregarán los gráficos -->
            <div id="lista_transacciones" class="w-full mt-8">
                <div class="row mb-3">
                    <div class="flex gap-3">
                        <p class="text-sm font-bold">Items por page</p>
                        <select id="itemsPerPage" class="form-select">
                            <option value="5">5</option>
                            <option value="10">10</option>
                            <option value="15">15</option>
                            <option value="20">20</option>
                            <option value="30">30</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                    </div>
                </div>
                <div class="max-h-[300px] overflow-y-auto">
                    <table>
                        <thead>
                            <tr>
                                <th>Número</th>
                                <th>Tipo</th>
                                <th>Monto</th>
                                <th>Fecha</th>
                                <th>Descripción</th>
                                <th>Proyecto</th>
                                <th>Categoria</th>
                            </tr>
                        </thead>
                        <tbody id="detalle_transaccion">
                            <!-- Los datos se insertarán aquí -->
                        </tbody>
                    </table>
                </div>
                <nav>
                    <ul class="pagination justify-end flex gap-3 items-start mt-8">
                        <li class="page-item  bg-white rounded text-sm font-bold" id="prevPage"><a class="page-link bg-white rounded text-sm font-bold" href="#">Anterior</a></li>
                        <!-- Páginas generadas dinámicamente -->
                        <li class="page-item" id="nextPage"><a class="page-link bg-white rounded text-sm font-bold" href="#">Posterior</a></li>
                    </ul>
                </nav>
            </div>
        </div>
        <!-- Formulario de edición, inicialmente oculto -->
        <script src="../js/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="../js/lista_transacciones.js"></script>
    </body>

    </html>
<?php
} else {
    header('location: ../vista/index.php');
}
?>