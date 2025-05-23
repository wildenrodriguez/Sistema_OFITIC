<?php
require_once('model/conexion.php');

class HojaServicio extends Conexion
{
    private $codigo_hoja_servicio;
    private $nro_solicitud;
    private $id_tipo_servicio;
    private $redireccion;
    private $cedula_tecnico;
    private $fecha_resultado;
    private $resultado_hoja_servicio;
    private $observacion;
    private $estatus;
    private $detalles = [];

    public function __construct()
    {
        $this->conex = new Conexion("sistema");
        $this->conex = $this->conex->Conex();
    }

    // Setters y Getters
    public function set_codigo_hoja_servicio($codigo) { $this->codigo_hoja_servicio = $codigo; }
    public function get_codigo_hoja_servicio() { return $this->codigo_hoja_servicio; }
    
    public function set_nro_solicitud($nro) { $this->nro_solicitud = $nro; }
    public function get_nro_solicitud() { return $this->nro_solicitud; }
    
    public function set_id_tipo_servicio($id) { $this->id_tipo_servicio = $id; }
    public function get_id_tipo_servicio() { return $this->id_tipo_servicio; }
    
    public function set_redireccion($redireccion) { $this->redireccion = $redireccion; }
    public function get_redireccion() { return $this->redireccion; }
    
    public function set_cedula_tecnico($cedula) { $this->cedula_tecnico = $cedula; }
    public function get_cedula_tecnico() { return $this->cedula_tecnico; }
    
    public function set_fecha_resultado($fecha) { $this->fecha_resultado = $fecha; }
    public function get_fecha_resultado() { return $this->fecha_resultado; }
    
    public function set_resultado_hoja_servicio($resultado) { $this->resultado_hoja_servicio = $resultado; }
    public function get_resultado_hoja_servicio() { return $this->resultado_hoja_servicio; }
    
    public function set_observacion($observacion) { $this->observacion = $observacion; }
    public function get_observacion() { return $this->observacion; }
    
    public function set_estatus($estatus) { $this->estatus = $estatus; }
    public function get_estatus() { return $this->estatus; }
    
    public function set_detalles($detalles) { $this->detalles = $detalles; }
    public function get_detalles() { return $this->detalles; }

    private function existeHoja()
    {
        try {
            $stm = $this->conex->prepare("SELECT * FROM hoja_servicio WHERE codigo_hoja_servicio = ?");
            $stm->execute([$this->codigo_hoja_servicio]);
            return $stm->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return false;
        }
    }

    private function tiposServicioDisponibles()
    {
        try {
            $sql = "SELECT ts.id_tipo_servicio, ts.nombre_tipo_servicio 
                    FROM tipo_servicio ts 
                    WHERE ts.id_tipo_servicio NOT IN (
                        SELECT hs.id_tipo_servicio 
                        FROM hoja_servicio hs 
                        WHERE hs.nro_solicitud = ?
                    ) AND ts.estatus = 1";
            $stm = $this->conex->prepare($sql);
            $stm->execute([$this->nro_solicitud]);
            return $stm->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return [];
        }
    }

    private function obtenerDatosHoja()
    {
        try {
            $sql = "SELECT
                hs.codigo_hoja_servicio,
                hs.nro_solicitud,
                hs.id_tipo_servicio,
                ts.nombre_tipo_servicio,
                hs.redireccion,
                hs.cedula_tecnico,
                CONCAT(tec.nombre_empleado, ' ', tec.apellido_empleado) AS nombre_tecnico,
                hs.fecha_resultado,
                hs.resultado_hoja_servicio,
                hs.observacion,
                hs.estatus,
                s.motivo,
                s.fecha_solicitud,
                s.estado_solicitud,
                CONCAT(sol.nombre_empleado, ' ', sol.apellido_empleado) AS nombre_solicitante,
                sol.telefono_empleado,
                u.nombre_unidad,
                d.nombre AS nombre_dependencia,
                e.tipo_equipo,
                m.nombre_marca,
                e.serial,
                b.codigo_bien
            FROM hoja_servicio hs
            LEFT JOIN solicitud s ON hs.nro_solicitud = s.nro_solicitud
            LEFT JOIN tipo_servicio ts ON hs.id_tipo_servicio = ts.id_tipo_servicio
            LEFT JOIN empleado sol ON s.cedula_solicitante = sol.cedula_empleado
            LEFT JOIN empleado tec ON hs.cedula_tecnico = tec.cedula_empleado
            LEFT JOIN unidad u ON sol.id_unidad = u.id_unidad
            LEFT JOIN dependencia d ON u.id_dependencia = d.id
            LEFT JOIN equipo e ON s.id_equipo = e.id_equipo
            LEFT JOIN bien b ON e.codigo_bien = b.codigo_bien
            LEFT JOIN marca m ON b.id_marca = m.id_marca
            WHERE hs.codigo_hoja_servicio = ?";
            
            $stm = $this->conex->prepare($sql);
            $stm->execute([$this->codigo_hoja_servicio]);
            return $stm->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return false;
        }
    }

    private function consultarDetalles()
    {
        try {
            $sql = "SELECT componente, detalle, id_movimiento_material 
                    FROM detalle_hoja 
                    WHERE codigo_hoja_servicio = ?";
            $stm = $this->conex->prepare($sql);
            $stm->execute([$this->codigo_hoja_servicio]);
            return $stm->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return [];
        }
    }

    private function registrarDetalles()
    {
        try {
            $this->conex->beginTransaction();
            
            $sql = "INSERT INTO detalle_hoja 
                    (codigo_hoja_servicio, componente, detalle) 
                    VALUES (?, ?, ?)";
            $stm = $this->conex->prepare($sql);
            
            foreach ($this->detalles as $detalle) {
                $stm->execute([
                    $this->codigo_hoja_servicio,
                    $detalle['componente'],
                    $detalle['detalle']
                ]);
            }
            
            $this->conex->commit();
            return true;
        } catch (PDOException $e) {
            $this->conex->rollBack();
            return false;
        }
    }

    private function finalizarHoja()
    {
        try {
            $sql = "UPDATE hoja_servicio 
                    SET cedula_tecnico = ?, 
                        fecha_resultado = NOW(),
                        resultado_hoja_servicio = ?,
                        observacion = ?,
                        estatus = 'I' 
                    WHERE codigo_hoja_servicio = ?";
            $stm = $this->conex->prepare($sql);
            return $stm->execute([
                $this->cedula_tecnico,
                $this->resultado_hoja_servicio,
                $this->observacion,
                $this->codigo_hoja_servicio
            ]);
        } catch (PDOException $e) {
            return false;
        }
    }

    private function limpiarDetalles()
    {
        try {
            $sql = "DELETE FROM detalle_hoja WHERE codigo_hoja_servicio = ?";
            $stm = $this->conex->prepare($sql);
            return $stm->execute([$this->codigo_hoja_servicio]);
        } catch (PDOException $e) {
            return false;
        }
    }

    private function listarHojasSolicitud()
    {
        try {
            $sql = "SELECT codigo_hoja_servicio 
                    FROM hoja_servicio 
                    WHERE nro_solicitud = ?";
            $stm = $this->conex->prepare($sql);
            $stm->execute([$this->nro_solicitud]);
            return $stm->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return [];
        }
    }

    private function registrarHoja()
    {
        try {
            $sql = "INSERT INTO hoja_servicio 
                    (nro_solicitud, id_tipo_servicio, estatus) 
                    VALUES (?, ?, 'A')";
            $stm = $this->conex->prepare($sql);
            $stm->execute([$this->nro_solicitud, $this->id_tipo_servicio]);
            return $this->conex->lastInsertId();
        } catch (PDOException $e) {
            return false;
        }
    }

    private function actualizarHoja()
    {
        try {
            $sql = "UPDATE hoja_servicio 
                    SET observacion = ?, 
                        resultado_hoja_servicio = ?,
                        fecha_resultado = NOW()
                    WHERE codigo_hoja_servicio = ?";
            $stm = $this->conex->prepare($sql);
            return $stm->execute([
                $this->observacion,
                $this->resultado_hoja_servicio,
                $this->codigo_hoja_servicio
            ]);
        } catch (PDOException $e) {
            return false;
        }
    }

    private function listarTiposServicio()
    {
        try {
            $sql = "SELECT * FROM tipo_servicio WHERE estatus = 1";
            $stm = $this->conex->prepare($sql);
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return [];
        }
    }

    private function serviciosPorTipo()
    {
        try {
            $sql = "SELECT
                hs.codigo_hoja_servicio,
                hs.nro_solicitud,
                hs.fecha_resultado,
                CONCAT(e.nombre_empleado, ' ', e.apellido_empleado) AS solicitante,
                eq.tipo_equipo,
                m.nombre_marca,
                eq.serial,
                b.codigo_bien,
                s.motivo,
                s.fecha_solicitud,
                hs.resultado_hoja_servicio,
                hs.estatus
            FROM hoja_servicio hs
            JOIN solicitud s ON hs.nro_solicitud = s.nro_solicitud
            JOIN empleado e ON s.cedula_solicitante = e.cedula_empleado
            LEFT JOIN equipo eq ON s.id_equipo = eq.id_equipo
            LEFT JOIN bien b ON eq.codigo_bien = b.codigo_bien
            LEFT JOIN marca m ON b.id_marca = m.id_marca
            WHERE hs.id_tipo_servicio = ? AND hs.estatus = 'A'
            ORDER BY hs.fecha_resultado DESC";
            
            $stm = $this->conex->prepare($sql);
            $stm->execute([$this->id_tipo_servicio]);
            return $stm->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return [];
        }
    }

    private function todosServicios()
    {
        try {
            $sql = "SELECT
                hs.codigo_hoja_servicio,
                hs.nro_solicitud,
                ts.nombre_tipo_servicio,
                hs.fecha_resultado,
                CONCAT(e.nombre_empleado, ' ', e.apellido_empleado) AS solicitante,
                eq.tipo_equipo,
                m.nombre_marca,
                eq.serial,
                b.codigo_bien,
                s.motivo,
                s.fecha_solicitud,
                hs.resultado_hoja_servicio,
                hs.estatus
            FROM hoja_servicio hs
            JOIN solicitud s ON hs.nro_solicitud = s.nro_solicitud
            JOIN tipo_servicio ts ON hs.id_tipo_servicio = ts.id_tipo_servicio
            JOIN empleado e ON s.cedula_solicitante = e.cedula_empleado
            LEFT JOIN equipo eq ON s.id_equipo = eq.id_equipo
            LEFT JOIN bien b ON eq.codigo_bien = b.codigo_bien
            LEFT JOIN marca m ON b.id_marca = m.id_marca
            WHERE hs.estatus = 'A'
            ORDER BY hs.fecha_resultado DESC";
            
            $stm = $this->conex->prepare($sql);
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return [];
        }
    }

    private function serviciosEliminados()
    {
        try {
            $sql = "SELECT
                hs.codigo_hoja_servicio,
                hs.nro_solicitud,
                ts.nombre_tipo_servicio,
                hs.fecha_resultado,
                CONCAT(e.nombre_empleado, ' ', e.apellido_empleado) AS solicitante,
                eq.tipo_equipo,
                m.nombre_marca,
                eq.serial,
                b.codigo_bien,
                s.motivo,
                s.fecha_solicitud,
                hs.resultado_hoja_servicio
            FROM hoja_servicio hs
            JOIN solicitud s ON hs.nro_solicitud = s.nro_solicitud
            JOIN tipo_servicio ts ON hs.id_tipo_servicio = ts.id_tipo_servicio
            JOIN empleado e ON s.cedula_solicitante = e.cedula_empleado
            LEFT JOIN equipo eq ON s.id_equipo = eq.id_equipo
            LEFT JOIN bien b ON eq.codigo_bien = b.codigo_bien
            LEFT JOIN marca m ON b.id_marca = m.id_marca
            WHERE hs.estatus = 'E'
            ORDER BY hs.fecha_resultado DESC";
            
            $stm = $this->conex->prepare($sql);
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return [];
        }
    }

    private function restaurarServicio()
    {
        try {
            $sql = "UPDATE hoja_servicio SET estatus = 'A' WHERE codigo_hoja_servicio = ?";
            $stm = $this->conex->prepare($sql);
            return $stm->execute([$this->codigo_hoja_servicio]);
        } catch (PDOException $e) {
            return false;
        }
    }

    public function Transaccion($peticion)
    {
        // Asignar propiedades según la petición
        if (isset($peticion['codigo_hoja_servicio'])) {
            $this->set_codigo_hoja_servicio($peticion['codigo_hoja_servicio']);
        }
        if (isset($peticion['nro_solicitud'])) {
            $this->set_nro_solicitud($peticion['nro_solicitud']);
        }
        if (isset($peticion['id_tipo_servicio'])) {
            $this->set_id_tipo_servicio($peticion['id_tipo_servicio']);
        }
        if (isset($peticion['cedula_tecnico'])) {
            $this->set_cedula_tecnico($peticion['cedula_tecnico']);
        }
        if (isset($peticion['resultado_hoja_servicio'])) {
            $this->set_resultado_hoja_servicio($peticion['resultado_hoja_servicio']);
        }
        if (isset($peticion['observacion'])) {
            $this->set_observacion($peticion['observacion']);
        }
        if (isset($peticion['detalles'])) {
            $this->set_detalles($peticion['detalles']);
        }

        switch ($peticion['peticion']) {
            case 'nuevo':
                return $this->registrarHoja();
            case 'tipos_disponibles':
                return $this->tiposServicioDisponibles();
            case 'consultar_tipos':
                return $this->listarTiposServicio();
            case 'consultar_detalles':
                return $this->consultarDetalles();
            case 'consultar':
                return $this->obtenerDatosHoja();
            case 'actualizar':
                return $this->actualizarHoja();
            case 'registrar_detalles':
                return $this->registrarDetalles();
            case 'servicios_todos':
                return $this->todosServicios();
            case 'servicios_por_tipo':
                return $this->serviciosPorTipo();
            case 'finalizar':
                return $this->finalizarHoja();
            case 'limpiar_detalles':
                return $this->limpiarDetalles();
            case 'listar':
                return $this->listarHojasSolicitud();
            case 'servicios_eliminados':
                return $this->serviciosEliminados();
            case 'restaurar':
                return $this->restaurarServicio();
            default:
                return ['error' => 'Petición no válida'];
        }
    }
}