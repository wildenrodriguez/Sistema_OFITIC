	<?php
	if (!$_SESSION) {
		echo '<script>window.location="?page=login"</script>';
		$msg["danger"] = "Sesion Finalizada.";
	}

	ob_start();

	require_once "model/Usuarios.php";
	$usuario = new Usuario();
	if (!$usuario->validar_entrada($_SESSION['user']['rol'], ["Super usuario", "Administrador"]))
		echo '<script>window.location="?page=404"</script>';

	if (is_file("view/" . $page . ".php")) {

		// Estilos de Pagina
		$titulo = "Solicitantes";
		$css = ["alert"];

		// Datos del Usuario Actual
		$usuario->set_cedula($_SESSION['user']['cedula']);

		$datos = $_SESSION['user'];
		$datos = $datos + $usuario->datos();

		// Lógica del Modelo
		require_once 'model/empleado.php';
		$obj_solicitante = new empleado();
		$cedulita = $obj_solicitante->obtener_cedulas();

		if (isset($_POST["registrar_solicitante"])) {
			if (preg_match("/^[VE]{1}[-]{1}[0-9]{7,8}$/", $_POST['cedula'])) {
				# code...
				$obj_solicitante->set_cedula($_POST['cedula']);

				if (!$obj_solicitante->verificar_existencia()) {

					$obj_solicitante->set_nombre($_POST['nombre']);
					$obj_solicitante->set_apellido($_POST['apellido']);
					$obj_solicitante->set_unidad($_POST['unidad']);
					$obj_solicitante->set_dependencia($_POST['dependencia']);
					$obj_solicitante->set_telefono($_POST['telefono']);
					$obj_solicitante->set_correo($_POST['correo']);

					if ($obj_solicitante->crear()) {
						$confirmacion = "¡Registro exitoso!";
						$color = "success";
					} else {
						$confirmacion = "¡No se logró el registro!";
						$color = "danger";
					}
				} else {
					$confirmacion = "¡Cédula ya registrada!";
					$color = "warning";
				}
				ob_clean();
			}
		}

		if (isset($_POST['eliminar'])) {
			if ($_POST['eliminar'] != $_SESSION['user']['cedula']) {


				$obj_solicitante->set_cedula($_POST['eliminar']);
				$usuario->set_cedula($_POST['eliminar']);
				$usuario->eliminar();

				if ($obj_solicitante->eliminar()) {
					$msg["success"] = "¡Registro Eliminado!";
				} else {
					$msg["danger"] = "No se pudo Eliminar el Registro";
				}
			} else {
				$msg["danger"] = "No se puede eliminar al usuario actual";
			}
		}
		$registros = [];
		$info = $obj_solicitante->consultar_solicitantes();
		$cabecera = array('Cedula', "Nombre", "Telefono", "Correo", "Unidad", "Dependencia");
		foreach ($info as $id => $solicitante) {
			$registros[$id] = [$solicitante["Cedula"], $solicitante["Nombre"] . " " . $solicitante["Apellido"], $solicitante["Telefono"], $solicitante["Correo"], $solicitante["Unidad"], $solicitante["Dependencia"], $solicitante["Rol"]];
		}

		$btn_color = "danger";
		$btn_icon = "trash3";
		$btn_name = "eliminar";
		$btn_value = "0";
		$origen = "";

		require_once "model/configuracion.php";
		$config = new configuracion();
		$config->set_tabla("unidad");
		$unidades = $config->Transaccion("consultar");;
		$config->set_tabla("dependencia");
		$dependencias = $config->Transaccion("consultar");;
		ob_clean();
		require_once "view/$page.php";
	} else {
		require_once "view/404.php";
	}
