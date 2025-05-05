<?php
require_once('model/conexion.php');

class Bien extends Conexion
{
    private $data;

    public function __construct()
    {
        parent::__construct();
        $this->conex = parent::Conex();
        $this->data = array();
    }

    public function set_datos($datos)
    {
        $this->data = $datos;
    }

    private function Registrar()
    {
        $query = "INSERT INTO bien (codigo_bien, tipo_bien, estado, ci_responsable, id_oficina, estatus) 
                  VALUES (:codigo_bien, :tipo_bien, :estado, :ci_responsable, :id_oficina, :estatus)";
        $stmt = $this->conex->prepare($query);
        $stmt->bindParam(':codigo_bien', $this->data['codigo_bien']);
        $stmt->bindParam(':tipo_bien', $this->data['tipo_bien']);
        $stmt->bindParam(':estado', $this->data['estado']);
        $stmt->bindParam(':ci_responsable', $this->data['ci_responsable']);
        $stmt->bindParam(':id_oficina', $this->data['id_oficina']);
        $stmt->bindParam(':estatus', $this->data['estatus']);
        return $stmt->execute();
    }

    private function Consultar()
    {
        $query = "SELECT b.codigo_bien, b.tipo_bien, b.estado, b.ci_responsable, b.id_oficina, b.estatus, 
                         e.nombre AS responsable, o.nombre AS oficina
                  FROM bien AS b
                  LEFT JOIN empleado AS e ON b.ci_responsable = e.cedula
                  LEFT JOIN oficina AS o ON b.id_oficina = o.id_oficiona";
        $stmt = $this->conex->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    private function Modificar()
    {
        $query = "UPDATE bien SET 
                  tipo_bien = :tipo_bien, 
                  estado = :estado, 
                  ci_responsable = :ci_responsable, 
                  id_oficina = :id_oficina, 
                  estatus = :estatus 
                  WHERE codigo_bien = :codigo_bien";
        $stmt = $this->conex->prepare($query);
        $stmt->bindParam(':tipo_bien', $this->data['tipo_bien']);
        $stmt->bindParam(':estado', $this->data['estado']);
        $stmt->bindParam(':ci_responsable', $this->data['ci_responsable']);
        $stmt->bindParam(':id_oficina', $this->data['id_oficina']);
        $stmt->bindParam(':estatus', $this->data['estatus']);
        $stmt->bindParam(':codigo_bien', $this->data['codigo_bien']);
        return $stmt->execute();
    }

    private function Eliminar()
    {
        $query = "DELETE FROM bien WHERE codigo_bien = :codigo_bien";
        $stmt = $this->conex->prepare($query);
        $stmt->bindParam(':codigo_bien', $this->data['codigo_bien']);
        return $stmt->execute();
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
            case "registrar":
                return $this->Registrar();

            case "consultar":
                return $this->Consultar();

            case "modificar":
                return $this->Modificar();

            case "eliminar":
                return $this->Eliminar();

            case "listar_disponibles":
                return $this->listarBienesDisponibles(
                    $peticion['excluir_bien'] ?? null
                );

            default:
                return false;
        }
    }
}
?>
