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

    function obtener_datos($id){
        $sql = "SELECT * FROM usuario where correo=:correo and contrasena=:pass";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id));
        $this->objetos = $query->fetchAll();
        return $this->objetos;
    }

    function editar($id_usuario,$telefono,$residencia,$correo,$sexo,$adicional){
        $sql="UPDATE usuario SET telefono_us=:telefono, residencia_us=:residencia, correo_us=:correo, sexo_us=:sexo, adicional_us=:adicional where id_usuario=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id_usuario,'telefono'=>$telefono, 'residencia'=>$residencia, 'correo'=>$correo, 'sexo'=>$sexo, 'adicional'=>$adicional));

    }
}
?>