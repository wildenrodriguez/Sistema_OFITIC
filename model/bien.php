<?php
require_once('model/conexion.php');

class Bien extends Conexion
{
    public function __construct()
    {
        parent::__construct();
        $this->conex = parent::Conex();
    }

    private function listarBienesDisponibles($excluirBien = null)
    {
        $query = "SELECT b.codigo_bien, b.tipo_bien 
             FROM bien b
             WHERE b.estatus = 1 
             AND b.codigo_bien NOT IN (
                 SELECT e.nro_bien 
                 FROM equipo e 
                 WHERE e.nro_bien IS NOT NULL
             )";

        // Si estamos editando y queremos incluir el bien actual
        if ($excluirBien) {
            $query .= " OR b.codigo_bien = :excluir_bien";
        }

        $stmt = $this->conex->prepare($query);

        if ($excluirBien) {
            $stmt->bindParam(':excluir_bien', $excluirBien);
        }

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function Transaccion($peticion)
    {
        switch ($peticion["peticion"]) {
            case "listar_disponibles":
                return $this->listarBienesDisponibles(
                    $peticion['excluir_bien'] ?? null
                );

            default:
                return false;
        }
    }
}
