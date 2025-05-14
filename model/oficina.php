<?php
require_once "model/conexion.php";
class Oficina extends Conexion
{
    private $id;
    private $id_piso;
    private $nombre;

    public function __construct()
    {
        $this->conex = new Conexion();
        $this->conex = $this->conex->Conex();
    }

    public function set_id($id)
    {
        $this->id = $id;
    }

    public function set_id_piso($id_piso)
    {
        $this->id_piso = $id_piso;
    }

    public function set_nombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public function get_id()
    {
        return $this->id;
    }

    public function get_id_piso()
    {
        return $this->id_piso;
    }

    public function get_nombre()
    {
        return $this->nombre;
    }

    private function Validar()
    {
        $dato = [];
        try {
            $query = "SELECT * FROM oficina WHERE id_oficiona = :id";
            $stm = $this->conex->prepare($query);
            $stm->bindParam(":id", $this->id);
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
        $bool = $this->Validar();
        $dato = [];

        if ($bool['bool'] == 0) {
            try {
                $query = "INSERT INTO oficina(id_piso, nombre, estatus) VALUES (:id_piso, :nombre, :estatus)";
                $stm = $this->conex->prepare($query);
                $stm->bindParam(":id_piso", $this->id_piso);
                $stm->bindParam(":nombre", $this->nombre);
                $stm->bindValue(":estatus", 1);
                $stm->execute();
                $dato['resultado'] = "registrar";
                $dato['estado'] = 1;
                $dato['mensaje'] = "Se registró con éxito";
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
        $bool = $this->Validar();

        if ($bool['bool'] == 0) {
            try {
                $query = "UPDATE oficina SET id_piso = :id_piso, nombre = :nombre WHERE id_oficiona = :id";
                $stm = $this->conex->prepare($query);
                $stm->bindParam(":id", $this->id);
                $stm->bindParam(":id_piso", $this->id_piso);
                $stm->bindParam(":nombre", $this->nombre);
                $stm->execute();
                $dato['resultado'] = "actualizar";
                $dato['estado'] = 1;
                $dato['mensaje'] = "Se actualizó el registro con éxito";
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

    private function Eliminar()
    {
        $dato = [];
        $bool = $this->Validar();

        if ($bool['bool'] == 0) {
            try {
                $query = "UPDATE oficina SET estatus = 0 WHERE id_oficiona = :id";
                $stm = $this->conex->prepare($query);
                $stm->bindParam(":id", $this->id);
                $stm->execute();
                $dato['resultado'] = "eliminar";
                $dato['estado'] = 1;
                $dato['mensaje'] = "Se eliminó el registro con éxito";
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
            $query = "SELECT oficina.id_oficiona, oficina.id_piso, piso.tipo_piso, oficina.nombre
                      FROM oficina
                      INNER JOIN piso ON oficina.id_piso = piso.id_piso
                      WHERE oficina.estatus = 1";
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

    public function Transaccion($peticion)
    {
        switch ($peticion['peticion']) {
            case 'registrar':
                return $this->Registrar();
            case 'consultar':
                return $this->Consultar();
            case 'actualizar':
                return $this->Actualizar();
            case 'eliminar':
                return $this->Eliminar();
            default:
                return "Operación: " . $peticion['peticion'] . " no válida";
        }
    }
}
?>
