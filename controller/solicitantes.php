<?php
if (!$_SESSION) {
    echo '<script>window.location="?page=login"</script>';
    $msg["danger"] = "Sesion Finalizada.";
}

ob_start();

require_once "model/usuario.php";
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
    
    // Obtener cédulas usando el nuevo método
    $cedula = $obj_solicitante->gestionarEmpleado('obtener_cedulas');

    if (isset($_POST["registrar_solicitante"])) {
        if (preg_match("/^[VE]{1}[-]{1}[0-9]{7,8}$/", $_POST['cedula'])) {
            $datosEmpleado = [
                'cedula' => $_POST['cedula'],
                'nombre' => $_POST['nombre'],
                'apellido' => $_POST['apellido'],
                'telefono' => $_POST['telefono'],
                'correo' => $_POST['correo'],
                'id_unidad' => $_POST['unidad'],
                'id_dependencia' => $_POST['dependencia']
            ];

            // Verificar existencia usando el nuevo método
            $existe = $obj_solicitante->gestionarEmpleado('verificar', ['cedula' => $_POST['cedula']]);
            
            if (!$existe) {
                // Crear empleado usando el nuevo método
                $resultado = $obj_solicitante->gestionarEmpleado('crear', $datosEmpleado);
                
                if ($resultado) {
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

            // Eliminar empleado usando el nuevo método
            if ($obj_solicitante->gestionarEmpleado('eliminar', ['cedula' => $_POST['eliminar']])) {
                $msg["success"] = "¡Registro Eliminado!";
            } else {
                $msg["danger"] = "No se pudo Eliminar el Registro";
            }
        } else {
            $msg["danger"] = "No se puede eliminar al usuario actual";
        }
    }

    // Consultar solicitantes usando el nuevo método
    $registros = [];
    $info = $obj_solicitante->gestionarEmpleado('listar');
    $cabecera = array('Cedula', "Nombre", "Telefono", "Correo", "Unidad", "Dependencia");
    foreach ($info as $id => $solicitante) {
        $registros[$id] = [
            $solicitante["Cedula"], 
            $solicitante["Nombre"] . " " . $solicitante["Apellido"], 
            $solicitante["Telefono"], 
            $solicitante["Correo"], 
            $solicitante["Unidad"], 
            $solicitante["Dependencia"], 
            $solicitante["Rol"]
        ];
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
