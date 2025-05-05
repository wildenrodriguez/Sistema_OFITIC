<?php
if (!$_SESSION) {
    echo '<script>window.location="?page=login"</script>';
    $msg["danger"] = "Sesion Finalizada.";
}

require_once "model/usuario.php";
$usuario = new Usuario();

if (is_file("view/$page.php")) {
    $peticion = [];
    $titulo = "Gestión de Bienes";
    $css = ["alert", "style"];
    $cabecera = array("Código", "Tipo", "Estado", "Responsable", "Oficina", "Estatus", "Acciones");

    $usuario->set_cedula($_SESSION['user']['cedula']);
    $datos = $_SESSION['user'];
    $datos = $datos + $usuario->Transaccion(['peticion' => 'perfil']);

    require_once('model/bien.php');
    $bien = new Bien();
    require_once('model/configuracion.php');
    $config = new Configuracion();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['accion'])) {
            $bien->set_datos($_POST);

            switch ($_POST['accion']) {
                case 'registrar':
                    $result = $bien->Transaccion(['peticion' => 'registrar']);
                    echo json_encode([
                        'success' => $result,
                        'message' => $result ? 'Bien registrado exitosamente' : 'Error al registrar el bien'
                    ]);
                    exit;

                case 'modificar':
                    $result = $bien->Transaccion(['peticion' => 'modificar']);
                    echo json_encode([
                        'success' => $result,
                        'message' => $result ? 'Bien actualizado exitosamente' : 'Error al actualizar el bien'
                    ]);
                    exit;

                case 'eliminar':
                    $result = $bien->Transaccion(['peticion' => 'eliminar']);
                    echo json_encode([
                        'success' => $result,
                        'message' => $result ? 'Bien eliminado exitosamente' : 'Error al eliminar el bien'
                    ]);
                    exit;

                case 'consultar':
                    $bienes = $bien->Transaccion(['peticion' => 'consultar']);
                    echo json_encode([
                        'data' => $bienes
                    ]);
                    exit;
            }
        }
    }

    $config->set_tabla('oficina');
    $oficinas = $config->Transaccion("consultar");

    require_once "view/$page.php";
} else {
    require_once "view/404.php";
}
?>
