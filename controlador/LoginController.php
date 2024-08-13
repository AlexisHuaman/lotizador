<?php
include_once '../modelo/usuario.php';
session_start();
if(!empty($_SESSION['id_usuario'])){
    header('location: ../vista/inicio.php');
}
else{
    $user = $_POST['user'];
    $pass = $_POST['pass'];
    $usuario = new usuario();

    $usuario->logearse($user,$pass);
    if(!empty($usuario->objetos)){
        foreach($usuario->objetos as $objeto){
            $_SESSION['id_usuario'] = $objeto->id;
            $_SESSION['nombre_usuario'] = $objeto->nombres;
            $_SESSION['rol'] = $objeto->rol;
        }
        header('location: ../vista/inicio.php');
    }
}
echo 'Llega hasta controlador/longincotroller';
?>