<?php
include_once 'conexion.php';
class usuario{
    var $objetos;
    public $acceso = NULL;
    public function __construct()
    {
        $db = new conexion();
        $this->acceso = $db->pdo;
    }

    function logearse($correo,$contrasena){
        $sql = "SELECT u.*, tr.nombre as rol FROM usuario as u inner join tipo_rol as tr on u.rol_id=tr.id where u.correo=:i_correo and u.contrasena=:i_contrasena";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':i_correo'=>$correo,':i_contrasena'=>$contrasena));
        $this->objetos = $query->fetchAll();
        return $this->objetos;
    }
}
echo 'Llega hasta modelo/usuario';
?>