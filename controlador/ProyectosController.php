<?php
include_once '../modelo/proyecto.php';
session_start();

$funcion = $_POST['funcion'];
if ($funcion == "buscar_proyectos_by_user") {
    $proyecto = new proyecto();
    $proyecto->listarProyectos($_SESSION["id_usuario"]);
    echo json_encode($proyecto->objeto);
}

if ($funcion == "detalles_pro") {
    $id = $_POST["id"];
    $proyecto = new proyecto();
    $proyecto->detalle_proyecto($id);
    echo json_encode($proyecto->objeto);
}

if ($funcion == "lista_transacciones") {
    // Verifica si 'id' está presente en el POST
    if (isset($_POST["id"])) {
        $id = $_POST["id"];
        
        try {
            // Asegúrate de que la clase proyecto y el método listarTransacciones estén bien definidos
            $proyecto = new proyecto();
            $transacciones = $proyecto->listarTransacciones($id);
            
            // Envía la respuesta en formato JSON
            echo json_encode($transacciones);
        } catch (Exception $e) {
            // Si ocurre algún error, envía un mensaje de error en formato JSON
            echo json_encode(['error' => $e->getMessage()]);
        }
    } else {
        // Si 'id' no está presente en el POST, envía un error
        echo json_encode(['error' => 'ID no proporcionado']);
    }
}
