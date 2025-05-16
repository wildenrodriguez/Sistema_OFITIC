<?php
require_once "model/conexion.php";
class Oficina extends Conexion
{
    private $id;
    private $id_piso;
    private $nombre;
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

    public function set_id_piso($id_piso)
    {
        $this->id_piso = $id_piso;
    }

    public function set_nombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public function set_estatus($estatus)
    {
        $this->estatus = $estatus;
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

    public function get_estatus()
    {
        return $this->estatus;
    }

    private function Validar()
    {
        $dato = [];

        try {
            $query = "SELECT * FROM oficina WHERE id_oficina = :id";

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
                $query = "INSERT INTO oficina(id_oficina, id_piso, nombre_oficina, estatus) VALUES 
                (NULL, :id_piso, :nombre, 1)";

                $stm = $this->conex->prepare($query);
                $stm->bindParam(":id_piso", $this->id_piso);
                $stm->bindParam(":nombre", $this->nombre);
                $stm->execute();
                $dato['resultado'] = "registrar";
                $dato['estado'] = 1;
                $dato['mensaje'] = "Se registró la oficina exitosamente";
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
            $query = "UPDATE oficina SET id_piso= :id_piso, nombre_oficina= :nombre WHERE id_oficina = :id";

            $stm = $this->conex->prepare($query);
            $stm->bindParam(":id", $this->id);
            $stm->bindParam(":id_piso", $this->id_piso);
            $stm->bindParam(":nombre", $this->nombre);
            $stm->execute();
            $dato['resultado'] = "modificar";
            $dato['estado'] = 1;
            $dato['mensaje'] = "Se modificaron los datos de la oficina con éxito";
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
                $query = "UPDATE oficina SET estatus = 0 WHERE id_oficina = :id";

                $stm = $this->conex->prepare($query);
                $stm->bindParam(":id", $this->id);
                $stm->execute();
                $dato['resultado'] = "eliminar";
                $dato['estado'] = 1;
                $dato['mensaje'] = "Se eliminó la oficina exitosamente";
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
            $query = "SELECT o.id_oficina, nombre_oficina, p.nro_piso
                    FROM oficina o 
                    JOIN piso p ON o.id_piso = p.id_piso 
                    WHERE o.estatus = 1";

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

    public function ConsultarPisos()
    {
        $dato = [];

        try {
            $query = "SELECT * FROM piso WHERE estatus = 1";

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
        $query = "SELECT o.*, p.nro_piso
                FROM oficina o 
                JOIN piso p ON o.id_piso = p.id_piso 
                WHERE o.estatus = 0";

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
        $query = "UPDATE oficina SET estatus = 1 WHERE id_oficina = :id";

        $stm = $this->conex->prepare($query);
        $stm->bindParam(":id", $this->id);
        $stm->execute();
        $dato['resultado'] = "restaurar";
        $dato['estado'] = 1;
        $dato['mensaje'] = "Oficina restaurada exitosamente";
        
        $msg = "(" . $_SESSION['user']['nombre_usuario'] . "), Se restauró la oficina ID: " . $this->id;
        Bitacora($msg, "Oficina");
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

            case 'consultar_pisos':
                return $this->ConsultarPisos();

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
?>