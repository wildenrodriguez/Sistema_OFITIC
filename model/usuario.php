    <?php 
    require_once('model/conexion.php');

    class Usuario extends Conexion{

        protected $cedula;
        private $nombres;
        private $apellidos;
        private $correo;
        protected $clave;
        protected $tipo;
        protected $rol;

        public function __construct(){
            $this->conex = new Conexion();
            $this->conex = $this->conex->Conex();
        }

        public function set_cedula($cedula){
            $this->cedula = $cedula;
        }

        public function set_nombres($nombres){
            $this->nombres = $nombres;
        }

        public function set_apellidos($apellidos){
            $this->apellidos = $apellidos;
        }

        public function set_tipo($tipo){
            $this->tipo = $tipo;
        }

        public function set_clave($contrase){
            $this->clave = $contrase;
        }

        public function set_rol($rol){
            $this->rol = $rol;
        }

        public function get_nombres(){
            return $this->nombres;
        }

        public function get_apellidos(){
            return $this->apellidos;
        }

        function validar_entrada($usuario, $permitidos){
            return in_array($usuario, $permitidos);
        }

        function exist($user){
            $con = $this->conex->prepare("SELECT * FROM usuario WHERE cedula=?");
            $con->execute([$user]);
            return $con->fetch();
        }

        function crear(){
            $con = $this->conex->prepare("INSERT INTO `usuario`(`cedula`, `clave`, `rol`) VALUES (:cedula,:clave,:rol)");
            $con->bindParam(':cedula',$this->cedula);
            $con->bindParam(':clave',$this->clave);
            $con->bindParam(':rol',$this->rol);
            return $con->execute();
        }

        public function crear_tecnico(){
            $con = $this->conex->prepare("INSERT INTO `tecnico`() VALUES (:cedula,:tipo)");
            $con->bindParam(':cedula',$this->cedula);
            $con->bindParam(':tipo',$this->tipo);
            return $con->execute();
        }

        public function validar(){
            $con = $this->conex->prepare("SELECT * FROM usuario WHERE cedula=?");
            $con->execute([$this->cedula]);
            return $con->fetch();
        }

        public function Iniciar_Sesion(){
            $exist = $this->exist($this->cedula);
            
            if($exist != NULL){
                if(password_verify($this->clave, $exist['clave'])){
                    return true;
                } else {
                    return false;
                }
            }else{
                return false;
            }
        }

        public function datos(){
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

        public function Transacción($peticion){

            switch ($peticion['peticion']) {
                case 'registrar':
                    # code...
                    break;
                
                case 'consultar':

                    break;
                
                case 'modificar':

                    break;

                case 'eliminar':

                    break;

                case 'iniciar_sesion':

                    break;

                case 'validar':

                    break;
                
                default:
                    return "error ".$peticion['peticion']." no valida";

            }
        }
    }
 ?>