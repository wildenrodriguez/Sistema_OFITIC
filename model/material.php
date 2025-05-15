<?php
require_once "model/conexion.php";
class Material extends Conexion
{

    private $id;
    private $lugar;
    private $nombre;
    private $stock;
    private $estatus;

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

    public function set_lugar($lugar)
    {
        $this->lugar = $lugar;
    }

    public function set_stock($stock)
    {
        $this->stock = $stock;
    }

    public function set_estatus($estatus)
    {
        $this->estatus = $estatus;
    }

    public function get_id()
    {
        return $this->id;
    }

    public function get_nombre()
    {
        return $this->nombre;
    }

    public function get_lugar()
    {
        return $this->lugar;
    }

    public function get_stock()
    {
        return $this->stock;
    }

    public function get_estatus()
    {
        return $this->estatus;
    }

    private function Validar()
    {
        $dato = [];

        try {
            $query = "SELECT * FROM material WHERE id = :id";

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
        $dato = [];
        $bool = $this->Validar();

        if ($bool['bool'] == 0) {
            try {
                $query = "INSERT INTO material(lugar, nombre, stock) VALUES 
            (:lugar, :nombre, :stock)";

                $stm = $this->conex->prepare($query);
                $stm->bindParam(":lugar", $this->lugar);
                $stm->bindParam(":nombre", $this->nombre);
                $stm->bindParam(":stock", $this->stock);
                $stm->execute();
                $dato['resultado'] = "registrar";
                $dato['mensaje'] = "Se registro con éxito";
            } catch (PDOException $e) {
                $dato['resultado'] = "error";
                $dato['mensaje'] = $e->getMessage();
            }
        } else {
            $dato['resultado'] = "error";
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
                $query = "UPDATE material SET lugar= :lugar, nombre= :nombre,
            stock= :stock WHERE id= :id";

                $stm = $this->conex->prepare($query);
                $stm->bindParam(":lugar", $this->lugar);
                $stm->bindParam(":nombre", $this->nombre);
                $stm->bindParam(":stock", $this->stock);
                $stm->bindParam(":id", $this->id);
                $stm->execute();
                $dato['resultado'] = "actualizar";
                $dato['mensaje'] = "Se actualizó el registro con éxito";
            } catch (PDOException $e) {
                $dato['resultado'] = "error";
                $dato['mensaje'] = $e->getMessage();
            }
        } else {
            $dato['resultado'] = "error";
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
                $query = "UPDATE material SET estatus = 0 WHERE id= :id";

                $stm = $this->conex->prepare($query);
                $stm->bindParam(":id", $this->id);
                $stm->execute();
                $dato['resultado'] = "eliminar";
                $dato['mensaje'] = "Se eliminó el registro con éxito";
            } catch (PDOException $e) {
                $dato['resultado'] = "error";
                $dato['mensaje'] = $e->getMessage();
            }
        } else {
            $dato['resultado'] = "error";
            $dato['mensaje'] = "Error al eliminar el registro";
        }
        $this->Cerrar_Conexion($this->conex, $stm);
        return $dato;
    }

    private function ModificarStock($operacion)
    {
        $dato = [];
        $bool = $this->Validar();

        if ($bool['bool'] == 0) {
            try {
                $query = "UPDATE material SET stock = :stock WHERE id= :id";

                $stm = $this->conex->prepare($query);
                $stm->bindParam(":id", $this->id);
                $stm->execute();
                $dato['resultado'] = "stock";
                $dato['mensaje'] = "Se ".$operacion." el stock del material: ".$this->nombre.".";
            } catch (PDOException $e) {
                $dato['resultado'] = "error";
                $dato['mensaje'] = $e->getMessage();
            }
        } else {
            $dato['resultado'] = "error";
            $dato['mensaje'] = "Error al eliminar el registro";
        }
        $this->Cerrar_Conexion($this->conex, $stm);
        return $dato;
    }

    private function Consultar()
    {
        $dato = [];

        try {
            $query = "SELECT * FROM material";

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

            case 'stock':
                return $this->ModificarStock($peticion['operacion']);

            default:
                return "Operacion: " . $peticion['peticion'] . " no valida";

        }

    }
}
?>