<?php

require_once('model/conexion.php');

class Hoja extends Conexion
{

    private $data;
    private $detalles;

    public function __construct()
    {
        $this->conex = new Conexion();
        $this->conex = $this->conex->Conex();
        $data = array();
    }

    public function set_nro_solicitud($nro_solicitud)
    {
        $this->data["nro_solicitud"] = $nro_solicitud;
    }


    public function set_detalles($detalles)
    {
        $this->detalles = $detalles;
    }


    public function set_cedula_tecnico($cedula_tecnico)
    {
        $this->data["cedula_tecnico"] = $cedula_tecnico;
    }

    public function set_cod_hoja($cod_hoja)
    {
        $this->data["cod_hoja"] = $cod_hoja;
    }

    public function set_tipo_servicio($tipo_servicio)
    {
        $this->data["tipo_servicio"] = $tipo_servicio;
    }

    public function get_tipo_servicio()
    {
        return $this->data["tipo_servicio"];
    }

    public function set_observacion($observacion)
    {
        $this->data["observacion"] = $observacion;
    }

    public function get_observacion()
    {
        return $this->data["observacion"];
    }

    public function set_estatus($estatus)
    {
        $this->data["estatus"] = $estatus;
    }

    public function get_estatus()
    {
        return $this->data["estatus"];
    }

    public function set_resultado($resultado)
    {
        $this->data["resultado"] = $resultado;
    }

    public function get_resultado()
    {
        return $this->data["resultado"];
    }

    public function set_componentes($componentes)
    {
        $this->data["componentes"] = $componentes;
    }

    private function exist()
    {
        $con = $this->conex->prepare("SELECT * FROM hoja_servicio WHERE cod_hoja=?");
        $con->execute([$this->data["cod_hoja"]]);
        $datos = $con->fetch(PDO::FETCH_ASSOC);

        $this->Cerrar_Conexion($void, $con);
        return $datos;
    }

    private function areas_disponibles()
    {
        $con = $this->conex->prepare("SELECT  ts.codigo, ts.nombre FROM tipo_servicio ts WHERE ts.codigo NOT IN ( SELECT hs.tipo_servicio FROM hoja_servicio hs WHERE hs.nro_solicitud = :nro_solicitud );            ");
        $con->bindParam(':nro_solicitud', $this->data["nro_solicitud"]);
        $con->execute();
        $datos = $con->fetchAll(PDO::FETCH_ASSOC);

        $this->Cerrar_Conexion($this->conex, $con);
        return $datos;
    }

    private function datos_hoja()
    {
        $con = $this->conex->prepare("SELECT
            hoja.nro_solicitud AS nro,
            hoja.observacion AS observacion,
            hoja.estatus AS estatus,
            hoja.resultado AS resultado,
            hoja.cod_hoja AS hoja,
            tec.nombre AS tecnico,
            sol.nombre AS solicitante,
            sol.telefono AS telefono,
            u.nombre AS unidad,
            d.nombre AS dependencia,
            equi.tipo AS tipo,
            mar.nombre AS marca,
            equi.serial AS 'serial',
            equi.nro_bien AS nro_bien,
            s.motivo AS motivo,
            s.fecha AS fecha,
            s.estatus AS estatus_s,
            tip.nombre AS tipo_s
          FROM hoja_servicio hoja
          LEFT JOIN solicitud AS s ON s.nro_solicitud = hoja.nro_solicitud
          LEFT JOIN tipo_servicio AS tip ON tip.codigo = hoja.tipo_servicio
          LEFT JOIN empleado AS sol ON sol.cedula = s.cedula_solicitante
          LEFT JOIN empleado AS tec ON tec.cedula = hoja.cedula_tecnico
          LEFT JOIN unidad AS u ON sol.cod_unidad = u.codigo
          LEFT JOIN dependencia AS d ON sol.cod_dependencia = d.codigo
          LEFT JOIN equipo AS equi ON s.id_equipo = equi.id_equipo
          LEFT JOIN marca AS mar ON equi.marca = mar.codigo
            WHERE cod_hoja=:hoja");
        $con->bindValue(':hoja', $this->data["cod_hoja"]);
        $con->execute();
        $datos = $con->fetch();
        $this->Cerrar_Conexion($this->conex, $con);
        return $datos;

    }

    private function consulta_detalles_hoja()
    {
        $con = $this->conex->prepare("SELECT componente , detalle FROM detalle_hoja WHERE cod_hoja=:hoja");
        $con->bindParam(':hoja', $this->data["cod_hoja"]);
        $con->execute();
        $datos = $con->fetchAll(PDO::FETCH_ASSOC);
        $this->Cerrar_Conexion($this->conex, $con);
        return $datos;
    }

    private function llenar_detalles()
    {
        foreach ($this->detalles as $detalle) {

            $componente = $detalle[0];
            $detalle = $detalle[1];

            $stmt = $this->conex->prepare("INSERT INTO detalle_hoja (cod_hoja, componente, detalle) VALUES (:cod_hoja, :componente, :detalle)");


            $stmt->bindParam(":cod_hoja", $this->data["cod_hoja"]);
            $stmt->bindParam(":componente", $componente);
            $stmt->bindParam(":detalle", $detalle);

            $stmt->execute();
        }
    }

    private function finalizar()
    {
        $sql = "UPDATE `hoja_servicio` SET `cedula_tecnico`=:cedula_tecnico,`estatus`='I' WHERE cod_hoja=:hoja";
        $solicitar = $this->conex->prepare($sql);
        $solicitar->bindParam(':hoja', $this->data["cod_hoja"]);
        $solicitar->bindParam(':cedula_tecnico', $this->data["cedula_tecnico"]);
        $resultado = $solicitar->execute();
        $this->Cerrar_Conexion($this->conex, $solicitar);
        return $resultado;
    }

    private function limpiar_detalles()
    {
        $con = $this->conex->prepare("DELETE FROM `detalle_hoja` WHERE cod_hoja=:hoja");
        $con->bindValue(':hoja', $this->data["cod_hoja"]);
        $con->execute();
    }

    private function mis_hojas()
    {
        $query = "SELECT cod_hoja FROM hoja_servicio WHERE nro_solicitud = :solicitud";

        $records = $this->conex->prepare($query);
        $records->bindParam(':solicitud', $this->data["nro_solicitud"]);
        $records->execute();
        $datos = $records->fetchAll(PDO::FETCH_ASSOC);
        $this->Cerrar_Conexion($this->conex, $records);
        return $datos;
    }

    private function nueva_hoja()
    {
        $sql = "INSERT INTO `hoja_servicio`(`nro_solicitud`, `tipo_servicio`) VALUES (:solicitud,:tipo)";
        $asignar = $this->conex->prepare($sql);
        $asignar->bindValue(':solicitud', $this->data["nro_solicitud"]);
        $asignar->bindParam(':tipo', $this->data["tipo_servicio"]);
        $asignar->execute();
    }

    private function Datos()
    {
        $datos = $this->exist($this->data["nro_solicitud"]);
        foreach ($datos as $values) {
            foreach ($values as $campo => $valor) {
                $this->data[$campo] = $valor;
            }
        }
    }

    private function actualizar_hoja()
    {
        $sql = "UPDATE `hoja_servicio` SET `observacion`=:observacion,`resultado`=:resultado WHERE cod_hoja=:cod";
        $solicitar = $this->conex->prepare($sql);
        $solicitar->bindValue(':cod', $this->data["cod_hoja"]);
        $solicitar->bindParam(':resultado', $this->data["resultado"]);
        $solicitar->bindParam(':observacion', $this->data["observacion"]);
        $resultado = $solicitar->execute();

        $this->Cerrar_Conexion($this->conex, $solicitar);

        return $resultado;
    }

    private function asignar_especialidad($especialidad_ant)
    {
        $sql = "INSERT INTO orden_solicitud_especialidad() VALUES (:solicitud,:especialidad,NULL)";
        $asignar = $this->conex->prepare($sql);
        $asignar->bindValue(':solicitud', $this->data["nro_solicitud"]);
        $asignar->bindParam(':especialidad', $this->data["id_especialidad"]);
        $asignar->execute();

        $sql = "UPDATE orden_solicitud_especialidad SET estatus='Inactivo' WHERE nro_solicitud = :solicitud AND id_especialidad = :especialidad";
        $actualizar = $this->conex->prepare($sql);
        $actualizar->bindValue(':solicitud', $this->data["nro_solicitud"]);
        $actualizar->bindParam(':especialidad', $especialidad_ant);
        $actualizar->execute();

        $this->Cerrar_Conexion($this->conex, $asignar);
        $this->Cerrar_Conexion($this->conex, $actualizar);
    }

    private function ConsultaServicios()
    {

        $query = "SELECT * FROM servicio";

        $records = $this->conex->prepare($query);

        $records->execute();

        return $records->fetchAll(PDO::FETCH_ASSOC);

    }

    private function servicios_t()
    {
        $query = "SELECT
            hoja.nro_solicitud AS nro,
            hoja.cod_hoja AS hoja,
            sol.nombre AS solicitante,
            equi.tipo AS tipo,
            mar.nombre AS marca,
            equi.serial AS 'serial',
            equi.nro_bien AS nro_bien,
            s.motivo AS motivo,
            s.fecha AS fecha
          FROM hoja_servicio hoja
          LEFT JOIN solicitud AS s ON s.nro_solicitud = hoja.nro_solicitud
          LEFT JOIN empleado AS sol ON sol.cedula = s.cedula_solicitante
          LEFT JOIN equipo AS equi ON s.id_equipo = equi.id_equipo
          LEFT JOIN marca AS mar ON equi.marca = mar.codigo
          WHERE hoja.tipo_servicio = :tipo
          ORDER BY fecha DESC;";

        $consult = $this->conex->prepare($query);
        $consult->bindParam(':tipo', $this->data["tipo_servicio"]);
        $consult->execute();

        return $consult->fetchAll(PDO::FETCH_ASSOC);

    }

    private function servicios_s()
    {
        $query = "SELECT
            hoja.nro_solicitud AS nro,
            hoja.cod_hoja AS hoja,
            sol.nombre AS solicitante,
            equi.tipo AS tipo,
            mar.nombre AS marca,
            equi.serial AS 'serial',
            equi.nro_bien AS nro_bien,
            s.motivo AS motivo,
            s.fecha AS fecha,
            tip.nombre AS tipo_s
          FROM hoja_servicio hoja
          LEFT JOIN solicitud AS s ON s.nro_solicitud = hoja.nro_solicitud
          LEFT JOIN tipo_servicio AS tip ON tip.codigo = hoja.tipo_servicio
          LEFT JOIN empleado AS sol ON sol.cedula = s.cedula_solicitante
          LEFT JOIN equipo AS equi ON s.id_equipo = equi.id_equipo
          LEFT JOIN marca AS mar ON equi.marca = mar.codigo
          ORDER BY fecha DESC;";

        $consulta = $this->conex->prepare($query);
        $consulta->execute();

        return $consulta->fetchAll(PDO::FETCH_ASSOC);

    }

    public function Transaccion($peticion)
    {
        switch ($peticion["peticion"]) {
            case "nuevo":
                return $this->nueva_hoja();

            case "consultar":
                return $this->ConsultaServicios();

            case "consultar_detalles":
                return $this->consulta_detalles_hoja();

            case "actualizar":
                return $this->actualizar_hoja();

            case "llenar_detalles":
                return $this->llenar_detalles();

            case "servicio_semanal":
                return $this->servicios_s();

            case "servicio_tipo":
                return $this->servicios_t();

            case "eliminar":
                return $this->eliminar();

            case "equipos":
                return $this->Equipos_dependencia($peticion["dato"]);

            case "consulta_marcas":
                return $this->consultar_marcas();

            case "reporte":
                return $this->consulta_reporte();

            default:
                return "Operación".$peticion." No valida";
                ;
        }
    }


}
?>