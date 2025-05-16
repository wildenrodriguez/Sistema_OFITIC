<?php
if (!$_SESSION) {
    echo '<script>window.location="?page=login"</script>';
    $msg["danger"] = "Sesion Finalizada.";
}

ob_start();
if (is_file("view/" . $page . ".php")) {
    require_once "controller/utileria.php";
    require_once "model/tipo_bien.php";

    $titulo = "Gestionar Tipos de Bien";
    $cabecera = array('#', "Nombre", "Modificar/Eliminar");

    $tipoBien = new TipoBien();

    if (isset($_POST["entrada"])) {
        $json['resultado'] = "entrada";
        echo json_encode($json);
        $msg = "(" . $_SESSION['user']['nombre_usuario'] . "), Ingresó al Módulo de Tipos de Bien";
        Bitacora($msg, "TipoBien");
        exit;
    }

    if (isset($_POST["registrar"])) {
        $tipoBien->set_nombre($_POST["nombre"]);
        $peticion["peticion"] = "registrar";
        $datos = $tipoBien->Transaccion($peticion);
        echo json_encode($datos);

        if($datos['estado'] == 1){
            $msg = "(" . $_SESSION['user']['nombre_usuario'] . "), Se registró un nuevo tipo de bien";
        } else {
            $msg = "(" . $_SESSION['user']['nombre_usuario'] . "), error al registrar un nuevo tipo de bien";
        }
        Bitacora($msg, "TipoBien");
        exit;
    }

    if (isset($_POST['consultar'])) {
        $peticion["peticion"] = "consultar";
        $datos = $tipoBien->Transaccion($peticion);
        echo json_encode($datos);
        exit;
    }

    if (isset($_POST["consultar_eliminadas"])) {
        $peticion["peticion"] = "consultar_eliminadas";
        $datos = $tipoBien->Transaccion($peticion);
        echo json_encode($datos);
        exit;
    }

    if (isset($_POST["restaurar"])) {
        $tipoBien->set_id($_POST["id_tipo_bien"]);
        $peticion["peticion"] = "restaurar";
        $datos = $tipoBien->Transaccion($peticion);
        echo json_encode($datos);
        exit;
    }

    if (isset($_POST["modificar"])) {
        $tipoBien->set_id($_POST["id_tipo_bien"]);
        $tipoBien->set_nombre($_POST["nombre"]);
        $peticion["peticion"] = "actualizar";
        $datos = $tipoBien->Transaccion($peticion);
        echo json_encode($datos);

        if($datos['estado'] == 1){
            $msg = "(" . $_SESSION['user']['nombre_usuario'] . "), Se modificó el registro del tipo de bien";
        } else {
            $msg = "(" . $_SESSION['user']['nombre_usuario'] . "), error al modificar tipo de bien";
        }
        Bitacora($msg, "TipoBien");
        exit;
    }

    if (isset($_POST["eliminar"])) {
        $tipoBien->set_id($_POST["id_tipo_bien"]);
        $peticion["peticion"] = "eliminar";
        $datos = $tipoBien->Transaccion($peticion);
        echo json_encode($datos);

        if($datos['estado'] == 1){
            $msg = "(" . $_SESSION['user']['nombre_usuario'] . "), Se eliminó un tipo de bien";
        } else {
            $msg = "(" . $_SESSION['user']['nombre_usuario'] . "), error al eliminar un tipo de bien";
        }
        Bitacora($msg, "TipoBien");
        exit;
    }

    require_once "view/" . $page . ".php";
} else {
    require_once "view/404.php";
}
?>