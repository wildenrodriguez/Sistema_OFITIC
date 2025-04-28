<?php
require_once "model/conexion.php";
class Bitacora extends Conexion
{

    private $id;
    private $usuario;
    private $modulo;
    private $accion;
    private $fecha;
    private $hora;

    public function __construct(){
        
        $this->conex = new Conexion();
        $this->conex = $this->conex->Conex();
    }

    public function set_id($id){
        $this->id = $id;
    }

    public function set_usuario($usuario){
        $this->usuario = $usuario;
    }

    public function set_modulo($modulo){
        $this->modulo = $modulo;
    }

    public function set_accion($accion){
        $this->accion = $accion;
    }

    public function set_fecha($fecha){
        $this->fecha = $fecha;
    }

    public function set_hora($hora){
        $this->hora = $hora;
    }

    public function get_id($id){
        return $this->id;
    }

    public function get_usuario($usuario){
        return $this->usuario;
    }

    public function get_modulo($modulo){
        return $this->modulo;
    }

    public function get_accion($accion){
        return $this->accion;
    }

    public function get_fecha($fecha){
        return $this->fecha;
    }

    public function get_hora($hora){
        return $this->hora;
    }

    private function Validar(){
        $dato = [];

        try {
            $query = "SELECT * FROM bitacora WHERE id = :id";
            
            $stm = $this->conex->prepare($query);
            $stm->bindParam(":id", $this->id);
            $stm->execute();

            if($stm->rowCount() > 0){
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

    private function Registrar(){
        $dato = [];
        $bool = $this->Validar();

        if($bool['bool'] == 0){
        try {
            $query = "INSERT INTO bitacora (id, usuario, modulo, accion, fecha, hora)
            VALUES (NULL, :usuario, :modulo, :accion, :fecha, :hora)";
            
            $stm = $this->conex->prepare($query);
            $stm->bindParam(":usuario", $this->usuario);
            $stm->bindParam(":modulo", $this->modulo);
            $stm->bindParam(":accion", $this->accion);
            $stm->bindParam(":fecha", $this->fecha);
            $stm->bindParam(":hora", $this->hora);
            $stm->execute();
            $dato['resultado'] = "registrar";
            $dato['mensaje'] = "Se registro con éxito";
        } catch (PDOException $e) {
            $dato['resultado'] = "error";
            $dato['mensaje'] = $e->getMessage();
        }
    } else {
        $dato['resultado'] = "error";
        $dato['mensaje'] = "Registro duplicado";
    }
        $this->Cerrar_Conexion($this->conex, $stm);
        return $dato;
    }


    private function Consultar(){
        $dato = [];

        try {
            $query = "SELECT * FROM bitacora";
            
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

    public function Transaccion($peticion){

        switch($peticion['peticion']){

            case 'registrar':
                return $this->Registrar();
            
            case 'consultar':
                return $this->Consultar();

            default:
                return "Operacion: ".$peticion['peticion']." no valida";

        }

    }
}
?>