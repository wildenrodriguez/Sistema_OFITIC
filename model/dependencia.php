<?php
require_once "model/conexion.php";
class Dependencia extends Conexion
{

    private $id;
    private $nombre;
    private $id_ente;

    public function __construct()
    {

        $this->conex = new Conexion("sistema");
        $this->conex = $this->conex->Conex();
    }

    public function set_id($id)
    {
        $this->id = $id;
    }

    public function set_nombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public function set_id_ente($id_ente)
    {
        $this->id_ente = $id_ente;
    }

    public function get_id()
    {
        return $this->id;
    }

    public function get_nombre()
    {
        return $this->nombre;
    }

    public function get_id_ente()
    {
        return $this->id_ente;
    }


    private function Validar()
    {
        $dato = [];

        try {
            $this->conex->beginTransaction();
            $query = "SELECT * FROM dependencia WHERE id = :id";

            $stm = $this->conex->prepare($query);
            $stm->bindParam(":id", $this->id);
            $stm->execute();
            if ($stm->rowCount() > 0) {
                $dato['arreglo'] = $stm->fetch(PDO::FETCH_ASSOC);
                $dato['bool'] = 1;
            } else {
                $dato['bool'] = 0;
            }
            $this->conex->commit();

        } catch (PDOException $e) {
            $this->conex->rollBack();
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
                $this->conex->beginTransaction();
                $query = "INSERT INTO dependencia(id, id_ente, nombre)
                VALUES (NULL, :id_ente, :nombre)";

                $stm = $this->conex->prepare($query);
                $stm->bindParam(":nombre", $this->nombre);
                $stm->bindParam(":id_ente", $this->id_ente);
                $stm->execute();
                $dato['resultado'] = "registrar";
                $dato['estado'] = 1;
                $dato['mensaje'] = "Se registró la dependencia exitosamente";
                $this->conex->commit();
            } catch (PDOException $e) {
                $this->conex->rollBack();
                $dato['resultado'] = "error";
                $dato['estado'] = -1;
                $dato['mensaje'] = $e->getMessage();
            }
        } else {
            $this->conex->rollBack();
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
            $this->conex->beginTransaction();
            $query = "UPDATE dependencia SET nombre = :nombre, id_ente = :id_ente
                WHERE id = :id";

            $stm = $this->conex->prepare($query);
            $stm->bindParam(":id", $this->id);
            $stm->bindParam(":nombre", $this->nombre);
            $stm->bindParam(":id_ente", $this->id_ente);
            $stm->execute();
            $dato['resultado'] = "modificar";
            $dato['estado'] = 1;
            $dato['mensaje'] = "Se modificaron los datos de la dependencia exitosamente";
            $this->conex->commit();
        } catch (PDOException $e) {
            $this->conex->rollBack();
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
                $query = "UPDATE dependencia SET estatus = 0 WHERE id = :id";

                $stm = $this->conex->prepare($query);
                $stm->bindParam(":id", $this->id);
                $stm->execute();
                $dato['resultado'] = "eliminar";
                $dato['estado'] = 1;
                $dato['mensaje'] = "Se eliminó el dependencia exitosamente";
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
            $query = "SELECT dependencia.id, dependencia.id_ente,
            dependencia.nombre, ente.nombre AS ente
            FROM dependencia
            INNER JOIN ente ON dependencia.id_ente = ente.id
            WHERE dependencia.estatus = 1";

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

            case 'validar':
                $validar = $this->Validar();
                $this->Cerrar_Conexion($this->conex, $none);
                return $validar;

            case 'consultar':
                return $this->Consultar();

            case 'actualizar':
                return $this->Actualizar();

            case 'eliminar':
                return $this->Eliminar();

            default:
                return "Operacion: " . $peticion['peticion'] . " no valida";

        }

    }
}
?>