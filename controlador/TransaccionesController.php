<?php
include_once '../modelo/transaccion.php';
session_start();

if (isset($_POST['funcion'])) {
    $funcion = $_POST['funcion'];
} else {
    $funcion = '';
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
} else {
    // Retornar un error si la función no es reconocida
    echo json_encode("funcion_no_valida");
}