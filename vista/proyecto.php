<?php
// Obtener el ID del proyecto desde la URL
$proyectoId = $_GET['id'];
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
    <title>Proyecto</title>

</head>

<body>
    <div id="id-proyect" data-id="<?php echo $proyectoId ?>"></div>


    <!--<div class="transaccion"></div>-->
    
    <div id="detalle_proyecto"></div>
    <h2>------------Transacciones-------------------</h2>
    <div class="table-container">
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
    <!--<p id="t_id"></p>
    <p id="t_presupuesto"></p>
    <p id="t_fecha"></p>
    <p id="t_descripcion"></p>
    <p id="t_tipo"></p>-->


    <form id="form-transaccion" class="form-horizontal">
        <div class="form-group row">
            <label for="t_presupuesto" class="col-sm-2 col-form-label">Presupuesto</label>
            <div class="col-sm-10">
                <input type="number" step="0.01" id="t_presupuesto" class="form-control" required>
            </div>
        </div>

        <div class="form-group row">
            <label for="t_fecha" class="col-sm-2 col-form-label">Fecha</label>
            <div class="col-sm-10">
                <input type="text" id="t_fecha" class="form-control" required>
            </div>
        </div>

        <div class="form-group row">
            <label for="t_descripcion" class="col-sm-2 col-form-label">Descripción</label>
            <div class="col-sm-10">
                <input type="text" id="t_descripcion" class="form-control" required>
            </div>
        </div>

        <div class="form-group row">
            <label for="t_tipo" class="col-sm-2 col-form-label">Tipo de transacción</label>
            <div class="col-sm-10">
                <input type="number" id="t_tipo" class="form-control" required>
            </div>
        </div>

        <div class="form-group row">
            <div class="offset-sm-2 col-sm-10 float-right">
                <button type="submit" class="btn btn-block btn-outline-success">Insertar</button>
            </div>
        </div>
    </form>
    Mostrar más detalles del proyecto aquí
    <script src="../js/jquery.min.js"></script>
    <script src="../js/datos_proyecto.js"></script>
    <script src="../js/lista_transacciones.js"></script>
</body>

</html>