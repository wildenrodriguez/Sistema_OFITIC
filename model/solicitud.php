<?php

require_once('model/conexion.php');

class Solicitud extends Conexion
{

    private $data;


    public function __construct()
    {
        $this->conex = new Conexion();
        $this->conex = $this->conex->Conex();
        $this->data = array();
    }

    public function set_fecha_inicio($fecha_inicio)
    {
        $this->data["fecha_inicio"] = $fecha_inicio;
    }

    public function set_fecha_final($fecha_final)
    {
        $this->data["fecha_final"] = $fecha_final;
    }

    public function set_nro_solicitud($nro_solicitud)
    {
        $this->data["nro_solicitud"] = $nro_solicitud;
    }

    public function set_cedula_solicitante($cedula_solicitante)
    {
        $this->data["cedula_solicitante"] = $cedula_solicitante;
    }

    public function set_motivo($motivo)
    {
        $this->data["motivo"] = $motivo;
    }

    public function set_id_equipo($id_equipo)
    {
        $this->data["id_equipo"] = $id_equipo;
    }

    public function get_id_equipo()
    {
        return $this->data["id_equipo"];
    }

    public function set_estatus($estatus)
    {
        $this->data["id_estatus"] = $estatus;
    }

    public function get_estatus()
    {
        return $this->data["id_estatus"];
    }

    public function set_resultado($resultado)
    {
        $this->data["resultado"] = $resultado;
    }

    public function set_id_especialidad($id_especialidad)
    {
        $this->data["id_especialidad"] = $id_especialidad;
    }

    public function get_id_especialidad()
    {
        return $this->data["id_especialidad"];
    }

    private function ValidarSolicitud($id)
    {
        $query = "SELECT * FROM orden_solicitud WHERE id=?";

        $con = $this->conex->prepare($query);
        
        $con->execute([$id]);
        $datos = $con->fetchAll(PDO::FETCH_ASSOC);
        $this->Cerrar_Conexion($none, $con);
        return $datos;

    }

    private function EliminarSolicitud()
    {

        $sql = "DELETE FROM solicitud WHERE nro_solicitud=?";
        $eliminar = $this->conex->prepare($sql);
        
        $bool = $eliminar->execute([$this->data["nro_solicitud"]]);
        $this->Cerrar_Conexion($this->conex, $eliminar);
        if ($bool > 0) {
            return true;
        } else {
            return NULL;
        }

    }

    private function Solicitar()
    {

        $query = "SELECT COUNT(*) AS total FROM solicitud WHERE cedula_solicitante = :cedula AND motivo = :motivo
        ORDER BY fecha DESC LIMIT 1";

        $records = $this->conex->prepare($query);
        $records->bindParam(':cedula', $this->data["cedula_solicitante"]);
        $records->bindParam(':motivo', $this->data["motivo"]);
        
        $records->execute();
        $resultado = $records->fetch();
        
        if ($resultado["total"] > 0) {
        } else {
            $sql = "INSERT INTO solicitud(cedula_solicitante,motivo,fecha) VALUES (:solicitante,:motivo,current_timestamp())";
            $solicitar = $this->conex->prepare($sql);
            $solicitar->bindValue(':solicitante', $this->data["cedula_solicitante"]);
            $solicitar->bindParam(':motivo', $this->data["motivo"]);
            
            $solicitar->execute();
            $this->Cerrar_Conexion($none, $solicitar);
        }

        $datos = $this->UltimaSolicitud();

        $html["lo0la"] = "lola";
        $html["html"] = "<tr class='odd'><td class='sorting_1'>" . $datos["ID"] . "</td><td>" . $datos["Motivo"] . "</td><td>" . $datos["Inicio"] . "</td><td>" . $datos["Estatus"] . "</td><td>" . $datos["Resultado"] . "</td><td></td></tr>";
        $this->Cerrar_Conexion($this->conex, $records);
        return $html;
    }

    private function CrearSolicitud()
    {
        $sql = "INSERT INTO `solicitud`(`cedula_solicitante`,`motivo`,`id_equipo`,estatus,fecha)
        VALUES (:solicitante,:motivo,:equipo,'En Proceso',current_timestamp())";

        $solicitar = $this->conex->prepare($sql);
        $solicitar->bindValue(':solicitante', $this->data["cedula_solicitante"]);
        $solicitar->bindParam(':equipo', $this->data["id_equipo"]);
        $solicitar->bindParam(':motivo', $this->data["motivo"]);
        
        $solicitar->execute();
        $this->Cerrar_Conexion($none, $solicitar);

        $nro = $this->conex->prepare("SELECT * FROM solicitud ORDER BY nro_solicitud DESC LIMIT 1;");
        
        $nro->execute();
        $datos = $nro->fetchAll(PDO::FETCH_ASSOC)[0]["nro_solicitud"];
        $this->Cerrar_Conexion($this->conex, $nro);
        return $datos;
    }

    private function ActualizarSolicitud()
    {
        $sql = "UPDATE `solicitud` SET `motivo`=:motivo,`id_equipo`=:equipo,`estatus`='En Proceso' WHERE nro_solicitud=:nro";

        $solicitar = $this->conex->prepare($sql);
        $solicitar->bindValue(':nro', $this->data["nro_solicitud"]);
        $solicitar->bindParam(':equipo', $this->data["id_equipo"]);
        $solicitar->bindParam(':motivo', $this->data["motivo"]);

        $bool = $solicitar->execute();
        $this->Cerrar_Conexion($this->conex, $solicitar);
        return $bool;
    }

    private function Finalizar()
    {
        $sql = "UPDATE `solicitud` SET `resultado`=:resultado,`estatus`='Finalizado' WHERE nro_solicitud=:nro";
        $solicitar = $this->conex->prepare($sql);
        $solicitar->bindValue(':nro', $this->data["nro_solicitud"]);
        $solicitar->bindParam(':resultado', $this->data["resultado"]);

        $bool = $solicitar->execute();
        $this->Cerrar_Conexion($this->conex, $solicitar);
        return $bool;
    }


    private function ConsultaServicios()
    {

        $query = "SELECT * FROM servicio";

        $records = $this->conex->prepare($query);

        $records->execute();
        $datos = $records->fetchAll(PDO::FETCH_ASSOC);
        $this->Cerrar_Conexion($this->conex, $records);
        return $datos;

    }

    private function SolicitudUsuario()
    {
        $query = "SELECT o.nro_solicitud AS ID, s.nombre AS Tecnico, o.motivo AS Motivo, e.tipo AS Equipo, o.fecha AS Inicio, o.estatus AS Estatus, o.resultado AS Resultado
            FROM solicitud AS o
               LEFT JOIN
               empleado AS s
               ON o.cedula_solicitante = s.cedula
               LEFT JOIN
               equipo AS e
               ON o.id_equipo = e.id_equipo
               WHERE o.cedula_solicitante = :cedula";

        $records = $this->conex->prepare($query);
        $records->bindParam(':cedula', $this->data["cedula_solicitante"]);
        $records->execute();
        $datos = $records->fetchAll(PDO::FETCH_ASSOC);
        $this->Cerrar_Conexion($this->conex, $records);
        return $datos;
    }

    private function UltimaSolicitud()
    {
        $query = "SELECT o.nro_solicitud AS ID, s.nombre AS Tecnico, o.motivo AS Motivo, e.tipo AS Equipo, o.fecha AS Inicio, o.estatus AS Estatus, o.resultado AS Resultado
            FROM solicitud AS o
            LEFT JOIN
            empleado AS s ON o.cedula_solicitante = s.cedula
            LEFT JOIN
            equipo AS e ON o.id_equipo = e.id_equipo
            WHERE o.cedula_solicitante = :cedula
            ORDER BY o.fecha DESC LIMIT 1";

        $records = $this->conex->prepare($query);

        $records->bindParam(':cedula', $this->data["cedula_solicitante"]);

        $records->execute();

        return $records->fetch();
    }

    private function Servicios()
    {
        $query = "SELECT o.nro_solicitud AS ID,
        s1.nombre AS Solicitante,
        o.cedula_solicitante AS Cedula,
        o.motivo AS Motivo,
        e.tipo AS Equipo,
        o.fecha AS Inicio,
        o.estatus AS Estatus,
        o.resultado AS Resultado
        FROM solicitud AS o
        LEFT JOIN empleado AS s1 ON o.cedula_solicitante = s1.cedula
        LEFT JOIN equipo AS e ON o.id_equipo = e.id_equipo
        ORDER BY Inicio DESC;";

        $records = $this->conex->prepare($query);

        $records->execute();

        return $records->fetchAll(PDO::FETCH_ASSOC);

    }

    private function ConsultaReporte()
    {
        $query = "SELECT o.nro_solicitud AS ID,
        s1.nombre AS Solicitante,
        o.cedula_solicitante AS Cedula,
        o.motivo AS Motivo,
        e.tipo AS Equipo,
        o.fecha AS Inicio,
        o.estatus AS Estatus,
        o.resultado AS Resultado
        FROM solicitud AS o
        LEFT JOIN empleado AS s1 ON o.cedula_solicitante = s1.cedula
        LEFT JOIN equipo AS e ON o.id_equipo = e.id_equipo
        WHERE o.fecha BETWEEN :inicio AND :final
        ORDER BY Inicio DESC;";

        $records = $this->conex->prepare($query);

        $records->bindParam(':inicio', $this->data["fecha_inicio"]);
        $records->bindParam(':final', $this->data["fecha_final"]);

        $records->execute();

        return $records->fetchAll(PDO::FETCH_ASSOC);

    }

    public function Transaccion($peticion)
    {
        switch ($peticion["peticion"]) {

            case "registrar":
                return $this->CrearSolicitud();

            case "solicitud_usuario":
                return $this->SolicitudUsuario();

            case "actualizar":
                return $this->ActualizarSolicitud();

            case "eliminar":
                return $this->EliminarSolicitud();

            case "finalizar":
                return $this->Finalizar();

            case "consultar_servicio":
                return $this->Servicios();

            default:
                $error = "Operación no Válida";
                return $error;
        }

    }

}
?>