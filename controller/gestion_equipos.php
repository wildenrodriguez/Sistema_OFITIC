<?php
if (!$_SESSION) {
    echo '<script>window.location="?page=login"</script>';
    $msg["danger"] = "Sesion Finalizada.";
}

ob_start();
if (is_file("view/" . $page . ".php")) {
    require_once "controller/utileria.php";
    require_once "model/equipo.php";
    require_once "model/unidad.php";
    require_once "model/bien.php";
    require_once "model/dependencia.php";

    $titulo = "Gestionar Equipos";
    $cabecera = array('#', "Tipo", "Serial", "Código Bien", "Dependencia", "Unidad", "Modificar/Eliminar");

    $equipo = new Equipo();
    $unidad = new Unidad();
    $dependencia = new Dependencia();
    $bien = new Bien();

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
        $equipo->set_id_unidad($_POST["id_unidad"]);
        $peticion["peticion"] = "registrar";
        $json = $equipo->Transaccion($peticion);
        echo json_encode($json);

        if ($json['estado'] == 1) {
            $msg = "(" . $_SESSION['user']['nombre_usuario'] . "), Se registró un nuevo equipo";
        } else {
            $msg = "(" . $_SESSION['user']['nombre_usuario'] . "), error al registrar un nuevo equipo";
        }
        Bitacora($msg, "Equipo");
        exit;
    }

    if (isset($_POST['consultar'])) {
        $peticion["peticion"] = "consultar";
        $json = $equipo->Transaccion($peticion);
        echo json_encode($json);
        exit;
    }

    if (isset($_POST['filtrar_bien'])) {
        $peticion["peticion"] = "filtrar";
        $json = $bien->Transaccion($peticion);
        $json['resultado'] = "filtrar_bien";
        echo json_encode($json);
        exit;
    }

    if (isset($_POST['cargar_unidad'])) {
        $peticion["peticion"] = "filtrar";
        $unidad->set_id_dependencia($_POST['id_dependencia']);
        $json = $unidad->Transaccion($peticion);
        $json['resultado'] = "consultar_unidad";
        echo json_encode($json);
        exit;
    }

        if (isset($_POST['cargar_dependencia'])) {
        $peticion["peticion"] = "consultar";
        $json = $dependencia->Transaccion($peticion);
        $json['resultado'] = "consultar_dependencia";
        echo json_encode($json);
        exit;
    }

    if (isset($_POST["consultar_eliminadas"])) {
        $peticion["peticion"] = "consultar_eliminadas";
        $json = $equipo->Transaccion($peticion);
        echo json_encode($json);
        exit;
    }

    if (isset($_POST["restaurar"])) {
        $equipo->set_id_equipo($_POST["id_equipo"]);
        $peticion["peticion"] = "restaurar";
        $json = $equipo->Transaccion($peticion);
        echo json_encode($json);
        exit;
    }

    if (isset($_POST['consultar_unidad'])) {
        $peticion["peticion"] = "consultar_unidad";
        $json = $equipo->Transaccion($peticion);
        echo json_encode($json);
        exit;
    }

    if (isset($_POST['consultar_bienes'])) {
        $peticion["peticion"] = "consultar_bienes";
        $json = $equipo->Transaccion($peticion);
        echo json_encode($json);
        exit;
    }

    if (isset($_POST["modificar"])) {
        $equipo->set_id_equipo($_POST["id_equipo"]);
        $equipo->set_tipo_equipo($_POST["tipo_equipo"]);
        $equipo->set_serial($_POST["serial"]);
        $equipo->set_codigo_bien($_POST["codigo_bien"]);
        $equipo->set_id_unidad($_POST["id_unidad"]);
        $peticion["peticion"] = "actualizar";
        $json = $equipo->Transaccion($peticion);
        echo json_encode($json);

        if ($json['estado'] == 1) {
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
        $json = $equipo->Transaccion($peticion);
        echo json_encode($json);

        if ($json['estado'] == 1) {
            $msg = "(" . $_SESSION['user']['nombre_usuario'] . "), Se eliminó un equipo";
        } else {
            $msg = "(" . $_SESSION['user']['nombre_usuario'] . "), error al eliminar un equipo";
        }
        Bitacora($msg, "Equipo");
        exit;
    }

    $unidades = $equipo->Transaccion(['peticion' => 'consultar_unidad']);
    $bienes = $equipo->Transaccion(['peticion' => 'consultar_bienes']);

    require_once "view/" . $page . ".php";
} else {
    require_once "view/404.php";
}
?>