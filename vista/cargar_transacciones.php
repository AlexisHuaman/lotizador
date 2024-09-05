<?php
// Iniciar sesión y conectar a la base de datos
session_start();
require_once('../modelo/conexion.php');

if (!empty($_POST['id_proyecto']) && !empty($_POST['fecha_inicio']) && !empty($_POST['fecha_fin'])) {
    $id_proyecto = $_POST['id_proyecto'];
    $fecha_inicio = $_POST['fecha_inicio'];
    $fecha_fin = $_POST['fecha_fin'];

    $conn = new conexion();
    $pdo = $conn->pdo;

    // Consulta para obtener las transacciones filtradas
    $sql = "SELECT * FROM transaccion JOIN tipo_transaccion ON transaccion.tipo_transaccion_id = tipo_transaccion.id WHERE proyecto_id = :id_proyecto AND fecha BETWEEN :fecha_inicio AND :fecha_fin";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id_proyecto', $id_proyecto, PDO::PARAM_INT);
    $stmt->bindParam(':fecha_inicio', $fecha_inicio);
    $stmt->bindParam(':fecha_fin', $fecha_fin);
    $stmt->execute();
    $transacciones = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($transacciones);
} else {
    echo json_encode(['no hay sistema']);
}
