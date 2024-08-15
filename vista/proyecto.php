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
    <title>Proyecto</title>
</head>

<body>
    <h1>Detalles del Proyecto</h1>
    <h1 id="p_nombre"></h1>
    <div id="id-proyect" data-id="<?php echo $proyectoId ?>"></div>
    <h2>------------Presupuesto-------------------</h2>
    <p>Presupuesto inicial:</p>
    <p id="p_presupuesto_inicial"></p>
    <p>Presupuesto actual:</p>
    <p id="p_presupuesto_actual"></p>

    <h2>------------Transacciones-------------------</h2>
    <div class="transaccion"></div>
    <!--
    <p id="t_id"></p>
    <p id="t_presupuesto"></p>
    <p id="t_fecha"></p>
    <p id="t_descripcion"></p>
    <p id="t_tipo"></p>
     Mostrar más detalles del proyecto aquí -->
    <script src="../js/jquery.min.js"></script>
    <script src="../js/datos_proyecto.js"></script>
    <script src="../js/lista_transacciones.js"></script>
</body>

</html>