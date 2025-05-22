<?php 
  if (!$_SESSION) {
    echo'<script>window.location="?page=login"</script>';
    $msg["danger"] = "Sesion Finalizada.";
  }

  ob_start();

  if (is_file("view/home.php")) {
    
    $titulo = "Home";
    $css = ["alert","style"];
    require_once "controller/utileria.php";
    require_once "model/usuario.php";
    $usuario = new Usuario();
    $usuario->set_cedula($_SESSION['user']['cedula']);
    
    $datos = $_SESSION['user'];
    $datos = $datos + $usuario->Transaccion(['peticion' => 'perfil']);

    if (isset($_POST["entrada"])) {
        $json['resultado'] = "entrada";
        echo json_encode($json);
        $msg = "(" . $_SESSION['user']['nombre_usuario'] . "), Ingresó al Módulo de Dashboard";
        Bitacora($msg, "Dashboard");
        exit;
    }


    

    require_once "view/home.php";
  } else {
    require_once "view/404.php";
  }
 ?>