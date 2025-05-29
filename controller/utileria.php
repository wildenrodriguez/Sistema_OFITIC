<?php
require_once "model/usuario.php";
require_once "model/bitacora.php";
require_once "model/notificacion.php";

$peticion = [];
$msg = "";

$titulo = "";
$cabecera = [];

$usuario = new Usuario();
$bitacora = new Bitacora();
$notificacion = new Notificacion();

$usuario->set_cedula($_SESSION['user']['cedula']);
$datos = $_SESSION['user'];
$datos = $datos + $usuario->Transaccion(['peticion' => 'perfil']);

if (is_file($foto = $datos['foto'])) {
    $foto = $datos['foto'];
} else {
    $foto = "assets/img/foto-perfil/default.jpg";
}

function Bitacora($msg, $modulo) {
    global $bitacora;
    $peticion["peticion"] = "registrar";
    $hora = date('H:i:s');
    $fecha = date('Y-m-d');

    $bitacora->set_usuario($_SESSION['user']['nombre_usuario']);
    $bitacora->set_modulo($modulo);
    $bitacora->set_accion($msg);
    $bitacora->set_fecha($fecha);
    $bitacora->set_hora($hora);
    $bitacora->Transaccion($peticion);
    exit;
}

function Notificar($msg, $modulo, $usuarios = []) {
    global $notificacion;
    $peticion["peticion"] = "registrar";
    $hora = date('H:i:s');
    $fecha = date('Y-m-d');

    if (empty($usuarios)) {
        $usuarios = [$_SESSION['user']['nombre_usuario']];
    }

    $resultados = [];
    foreach ($usuarios as $usuario) {
        $notificacion->set_usuario($usuario);
        $notificacion->set_modulo($modulo);
        $notificacion->set_mensaje($msg);
        $notificacion->set_fecha($fecha);
        $notificacion->set_hora($hora);
        $resultados[] = $notificacion->Transaccion($peticion);
    }

    return $resultados;
    
}
?>