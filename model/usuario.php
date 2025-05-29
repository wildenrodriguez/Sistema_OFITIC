<?php
require_once('model/conexion.php');

class Usuario extends Conexion
{

    private $cedula;
    private $nombre_usuario;
    private $nombres;
    private $apellidos;
    private $correo;
    private $telefono;
    private $clave;
    private $tipo;
    private $rol;
    private $foto;

    public function __construct()
    {
        $this->conex = new Conexion("usuario");
        $this->conex = $this->conex->Conex();
    }

    public function set_cedula($cedula)
    {
        $this->cedula = $cedula;
    }
    public function set_nombre_usuario($nombre_usuario)
    {
        $this->nombre_usuario = $nombre_usuario;
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

        public function get_nombre_usuario()
    {
        return $this->nombre_usuario;
    }

    public function get_nombres()
    {
        return $this->nombres;
    }

    public function get_apellidos()
    {
        return $this->apellidos;
    }

    public function set_foto($foto)
    {
        $this->foto = $foto;
    }

    public function get_foto()
    {
        return $this->foto;
    }
    public function set_correo($correo)
    {
        $this->correo = $correo;
    }
    public function get_correo()
    {
        return $this->correo;
    }
    public function set_telefono($telefono)
    {
        $this->telefono = $telefono;
    }
    public function get_telefono()
    {
        return $this->telefono;
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

        $query = "INSERT INTO usuario(cedula, clave, rol) VALUES (:cedula,:clave,:rol)";

        $con = $this->conex->prepare($query);
        $con->bindParam(':cedula', $this->cedula);
        $con->bindParam(':nombre_usuario', $this->nombre_usuario);
        $con->bindParam(':nombres', $this->nombres);
        $con->bindParam(':apellidos', $this->apellidos);
        $con->bindParam(':correo', $this->correo);
        $con->bindParam(':telefono', $this->telefono);

        return $con->execute();
    }

    private function ModificarUsuario()
    {
        $query = "UPDATE usuario SET 
                nombres = :nombres,
                apellidos = :apellidos,
                correo = :correo,
                telefono = :telefono 
                WHERE nombre_usuario = :nombre_usuario OR cedula = :cedula";

        $con = $this->conex->prepare($query);
        $con->bindParam(':cedula', $this->cedula);
        $con->bindParam(':nombre_usuario', $this->nombre_usuario);
        $con->bindParam(':nombres', $this->nombres);
        $con->bindParam(':apellidos', $this->apellidos);
        $con->bindParam(':correo', $this->correo);
        $con->bindParam(':telefono', $this->telefono);

        return $con->execute();
    }

    private function crear_tecnico()
    {
        $con = $this->conex->prepare("INSERT INTO tecnico() VALUES (:cedula,:tipo)");
        $con->bindParam(':cedula', $this->cedula);
        $con->bindParam(':tipo', $this->tipo);
        return $con->execute();
    }

    private function Validar()
    {
        $con = $this->conex->prepare("SELECT * FROM usuario WHERE cedula=?");
        $con->execute([$this->cedula]);

        $dato = $con->fetch();
        $this->Cerrar_Conexion($none, $con);

        return $dato;
    }

    private function IniciarSesion()
    {
        $dato = [];
        $exist = $this->Validar();

        if ($exist != NULL) {
            if (password_verify($this->clave, $exist['clave'])) {
                $dato = true;
            } else {
                $dato = false;
            }
        } else {
            $dato = false;
        }
        $this->Cerrar_Conexion($this->conex, $none);
        return $dato;
    }

    private function PerfilUsuario()
    {
        $query = "SELECT
                usuario.nombre_usuario,
                usuario.cedula,
                usuario.nombres,
                usuario.apellidos,
                usuario.id_rol,
                rol.nombre_rol as rol,
                usuario.telefono,
                usuario.correo,
                usuario.clave,
                usuario.foto
                FROM usuario
                INNER JOIN rol ON usuario.id_rol = rol.id_rol
                WHERE usuario.cedula = :cedula";

        $con = $this->conex->prepare($query);
        $con->bindValue(':cedula', $this->cedula);
        $con->execute();
        $datos = $con->fetch(PDO::FETCH_ASSOC);
        $this->Cerrar_Conexion($this->conex, $con);

        return $datos;
    }

    private function Eliminar()
    {
        $registro = $this->conex->prepare("DELETE FROM usuario WHERE cedula = :cedula");
        $registro->bindValue(":cedula", $this->cedula);
        $registro->execute();

    }

    private function ActualizarClave()
    {
        $query = "UPDATE usuario SET clave=? WHERE cedula = ?";

        $registro = $this->conex->prepare($query);

        if ($registro->execute([$this->clave, $this->cedula])) {
            $dato = true;
        } else {
            $dato = false;
        }
        $this->Cerrar_Conexion($this->conex, $registro);

        return $dato;
    }

    private function ConsultaUsuarios()
    {
        $datos = [];
        try {
            $query = "SELECT
            usuario.nombre_usuario,
                usuario.cedula,
                usuario.nombres,
                usuario.apellidos,
                usuario.telefono,
                usuario.correo,
                usuario.foto,
                rol.nombre_rol as rol
            FROM usuario
            INNER JOIN rol ON usuario.id_rol = rol.id_rol
            ORDER BY usuario.cedula = :cedula";

            $stm = $this->conex->prepare($query);
            $stm->bindValue(':cedula', $this->cedula);
            $stm->execute();

            $datos['resultado'] = "consultar";
            $datos['datos'] = $stm->fetchAll(PDO::FETCH_ASSOC);

            $this->Cerrar_Conexion($this->conex, $records);
        } catch (PDOException $e) {
            $datos['resultado'] = "error";
            $datos['mensaje'] = $e->getMessage();
        }


        return $datos;
    }

    private function ActualizarFoto()
    {
        $query = "UPDATE usuario SET foto=? WHERE cedula = ?";

        $registro = $this->conex->prepare($query);

        if ($registro->execute([$this->foto, $this->cedula])) {
            $dato = true;
        } else {
            $dato = false;
        }
        $this->Cerrar_Conexion($this->conex, $registro);

        return $dato;
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

            case 'actualizarFoto':

                return $this->ActualizarFoto();

            case 'permiso':
                return $this->ValidarPermiso($peticion['user'], $peticion['rol']);

            default:
                return "error " . $peticion['peticion'] . " no valida";
        }
    }
}
