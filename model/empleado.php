<?php 

    require_once('model/conexion.php');

    class empleado extends conexion{

        private $data;

        public function __construct(){
            $this->conex = new Conexion();
            $this->conex = $this->conex->Conex();
            $data=array();
        }

        function set_cedula($cedula){
            $this->data["cedula"] = $cedula;
        }

        function get_cedula(){
            return $this->data["cedula"];
        }

         function set_nombre($nombre){
            $this->data["nombre"] = $nombre;
        }

        function get_nombre(){
            return $this->data["nombre"];
        }

        function set_apellido($apellido){
            $this->data["apellido"] = $apellido;
        }

        function get_apellido(){
            return $this->data["apellido"];
        }

        function set_telefono($telefono){
            $this->data["telefono"] = $telefono;
        }

        function get_telefono(){
            return $this->data["telefono"];
        }

        function set_correo($correo){
            $this->data["correo"] = $correo;
        }

        function get_correo(){
            return $this->data["correo"];
        }

       function set_unidad($unidad){
            $this->data["id_unidad"] = $unidad;
        }

        function get_unidad(){
            return $this->data["id_unidad"];
        }

        function set_dependencia($dependencia){
            $this->data["id_dependencia"] = $dependencia;
        }

        function get_dependencia(){
            return $this->data["id_dependencia"];
        }

        function Empleados_dependencia($dependenciaId) {
          
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

        function datos_empleado(){
            $con = $this->conex->prepare("SELECT s.cedula AS cedula, s.nombre AS nombre, s.apellido AS apellido, s.telefono AS telefono, s.correo AS correo, u.nombre AS unidad, d.nombre AS dependencia
            FROM empleado AS s INNER JOIN unidad AS u ON s.cod_unidad = u.codigo INNER JOIN dependencia AS d ON s.cod_dependencia = d.codigo WHERE cedula=?");
            $con->execute([$this->data["cedula"]]);
            return $con->fetch();  
        }

        function exist(){
            $con = $this->conex->prepare("SELECT * FROM empleado WHERE cedula=?");
            $con->execute([$this->data["cedula"]]);
            return $con->fetch();  
        }

//        public function Datos(){
  //          $datos = $this->exist($this->data["cedula"]);
    //        foreach ($datos as $values) {
      //          foreach ($values as $campo => $valor) {
        //            $this->data[$campo] = $valor;
          //      }
           // }
        //}

        function eliminar(){
            
            $sql = "DELETE FROM empleado WHERE cedula=?";
            $eliminar = $this->conex->prepare($sql);
            $eliminar->execute([$this->data["cedula"]]);

            if ($eliminar->rowCount()>0){
                return true;
            }else{
                return NULL;
            }

        }


        public function crear(){
            $registro = $this->conex->prepare("INSERT INTO `empleado`() VALUES (:cedula,:nombre,:apellido,:unidad,".$this->data['id_dependencia'].",:telefono,:correo); SELECT SCOPE_IDENTITY();");
            $registro->bindValue(':cedula',$this->data["cedula"]);
            $registro->bindParam(':nombre',$this->data["nombre"]);
            $registro->bindParam(':apellido',$this->data["apellido"]);
            $registro->bindParam(':unidad',$this->data["id_unidad"]);
           // $registro->bindParam(':dependencia',$this->data["id_dependencia"]);
            $registro->bindParam(':telefono',$this->data["telefono"]);
            $registro->bindParam(':correo',$this->data["correo"]);
            return $registro->execute();
            
        }

        public function modificar(){
            $registro = $this->conex->prepare("UPDATE empleado SET nombre = :nombre, apellido = :apellido, telefono = :telefono, correo = :correo WHERE cedula = :cedula");
            $registro->bindValue(':cedula',$this->data["cedula"]);
            $registro->bindParam(':nombre',$this->data["nombre"]);
            $registro->bindParam(':apellido',$this->data["apellido"]);
            $registro->bindParam(':telefono',$this->data["telefono"]);
            $registro->bindParam(':correo',$this->data["correo"]);
            
            if ($registro->execute()) {
                return true;
            } else {
                return false;
            }
            
        }

        function consultar_solicitantes(){

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

        function verificar_existencia(){

            $sql = "SELECT * FROM empleado WHERE cedula = :cedula";

            $consulta = $this->conex->prepare($sql);

            $consulta->bindParam(':cedula',$this->data["cedula"]);

            $consulta->execute();

            return $consulta->rowCount()>0;
        }
        
        public function mis_servicios(){

            $query = "SELECT * FROM orden_solicitud WHERE cedula_solicitante=:cedula";

            $records = $this->conex->prepare($query);

            $records->bindParam(':cedula',$this->cedula);

            $records->execute();

            return $records->fetchAll(PDO::FETCH_ASSOC);
            
        }

        function obtener_cedulas(){
            $query = "SELECT cedula FROM empleado";

            $records = $this->conex->prepare($query);

            $records->execute();

            return $records->fetchAll(PDO::FETCH_ASSOC);
        }

        function no_usuarios(){
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
    }
 ?>