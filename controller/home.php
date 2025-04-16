<?php 
  if (!$_SESSION) {
    echo'<script>window.location="?page=login"</script>';
    $msg["danger"] = "Sesion Finalizada.";
  }

  ob_start();

  if (is_file("view/home.php")) {
    
    $titulo = "Home";
    $css = ["alert","style"];
    require_once "model/usuario.php";
    $usuario = new Usuario();
    $usuario->set_cedula($_SESSION['user']['cedula']);
    
    $datos = $_SESSION['user'];
    $datos = $datos + $usuario->datos();


    

    require_once "view/home.php";
  } else {
    require_once "view/404.php";
  }
 ?>