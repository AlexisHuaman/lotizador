<?php
include_once '../modelo/transaccion.php';
session_start();

if (isset($_POST['funcion'])) {
    $funcion = $_POST['funcion'];
} else {
    $funcion = '';
}

if ($funcion == "categoria_transaccion") {
    // Asegurarse de que recibimos el tipo de transacción del frontend
    $tipo = isset($_POST['tipo']) ? $_POST['tipo'] : null;
    if ($tipo !== null) {
        $transaccion = new transaccion();
        // Pasar el tipo de transacción a la función del modelo
        $transaccion->categoria_transaccion($tipo);
        echo json_encode($transaccion->objeto);
    } else {
        echo json_encode([]);
    }
}

if ($funcion == "insertar_transaccion") {
    // Recoger los datos enviados por el formulario
    $presupuesto = $_POST["presupuesto"];
    $fecha = $_POST["fecha"];
    $descripcion = $_POST["descripcion"];
    $tipo = $_POST["tipo"];
    $proyecto_id = $_POST["id"]; // Obtener el ID del proyecto

    // Crear una instancia de la clase Transaccion
    $transaccion = new Transaccion();

    // Llamar al método insertar en la clase Transaccion
    $transaccion->insertar($presupuesto, $fecha, $descripcion, $proyecto_id, $tipo);

    // Retornar una respuesta al cliente
    echo json_encode("insertado");
}
