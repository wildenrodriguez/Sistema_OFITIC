<?php

require_once('model/conexion.php');

class Empleado extends Conexion
{
    private $cedula;
    private $nombre;
    private $apellido;
    private $id_cargo;
    private $id_servicio;
    private $id_unidad;
    private $telefono;
    private $correo;

    public function __construct()
    {
        $this->conex = new Conexion("sistema");
        $this->conex = $this->conex->Conex();
    }

    // Setters y Getters
    public function set_cedula($cedula) { $this->cedula = $cedula; }
    public function get_cedula() { return $this->cedula; }
    
    public function set_nombre($nombre) { $this->nombre = $nombre; }
    public function get_nombre() { return $this->nombre; }
    
    public function set_apellido($apellido) { $this->apellido = $apellido; }
    public function get_apellido() { return $this->apellido; }
    
    public function set_telefono($telefono) { $this->telefono = $telefono; }
    public function get_telefono() { return $this->telefono; }
    
    public function set_correo($correo) { $this->correo = $correo; }
    public function get_correo() { return $this->correo; }
    
    public function set_id_cargo($id_cargo) { $this->id_cargo = $id_cargo; }
    public function get_id_cargo() { return $this->id_cargo; }
    
    public function set_id_servicio($id_servicio) { $this->id_servicio = $id_servicio; }
    public function get_id_servicio() { return $this->id_servicio; }
    
    public function set_id_unidad($id_unidad) { $this->id_unidad = $id_unidad; }
    public function get_id_unidad() { return $this->id_unidad; }

    private function Registrar()
    {
        try {
            $stm = $this->conex->prepare("INSERT INTO empleado 
                (cedula_empleado, nombre_empleado, apellido_empleado, id_cargo, id_servicio, id_unidad, telefono_empleado, correo_empleado) 
                VALUES (:cedula, :nombre, :apellido, :cargo, :servicio, :unidad, :telefono, :correo)");
            
            $stm->bindParam(':cedula', $this->cedula);
            $stm->bindParam(':nombre', $this->nombre);
            $stm->bindParam(':apellido', $this->apellido);
            $stm->bindParam(':cargo', $this->id_cargo);
            $stm->bindParam(':servicio', $this->id_servicio);
            $stm->bindParam(':unidad', $this->id_unidad);
            $stm->bindParam(':telefono', $this->telefono);
            $stm->bindParam(':correo', $this->correo);
            
            return $stm->execute();
        } catch (PDOException $e) {
            return false;
        }
    }

    private function Consultar($filtro = null)
    {
        $datos = [];
        try {
            $sql = "SELECT 
                e.cedula_empleado AS cedula,
                e.nombre_empleado AS nombre,
                e.apellido_empleado AS apellido,
                e.telefono_empleado AS telefono,
                e.correo_empleado AS correo,
                u.nombre_unidad AS unidad,
                CONCAT(et.nombre,' - ',d.nombre) AS dependencia,
                c.nombre_cargo AS cargo,
                ts.nombre_tipo_servicio AS servicio
            FROM empleado AS e
            LEFT JOIN unidad AS u ON e.id_unidad = u.id_unidad
            LEFT JOIN dependencia AS d ON u.id_dependencia = d.id
            LEFT JOIN ente AS et ON d.id_ente = et.id
            LEFT JOIN cargo AS c ON e.id_cargo = c.id_cargo
            LEFT JOIN tipo_servicio AS ts ON e.id_servicio = ts.id_tipo_servicio";
            
            if ($filtro && isset($filtro['cedula'])) {
                $sql .= " WHERE e.cedula_empleado = :cedula";
                $stm = $this->conex->prepare($sql);
                $stm->bindParam(':cedula', $filtro['cedula']);
            } else {
                $stm = $this->conex->prepare($sql);
            }
            
            $stm->execute();
            $datos['resultado'] = "consultar";
            $datos['datos'] = $stm->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $datos['resultado'] = "error";
            $datos['mensaje'] = $e->getMessage();
        }
        return $datos;
    }

    private function Empleados_dependencia($dependenciaId)
    {
        $datos = [];
        try {
            $sql = "SELECT 
                e.cedula_empleado AS cedula, 
                CONCAT(e.nombre_empleado, ' ', e.apellido_empleado) AS nombre 
            FROM empleado AS e
            JOIN unidad AS u ON e.id_unidad = u.id_unidad
            WHERE u.id_dependencia = ?";
            
            $stm = $this->conex->prepare($sql);
            $stm->bindParam(1, $dependenciaId, PDO::PARAM_INT);
            $stm->execute();
            
            $datos['resultado'] = "success";
            $datos['datos'] = $stm->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $datos['resultado'] = "error";
            $datos['mensaje'] = $e->getMessage();
        }
        return $datos;
    }

    private function Validar()
    {
        try {
            $stm = $this->conex->prepare("SELECT * FROM empleado WHERE cedula_empleado = ?");
            $stm->execute([$this->cedula]);
            return $stm->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return false;
        }
    }

    private function Eliminar()
    {
        try {
            $sql = "DELETE FROM empleado WHERE cedula_empleado = ?";
            $stm = $this->conex->prepare($sql);
            $stm->execute([$this->cedula]);
            return $stm->rowCount() > 0;
        } catch (PDOException $e) {
            return false;
        }
    }

    private function Modificar()
    {
        try {
            $stm = $this->conex->prepare("UPDATE empleado SET 
                nombre_empleado = :nombre, 
                apellido_empleado = :apellido, 
                id_cargo = :cargo,
                id_servicio = :servicio,
                id_unidad = :unidad,
                telefono_empleado = :telefono, 
                correo_empleado = :correo 
                WHERE cedula_empleado = :cedula");
                
            $stm->bindParam(':cedula', $this->cedula);
            $stm->bindParam(':nombre', $this->nombre);
            $stm->bindParam(':apellido', $this->apellido);
            $stm->bindParam(':cargo', $this->id_cargo);
            $stm->bindParam(':servicio', $this->id_servicio);
            $stm->bindParam(':unidad', $this->id_unidad);
            $stm->bindParam(':telefono', $this->telefono);
            $stm->bindParam(':correo', $this->correo);
            
            return $stm->execute();
        } catch (PDOException $e) {
            return false;
        }
    }

    private function consultar_solicitantes()
    {
        try {
            $query = "SELECT 
                e.cedula_empleado AS cedula, 
                e.nombre_empleado AS nombre, 
                e.apellido_empleado AS apellido, 
                e.telefono_empleado AS telefono, 
                e.correo_empleado AS correo, 
                u.nombre_unidad AS unidad, 
                d.nombre AS dependencia
            FROM empleado AS e
            JOIN unidad AS u ON e.id_unidad = u.id_unidad
            JOIN dependencia AS d ON u.id_dependencia = d.id";
            
            $stm = $this->conex->prepare($query);
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return [];
        }
    }

    private function mis_servicios()
    {
        try {
            $query = "SELECT * FROM solicitud WHERE cedula_solicitante = ?";
            $stm = $this->conex->prepare($query);
            $stm->execute([$this->cedula]);
            return $stm->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return [];
        }
    }

    public function Transaccion($peticion)
    {
        if (isset($peticion['cedula'])) {
            $this->set_cedula($peticion['cedula']);
        }
        if (isset($peticion['nombre'])) {
            $this->set_nombre($peticion['nombre']);
        }
        if (isset($peticion['apellido'])) {
            $this->set_apellido($peticion['apellido']);
        }
        if (isset($peticion['id_cargo'])) {
            $this->set_id_cargo($peticion['id_cargo']);
        }
        if (isset($peticion['id_servicio'])) {
            $this->set_id_servicio($peticion['id_servicio']);
        }
        if (isset($peticion['id_unidad'])) {
            $this->set_id_unidad($peticion['id_unidad']);
        }
        if (isset($peticion['telefono'])) {
            $this->set_telefono($peticion['telefono']);
        }
        if (isset($peticion['correo'])) {
            $this->set_correo($peticion['correo']);
        }

        switch ($peticion['peticion']) {
            case 'Registrar':
                return $this->Registrar();
            case 'Modificar':
                return $this->Modificar();
            case 'Eliminar':
                return $this->Eliminar();
            case 'consultar':
                return $this->Consultar($peticion);
            case 'Validar':
                return $this->Validar();
            case 'listar':
                return $this->consultar_solicitantes();
            case 'empleados_dependencia':
                return $this->Empleados_dependencia($peticion['dependenciaId']);
            case 'mis_servicios':
                return $this->mis_servicios();
            default:
                return ['resultado' => 'error', 'mensaje' => 'Petición no válida'];
        }
    }
}
?>