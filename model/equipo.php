<?php

require_once('model/conexion.php');

class Equipo extends Conexion
{

    private $data;

    public function __construct()
    {
        parent::__construct();
        $this->conex = parent::Conex();
        $data = array();
    }

    public function set_datos($datos)
    {
        $this->data = $datos;
    }

    public function set_serial($serial)
    {
        $this->data["serial"] = $serial;
    }
    public function set_nro_bien($nro_bien)
    {
        $this->data["nro_bien"] = $nro_bien;
    }
    public function set_tipo($tipo)
    {
        $this->data["tipo"] = $tipo;
    }
    public function set_marca($marca)
    {
        $this->data["marca"] = $marca;
    }

    public function get_serial()
    {
        return $this->data['serial'];
    }

    public function get_nro_bien()
    {
        return $this->data['nro_bien'];
    }

    public function get_marca()
    {
        return $this->data['marca'];
    }

    public function get_tipo()
    {
        return $this->data['tipo'];
    }

    public function get_id()
    {
        return $this->data['id'];
    }

    public function get_data()
    {
        return $this->data;
    }

    private function Validar()
    {
        $query = "SELECT `id_equipo` FROM equipo WHERE (`serial` = :serial_)";
        $insert = $this->conex->prepare($query);
        $insert->bindParam(':serial_', $this->data['serial']);
        $insert->execute();

        if ($insert->rowCount() > 0) {
            return true;
        } else {
            return false;
        }

    }

    private function Registrar()
    {
        $query = "INSERT INTO equipo() VALUES(NULL,:tipo,:serial_,:marca,:nro_bien,:dependencia);
            SELECT SCOPE_IDENTITY();";

        $insert = $this->conex->prepare($query);

        $insert->bindParam(':serial_', $this->data['serial']);
        $insert->bindParam(':tipo', $this->data['tipo']);
        $insert->bindParam(':marca', $this->data['marca']);
        $insert->bindParam(':nro_bien', $this->data['nro_bien']);
        $insert->bindParam(':dependencia', $this->data['dependencia']);

        $insert->execute();

        if ($insert->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    private function Consultar()
    {
        $query = "SELECT e.id_equipo,e.tipo,e.serial,e.marca AS id_marca,m.nombre AS marca,nro_bien,e.dependencia AS id_dependencia,d.nombre AS dependencia FROM equipo AS e INNER JOIN marca AS m ON e.marca=m.codigo INNER JOIN dependencia AS d ON e.dependencia=d.codigo";

        $select = $this->conex->prepare($query);

        $select->execute();

        if ($select->rowCount() > 0) {
            return $select->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return false;
        }
    }

    private function Modificar()
    {

        $query = "UPDATE equipo SET serial=:serial_1 , nro_bien=:nro_bien , marca=:marca , dependencia=:dependencia ,tipo=:tipo WHERE id_equipo=:id";

        $update = $this->conex->prepare($query);

        $update->bindParam(':serial_1', $this->data['serial']);
        $update->bindParam(':nro_bien', $this->data['nro_bien']);
        $update->bindParam(':marca', $this->data['marca']);
        $update->bindParam(':dependencia', $this->data['dependencia']);
        $update->bindParam(':tipo', $this->data['tipo']);
        $update->bindParam(':id', $this->data['modificar']);
        $update->execute();

        if ($update->rowCount() > 0) {
            return true;
        } else {
            return false;
        }

    }

    private function Eliminar()
    {
        $query = "DELETE FROM equipo WHERE id_equipo=:id_equipo";

        $update = $this->conex->prepare($query);
        $update->bindParam(':id_equipo', $this->data);
        $update->execute();

        if ($update->rowCount() > 0) {
            return true;
        } else {
            return NULL;
        }

    }

    private function ConsultarReporte()
    {

        $query = "SELECT * FROM equipo";
        $records = $this->conex->prepare($query);
        $records->execute();

        return $records->fetchAll(PDO::FETCH_ASSOC);
    }

    private function ConsultarMarcas()
    {
        $query = "SELECT * FROM marca ORDER BY nombre ASC";

        $select = $this->conex->prepare($query);

        $select->execute();

        if ($select->rowCount() > 0) {
            return $select->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return NULL;
        }
    }

    private function EquiposDependencia($dependenciaId)
    {

        $sql = "SELECT `id_equipo` AS id, serial, tipo FROM equipo WHERE dependencia = ?";
        $stmt = $this->conex->prepare($sql);
        $stmt->bindParam(1, $dependenciaId);

        $stmt->execute();
        $equipos = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $equipos;
    }

    public function Transaccion($peticion)
    {
        switch ($peticion["peticion"]) {

            case "crear":
                return $this->Registrar();

            case "validar":
                return $this->Validar();

            case "consultar":
                return $this->Consultar();

            case "modificar":
                return $this->Modificar();

            case "eliminar":
                return $this->Eliminar();
                
            case "equipos":
                return $this->EquiposDependencia($peticion["dependencia_id"]);

            case "consulta_marcas":
                return $this->ConsultarMarcas();

            case "reporte":
                return $this->ConsultarReporte();

            default:
                "error";
                break;
        }
    }
}
?>