<?php
include_once 'conexion.php';

class transaccion
{
    var $objeto;
    public $acceso = null;

    public function __construct()
    {
        $db = new conexion();
        $this->acceso = $db->pdo;
    }

    function crear_categoria($nombreCategoria, $tipoCategoria)
    {
        $sql = "INSERT INTO categoria (nombre, auxiliar_tipo)
                VALUES (:nombreCategoria, :tipoCategoria)";
        $query = $this->acceso->prepare($sql);
        $query->execute([":nombreCategoria" => $nombreCategoria, ":tipoCategoria" => $tipoCategoria]);
        $this->objeto = $query->fetchAll();
        return $this->objeto;
    }

    function categoria_transaccion($tipo)
    {
        $sql = "SELECT * FROM categoria WHERE auxiliar_tipo = :tipo";
        $query = $this->acceso->prepare($sql);
        $query->execute([':tipo' => $tipo]);
        $this->objeto = $query->fetchAll(PDO::FETCH_ASSOC);
    }

    function obtenerTransaccionesPorCategoria($ID)
    {
        $sql = "SELECT * FROM transaccion WHERE categoria_id = :tipo";
        $query = $this->acceso->prepare($sql);
        $query->execute([':tipo' => $ID]);
        $this->objeto = $query->fetchAll(PDO::FETCH_ASSOC);
    }

    function insertar($t_presupuesto, $t_fecha, $t_descripcion, $t_pro, $t_tipo)
    {
        $sql = "INSERT INTO transaccion (presupuesto, fecha, descripcion, proyecto_id, tipo_transaccion_id)
                VALUES (:t_presupuesto, :t_fecha, :t_descripcion, :t_pro, :t_tipo)";
        $query = $this->acceso->prepare($sql);
        $query->execute([":t_presupuesto" => $t_presupuesto, ":t_fecha" => $t_fecha, ":t_descripcion" => $t_descripcion, ":t_pro" => $t_pro, ":t_tipo" => $t_tipo]);
        $this->objeto = $query->fetchAll();
        return $this->objeto;
    }
}
