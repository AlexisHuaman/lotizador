<?php
include_once 'conexion.php';

class proyecto{
    var $objeto;
    public $acceso = null;

    public function __construct()
    {
        $db = new conexion();
        $this->acceso = $db->pdo;
    }
    
    function listarProyectos($user_id){
        $sql = "SELECT * FROM proyecto WHERE usuario_id=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute([':id'=>$user_id]);
        $this->objeto = $query->fetchAll();
        return $this->objeto;
    }
    function ingresar_proyecto($name_pro){
        $sql = "SELECT * FROM proyecto WHERE nombre=:name_pro";
        $query = $this->acceso->prepare($sql);
        $query->execute([':name_pro'=>$name_pro]);
        $this->objeto = $query->fetchAll();
        return $this->objeto;
        echo "Proyecto: ". $objeto->nombre;
    }
}
?>