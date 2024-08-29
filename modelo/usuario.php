<?php
include_once 'conexion.php';
class usuario{
    var $objetos;
    public $acceso = null;
    public function __construct()
    {
        $db = new conexion();
        $this->acceso = $db->pdo;
    }
    function logearse($correo, $pass){
        $sql = "SELECT * FROM usuario where correo=:correo and contrasena=:pass";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':correo'=>$correo, ':pass'=>$pass));
        $this->objetos = $query->fetchAll();
        return $this->objetos;
    }

    function obtener_datos($id_user){
        $sql = "SELECT * FROM usuario where id=:id_user";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id_user'=>$id_user));
        $this->objetos = $query->fetchAll();
        return $this->objetos;
    }

    function editar($id_usuario, $nombre, $telefono, $correo){
        $sql="UPDATE usuario SET telefono=:telefono, correo=:correo, nombres=:nombres where id=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id_usuario,'telefono'=>$telefono, 'nombres'=>$nombre, 'correo'=>$correo));

    }
}
?>