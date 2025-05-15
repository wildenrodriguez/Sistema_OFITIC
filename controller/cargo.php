<?php
if (!$_SESSION) {
    echo '<script>window.location="?page=login"</script>';
    $msg["danger"] = "Sesión Finalizada.";
}

ob_start();
if (is_file("view/" . $page . ".php")) {
    require_once "controller/utileria.php";
    require_once "model/cargo.php";

    $titulo = "Gestionar Cargos";
    $cabecera = array('#', "Nombre", "Modificar/Eliminar");

    $cargo = new Cargo();

    if (isset($_POST["entrada"])) {
        $json['resultado'] = "entrada";
        echo json_encode($json);
        $msg = "(" . $_SESSION['user']['nombre_usuario'] . "), Ingresó al Módulo de Cargo";
        Bitacora($msg, "Cargo");
        exit;
    }

    if (isset($_POST["registrar"])) {
        $cargo->set_nombre($_POST["nombre_cargo"]);
        $peticion["peticion"] = "registrar";
        $datos = $cargo->Transaccion($peticion);
        echo json_encode($datos);

        if ($datos['estado'] == 1) {
            $msg = "(" . $_SESSION['user']['nombre_usuario'] . "), Se registró un nuevo cargo";
        } else {
            $msg = "(" . $_SESSION['user']['nombre_usuario'] . "), error al registrar un nuevo cargo";
        }
        Bitacora($msg, "Cargo");
        exit;
    }

    if (isset($_POST['consultar'])) {
        $peticion["peticion"] = "consultar";
        $datos = $cargo->Transaccion($peticion);
        echo json_encode($datos);
        exit;
    }

    if (isset($_POST["consultar_eliminados"])) {
        $peticion["peticion"] = "consultar_eliminados";
        $datos = $cargo->Transaccion($peticion);
        echo json_encode($datos);
        exit;
    }

    if (isset($_POST["restaurar"])) {
        $cargo->set_id($_POST["id_cargo"]);
        $peticion["peticion"] = "restaurar";
        $datos = $cargo->Transaccion($peticion);
        echo json_encode($datos);
        exit;
    }

    if (isset($_POST["modificar"])) {
        $cargo->set_id($_POST["id_cargo"]);
        $cargo->set_nombre($_POST["nombre_cargo"]);
        $peticion["peticion"] = "actualizar";
        $datos = $cargo->Transaccion($peticion);
        echo json_encode($datos);

        if ($datos['estado'] == 1) {
            $msg = "(" . $_SESSION['user']['nombre_usuario'] . "), Se modificó el registro del cargo";
        } else {
            $msg = "(" . $_SESSION['user']['nombre_usuario'] . "), error al modificar cargo";
        }
        Bitacora($msg, "Cargo");
        exit;
    }

    if (isset($_POST["eliminar"])) {
        $cargo->set_id($_POST["id_cargo"]);
        $peticion["peticion"] = "eliminar";
        $datos = $cargo->Transaccion($peticion);
        echo json_encode($datos);

        if ($datos['estado'] == 1) {
            $msg = "(" . $_SESSION['user']['nombre_usuario'] . "), Se eliminó un cargo";
        } else {
            $msg = "(" . $_SESSION['user']['nombre_usuario'] . "), error al eliminar un cargo";
        }
        Bitacora($msg, "Cargo");
        exit;
    }

    require_once "view/" . $page . ".php";
} else {
    require_once "view/404.php";
}
?>
