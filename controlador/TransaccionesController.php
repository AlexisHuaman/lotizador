<?php
include_once '../modelo/proyecto.php';
session_start();

if ($funcion == "editar_pre") {
    $id = $_POST["id"];
    $proyecto = new proyecto();
    $proyecto->editar_pre($id);
    echo json_encode($proyecto->objeto);
}