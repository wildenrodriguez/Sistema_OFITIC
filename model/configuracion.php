<?php

require_once('model/conexion.php');

class configuracion extends Conexion
{
    private $nombre;
    private $codigo;
    private $tabla;

    public function __construct()
    {
        $this->conex = new Conexion();
        $this->conex = $this->conex->Conex();
    }

    public function set_tabla($tabla)
    {
        $this->tabla = $tabla;
    }

    public function set_nombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public function set_codigo($codigo)
    {
        $this->codigo = $codigo;
    }

    public function get_codigo()
    {
        return $this->codigo;
    }

    public function get_nombre()
    {
        return $this->nombre;
    }

    public function get_tabla()
    {
        return $this->tabla;
    }

    private function consultar_tabla()
    {

        $registro = "SELECT * FROM " . $this->tabla;
        $consulta = $this->conex->prepare($registro);
        $resul = $consulta->execute();
        $datos = $consulta->fetchAll(PDO::FETCH_ASSOC);
        $consulta = NULL;
        return $datos;
    }

    private function validar_tabla()
    {
        $con = $this->conex->prepare("SELECT * FROM $this->tabla WHERE nombre=?");
        $con->execute([$this->nombre]);
        if ($con->rowCount() > 0) {
            $con = NULL;
            return true;
        } else {
            $con = NULL;
            return NULL;
        }
    }

    private function registrar_configuracion()
    {

        if (!$this->validar_tabla()) {
            $sql = "INSERT INTO $this->tabla(nombre) VALUES(:nombre);";
            $registro = $this->conex->prepare($sql);
            $registro->bindParam(':nombre', $this->nombre);
            $valor = $registro->execute();
            $registro = NULL;
            return $valor;
        }
    }

    private function eliminar_configuracion()
    {
        $registro = $this->conex->prepare("DELETE FROM $this->tabla WHERE codigo = :id");
        $registro->bindParam(":id", $this->codigo);
        $registro->execute();
        $registro = NULL;
    }

    private function consulta_reporte2()
    {
        $query = "SELECT * FROM $this->tabla";

        $records = $this->conex->prepare($query);

        $records->execute();
        $datos = $records->fetchAll(PDO::FETCH_ASSOC);
  
        $records = NULL;
        return $datos;
    }

    public function Transaccion($peticion, )
    {
        switch ($peticion) {
            case "crear":

                return $this->registrar_configuracion();

            case "consultar":
                return $this->consultar_tabla();

            case "eliminar":
                return $this->eliminar_configuracion();

            case "reporte":
                return $this->eliminar_configuracion();

            default:
                "error";
                break;
        }
        $this->conex = NULL;
    }
}
