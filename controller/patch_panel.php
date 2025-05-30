<?php

    if (!$_SESSION) {

        echo '<script>window.location="?page=login"</script>';
        $msg["danger"] = "Sesion Finalizada.";

    }

    ob_start();

    if (is_file("view/" . $page . ".php")) {

        require_once "controller/utileria.php";
        require_once "model/patch_panel.php";

        $titulo = "Gestionar Patch Panel";
        $cabecera = array('Código de Bien', "Cantidad de Puertos", "Tipo de Patch Panel", "Serial", "Modificar / Eliminar");

        $patch_panel = new patch_panel();

        $bien = $patch_panel->Transaccion(['peticion' => 'consultar_bien']);
        


        if (isset($_POST["entrada"])) {

            $json['resultado'] = "entrada";
            echo json_encode($json);
            $msg = "(" . $_SESSION['user']['nombre_usuario'] . "), Ingresó al Módulo de Patch Panel";
            Bitacora($msg, "Patch Panel");

            exit;
        }

        if (isset($_POST["registrar"])) {
            
            $codigos_bien_validos = array_column($bien, 'codigo_bien');
            
            if (!in_array($_POST["codigo_bien"], $codigos_bien_validos)) {
                $json['resultado'] = "error";
                $json['mensaje'] = "Error <br> Seleccione un Código de Bien";
                $msg = "(" . $_SESSION['user']['nombre_usuario'] . "), envió solicitud no válida";
                
            } else if (preg_match("/^[0-9a-zA-ZáéíóúüñÑçÇ\/\-.,# ]{3,45}$/", $_POST["serial_patch_panel"]) == 0) {
                $json['resultado'] = "error";
                $json['mensaje'] = "Error <br> Serial del Patch Panel no válido";
                $msg = "(" . $_SESSION['user']['nombre_usuario'] . "), envió solicitud no válida";
                
            } else if (!in_array($_POST["cantidad_puertos"], ["8", "12", "16", "24", "32", "48", "96"])) {
                $json['resultado'] = "error";
                $json['mensaje'] = "Error <br>Cantidad de Puertos no válido";
                $msg = "(" . $_SESSION['user']['nombre_usuario'] . "), envió solicitud no válida";
                
            } else if (!in_array($_POST["tipo_patch_panel"], ["Red", "Telefonía"])) {
                $json['resultado'] = "error";
                $json['mensaje'] = "Error <br> Tipo de Patch Panel no válido";
                $msg = "(" . $_SESSION['user']['nombre_usuario'] . "), envió solicitud no válida";
                
            } else {
                
                $patch_panel->set_codigo_bien($_POST["codigo_bien"]);
                $patch_panel->set_tipo_patch_panel($_POST["tipo_patch_panel"]);
                $patch_panel->set_cantidad_puertos($_POST["cantidad_puertos"]);
                $patch_panel->set_serial_patch_panel($_POST["serial_patch_panel"]);

                $peticion["peticion"] = "registrar";
                $json = $patch_panel->Transaccion($peticion);

                if($json['estado'] == 1){
                    $msg = "(" . $_SESSION['user']['nombre_usuario'] . "), Se registró un nuevo Patch Panel";
                } else {
                    $msg = "(" . $_SESSION['user']['nombre_usuario'] . "), error al registrar un nuevo Patch Panel";
                }

            }

            echo json_encode($json);
            Bitacora($msg, "Patch Panel");
            exit;
        }

        if (isset($_POST['consultar'])) {

            $peticion["peticion"] = "consultar";
            $datos = $patch_panel->Transaccion($peticion);
            echo json_encode($datos);

            exit;
        }

        if (isset($_POST["consultar_eliminadas"])) {

            $peticion["peticion"] = "consultar_eliminadas";
            $datos = $patch_panel->Transaccion($peticion);
            echo json_encode($datos);

            exit;
        }

        if (isset($_POST['consultar_bien'])) {
            $datos = $patch_panel->ConsultarBien();
            echo json_encode($datos);
            exit;
        }
        
        if (isset($_POST["restaurar"])) {

            $patch_panel->set_codigo_bien($_POST["codigo_bien"]);
            $patch_panel->set_codigo_bien($_POST["codigo_bien"]);
            $peticion["peticion"] = "restaurar";
            $datos = $patch_panel->Transaccion($peticion);
            echo json_encode($datos);

            exit;
        }

        if (isset($_POST["modificar"])) {

           if (preg_match("/^[0-9a-zA-ZáéíóúüñÑçÇ\/\-.,# ]{3,45}$/", $_POST["serial_patch_panel"]) == 0) {
                $json['resultado'] = "error";
                $json['mensaje'] = "Error <br> Serial del Patch Panel no válido";
                $msg = "(" . $_SESSION['user']['nombre_usuario'] . "), envió solicitud no válida";
                
            } else if (!in_array($_POST["cantidad_puertos"], ["8", "12", "16", "24", "32", "48", "96"])) {
                $json['resultado'] = "error";
                $json['mensaje'] = "Error <br>Cantidad de Puertos no válido";
                $msg = "(" . $_SESSION['user']['nombre_usuario'] . "), envió solicitud no válida";
                
            } else if (!in_array($_POST["tipo_patch_panel"], ["Red", "Telefonía"])) {
                $json['resultado'] = "error";
                $json['mensaje'] = "Error <br> Tipo de Patch Panel no válido";
                $msg = "(" . $_SESSION['user']['nombre_usuario'] . "), envió solicitud no válida";
                
            } else {

                $patch_panel->set_codigo_bien($_POST["codigo_bien"]);
                $patch_panel->set_tipo_patch_panel($_POST["tipo_patch_panel"]);
                $patch_panel->set_cantidad_puertos($_POST["cantidad_puertos"]);
                $patch_panel->set_serial_patch_panel($_POST["serial_patch_panel"]);

                $peticion["peticion"] = "actualizar";
                $json = $patch_panel->Transaccion($peticion);

                if($json['estado'] == 1){
                    $msg = "(" . $_SESSION['user']['nombre_usuario'] . "), Se modificó el registro del Patch Panel";
                } else {
                    $msg = "(" . $_SESSION['user']['nombre_usuario'] . "), error al modificar el Patch Panel";
                }

            }

            echo json_encode($json);
            Bitacora($msg, "patch_panel");
            exit;
        }

        if (isset($_POST["eliminar"])) {

                $patch_panel->set_codigo_bien($_POST["codigo_bien"]);
                $peticion["peticion"] = "eliminar";
                $json = $patch_panel->Transaccion($peticion);

                if($json['estado'] == 1){

                    $msg = "(" . $_SESSION['user']['nombre_usuario'] . "), Se eliminó un Patch Panel";

                } else {
                    
                    $msg = "(" . $_SESSION['user']['nombre_usuario'] . "), error al eliminar un Patch Panel";
                }
            
       
            echo json_encode($json);
            Bitacora($msg, "patch_panel");
            exit;
        }

        require_once "view/" . $page . ".php";

    } else {

        require_once "view/404.php";

    }

?>