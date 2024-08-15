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
    <div>Presupuesto
        <h1>Presupuesto inicial:</h1><h1 id="p_presupuesto_inicial"></h1>
        <h1>Presupuesto actual:</h1><h1 id="p_presupuesto_actual"></h1>
    </div>
    <h2>------------Transacciones-------------------</h2>
    <!-- Mostrar más detalles del proyecto aquí -->
    <script src="../js/jquery.min.js"></script>
    <script src="../js/datos_proyecto.js"></script>
    <script src="../js/lista_transacciones.js"></script>
</body>

</html>