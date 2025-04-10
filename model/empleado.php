<?php 

    require_once('model/conexion.php');

    class Empleado extends Conexion{

        private $data;

        public function __construct(){
            $this->conex = new Conexion();
            $this->conex = $this->conex->Conex();
            $data=array();
        }

        public function set_cedula($cedula){
            $this->data["cedula"] = $cedula;
        }

        public function get_cedula(){
            return $this->data["cedula"];
        }

        public function set_nombre($nombre){
            $this->data["nombre"] = $nombre;
        }

        public function get_nombre(){
            return $this->data["nombre"];
        }

        public function set_apellido($apellido){
            $this->data["apellido"] = $apellido;
        }

        public function get_apellido(){
            return $this->data["apellido"];
        }

        public function set_telefono($telefono){
            $this->data["telefono"] = $telefono;
        }

        public function get_telefono(){
            return $this->data["telefono"];
        }

        public function set_correo($correo){
            $this->data["correo"] = $correo;
        }

        public function get_correo(){
            return $this->data["correo"];
        }

        public function set_unidad($unidad){
            $this->data["id_unidad"] = $unidad;
        }

        public function get_unidad(){
            return $this->data["id_unidad"];
        }

        public function set_dependencia($dependencia){
            $this->data["id_dependencia"] = $dependencia;
        }

        public function get_dependencia(){
            return $this->data["id_dependencia"];
        }

        private function EmpleadosDependencia($dependenciaId) {
          
            // Prepare SQL statement
            $sql = "SELECT cedula, nombre FROM empleado WHERE cod_dependencia = ?";
            $stmt = $this->conex->prepare($sql);
          
            // Bind parameters
            $stmt->bindParam(1, $dependenciaId);
          
            // Execute query
            $stmt->execute();
          
            // Fetch results
            $equipos = $stmt->fetchAll(PDO::FETCH_ASSOC);
          
            return $equipos;
          }

        private function DatosEmpleado(){
            
            $query = "SELECT s.cedula AS cedula,
            s.nombre AS nombre, 
            s.apellido AS apellido, 
            s.telefono AS telefono, 
            s.correo AS correo, 
            u.nombre AS unidad,
            d.nombre AS dependencia
            FROM empleado AS s INNER JOIN unidad AS u ON s.cod_unidad = u.codigo
            INNER JOIN dependencia AS d ON s.cod_dependencia = d.codigo WHERE cedula=:?";
            $con = $this->conex->prepare($query);

            $con->execute([$this->data["cedula"]]);
            $datos = $con->fetch();
            $this->Cerrar_Conexion($this->conex, $con);
            return $datos;
        }

        private function Validar(){
            $con = $this->conex->prepare("SELECT * FROM empleado WHERE cedula=?");
            $con->execute([$this->data["cedula"]]);
            $datos = $con->fetch();  
            $this->Cerrar_Conexion($none, $con);
            return $datos;
        }

        private function Eliminar(){
            
            $sql = "DELETE FROM empleado WHERE cedula=?";

            $eliminar = $this->conex->prepare($sql);
            $eliminar->execute([$this->data["cedula"]]);

            if ($eliminar->rowCount()>0){
                $this->Cerrar_Conexion($this->conex, $eliminar);
                return true;
            }else{
                $this->Cerrar_Conexion($this->conex, $eliminar);
                return NULL;
            }

        }

        private function Crear(){
            $registro = $this->conex->prepare("INSERT INTO `empleado`()
            VALUES (:cedula,:nombre,:apellido,:unidad,".$this->data['id_dependencia'].",:telefono,:correo);
            SELECT SCOPE_IDENTITY();");
            $registro->bindValue(':cedula',$this->data["cedula"]);
            $registro->bindParam(':nombre',$this->data["nombre"]);
            $registro->bindParam(':apellido',$this->data["apellido"]);
            $registro->bindParam(':unidad',$this->data["id_unidad"]);
            $registro->bindParam(':telefono',$this->data["telefono"]);
            $registro->bindParam(':correo',$this->data["correo"]);
            $bool = $registro->execute();
            $this->Cerrar_Conexion($this->conex, $registro);
            return $bool;
            
        }

        private function Modificar(){
            
            $query = "UPDATE empleado SET nombre = :nombre, apellido = :apellido,
            telefono = :telefono, correo = :correo WHERE cedula = :cedula";

            $registro = $this->conex->prepare($query);
            $registro->bindValue(':cedula',$this->data["cedula"]);
            $registro->bindParam(':nombre',$this->data["nombre"]);
            $registro->bindParam(':apellido',$this->data["apellido"]);
            $registro->bindParam(':telefono',$this->data["telefono"]);
            $registro->bindParam(':correo',$this->data["correo"]);
            
            if ($registro->execute()) {
                $this->Cerrar_Conexion($this->conex, $registro);
                return true;
            } else {
                $this->Cerrar_Conexion($this->conex, $registro);
                return false;
            }
            
        }

        private function ConsultarSolicitantes(){

            $query = "SELECT e.cedula AS Cedula, e.nombre AS Nombre, e.apellido AS Apellido, e.telefono AS Telefono, e.correo AS Correo, u.nombre AS Unidad, d.nombre AS Dependencia, user.rol AS Rol
            FROM empleado AS e
            INNER JOIN
            unidad AS u
            ON e.cod_unidad = u.codigo
            INNER JOIN
            dependencia AS d
            ON e.cod_dependencia = d.codigo
            LEFT JOIN
            usuario AS user
            ON e.cedula = user.cedula";
            $records = $this->conex->prepare($query);

            $records->execute();

            return $records->fetchAll(PDO::FETCH_ASSOC);
            
        }

        
        private function MisServicios(){

            $query = "SELECT * FROM orden_solicitud WHERE cedula_solicitante=:cedula";

            $records = $this->conex->prepare($query);

            $records->bindParam(':cedula',$this->cedula);

            $records->execute();

            return $records->fetchAll(PDO::FETCH_ASSOC);
            
        }

        private function ObtenerCedulas(){
            $query = "SELECT cedula FROM empleado";

            $records = $this->conex->prepare($query);

            $records->execute();

            return $records->fetchAll(PDO::FETCH_ASSOC);
        }

        private function NoUsuarios(){
            $query = "SELECT 
            e.cedula,
            e.nombre
          FROM empleado AS e
          LEFT JOIN usuario AS u ON e.cedula = u.cedula
          WHERE u.cedula IS NULL;";

            $records = $this->conex->prepare($query);

            $records->execute();

            return $records->fetchAll(PDO::FETCH_ASSOC);
        }

        public function Transaccion($peticion) {

            switch ($peticion['peticion']) {
                case 'crear':
                    return $this->Crear();
                    
                case 'modificar':
                    return $this->Modificar();
                    
                case 'eliminar':
                    return $this->Eliminar();
                    
                case 'consultar':
                    return $this->DatosEmpleado();
                    
                case 'verificar':
                    return $this->Validar();
                    
                case 'listar':
                    return $this->ConsultarSolicitantes();
                    
                case 'empleados_dependencia':
                    if (isset($peticion['dependenciaId'])) {
                        return $this->EmpleadosDependencia($peticion['dependenciaId']);
                    } else {
                        return "error";
                    }
                    
                case 'no_usuarios':
                    return $this->NoUsuarios();
                    
                case 'mis_servicios':
                    if (isset($peticion['cedula'])) {
                        $this->data["cedula"] = $datos['cedula'];
                        return $this->MisServicios();
                    } else {
                        return "error";
                    }
                    
                default:
                    return false;
            }
            
        }
    }
 ?>