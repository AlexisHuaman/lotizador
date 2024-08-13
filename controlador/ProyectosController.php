<?php
include_once '../modelo/proyecto.php';
session_start();

$funcion = $_POST['funcion'];
if ($funcion == "buscar_proyectos_by_user") {
    $proyecto = new proyecto();
    $proyecto->listarProyectos($_SESSION["id_usuario"]);
    echo json_encode($proyecto->objeto);
}
