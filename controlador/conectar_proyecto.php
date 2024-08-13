<?php
echo 'llego hasta controlador/conectar_proyecto';
include_once '../modelo/proyecto.php';
session_start();
$proyecto = new proyecto();
$name_pro = $_POST['name_pro'];

$proyecto->ingresar_proyecto($name_pro);
echo ' regresa de ingresar_proyecto.php';

?>