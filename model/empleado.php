<?php

require_once('model/conexion.php');

class Empleado extends Conexion
{

    private $cedula;
    private $nombre;
    private $apellido;
    private $cargo;
    private $unidad;
    private $dependencia;
    private $telefono;
    private $correo;

    public function __construct()
    {
        $this->conex = new Conexion("sistema");
        $this->conex = $this->conex->Conex();
    }

    public function set_cedula($cedula)
    {
        $this->cedula = $cedula;
    }

    public function get_cedula()
    {
        return $this->cedula;
    }

    public function set_nombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public function get_nombre()
    {
        return $this->nombre;
    }

    public function set_apellido($apellido)
    {
        $this->apellido = $apellido;
    }

    public function get_apellido()
    {
        return $this->apellido;
    }

    public function set_telefono($telefono)
    {
        $this->telefono = $telefono;
    }

    public function get_telefono()
    {
        return $this->telefono;
    }

    public function set_correo($correo)
    {
        $this->correo = $correo;
    }

    public function get_correo()
    {
        return $this->correo;
    }


    public function set_unidad($unidad)
    {
        $this->unidad = $unidad;
    }

    public function get_cargo()
    {
        return $this->cargo;
    }
    public function set_cargo($cargo)
    {
        $this->cargo = $cargo;
    }

    public function get_unidad()
    {
        return $this->unidad;
    }

    public function set_dependencia($dependencia)
    {
        $this->dependencia = $dependencia;
    }

    public function get_dependencia()
    {
        return $this->dependencia;
    }

    private function Empleados_dependencia($dependenciaId)
    {
        $datos = [];

        try {
            $sql = "SELECT cedula, nombre FROM empleado WHERE cod_dependencia = ?";

            $stm = $this->conex->prepare($sql);
            $stm->bindParam(1, $dependenciaId);
            $stm->execute();
            $datos['resultado'] = "consulta_dependencia";
            $datos['datos'] = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $datos['resultado'] = "error";
            $datos['mensaje'] = $e->getMessage();
        }

        return $datos;
    }

    private function Consultar($consulta = "default")
    {
        $datos = [];

        try {
            $sql = "SELECT 
            s.cedula_empleado AS cedula,
            s.nombre_empleado AS nombre,
            s.apellido_empleado AS apellido,
            s.telefono_empleado AS telefono,
            s.correo_empleado AS correo,
            u.nombre_unidad AS unidad,
            d.nombre_dependencia AS dependencia,
            c.nombre_cargo AS cargo,
            t.nombre_tipo_servicio AS servicio
        FROM empleado AS s
        LEFT JOIN unidad AS u ON s.id_unidad = u.id_unidad
        LEFT JOIN dependencia AS d ON s.id_dependencia = d.id_dependencia
        LEFT JOIN cargo AS c ON s.id_cargo = c.id_cargo
        LEFT JOIN tipo_servicio AS t ON s.id_servicio = t.id_tipo_servicio";

            $stm = $this->conex->prepare($sql);
            $stm->execute($this->cedula);
            $datos['resultado'] = "consultar";
            $datos['datos'] = $stm->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $datos['resultado'] = "error";
            $datos['mensaje'] = $e->getMessage();
        }
        return $datos;
    }

    private function Validar()
    {
        $stm = $this->conex->prepare("SELECT * FROM empleado WHERE cedula=?");
        $stm->execute($this->cedula);
        return $stm->fetch();
    }

    private function Eliminar()
    {

        $sql = "DELETE FROM empleado WHERE cedula=?";
        $stm = $this->conex->prepare($sql);
        $stm->execute($this->cedula);

        if ($stm->rowCount() > 0) {
            return true;
        } else {
            return NULL;
        }

    }


    private function Registrar()
    {
        $stm = $this->conex->prepare("INSERT INTO empleado() VALUES (:cedula,:nombre,:apellido,:unidad," . $this->data['id_dependencia'] . ",:telefono,:correo)");
        $stm->bindValue(':cedula', $this->cedula);
        $stm->bindParam(':nombre', $this->nombre);
        $stm->bindParam(':apellido', $this->apellido);
        $stm->bindParam(':unidad', $this->unidad);
        $stm->bindParam(':dependencia', $this->dependencia);
        $stm->bindParam(':telefono', $this->telefono);
        $stm->bindParam(':correo', $this->correo);
        return $stm->execute();

    }

    private function Modificar()
    {
        $stm = $this->conex->prepare("UPDATE empleado SET nombre = :nombre, apellido = :apellido, telefono = :telefono, correo = :correo WHERE cedula = :cedula");
        $stm->bindValue(':cedula', $this->cedula);
        $stm->bindParam(':nombre', $this->nombre);
        $stm->bindParam(':apellido', $this->apellido);
        $stm->bindParam(':telefono', $this->telefono);
        $stm->bindParam(':correo', $this->correo);

        if ($stm->execute()) {
            return true;
        } else {
            return false;
        }

    }

    private function consultar_solicitantes()
    {

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

    private function verificar_Validarencia()
    {

        $sql = "SELECT * FROM empleado WHERE cedula = :cedula";

        $stmsulta = $this->conex->prepare($sql);

        $stmsulta->bindParam(':cedula', $this->cedula);

        $stmsulta->execute();

        return $stmsulta->rowCount() > 0;
    }

    private function mis_servicios()
    {

        $query = "SELECT * FROM orden_solicitud WHERE cedula_solicitante=:cedula";

        $records = $this->conex->prepare($query);

        $records->bindParam(':cedula', $this->cedula);

        $records->execute();

        return $records->fetchAll(PDO::FETCH_ASSOC);

    }

    private function obtener_cedulas()
    {
        $query = "SELECT cedula FROM empleado";

        $records = $this->conex->prepare($query);

        $records->execute();

        return $records->fetchAll(PDO::FETCH_ASSOC);
    }

    public function Transaccion($peticion)
    {

        switch ($peticion['peticion']) {
            case 'Registrar':
                return $this->Registrar();

            case 'Modificar':
                return $this->Modificar();

            case 'Eliminar':
                return $this->Eliminar();

            case 'consultar':
                return $this->Consultar();

            case 'verificar':
                return $this->verificar_Validarencia();

            case 'listar':
                return $this->consultar_solicitantes();

            case 'empleados_dependencia':
                if (isset($peticion['dependenciaId'])) {
                    return $this->Empleados_dependencia($peticion['dependenciaId']);
                }

            case 'mis_servicios':
                if (isset($peticion['cedula'])) {
                    $this->cedula = $peticion['cedula'];
                    return $this->mis_servicios();
                }

            default:
                return false;
        }
    }
}
?>