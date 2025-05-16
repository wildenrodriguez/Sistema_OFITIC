<?php
require_once "model/conexion.php";
class Bien extends Conexion
{
    private $codigo_bien;
    private $id_tipo_bien;
    private $id_marca;
    private $descripcion;
    private $estado;
    private $cedula_empleado;
    private $id_oficina;
    private $estatus;

    public function __construct()
    {
        $this->conex = new Conexion("sistema");
        $this->conex = $this->conex->Conex();
    }

    public function set_codigo_bien($codigo_bien)
    {
        $this->codigo_bien = $codigo_bien;
    }

    public function set_id_tipo_bien($id_tipo_bien)
    {
        $this->id_tipo_bien = $id_tipo_bien;
    }

    public function set_id_marca($id_marca)
    {
        $this->id_marca = $id_marca;
    }

    public function set_descripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }

    public function set_estado($estado)
    {
        $this->estado = $estado;
    }

    public function set_cedula_empleado($cedula_empleado)
    {
        $this->cedula_empleado = $cedula_empleado;
    }

    public function set_id_oficina($id_oficina)
    {
        $this->id_oficina = $id_oficina;
    }

    public function set_estatus($estatus)
    {
        $this->estatus = $estatus;
    }

    public function get_codigo_bien()
    {
        return $this->codigo_bien;
    }

    public function get_id_tipo_bien()
    {
        return $this->id_tipo_bien;
    }

    public function get_id_marca()
    {
        return $this->id_marca;
    }

    public function get_descripcion()
    {
        return $this->descripcion;
    }

    public function get_estado()
    {
        return $this->estado;
    }

    public function get_cedula_empleado()
    {
        return $this->cedula_empleado;
    }

    public function get_id_oficina()
    {
        return $this->id_oficina;
    }

    public function get_estatus()
    {
        return $this->estatus;
    }

    private function Validar()
    {
        $dato = [];

        try {
            $query = "SELECT * FROM bien WHERE codigo_bien = :codigo";

            $stm = $this->conex->prepare($query);
            $stm->bindParam(":codigo", $this->codigo_bien);
            $stm->execute();

            if ($stm->rowCount() > 0) {
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

    private function Registrar()
    {
        $dato = [];
        $bool = $this->Validar();

        if ($bool['bool'] == 0) {
            try {
                $query = "INSERT INTO bien(codigo_bien, id_tipo_bien, id_marca, descripcion, estado, cedula_empleado, id_oficina, estatus) VALUES 
                (:codigo, :tipo_bien, :marca, :descripcion, :estado, :empleado, :oficina, 1)";

                $stm = $this->conex->prepare($query);
                $stm->bindParam(":codigo", $this->codigo_bien);
                $stm->bindParam(":tipo_bien", $this->id_tipo_bien);
                $stm->bindParam(":marca", $this->id_marca);
                $stm->bindParam(":descripcion", $this->descripcion);
                $stm->bindParam(":estado", $this->estado);
                $stm->bindParam(":empleado", $this->cedula_empleado);
                $stm->bindParam(":oficina", $this->id_oficina);
                $stm->execute();
                $dato['resultado'] = "registrar";
                $dato['estado'] = 1;
                $dato['mensaje'] = "Se registró el bien exitosamente";
            } catch (PDOException $e) {
                $dato['resultado'] = "error";
                $dato['estado'] = -1;
                $dato['mensaje'] = $e->getMessage();
            }
        } else {
            $dato['resultado'] = "error";
            $dato['estado'] = -1;
            $dato['mensaje'] = "Registro duplicado";
        }
        $this->Cerrar_Conexion($this->conex, $stm);
        return $dato;
    }

    private function Actualizar()
    {
        $dato = [];

        try {
            $query = "UPDATE bien SET id_tipo_bien=:tipo_bien, id_marca=:marca, descripcion=:descripcion, 
                     estado=:estado, cedula_empleado=:empleado, id_oficina=:oficina 
                     WHERE codigo_bien = :codigo";

            $stm = $this->conex->prepare($query);
            $stm->bindParam(":codigo", $this->codigo_bien);
            $stm->bindParam(":tipo_bien", $this->id_tipo_bien);
            $stm->bindParam(":marca", $this->id_marca);
            $stm->bindParam(":descripcion", $this->descripcion);
            $stm->bindParam(":estado", $this->estado);
            $stm->bindParam(":empleado", $this->cedula_empleado);
            $stm->bindParam(":oficina", $this->id_oficina);
            $stm->execute();
            $dato['resultado'] = "modificar";
            $dato['estado'] = 1;
            $dato['mensaje'] = "Se modificaron los datos del bien con éxito";
        } catch (PDOException $e) {
            $dato['estado'] = -1;
            $dato['resultado'] = "error";
            $dato['mensaje'] = $e->getMessage();
        }
        $this->Cerrar_Conexion($this->conex, $stm);
        return $dato;
    }

    private function Eliminar()
    {
        $dato = [];
        $bool = $this->Validar();

        if ($bool['bool'] != 0) {
            try {
                $query = "UPDATE bien SET estatus = 0 WHERE codigo_bien = :codigo";

                $stm = $this->conex->prepare($query);
                $stm->bindParam(":codigo", $this->codigo_bien);
                $stm->execute();
                $dato['resultado'] = "eliminar";
                $dato['estado'] = 1;
                $dato['mensaje'] = "Se eliminó el bien exitosamente";
            } catch (PDOException $e) {
                $dato['resultado'] = "error";
                $dato['estado'] = -1;
                $dato['mensaje'] = $e->getMessage();
            }
        } else {
            $dato['resultado'] = "error";
            $dato['estado'] = -1;
            $dato['mensaje'] = "Error al eliminar el registro";
        }
        $this->Cerrar_Conexion($this->conex, $stm);
        return $dato;
    }

    private function Consultar()
    {
        $dato = [];

        try {
            $query = "SELECT b.*, tb.nombre_tipo_bien, m.nombre_marca, o.nombre_oficina, 
                     CONCAT(e.nombre_empleado, ' ', e.apellido_empleado) AS empleado
                     FROM bien b 
                     LEFT JOIN tipo_bien tb ON b.id_tipo_bien = tb.id_tipo_bien
                     LEFT JOIN marca m ON b.id_marca = m.id_marca
                     LEFT JOIN oficina o ON b.id_oficina = o.id_oficina
                     LEFT JOIN empleado e ON b.cedula_empleado = e.cedula_empleado
                     WHERE b.estatus = 1";

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

    public function ConsultarTiposBien()
    {
        try {
            $query = "SELECT * FROM tipo_bien WHERE estatus = 1";
            $stm = $this->conex->prepare($query);
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return [];
        }
    }

    public function ConsultarMarcas()
    {
        try {
            $query = "SELECT * FROM marca WHERE estatus = 1";
            $stm = $this->conex->prepare($query);
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return [];
        }
    }

    public function ConsultarOficinas()
    {
        try {
            $query = "SELECT * FROM oficina WHERE estatus = 1";
            $stm = $this->conex->prepare($query);
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return [];
        }
    }

    public function ConsultarEmpleados()
    {
        try {
            $query = "SELECT cedula_empleado, CONCAT(nombre_empleado, ' ', apellido_empleado) AS nombre_completo 
                     FROM empleado";
            $stm = $this->conex->prepare($query);
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return [];
        }
    }

    private function ConsultarEliminadas()
    {
        $dato = [];

        try {
            $query = "SELECT b.*, tb.nombre_tipo_bien, m.nombre_marca
                     FROM bien b 
                     LEFT JOIN tipo_bien tb ON b.id_tipo_bien = tb.id_tipo_bien
                     LEFT JOIN marca m ON b.id_marca = m.id_marca
                     WHERE b.estatus = 0";

            $stm = $this->conex->prepare($query);
            $stm->execute();
            $dato['resultado'] = "consultar_eliminadas";
            $dato['datos'] = $stm->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $dato['resultado'] = "error";
            $dato['mensaje'] = $e->getMessage();
        }
        $this->Cerrar_Conexion($this->conex, $stm);
        return $dato;
    }

    private function Restaurar()
    {
        $dato = [];
        try {
            $query = "UPDATE bien SET estatus = 1 WHERE codigo_bien = :codigo";

            $stm = $this->conex->prepare($query);
            $stm->bindParam(":codigo", $this->codigo_bien);
            $stm->execute();
            $dato['resultado'] = "restaurar";
            $dato['estado'] = 1;
            $dato['mensaje'] = "Bien restaurado exitosamente";
            
            $msg = "(" . $_SESSION['user']['nombre_usuario'] . "), Se restauró el bien Código: " . $this->codigo_bien;
            Bitacora($msg, "Bien");
        } catch (PDOException $e) {
            $dato['resultado'] = "error";
            $dato['estado'] = -1;
            $dato['mensaje'] = $e->getMessage();
        }
        $this->Cerrar_Conexion($this->conex, $stm);
        return $dato;
    }

    public function Transaccion($peticion)
    {
        switch ($peticion['peticion']) {
            case 'registrar':
                return $this->Registrar();

            case 'consultar':
                return $this->Consultar();

            case 'consultar_eliminadas':
                return $this->ConsultarEliminadas();   

            case 'consultar_tipos_bien':
                return $this->ConsultarTiposBien();

            case 'consultar_marcas':
                return $this->ConsultarMarcas();

            case 'consultar_oficinas':
                return $this->ConsultarOficinas();

            case 'consultar_empleados':
                return $this->ConsultarEmpleados();

            case 'actualizar':
                return $this->Actualizar();

            case 'eliminar':
                return $this->Eliminar();

            case 'restaurar':
                return $this->Restaurar();

            default:
                return "Operacion: " . $peticion['peticion'] . " no valida";
        }
    }
}
?>