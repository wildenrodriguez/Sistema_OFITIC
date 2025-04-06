<?php 

    require_once('model/conexion.php');

    class solicitud extends conexion{

        private $data;
        

        public function __construct(){
            $this->conex = new Conexion();
            $this->conex = $this->conex->Conex();
            $data=array();
        }

        function set_fecha_inicio($fecha_inicio){
            $this->data["fecha_inicio"] = $fecha_inicio;
        }
        
        function set_fecha_final($fecha_final){
            $this->data["fecha_final"] = $fecha_final;
        }

        function set_nro_solicitud($nro_solicitud){
            $this->data["nro_solicitud"] = $nro_solicitud;
        }

         function set_cedula_solicitante($cedula_solicitante){
            $this->data["cedula_solicitante"] = $cedula_solicitante;
        }

        function set_motivo($motivo){
            $this->data["motivo"] = $motivo;
        }

        function set_id_equipo($id_equipo){
            $this->data["id_equipo"] = $id_equipo;
        }

        function get_id_equipo(){
            return $this->data["id_equipo"];
        }

        function set_estatus($estatus){
            $this->data["id_estatus"] = $estatus;
        }

        function get_estatus(){
            return $this->data["id_estatus"];
        }

        function set_resultado($resultado){
            $this->data["resultado"] = $resultado;
        }

        function set_id_especialidad($id_especialidad){
            $this->data["id_especialidad"] = $id_especialidad;
        }

        function get_id_especialidad(){
            return $this->data["id_especialidad"];
        }

        function exist($id){
            $con = $this->conex->prepare("SELECT * FROM orden_solicitud WHERE id=?");
            $con->execute([$id]);
            return $con->fetchAll(PDO::FETCH_ASSOC);
            
        }

        function eliminar(){
            
            $sql = "DELETE FROM solicitud WHERE nro_solicitud=?";
            $eliminar = $this->conex->prepare($sql);
            $eliminar->execute([$this->data["nro_solicitud"]]);

            if ($eliminar->rowCount()>0){
                return true;
            }else{
                return NULL;
            }

        }

        public function Solicitar(){
           
            $query = "SELECT COUNT(*) AS total FROM solicitud WHERE cedula_solicitante = :cedula AND motivo = :motivo ORDER BY fecha DESC LIMIT 1";
            $records = $this->conex->prepare($query);
            $records->bindParam(':cedula',$this->data["cedula_solicitante"]);
            $records->bindParam(':motivo',$this->data["motivo"]);
            $records->execute();
            $resultado = $records->fetch();
          
            if ($resultado["total"] > 0) {
            } else {
                $sql="INSERT INTO solicitud(cedula_solicitante,motivo,fecha) VALUES (:solicitante,:motivo,current_timestamp())";
                $solicitar = $this->conex->prepare($sql);
                $solicitar->bindValue(':solicitante',$this->data["cedula_solicitante"]);
                $solicitar->bindParam(':motivo',$this->data["motivo"]);
                $solicitar->execute();
            }
          
            $datos=$this->ultimo_ingresado();
          
            $html["lo0la"]="lola";
            $html["html"]="<tr class='odd'><td class='sorting_1'>".$datos["ID"]."</td><td>".$datos["Motivo"]."</td><td>".$datos["Inicio"]."</td><td>".$datos["Estatus"]."</td><td>".$datos["Resultado"]."</td><td></td></tr>";
          
            return $html;
          }

        public function crear(){
            $sql="INSERT INTO `solicitud`(`cedula_solicitante`,`motivo`,`id_equipo`,estatus,fecha) VALUES (:solicitante,:motivo,:equipo,'En Proceso',current_timestamp())";
            $solicitar = $this->conex->prepare($sql);
            $solicitar->bindValue(':solicitante',$this->data["cedula_solicitante"]);
            $solicitar->bindParam(':equipo',$this->data["id_equipo"]);
            $solicitar->bindParam(':motivo',$this->data["motivo"]);
            $solicitar->execute();
            $nro = $this->conex->prepare("SELECT * FROM solicitud ORDER BY nro_solicitud DESC LIMIT 1;");
            $nro->execute();
            return $nro->fetchAll(PDO::FETCH_ASSOC)[0]["nro_solicitud"];
        }

        public function actualizar_solicitud(){
            $sql="UPDATE `solicitud` SET `motivo`=:motivo,`id_equipo`=:equipo,`estatus`='En Proceso' WHERE nro_solicitud=:nro";
            $solicitar = $this->conex->prepare($sql);
            $solicitar->bindValue(':nro',$this->data["nro_solicitud"]);
            $solicitar->bindParam(':equipo',$this->data["id_equipo"]);
            $solicitar->bindParam(':motivo',$this->data["motivo"]);

            return $solicitar->execute();
        }

        public function finalizar(){
            $sql="UPDATE `solicitud` SET `resultado`=:resultado,`estatus`='Finalizado' WHERE nro_solicitud=:nro";
            $solicitar = $this->conex->prepare($sql);
            $solicitar->bindValue(':nro',$this->data["nro_solicitud"]);
            $solicitar->bindParam(':resultado',$this->data["resultado"]);

            return $solicitar->execute();
        }


        public function ConsultaServicios(){

            $query = "SELECT * FROM servicio";

            $records = $this->conex->prepare($query);

            $records->execute();

            return $records->fetchAll(PDO::FETCH_ASSOC);
            
        }
        
        public function mis_servicios(){
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

            $records->bindParam(':cedula',$this->data["cedula_solicitante"]);

            $records->execute();

            return $records->fetchAll(PDO::FETCH_ASSOC);
            
        }

        private function ultimo_ingresado(){
            $query = "SELECT o.nro_solicitud AS ID, s.nombre AS Tecnico, o.motivo AS Motivo, e.tipo AS Equipo, o.fecha AS Inicio, o.estatus AS Estatus, o.resultado AS Resultado
            FROM solicitud AS o
               LEFT JOIN
               empleado AS s
               ON o.cedula_solicitante = s.cedula
               LEFT JOIN
               equipo AS e
               ON o.id_equipo = e.id_equipo
               WHERE o.cedula_solicitante = :cedula
               ORDER BY o.fecha DESC
                LIMIT 1";

            $records = $this->conex->prepare($query);

            $records->bindParam(':cedula',$this->data["cedula_solicitante"]);

            $records->execute();

            return  $records->fetch();
        }

        public function servicios(){
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

        public function consulta_reporte(){
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

            $records->bindParam(':inicio',$this->data["fecha_inicio"]);
            $records->bindParam(':final',$this->data["fecha_final"]);

            $records->execute();

            return $records->fetchAll(PDO::FETCH_ASSOC);
            
        }
    }
 ?>