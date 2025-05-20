<?php
if (!$_SESSION['user']) {
	echo '<script>window.location="?page=login"</script>';
	$msg["danger"] = "Sesion Finalizada.";
}
ob_start();



if (is_file("view/" . $page . ".php")) {

	require_once "controller/utileria.php";
	$titulo = "Mi Perfil";
	if (is_file($datos['foto'])) {
		$foto = $datos['foto'];
	}

	// if (isset($_FILES['foto_perfil']) && $_FILES['foto_perfil']['error'] == 0) {

	// 	$targetDir = "assets/img/foto-perfil/";
	// 	$targetFile = $targetDir . basename($_FILES["foto_perfil"]["name"]);
	// 	$extension = pathinfo($_FILES["foto_perfil"]["name"], PATHINFO_EXTENSION);
	// 	$nuevoNombre = $datos['cedula'] . '.' . $extension;
	// 	$targetFile = $targetDir . $nuevoNombre;


	// 	if (move_uploaded_file($_FILES["foto_perfil"]["tmp_name"], $targetFile)) {
	// 		$usuario->set_foto($targetFile);
	// 		$usuario->Transaccion(['peticion' => 'actualizarFoto']);
	// 		header("Location: ?page=users-profile");
	// 	}
	// 	print_r($_FILES["foto_perfil"]["tmp_name"]);
	// }

	if (isset($_POST['eliminarF'])) {
		$ruta_archivo = $datos['foto'];

		if (file_exists($ruta_archivo)) {
			if (unlink($ruta_archivo)) {
				header("Location: ?page=users-profile");
			} else {
				echo "Error al intentar eliminar el archivo";
			}
		} else {
			echo "El archivo no existe";
		}
		// $usuario->set_foto($foto);
		// if ($usuario->Transaccion(['peticion' => 'eliminarFoto'])) {
		// 	header("Location: ?page=users-profile");
		// } else {
		// 	$msg["danger"] = "No se pudo eliminar la foto de perfil";
		// }
	}

	if (isset($_POST['cambiar'])) {
		if (isset($_FILES['foto_perfil']) && $_FILES['foto_perfil']['error'] == 0) {

			$targetDir = "assets/img/foto-perfil/";
			$targetFile = $targetDir . basename($_FILES["foto_perfil"]["name"]);
			$extension = pathinfo($_FILES["foto_perfil"]["name"], PATHINFO_EXTENSION);
			$nuevoNombre = $datos['cedula'] . '.' . $extension;
			$targetFile = $targetDir . $nuevoNombre;
	
	
			if (move_uploaded_file($_FILES["foto_perfil"]["tmp_name"], $targetFile)) {
				$usuario->set_foto($targetFile);
				$usuario->Transaccion(['peticion' => 'actualizarFoto']);
				header("Location: ?page=users-profile");
			}
			print_r($_FILES["foto_perfil"]["tmp_name"]);
		}

		$nombre = $_POST['Nombre'];
		$apellido = $_POST['Apellido'];
		$correo = $_POST['Correo'];
		$tlf = $_POST['Telefono'];

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
