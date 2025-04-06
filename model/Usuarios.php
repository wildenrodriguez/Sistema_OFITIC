    <?php 
    require_once('model/conexion.php');

    class Usuario extends conexion{

        protected $cedula;
        protected $rol;
        protected $clave;
        protected $tipo;

        public function __construct(){
            $this->conex = new Conexion();
            $this->conex = $this->conex->Conex();
        }

        function set_cedula($cedula){
            $this->cedula = $cedula;
        }

        function set_tipo($tipo){
            $this->tipo = $tipo;
        }

        function set_clave($contrase){
            $this->clave = $contrase;
        }

        function set_rol($rol){
            $this->rol = $rol;
        }

        function validar_entrada($usuario, $permitidos){
            return in_array($usuario, $permitidos);
        }

        function exist($user, $pass){
            $con = $this->conex->prepare("SELECT * FROM usuario WHERE cedula=? AND clave=?");
            $con->execute([$user,$pass]);
            return $con->fetch();
        }

        function crear(){
            $con = $this->conex->prepare("INSERT INTO `usuario`(`cedula`, `clave`, `rol`) VALUES (:cedula,:cedula,:rol)");
            $con->bindParam(':cedula',$this->cedula);
            $con->bindParam(':rol',$this->rol);
            return $con->execute();
        }

        function crear_tecnico(){
            $con = $this->conex->prepare("INSERT INTO `tecnico`() VALUES (:cedula,:tipo)");
            $con->bindParam(':cedula',$this->cedula);
            $con->bindParam(':tipo',$this->tipo);
            return $con->execute();
        }

        function validar(){
            $con = $this->conex->prepare("SELECT * FROM usuario WHERE cedula=?");
            $con->execute([$this->cedula]);
            return $con->fetch();
        }

        public function Iniciar_Sesion(){
            $exist = $this->exist($this->cedula, $this->clave);
            
            if($exist){
                return true;
            }else{
                return false;
            }
        }

        function datos(){
            $con = $this->conex->prepare("SELECT `clave`, `rol` FROM `usuario` WHERE cedula = :cedula");
            $con->bindValue(':cedula',$this->cedula);
            $con->execute();
            
            return $con->fetch() ;
        }

        public function eliminar(){
            $registro = $this->conex->prepare("DELETE FROM usuario WHERE cedula = :cedula");
            $registro->bindValue(":cedula",$this->cedula);
            $registro->execute(); 

            $tecnico = $this->conex->prepare("DELETE FROM tecnico WHERE cedula = :cedula");
            $tecnico->bindValue(":cedula",$this->cedula);
            $tecnico->execute();
        }

        public function Actualizar_Contra(){

            $registro = $this->conex->prepare("UPDATE usuario SET clave=? WHERE cedula = ?");
            
            if ($registro->execute([$this->clave,$this->cedula])) {
                return true;
            } else {
                return false;
            }
            
        }
        
        public function Consulta_Usuarios(){

            $query = "SELECT
            usuario.cedula AS Cedula,
            usuario.rol AS Rol,
            usuario.clave AS Clave,
            empleado.nombre AS Nombre,
            tecnico.tipo AS tipo_c,
            tipo_servicio.nombre AS Tipo
          FROM
            usuario
          LEFT JOIN empleado ON usuario.cedula = empleado.cedula
          LEFT JOIN tecnico ON tecnico.cedula = empleado.cedula
          LEFT JOIN tipo_servicio ON tecnico.tipo = tipo_servicio.codigo;
          ";

            $records = $this->conex->prepare($query);

            $records->execute();

            return $records->fetchAll(PDO::FETCH_ASSOC);
            
        }

    }
 ?>