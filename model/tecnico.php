<?php 

    require_once('model/conexion.php');

    class tecnico extends conexion{

        private $data;

        public function __construct(){
            $this->conex = new Conexion();
            $this->conex = $this->conex->Conex();
            $data=array();
        }

         function set_cedula($cedula){
            $this->data["cedula"] = $cedula;
        }

        function set_tipo($tipo){
            $this->data["tipo"] = $tipo;
        }

        function tipo(){
            $con = $this->conex->prepare("SELECT tipo FROM tecnico WHERE cedula=?");
            $con->execute([$this->data["cedula"]]);
            return $con->fetch();
        }

        function exist($id){
            $con = $this->conex->prepare("SELECT * FROM orden_solicitud WHERE id=?");
            $con->execute([$id]);
            return $con->fetchAll(PDO::FETCH_ASSOC);
        }

        public function Solicitar(){
            $sql="INSERT INTO solicitud(cedula_solicitante,motivo) VALUES (:solicitante,:motivo);
                  SELECT LAST_INSERT_ID() AS id;";
            $solicitar = $this->conex->prepare($sql);
            $solicitar->bindValue(':solicitante',$this->data["cedula_solicitante"]);
            $solicitar->bindParam(':motivo',$this->data["motivo"]);

            return $solicitar->execute();
        }

        public function crear(){
            
            $sql="INSERT INTO `solicitud`(`cedula_solicitante`,`motivo`,`id_equipo`,estatus) VALUES (:solicitante,:motivo,:equipo,'En Proceso')";
            $solicitar = $this->conex->prepare($sql);
            $solicitar->bindValue(':solicitante',$this->data["cedula_solicitante"]);
            $solicitar->bindParam(':equipo',$this->data["id_equipo"]);
            $solicitar->bindParam(':motivo',$this->data["motivo"]);
            $solicitar->execute();
            $nro = $this->conex->prepare("SELECT * FROM solicitud ORDER BY nro_solicitud DESC LIMIT 1;");
            $nro->execute();
            return $nro->fetchAll(PDO::FETCH_ASSOC)[0]["nro_solicitud"];
        }
    }
 ?>