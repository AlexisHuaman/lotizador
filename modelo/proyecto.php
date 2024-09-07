<?php
include_once 'conexion.php';

class proyecto
{
    var $objeto;
    public $acceso = null;

    public function __construct()
    {
        $db = new conexion();
        $this->acceso = $db->pdo;
    }

    function listarProyectos($user_id)
    {
        $sql = "SELECT * FROM proyecto WHERE usuario_id=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute([':id' => $user_id]);
        $this->objeto = $query->fetchAll();
        return $this->objeto;
    }
    function detalle_proyecto($id_pro)
    {
        $sql = "SELECT * FROM proyecto WHERE id=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute([':id' => $id_pro]);
        $this->objeto = $query->fetch();
        return $this->objeto;
    }

    function listarTransacciones($id_pro)
    {
        $sql = "SELECT * FROM proyecto JOIN transaccion JOIN tipo_transaccion ON transaccion.tipo_transaccion_id = tipo_transaccion.id WHERE usuario_id=:id ";
        $query = $this->acceso->prepare($sql);
        $query->execute([':id' => $id_pro]);
        $this->objeto = $query->fetchAll();
        return $this->objeto;
    }

    function listarTransaccionesxproyecto($id_pro)
    {
        $sql = "SELECT * FROM transaccion JOIN tipo_transaccion ON transaccion.tipo_transaccion_id = tipo_transaccion.id WHERE proyecto_id=:id ";
        $query = $this->acceso->prepare($sql);
        $query->execute([':id' => $id_pro]);
        $this->objeto = $query->fetchAll();
        return $this->objeto;
    }
    function presupuesto($id_pro, $p_presupuesto)
    {
        $sql = "UPDATE proyecto SET presupuesto=:p_presupuesto WHERE id=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id' => $id_pro, ':p_presupuesto' => $p_presupuesto));
    }
}
