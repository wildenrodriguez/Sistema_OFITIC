<?php

require_once "model/conexion.php";

class punto_conexion extends Conexion {

    private $id_punto_conexion;
    private $codigo_patch_panel;
    private $id_equipo;
    private $puerto_patch_panel;

    public function __construct() {
        $this->conex = new Conexion("sistema");
        $this->conex = $this->conex->Conex();
    }


    public function get_id_punto_conexion() {
    return $this->id_punto_conexion;
    }
    public function set_id_punto_conexion($id_punto_conexion) {
        $this->id_punto_conexion = $id_punto_conexion;
    }

    public function get_codigo_patch_panel() {
    return $this->codigo_patch_panel;
    }
    public function set_codigo_patch_panel($codigo_patch_panel) {
        $this->codigo_patch_panel = $codigo_patch_panel;
    }

    public function get_id_equipo() {
        return $this->id_equipo;
    }
    public function set_id_equipo($id_equipo) {
        $this->id_equipo = $id_equipo;
    }

    public function get_puerto_patch_panel() {
        return $this->puerto_patch_panel;
    }
    public function set_puerto_patch_panel($puerto_patch_panel) {
        $this->puerto_patch_panel = $puerto_patch_panel;
    }

    private function Validar() {

        $dato = [];

        try {

            $query = "SELECT * FROM punto_conexion WHERE codigo_patch_panel = :codigo_patch_panel AND puerto_patch_panel = :puerto_patch_panel";

            $stm = $this->conex->prepare($query);
            $stm->bindParam(":codigo_patch_panel", $this->codigo_patch_panel);
            $stm->bindParam(":puerto_patch_panel", $this->puerto_patch_panel);
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
    } //validar punto conexion, puerto -- patch panel
        

    private function Registrar() {

        $dato = [];
        $bool = $this->Validar();;

        if ($bool['bool'] == 0) {

            try {

                $query = "INSERT INTO punto_conexion(codigo_patch_panel, id_equipo,  puerto_patch_panel) VALUES 
                (:codigo_patch_panel, :id_equipo, :puerto_patch_panel)";

                $stm = $this->conex->prepare($query);
                
                $stm->bindParam(":codigo_patch_panel", $this->codigo_patch_panel);
                $stm->bindParam(":id_equipo", $this->id_equipo);
                $stm->bindParam(":puerto_patch_panel", $this->puerto_patch_panel);
                $stm->execute();
                $dato['resultado'] = "registrar";
                $dato['estado'] = 1;
                $dato['mensaje'] = "Se Registro el Punto de Conexión Exitosamente";

            } catch (PDOException $e) {

                $dato['resultado'] = "error";
                $dato['estado'] = -1;
                $dato['mensaje'] = $e->getMessage();

            }

        } else {

            $dato['resultado'] = "error";
            $dato['estado'] = -1;
            $dato['mensaje'] = "Punto de Conexión Ocupado";

        }

        $this->Cerrar_Conexion($this->conex, $stm);

        return $dato;
    }

    private function Actualizar() {

        $dato = [];
        

        

        try {
                $query = "UPDATE punto_conexion 
                            SET codigo_patch_panel = :codigo_patch_panel, 
                            id_equipo = :id_equipo, 
                            puerto_patch_panel = :puerto_patch_panel
                        WHERE id_punto_conexion = :id_punto_conexion";

                $stm = $this->conex->prepare($query);
                $stm->bindParam(":codigo_patch_panel", $this->codigo_patch_panel);
                $stm->bindParam(":id_equipo", $this->id_equipo);
                $stm->bindParam(":puerto_patch_panel", $this->puerto_patch_panel);
                $stm->bindParam(":id_punto_conexion", $this->id_punto_conexion);
                $stm->execute();

                $dato['resultado'] = "modificar";
                $dato['estado'] = 1;
                $dato['mensaje'] = "Se modificó el Punto de Conexión exitosamente";
                $this->Cerrar_Conexion($this->conex, $stm);

            } catch (PDOException $e) {

                $dato['estado'] = -1;
                $dato['resultado'] = "error";
                $dato['mensaje'] = $e->getMessage();

            }
        

            

        

        $this->Cerrar_Conexion($this->conex, $stm);

        return $dato;
    }

    private function Eliminar() {

        $dato = [];
        

        

            try {
                    $query = "DELETE FROM punto_conexion WHERE id_punto_conexion = :id_punto_conexion";

                $stm = $this->conex->prepare($query);
                $stm->bindParam(":id_punto_conexion", $this->id_punto_conexion);
                $stm->execute();

                $dato['resultado'] = "eliminar";
                $dato['estado'] = 1;
                $dato['mensaje'] = "Se eliminó el Punto de Conexión exitosamente";
                $this->Cerrar_Conexion($this->conex, $stm);

            } catch (PDOException $e) {

                $dato['resultado'] = "error";
                $dato['estado'] = -1;
                $dato['mensaje'] = $e->getMessage();

            }

       


        $this->Cerrar_Conexion($this->conex, $stm);

        return $dato;
    }

    private function Consultar() {

        $dato = [];

        try {

            $query = "SELECT 
                        id_punto_conexion, 
                        codigo_patch_panel, 
                        id_equipo, 
                        puerto_patch_panel
                    FROM punto_conexion";

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

    public function Transaccion($peticion) {

        switch ($peticion['peticion']) {

            case 'registrar':
                return $this->Registrar();

            case 'consultar':
                return $this->Consultar();

            case 'actualizar':
                return $this->Actualizar();

            case 'eliminar':
                return $this->Eliminar();
             
            case 'validar':
                return $this->Validar();

            default:
                return "Operacion: " . $peticion['peticion'] . " no valida";

        }

    }

}

?>