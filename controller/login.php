<?php
ob_start();
if (is_file("view/$page.php")) {
	$titulo = "Login";
	$css = [];

	require_once "model/usuarios.php";

	$user = new usuario;

	if (!empty($_POST)) {
		$cedula = $_POST['particle'] . $_POST['CI'];
		$pass = $_POST['password'];
		$user->set_cedula($cedula);
		$user->set_clave($pass);
		if ($user->Iniciar_Sesion()) {
			require_once "model/empleado.php";
			$emp = new empleado;


			$emp->set_cedula($cedula);
			$datos = $emp->datos_empleado() + $user->datos();
			$_SESSION['user'] = $datos;
			$_GET['page'] = "";
			if ($cedula == $pass) {

				echo '<script>window.location="?page=users-profile"</script>';
				ob_clean();
				exit();
			}
			echo '<script>window.location="?page=home"</script>';
			ob_clean();
			exit();
		} else {
			$msg["danger"] = "Usuario y/o contraseña incorrectos";
		}
	}
	if ($page == "login") {
		require_once "view/$page.php";
	}
} else {
	require_once "view/404.php";
}
