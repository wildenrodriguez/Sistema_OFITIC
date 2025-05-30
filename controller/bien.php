<?php
if (!$_SESSION) {
    echo '<script>window.location="?page=login"</script>';
    $msg["danger"] = "Sesion Finalizada.";
}

ob_start();
if (is_file("view/" . $page . ".php")) {
    require_once "controller/utileria.php";
    require_once "model/bien.php";

    $titulo = "Gestionar Bienes";
    $cabecera = array('#', "Código", "Tipo", "Marca", "Descripción", "Estado", "Oficina", "Empleado", "Modificar/Eliminar");

    $bien = new Bien();

    if (isset($_POST["entrada"])) {
        $json['resultado'] = "entrada";
        echo json_encode($json);
        $msg = "(" . $_SESSION['user']['nombre_usuario'] . "), Ingresó al Módulo de Bienes";
        Bitacora($msg, "Bien");
        exit;
    }

    if (isset($_POST["registrar"])) {
        $bien->set_codigo_bien($_POST["codigo_bien"]);
        $bien->set_id_tipo_bien($_POST["id_tipo_bien"]);
        $bien->set_id_marca($_POST["id_marca"]);
        $bien->set_descripcion($_POST["descripcion"]);
        $bien->set_estado($_POST["estado"]);
        $bien->set_cedula_empleado($_POST["cedula_empleado"]);
        $bien->set_id_oficina($_POST["id_oficina"]);
        $peticion["peticion"] = "registrar";
        $datos = $bien->Transaccion($peticion);
        echo json_encode($datos);

        if ($datos['estado'] == 1) {
            $msg = "(" . $_SESSION['user']['nombre_usuario'] . "), Se registró un nuevo bien";
        } else {
            $msg = "(" . $_SESSION['user']['nombre_usuario'] . "), error al registrar un nuevo bien";
        }
        Bitacora($msg, "Bien");
        exit;
    }

    if (isset($_POST['consultar'])) {
        $peticion["peticion"] = "consultar";
        $datos = $bien->Transaccion($peticion);
        echo json_encode($datos);
        exit;
    }

    if (isset($_POST["consultar_eliminadas"])) {
        $peticion["peticion"] = "consultar_eliminadas";
        $datos = $bien->Transaccion($peticion);
        echo json_encode($datos);
        exit;
    }

    if (isset($_POST["restaurar"])) {
        $bien->set_codigo_bien($_POST["codigo_bien"]);
        $peticion["peticion"] = "restaurar";
        $datos = $bien->Transaccion($peticion);
        echo json_encode($datos);
        $msg = "(" . $_SESSION['user']['nombre_usuario'] . "), Se restauró el bien Código: " . $_POST["codigo_bien"];
        Bitacora($msg, "Bien");
        exit;
    }

    if (isset($_POST['consultar_tipos_bien'])) {
        $peticion["peticion"] = "consultar_tipos_bien";
        $datos = $bien->Transaccion($peticion);
        echo json_encode($datos);
        exit;
    }

    if (isset($_POST['consultar_marcas'])) {
        $peticion["peticion"] = "consultar_marcas";
        $datos = $bien->Transaccion($peticion);
        echo json_encode($datos);
        exit;
    }

    if (isset($_POST['consultar_oficinas'])) {
        $peticion["peticion"] = "consultar_oficinas";
        $datos = $bien->Transaccion($peticion);
        echo json_encode($datos);
        exit;
    }

    if (isset($_POST['consultar_empleados'])) {
        $peticion["peticion"] = "consultar_empleados";
        $datos = $bien->Transaccion($peticion);
        echo json_encode($datos);
        exit;
    }

    if (isset($_POST["modificar"])) {
        $bien->set_codigo_bien($_POST["codigo_bien"]);
        $bien->set_id_tipo_bien($_POST["id_tipo_bien"]);
        $bien->set_id_marca($_POST["id_marca"]);
        $bien->set_descripcion($_POST["descripcion"]);
        $bien->set_estado($_POST["estado"]);
        $bien->set_cedula_empleado($_POST["cedula_empleado"]);
        $bien->set_id_oficina($_POST["id_oficina"]);
        $peticion["peticion"] = "actualizar";
        $datos = $bien->Transaccion($peticion);
        echo json_encode($datos);

        if ($datos['estado'] == 1) {
            $msg = "(" . $_SESSION['user']['nombre_usuario'] . "), Se modificó el registro del bien";
        } else {
            $msg = "(" . $_SESSION['user']['nombre_usuario'] . "), error al modificar bien";
        }
        Bitacora($msg, "Bien");
        exit;
    }

    if (isset($_POST["eliminar"])) {
        $bien->set_codigo_bien($_POST["codigo_bien"]);
        $peticion["peticion"] = "eliminar";
        $datos = $bien->Transaccion($peticion);
        echo json_encode($datos);

        if ($datos['estado'] == 1) {
            $msg = "(" . $_SESSION['user']['nombre_usuario'] . "), Se eliminó un bien";
        } else {
            $msg = "(" . $_SESSION['user']['nombre_usuario'] . "), error al eliminar un bien";
        }
        Bitacora($msg, "Bien");
        exit;
    }

    $tipos_bien = $bien->Transaccion(['peticion' => 'consultar_tipos_bien']);
    $marcas = $bien->Transaccion(['peticion' => 'consultar_marcas']);
    $oficinas = $bien->Transaccion(['peticion' => 'consultar_oficinas']);
    $empleados = $bien->Transaccion(['peticion' => 'consultar_empleados']);

    require_once "view/" . $page . ".php";
} else {
    require_once "view/404.php";
}
