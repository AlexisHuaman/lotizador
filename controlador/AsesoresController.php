<?php
include_once '../modelo/asesor.php';
session_start();

if (isset($_POST['funcion'])) {
    $funcion = $_POST['funcion'];
} else {
    $funcion = '';
}

if ($funcion == "lista_asesores") {
    $id = $_POST['id'];
    $asesor = new asesor();
    $asesor->lista_asesores($id);
    echo json_encode($asesor->objeto);
}

if ($funcion == "crear_categoria") {
    $nombreCategoria = $_POST['nombreCategoria'];
    $tipoCategoria = $_POST['tipoCategoria'];
    $transaccion = new transaccion();
    $transaccion->crear_categoria($nombreCategoria, $tipoCategoria);
    echo json_encode("Categoria_creada");
}
