<?php
include_once 'conexion.php';

class transaccion{
    var $objeto;
    public $acceso = null;

    public function __construct()
    {
        $db = new conexion();
        $this->acceso = $db->pdo;
    }

    function insertar($t_presupuesto, $t_fecha, $t_descripcion, $t_pro, $t_tipo){
        $sql = "INSERT INTO transaccion (presupuesto, fecha, descripcion, proyecto_id, tipo_transaccion_id)
                VALUE (:t_presupuesto, :t_fecha, :t_descripcion, :t_pro, :t_tipo";
        $query = $this->acceso->prepare($sql);
        $query->execute([':t_presupuesto'=>$t_presupuesto, ':t_fecha'=>$t_fecha, ':t_descripcion'=>$t_descripcion, ':t_pro'=>$t_pro, ':t_tipo'=>$t_tipo]);
        $this->objeto = $query->fetchAll();
        return $this->objeto;
    }
}
?>