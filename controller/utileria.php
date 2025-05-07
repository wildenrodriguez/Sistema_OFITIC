<?php
require_once "model/usuario.php";
require_once "model/bitacora.php";

$peticion = [];
$msg = "";

$titulo = "";
$cabecera = [];

$usuario = new Usuario();
$bitacora = new Bitacora();

$usuario->set_cedula($_SESSION['user']['cedula']);
$datos = $_SESSION['user'];
$datos = $datos + $usuario->Transaccion(['peticion' => 'perfil']);

function Bitacora($msg, $modulo){

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
}
?>