<?php
require_once('model/conexion.php');

class Usuario extends Conexion
{

    private $cedula;
    private $nombre_usuario;
    private $nombres;
    private $apellidos;
    private $correo;
    private $clave;
    private $tipo;
    private $rol;

    public function __construct()
    {
        $this->conex = new Conexion();
        $this->conex = $this->conex->Conex();
    }

    public function set_cedula($cedula)
    {
        $this->cedula = $cedula;
    }

    public function set_nombres($nombres)
    {
        $this->nombres = $nombres;
    }

    public function set_apellidos($apellidos)
    {
        $this->apellidos = $apellidos;
    }

    public function set_tipo($tipo)
    {
        $this->tipo = $tipo;
    }

    public function set_clave($contrase)
    {
        $this->clave = $contrase;
    }

    public function set_rol($rol)
    {
        $this->rol = $rol;
    }

    public function get_nombres()
    {
        return $this->nombres;
    }

    public function get_apellidos()
    {
        return $this->apellidos;
    }

    private function ValidarPermiso($usuario, $permitidos)
    {

        if ($permitidos == $usuario) {
            $bool = 1;
        } else {
            $bool = 0;
        }
        return $bool;
    }

    private function Registrar()
    {

        $query = "INSERT INTO `usuario`(`cedula`, `clave`, `rol`) VALUES (:cedula,:clave,:rol)";

        $con = $this->conex->prepare($query);
        $con->bindParam(':cedula', $this->cedula);
        $con->bindParam(':clave', $this->clave);
        $con->bindParam(':rol', $this->rol);

        return $con->execute();
    }

    private function ModificarUsuario()
    {
        $query = "UPDATE `usuario` SET `nombre_usuario`=':nombre_usuario',`cedula`=':cedula',
            `nombres`=':nombres',`apellidos`=':apellidos',
            `correo`=':correo',`clave`=':clave', WHERE nombre_usuario = `:id_usuario` OR `cedula` = 'id_cedula'";

        $con = $this->conex->prepare($query);
        $con->bindParam(':cedula', $this->cedula);
        $con->bindParam(':clave', $this->clave);
        $con->bindParam(':rol', $this->rol);

        return $con->execute();
    }

    private function crear_tecnico()
    {
        $con = $this->conex->prepare("INSERT INTO `tecnico`() VALUES (:cedula,:tipo)");
        $con->bindParam(':cedula', $this->cedula);
        $con->bindParam(':tipo', $this->tipo);
        return $con->execute();
    }

    private function Validar()
    {
        $con = $this->conex->prepare("SELECT * FROM usuario WHERE cedula=?");
        $con->execute([$this->cedula]);
        return $con->fetch();
    }

    private function IniciarSesion()
    {
        $exist = $this->Validar();

        if ($exist != NULL) {
            if (password_verify($this->clave, $exist['clave'])) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    private function PerfilUsuario()
    {
        $query = "  SELECT 
                    usuario.cedula,
                    usuario.nombres,
                    usuario.apellidos,
                    usuario.id_rol,
                    usuario.telefono,
                    usuario.correo,
                    usuario.clave,
                    unidad.nombre AS unidad,
                    dependencia.nombre AS dependencia,
                    tecnico.tipo AS especialidad,
                    rol.nombre as rol
                FROM usuario
                INNER JOIN empleado ON usuario.cedula = empleado.cedula
                INNER JOIN unidad ON empleado.cod_unidad = unidad.codigo
                INNER JOIN dependencia ON empleado.cod_dependencia = dependencia.codigo
                INNER JOIN rol ON usuario.id_rol = rol.id_rol
                LEFT JOIN tecnico ON usuario.cedula = tecnico.cedula
                WHERE usuario.cedula = :cedula
            ";

        $con = $this->conex->prepare($query);
        $con->bindValue(':cedula', $this->cedula);
        $con->execute();

        return $con->fetch(PDO::FETCH_ASSOC);
    }

    private function Eliminar()
    {
        $registro = $this->conex->prepare("DELETE FROM usuario WHERE cedula = :cedula");
        $registro->bindValue(":cedula", $this->cedula);
        $registro->execute();

        $tecnico = $this->conex->prepare("DELETE FROM tecnico WHERE cedula = :cedula");
        $tecnico->bindValue(":cedula", $this->cedula);
        $tecnico->execute();
    }

    private function ActualizarClave()
    {

        $query = "UPDATE usuario SET clave=? WHERE cedula = ?";

        $registro = $this->conex->prepare($query);

        if ($registro->execute([$this->clave, $this->cedula])) {
            return true;
        } else {
            return false;
        }
    }

    private function ConsultaUsuarios()
    {
        $query = "SELECT
                usuario.cedula,
                usuario.nombres,
                usuario.apellidos,
                usuario.clave,
                usuario.id_rol,
                rol.nombre as rol,
                tecnico.tipo AS tipo_c,
                tipo_servicio.nombre AS Tipo
            FROM usuario
            LEFT JOIN empleado ON usuario.cedula = empleado.cedula
            LEFT JOIN tecnico ON tecnico.cedula = empleado.cedula
            LEFT JOIN tipo_servicio ON tecnico.tipo = tipo_servicio.codigo
            INNER JOIN rol ON usuario.id_rol = rol.id_rol
            ORDER BY usuario.cedula = :cedula";  // Añade esta condición

        $records = $this->conex->prepare($query);
        $records->bindValue(':cedula', $this->cedula);
        $records->execute();

        return $records->fetchAll(PDO::FETCH_ASSOC);  // Cambia a fetch para un solo registro
    }

    public function Transaccion($peticion)
    {

        switch ($peticion['peticion']) {
            case 'registrar':

                return $this->Registrar();

            case 'consultar':

                return $this->ConsultaUsuarios();

            case 'modificar':

                return $this->ModificarUsuario();

            case 'eliminar':

                return $this->Eliminar();

            case 'sesion':

                return $this->IniciarSesion();

            case 'validar':

                break;

            case 'perfil':

                return $this->PerfilUsuario();

            case 'ActualizarClave':

                return $this->ActualizarClave();

            case 'permiso':
                return $this->ValidarPermiso($peticion['user'], $peticion['rol']);

            default:
                return "error " . $peticion['peticion'] . " no valida";
        }
    }
}
