<?php
require_once('model/conexion.php');

class Equipo extends Conexion
{
    private $data;

    public function __construct()
    {
        parent::__construct();
        $this->conex = parent::Conex();
        $this->data = array();
    }

    public function set_datos($datos)
    {
        $this->data = $datos;
    }

    private function Validar()
    {
        $query = "SELECT id_equipo FROM equipo WHERE serial = :serial";
        $stmt = $this->conex->prepare($query);
        $stmt->bindParam(':serial', $this->data['serial']);
        $stmt->execute();
        return $stmt->rowCount() > 0;
    }

    private function ValidarBien()
    {
        $query = "SELECT id_equipo FROM equipo WHERE nro_bien = :nro_bien";
        
        // Si estamos excluyendo un equipo (para edición)
        if (!empty($this->data['excluir'])) {
            $query .= " AND id_equipo != :excluir";
        }
        
        $stmt = $this->conex->prepare($query);
        $stmt->bindParam(':nro_bien', $this->data['nro_bien']);
        
        if (!empty($this->data['excluir'])) {
            $stmt->bindParam(':excluir', $this->data['excluir']);
        }
        
        $stmt->execute();
        return $stmt->rowCount() > 0;
    }

    private function Registrar()
    {
        $query = "INSERT INTO equipo (tipo, serial, marca, nro_bien, dependencia) 
                 VALUES (:tipo, :serial, :marca, :nro_bien, :dependencia)";
        
        $stmt = $this->conex->prepare($query);
        $stmt->bindParam(':tipo', $this->data['tipo']);
        $stmt->bindParam(':serial', $this->data['serial']);
        $stmt->bindParam(':marca', $this->data['marca']);
        $stmt->bindParam(':nro_bien', $this->data['nro_bien']);
        $stmt->bindParam(':dependencia', $this->data['dependencia']);
        
        return $stmt->execute();
    }

    private function Consultar()
    {
        $query = "SELECT e.id_equipo, e.tipo, e.serial, e.marca AS id_marca, 
                 m.nombre AS marca, e.nro_bien, e.cod_dependencia AS id_dependencia, 
                 d.nombre AS dependencia, b.tipo_bien
                 FROM equipo AS e 
                 INNER JOIN marca AS m ON e.marca = m.codigo 
                 INNER JOIN dependencia AS d ON e.cod_dependencia = d.codigo
                 LEFT JOIN bien AS b ON e.nro_bien = b.codigo_bien";
        
        $stmt = $this->conex->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    private function Modificar()
    {
        $query = "UPDATE equipo SET 
                 tipo = :tipo, 
                 serial = :serial, 
                 marca = :marca, 
                 nro_bien = :nro_bien, 
                 dependencia = :dependencia 
                 WHERE id_equipo = :id";
        
        $stmt = $this->conex->prepare($query);
        $stmt->bindParam(':tipo', $this->data['tipo']);
        $stmt->bindParam(':serial', $this->data['serial']);
        $stmt->bindParam(':marca', $this->data['marca']);
        $stmt->bindParam(':nro_bien', $this->data['nro_bien']);
        $stmt->bindParam(':dependencia', $this->data['dependencia']);
        $stmt->bindParam(':id', $this->data['id']);
        
        return $stmt->execute();
    }

    private function Eliminar()
    {
        $query = "DELETE FROM equipo WHERE id_equipo = :id";
        $stmt = $this->conex->prepare($query);
        $stmt->bindParam(':id', $this->data['id']);
        return $stmt->execute();
    }

    private function ConsultarMarcas()
    {
        $query = "SELECT * FROM marca ORDER BY nombre ASC";
        $stmt = $this->conex->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


private function cargarBienesDisponibles($excluirBien = null)
{
    require_once('model/bien.php');
    $bien = new Bien();
    return $bien->Transaccion([
        'peticion' => 'listar_disponibles',
        'excluir_bien' => $excluirBien
    ]);
}



    public function Transaccion($peticion)
    {
        switch ($peticion["peticion"]) {
            case "registrar":
                return $this->Registrar();
                
            case "validar":
                return $this->Validar();
                
            case "validar_bien":
                return $this->ValidarBien();
                
            case "consultar":
                return $this->Consultar();
                
            case "modificar":
                return $this->Modificar();
                
            case "eliminar":
                return $this->Eliminar();
                
            case "consulta_marcas":
                return $this->ConsultarMarcas();

            case "cargar_bienes":
                return $this->cargarBienesDisponibles($peticion['excluir_bien'] ?? null);
                
            default:
                return false;
        }
    }
}
?>