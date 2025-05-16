<?php
if (!$_SESSION) {
    echo '<script>window.location="?page=login"</script>';
    $msg["danger"] = "Sesion Finalizada.";
}

ob_start();
if (is_file("view/" . $page . ".php")) {
    require_once "controller/utileria.php";
    require_once "model/equipo.php";

    $titulo = "Gestionar Equipos";
    $cabecera = array('#', "Tipo", "Serial", "Código Bien", "Dependencia", "Modificar/Eliminar");

    $equipo = new Equipo();

    if (isset($_POST["entrada"])) {
        $json['resultado'] = "entrada";
        echo json_encode($json);
        $msg = "(" . $_SESSION['user']['nombre_usuario'] . "), Ingresó al Módulo de Equipos";
        Bitacora($msg, "Equipo");
        exit;
    }

    if (isset($_POST["registrar"])) {
        $equipo->set_tipo_equipo($_POST["tipo_equipo"]);
        $equipo->set_serial($_POST["serial"]);
        $equipo->set_codigo_bien($_POST["codigo_bien"]);
        $equipo->set_id_dependencia($_POST["id_dependencia"]);
        $peticion["peticion"] = "registrar";
        $datos = $equipo->Transaccion($peticion);
        echo json_encode($datos);

        if($datos['estado'] == 1){
            $msg = "(" . $_SESSION['user']['nombre_usuario'] . "), Se registró un nuevo equipo";
        } else {
            $msg = "(" . $_SESSION['user']['nombre_usuario'] . "), error al registrar un nuevo equipo";
        }
        Bitacora($msg, "Equipo");
        exit;
    }

    if (isset($_POST['consultar'])) {
        $peticion["peticion"] = "consultar";
        $datos = $equipo->Transaccion($peticion);
        echo json_encode($datos);
        exit;
    }

    if (isset($_POST["consultar_eliminadas"])) {
        $peticion["peticion"] = "consultar_eliminadas";
        $datos = $equipo->Transaccion($peticion);
        echo json_encode($datos);
        exit;
    }

    if (isset($_POST["restaurar"])) {
        $equipo->set_id_equipo($_POST["id_equipo"]);
        $peticion["peticion"] = "restaurar";
        $datos = $equipo->Transaccion($peticion);
        echo json_encode($datos);
        exit;
    }

    if (isset($_POST['consultar_dependencias'])) {
        $peticion["peticion"] = "consultar_dependencias";
        $datos = $equipo->Transaccion($peticion);
        echo json_encode($datos);
        exit;
    }

    if (isset($_POST['consultar_bienes'])) {
        $peticion["peticion"] = "consultar_bienes";
        $datos = $equipo->Transaccion($peticion);
        echo json_encode($datos);
        exit;
    }

    if (isset($_POST["modificar"])) {
        $equipo->set_id_equipo($_POST["id_equipo"]);
        $equipo->set_tipo_equipo($_POST["tipo_equipo"]);
        $equipo->set_serial($_POST["serial"]);
        $equipo->set_codigo_bien($_POST["codigo_bien"]);
        $equipo->set_id_dependencia($_POST["id_dependencia"]);
        $peticion["peticion"] = "actualizar";
        $datos = $equipo->Transaccion($peticion);
        echo json_encode($datos);

        if($datos['estado'] == 1){
            $msg = "(" . $_SESSION['user']['nombre_usuario'] . "), Se modificó el registro del equipo";
        } else {
            $msg = "(" . $_SESSION['user']['nombre_usuario'] . "), error al modificar equipo";
        }
        Bitacora($msg, "Equipo");
        exit;
    }

    if (isset($_POST["eliminar"])) {
        $equipo->set_id_equipo($_POST["id_equipo"]);
        $peticion["peticion"] = "eliminar";
        $datos = $equipo->Transaccion($peticion);
        echo json_encode($datos);

        if($datos['estado'] == 1){
            $msg = "(" . $_SESSION['user']['nombre_usuario'] . "), Se eliminó un equipo";
        } else {
            $msg = "(" . $_SESSION['user']['nombre_usuario'] . "), error al eliminar un equipo";
        }
        Bitacora($msg, "Equipo");
        exit;
    }

    $dependencias = $equipo->Transaccion(['peticion' => 'consultar_dependencias']);
    $bienes = $equipo->Transaccion(['peticion' => 'consultar_bienes']);

    require_once "view/" . $page . ".php";
} else {
    require_once "view/404.php";
}
?>