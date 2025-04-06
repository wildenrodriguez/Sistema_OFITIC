<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
</head>
<body>
<center><h1 style="font-size: 24px; font-weight: bold;">Reporte de solicitudes</h1></center>
<table border="1" cellspacing="0" cellpadding="3">
    <thead>
      <tr>
        <th>#</th>
        <th>Solicitante</th>
        <th>Cedula</th>
        <th>Motivo</th>
        <th>Equipo</th>
        <th>Estado</th>
        <th>Fecha Reporte</th>
      </tr>
    </thead>
    <tbody>
        <?php
         foreach ($_SESSION['servicio'] as $informacion){ ?>
            <tr>
                <?php foreach ($informacion as $campo) echo "<td>$campo</td>"; ?>
            </tr>
        <?php  }?>
    </tbody>
  </table>
</body>
</html>