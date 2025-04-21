<?php
if (!$_SESSION['user']) {
	echo '<script>window.location="?page=login"</script>';
	$msg["danger"] = "Sesion Finalizada.";
}
ob_start();

require_once "model/usuario.php";
$usuario = new Usuario();
var_dump($_SESSION['user']);
$usuario->set_cedula($_SESSION['user']['cedula']);
$peticion = ['peticion' => "perfil"];
$datos = $usuario->Transaccion($peticion);

if (is_file("view/" . $page . ".php")) {

	$titulo = "Mi Perfil";
	$css = ["alert"];

	if (isset($_POST['cambiar'])) {

		$nombre = $_POST['Nombre'];
		$apellido = $_POST['apellido'];
		$correo = $_POST['correo'];
		$tlf = $_POST['telefono'];

		$usuario->set_nombres($nombre);
		$usuario->set_apellidos($apellido);
		$usuario->set_correo($correo);
		$usuario->set_telefono($tlf);

		if ($usuario->Transaccion(['peticion' => 'modificar'])) {
			$msg["success"] = "Actualizado";
		} else {
			$msg["danger"] = "No se pudo actualizar";
		}

		$datos = $usuario->Transaccion(['peticion' => 'perfil']);
		$_SESSION['user']['user'] = $datos;

		ob_clean();
	}

	if (isset($_POST['passw'])) {

		if ($_POST['newpassword'] == $_POST['renewpassword']) {

			$usuario->set_clave($_POST['newpassword']);
			if ($usuario->Transaccion(['peticion' => 'ActualizarClave'])) {
				unset($msg);
				$msg["success"] = "Contraseña actualizada";
			} else {
				$msg["danger"] = "No se pudo actualizar la contraseña";
			}
		} else {
			$msg["danger"] = "Las contraseñas no coinciden";
		}
	}

	// En users-profile.php (línea ~59)
if (isset($datos['clave']) && $datos['clave'] == $datos['cedula']) {
    $active3 = "active";
    $active4 = "show active";
} else {
    $active1 = "active";
    $active2 = "show active";
}

	require_once "view/users-profile.php";
} else {
	require_once "view/404.php";
}
