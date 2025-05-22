<?php
if (!$_SESSION) {
  echo '<script>window.location="?page=login"</script>';
  $msg["danger"] = "Sesion Finalizada.";
}

ob_start();

if (is_file("view/home.php")) {

  $titulo = "Home";
  $css = ["alert", "style"];
  require_once "controller/utileria.php";
  require_once "model/usuario.php";
  require_once "model/empleado.php";
  require_once "model/oficina.php";
  $usuario = new Usuario();
  $empleado = new Empleado();
  $oficina = new Oficina();
  $usuario->set_cedula($_SESSION['user']['cedula']);
  $dato1 = $usuario->Transaccion(['peticion' => 'consultar']);
  $dato2 = $empleado->Transaccion(['peticion' => 'consultar']);
  $dato3 = $oficina->Transaccion(['peticion' => 'consultar']);
  $cantidadUsuarios = count($dato1['datos']);
  $cantidadEmpleados = count($dato2['datos']);
  $cantidadOficina = count($dato3['datos']);

  if (isset($_POST["grafico"])) {
  $grafico = [
    'resultado' => 'grafico',
    'datos' => [
      'GraUsuario' => [
        'label' => 'Usuarios',
        'labels' => ['Usuarios', 'Empleados', 'Oficinas'],
        'data' => [$cantidadUsuarios, $cantidadEmpleados, $cantidadOficina],
      ],
      'Graftecnicos' => [
        'label' => 'Técnicos',
        'labels' => ['Redes', 'Soporte', 'Electrónica'],
        'data' => [2, 1, 2], // Puedes reemplazar por datos dinámicos si tienes
      ],
      'miGrafico' => [
        'label' => 'Puntos de Red',
        'labels' => ['Chequeados', 'Funcionando', 'Fuera de servicio'],
        'data' => [28, 18, 10],
      ]
    ]
  ];
  echo json_encode($grafico);
  exit;
}


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
