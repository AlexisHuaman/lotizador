<?php
include_once '../modelo/usuario.php';
$usuario = new usuario();

if ($_POST['funcion'] == 'buscar_usuario') {
    $json = array();
    $usuario->obtener_datos($_POST['dato']);
    foreach ($usuario->objetos as $objeto) {
        $json[] = array(
            'u_nombre' => $objeto->nombres,
            'u_correo' => $objeto->correo,
            'u_telefono' => $objeto->telefono,
        );
    }
    $jsonstring = json_encode($json[0]);
    echo $jsonstring;
}

if ($_POST['funcion'] == 'capturar_datos') {
    $json = array();
    $id_usuario = $_POST['id_usuario'];
    $usuario->obtener_datos($id_usuario);
    foreach ($usuario->objetos as $objeto) {
        $json[] = array(
            'u_nombre' => $objeto->nombres,
            'u_correo' => $objeto->correo,
            'u_telefono' => $objeto->telefono,
        );
    }
    $jsonstring = json_encode($json[0]);
    echo $jsonstring;
}

if ($_POST['funcion'] == 'editar_usuario') {
    $id_usuario = $_POST['id_usuario'];
    $telefono = $_POST['telefono'];
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $usuario->editar($id_usuario, $nombre, $telefono, $correo);
    echo 'editado';
}
