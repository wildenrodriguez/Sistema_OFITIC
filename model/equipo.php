<?php
require_once "model/conexion.php";
class Equipo extends Conexion
{
    private $id_equipo;
    private $tipo_equipo;
    private $serial;
    private $codigo_bien;
    private $id_unidad;

    public function __construct()
    {
        $this->conex = new Conexion("sistema");
        $this->conex = $this->conex->Conex();
    }

    public function set_id_equipo($id_equipo)
    {
        $this->id_equipo = $id_equipo;
    }

    public function set_tipo_equipo($tipo_equipo)
    {
        $this->tipo_equipo = $tipo_equipo;
    }

    public function set_serial($serial)
    {
        $this->serial = $serial;
    }

    public function set_codigo_bien($codigo_bien)
    {
        $this->codigo_bien = $codigo_bien;
    }

    public function set_id_unidad($id_unidad)
    {
        $this->id_unidad = $id_unidad;
    }

    public function get_id_equipo()
    {
        return $this->id_equipo;
    }

    public function get_tipo_equipo()
    {
        return $this->tipo_equipo;
    }

    public function get_serial()
    {
        return $this->serial;
    }

    public function get_codigo_bien()
    {
        return $this->codigo_bien;
    }

    public function get_id_unidad()
    {
        return $this->id_unidad;
    }

    private function Validar()
    {
        $dato = [];

        try {
            $query = "SELECT * FROM equipo WHERE id_equipo = :id";

            $stm = $this->conex->prepare($query);
            $stm->bindParam(":id", $this->id_equipo);
            $stm->execute();

            if ($stm->rowCount() > 0) {
                $dato['arreglo'] = $stm->fetch(PDO::FETCH_ASSOC);
                $dato['bool'] = 1;
            } else {
                $dato['bool'] = 0;
            }
        } catch (PDOException $e) {
            $dato['error'] = $e->getMessage();
        }
        $this->Cerrar_Conexion($none, $stm);
        return $dato;
    }

    private function Registrar()
    {
        $dato = [];
        $bool = $this->Validar();

        if ($bool['bool'] == 0) {
            try {
                $query = "INSERT INTO equipo(id_equipo, tipo_equipo, serial, codigo_bien, id_unidad, estatus) VALUES 
                (NULL, :tipo_equipo, :serial, :codigo_bien, :id_unidad, :estatus)";

                $stm = $this->conex->prepare($query);
                $stm->bindParam(":tipo_equipo", $this->tipo_equipo);
                $stm->bindParam(":serial", $this->serial);
                $stm->bindParam(":codigo_bien", $this->codigo_bien);
                $stm->bindParam(":id_unidad", $this->id_unidad);
                $stm->bindValue(":estatus", 1);
                $stm->execute();
                $dato['resultado'] = "registrar";
                $dato['estado'] = 1;
                $dato['mensaje'] = "Se registró el equipo exitosamente";
            } catch (PDOException $e) {
                $dato['resultado'] = "error";
                $dato['estado'] = -1;
                $dato['mensaje'] = $e->getMessage();
            }
        } else {
            $dato['resultado'] = "error";
            $dato['estado'] = -1;
            $dato['mensaje'] = "Registro duplicado";
        }
        $this->Cerrar_Conexion($this->conex, $stm);
        return $dato;
    }

    private function Actualizar()
    {
        $dato = [];

        try {
            $query = "UPDATE equipo SET tipo_equipo= :tipo_equipo, serial= :serial, codigo_bien= :codigo_bien, 
                     id_unidad= :id_unidad WHERE id_equipo = :id";

            $stm = $this->conex->prepare($query);
            $stm->bindParam(":id", $this->id_equipo);
            $stm->bindParam(":tipo_equipo", $this->tipo_equipo);
            $stm->bindParam(":serial", $this->serial);
            $stm->bindParam(":codigo_bien", $this->codigo_bien);
            $stm->bindParam(":id_unidad", $this->id_unidad);
            $stm->execute();
            $dato['resultado'] = "modificar";
            $dato['estado'] = 1;
            $dato['mensaje'] = "Se modificaron los datos del equipo con éxito";
        } catch (PDOException $e) {
            $dato['estado'] = -1;
            $dato['resultado'] = "error";
            $dato['mensaje'] = $e->getMessage();
        }
        $this->Cerrar_Conexion($this->conex, $stm);
        return $dato;
    }

    private function Eliminar()
    {
        $dato = [];
        $bool = $this->Validar();

        if ($bool['bool'] != 0) {
            try {
                $query = "UPDATE equipo SET estatus = 0 WHERE id_equipo = :id";

                $stm = $this->conex->prepare($query);
                $stm->bindParam(":id", $this->id_equipo);
                $stm->execute();
                $dato['resultado'] = "eliminar";
                $dato['estado'] = 1;
                $dato['mensaje'] = "Se eliminó el equipo exitosamente";
            } catch (PDOException $e) {
                $dato['resultado'] = "error";
                $dato['estado'] = -1;
                $dato['mensaje'] = $e->getMessage();
            }
        } else {
            $dato['resultado'] = "error";
            $dato['estado'] = -1;
            $dato['mensaje'] = "Error al eliminar el registro";
        }
        $this->Cerrar_Conexion($this->conex, $stm);
        return $dato;
    }

    private function Consultar()
    {
        $dato = [];

        try {
            $query = "SELECT e.*, u.nombre_unidad
                     FROM equipo e 
                     JOIN unidad u ON e.id_unidad = u.id_unidad 
                     WHERE u.estatus = 1 AND e.estatus = 1";

            $stm = $this->conex->prepare($query);
            $stm->execute();
            $dato['resultado'] = "consultar";
            $dato['datos'] = $stm->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $dato['resultado'] = "error";
            $dato['mensaje'] = $e->getMessage();
        }
        $this->Cerrar_Conexion($this->conex, $stm);
        return $dato;
    }

    public function ConsultarUnidad()
    {
        $dato = [];

        try {
            $query = "SELECT * FROM unidad WHERE estatus = 1";

            $stm = $this->conex->prepare($query);
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return [];
        }
    }

    public function ConsultarBienes()
    {
        $dato = [];

        try {
            $query = "SELECT b.codigo_bien 
FROM bien b
WHERE b.estatus = 1
AND b.codigo_bien NOT IN (
    SELECT e.codigo_bien 
    FROM equipo e 
    WHERE e.codigo_bien IS NOT NULL
    AND e.estatus = 1
);";

            $stm = $this->conex->prepare($query);
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return [];
        }
    }

    private function ConsultarEliminadas()
    {
        $dato = [];

        try {
            $query = "SELECT e.*, u.nombre_unidad 
                     FROM equipo e 
                     JOIN unidad u ON e.id_unidad = u.id_unidad 
                     WHERE u.estatus = 0 or e.estatus = 0";

            $stm = $this->conex->prepare($query);
            $stm->execute();
            $dato['resultado'] = "consultar_eliminadas";
            $dato['datos'] = $stm->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $dato['resultado'] = "error";
            $dato['mensaje'] = $e->getMessage();
        }
        $this->Cerrar_Conexion($this->conex, $stm);
        return $dato;
    }

    private function Restaurar()
    {
        $dato = [];
        try {
            $query = "UPDATE equipo SET estatus = 1 WHERE id_equipo = :id";

            $stm = $this->conex->prepare($query);
            $stm->bindParam(":id", $this->id_equipo);
            $stm->execute();
            $dato['resultado'] = "restaurar";
            $dato['estado'] = 1;
            $dato['mensaje'] = "Equipo restaurado exitosamente";

            $msg = "(" . $_SESSION['user']['nombre_usuario'] . "), Se restauró el equipo ID: " . $this->id_equipo;
            Bitacora($msg, "Equipo");
        } catch (PDOException $e) {
            $dato['resultado'] = "error";
            $dato['estado'] = -1;
            $dato['mensaje'] = $e->getMessage();
        }
        $this->Cerrar_Conexion($this->conex, $stm);
        return $dato;
    }

    public function Transaccion($peticion)
    {
        switch ($peticion['peticion']) {
            case 'registrar':
                return $this->Registrar();

            case 'consultar':
                return $this->Consultar();

            case 'consultar_eliminadas':
                return $this->ConsultarEliminadas();

            case 'consultar_unidad':
                return $this->ConsultarUnidad();

            case 'consultar_bienes':
                return $this->ConsultarBienes();

            case 'actualizar':
                return $this->Actualizar();

            case 'eliminar':
                return $this->Eliminar();

            case 'restaurar':
                return $this->Restaurar();

            default:
                return "Operacion: " . $peticion['peticion'] . " no valida";
        }
    }
}
