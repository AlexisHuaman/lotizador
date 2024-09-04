<?php
session_start();
$proyectoId = $_GET['id'];
if (!empty($_SESSION['id_usuario'])) {
    // Obtener el ID del proyecto desde la URL

    //$_SESSION['id_proyecto'] = $proyectoId;
    // Usar el ID para cargar la información del proyecto desde la base de datos
    // ...
    // Mostrar la información del proyecto en la página
?>

    <!DOCTYPE html>
    <html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/main.css">
        <link rel="stylesheet" href="../css/style.css">
        <link rel="stylesheet" href="../css/style_proyecto.css">
        <link rel="stylesheet" href="../css/style_filtro.css">

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <style>
            /* Puedes agregar estilo para que la transición sea más suave */
            #editFormContainer {
                display: none;
                margin-top: 20px;
            }
        </style>
        <script src="https://cdn.tailwindcss.com"></script>

        <title>Proyecto</title>

    </head>

    <body>
        <div id="id-proyect" data-id="<?php echo $proyectoId ?>"></div>


        <!-- Nombre del proyecto -->
        <h1 id="p_nombre">Nombre del Proyecto</h1>

        <!-- Presupuesto del proyecto con etiqueta -->
        <div class="presupuesto-container">
            <span class="presupuesto-label">Presupuesto del Proyecto: </span>
            <h1 id="presupuesto_transiciones">Presupuesto Final: </h1>
        </div>

        <!--
        <div class="filtro">
            <label for="t_presupuesto" class="col-form-label">Filtrar transacciones</label>
            <select id="filtro" class="form-control" required>
                <option value="1">Tipo de transaccion</option>
                <option value="2">Monto</option>
                <option value="3">Fecha</option>
            </select>
            <div class="buttons">
                <button class="edit_btn" id="filtro_btn">Seleccionar</button>
            </div>

            <div id="editFormContainer">
                <form id="editForm">
                    <div class="form-group">
                        <label for="edit_nombre">Fecha/Monto inicial:</label>
                        <input type="text" id="f_inicial" name="edit_nombre">
                    </div>
                    <div class="form-group">
                        <label for="edit_correo">Fecha/Monto final:</label>
                        <input type="email" id="f_final" name="edit_correo">
                    </div>
                    <div class="form-group">
                        <label for="edit_telefono">Tipo de transaccion:</label>
                        <select id="f_tipo" class="form-control" required>
                            <option value="1">Inversión</option>
                            <option value="2">Gasto</option>
                            <option value="3">Venta</option>
                        </select>
                    </div>
                    <button type="submit" class="save_btn" id="save_btn">Filtrar</button>
                </form>
            </div>
        </div>
        -->
        <div class="filtro">
            <form action="descargar_reporte.php?id=<?php echo $proyectoId ?>" method="post" accept-charset="utf-8">
                <div class="row align-items-center">
                    <div class="col">
                        <input type="date" name="fecha_inicio" class="form-control" placeholder="Fecha inicio">
                    </div>
                    <div class="col">
                        <input type="date" name="fecha_fin" class="form-control" placeholder="Fecha fin">
                    </div>
                    <div class="col">
                        <button class="btn btn-danger mb-2" id="filtrar-reporte">Filtrar</button>
                    </div>
                    <div class="col">
                        <button type="submit" class="btn btn-danger mb-2" id="descargar-reporte">Descargar reporte</button>
                    </div>

                    <input type="hidden" name="tabla_transacciones" id="tabla-transacciones" value="">

                </div>
            </form>
        </div>



        <script>
            $(document).ready(function() {
                $('#filtrar-reporte').click(function() {
                    $('#editFormContainer').slideDown(); // Muestra el formulario con una animación suave
                });
            });
        </script>


        <div id="lista_transacciones" class="max-w-[800px] mx-auto mt-8">
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
                        </tr>
                    </thead>
                    <tbody id="detalle_transaccion">
                        <!-- Los datos se insertarán aquí -->
                    </tbody>
                </table>
            </div>
            <nav>
                <ul class="pagination justify-end flex gap-3 items-start mt-8">
                    <li class="page-item  bg-white rounded text-sm font-bold" id="prevPage"><a class="page-link bg-white rounded text-sm font-bold" href="#">Previous</a></li>
                    <!-- Páginas generadas dinámicamente -->
                    <li class="page-item" id="nextPage"><a class="page-link bg-white rounded text-sm font-bold" href="#">Next</a></li>
                </ul>
            </nav>
        </div>



        <form id="form-transaccion" class="form-horizontal">
            <div class="form-row">
                <div class="form-group col">
                    <label for="t_presupuesto" class="col-form-label">Presupuesto</label>
                    <input type="number" step="0.01" id="t_presupuesto" class="form-control" required>
                </div>

                <div class="form-group col">
                    <label for="t_fecha" class="col-form-label">Fecha</label>
                    <input type="text" id="t_fecha" class="form-control" required>
                </div>

                <div class="form-group col">
                    <label for="t_descripcion" class="col-form-label">Descripción</label>
                    <input type="text" id="t_descripcion" class="form-control" required>
                </div>

                <div class="form-group col">
                    <label for="t_tipo" class="col-form-label">Tipo de transacción</label>
                    <select id="t_tipo" class="form-control" required>
                        <option value="1">Inversión</option>
                        <option value="2">Gasto</option>
                        <option value="3">Venta</option>
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-sm-12 text-right">
                    <button type="submit" class="btn btn-block btn-outline-success">Insertar</button>
                </div>
            </div>
        </form>

        <!-- Formulario de edición, inicialmente oculto -->



        Mostrar más detalles del proyecto aquí
        <script src="../js/jquery.min.js"></script>
        <script src="../js/datos_proyecto.js"></script>
        <script src="../js/lista_transacciones.js"></script>
    </body>

    </html>

<?php
} else {

    header('location: ../vista/index.php');
}
?>