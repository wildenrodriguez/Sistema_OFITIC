<?php require_once("Componentes/head.php");?>

<body>
<?php require_once("Componentes/menu.php");?>

  <main id="main" class="main">
    <div class="pagetitle">
      <h1><?php echo $titulo ?></h1>
      <nav>
        <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="">Home</a></li>
	      <li class="breadcrumb-item active"><?php echo $titulo ?></li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Solicitudes</h5>
              <?php require_once "Componentes/modal_orden.php"; ?>
              <?php require_once "Componentes/modal_solicitud.php"; ?>
               <button type="button" class="btn btn-primary my-4" data-bs-toggle="modal" data-bs-target="#mostra">Crear Solicitud</button>
                
               <div class="table-responsive">
    <table class="table" id="tabla">
        <thead>
            <tr>
                <?php foreach ($cabecera as $campo) echo "<th scope='col'>$campo</th>"; ?>
                <th scope='col'></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($registros as $informacion){ ?>
            <tr>
                <?php foreach ($informacion as $campo) echo "<td>$campo</td>"; ?>
                <td>
                <?php if($informacion["5"]=="Pendiente"){ ?>    <button class="btn btn-sm btn-<?php echo $btn_color?> info" name="<?php echo $btn_name?>" data-bs-toggle="modal" data-bs-target="#<?php echo $modal?>"><i class="bi bi-<?php echo $btn_icon?>" title="Modificar"></i></button><?php } ?>
                <?php if($datos["rol"] == "Super usuario"){ ?>
                  <form method="post" id="form_config" autocomplete="off">
                        <input type="text" name="eliminar" hidden value="<?php echo "$informacion[0]"; ?>" >
                    <button class="btn btn-sm btn-danger  my-2" type="submit" id="eliminar" name="eliminar" value="<?php echo "$origen $informacion[0]"; ?>" title="Eliminar"><i class="bi bi-trash3"></i></button>
                    </form>
                <?php } ?>
                </td>
            </tr>
            <?php  }?>
        </tbody>
    </table>
</div>
              <hr>
              <form method="post" autocomplete="off">
              <div class="row">
                <div class="input-group col-sm">
                  <label for="inicio" class="input-group-text">Inicio</label>
                  <input required class="form-control" type="date" id="fecha" name="inicio" max="<?php echo date('Y-m-d'); ?>">
                </div>
                <div class="input-group col-sm">
                  <label for="final" class="input-group-text">Final</label>
                  <input required class="form-control" value="<?php echo date('Y-m-d'); ?>" type="date" id="fecha" name="final" max="<?php echo date('Y-m-d'); ?>">
                </div>
                <div class="col-sm">
                  <input formtarget="_blank" class="btn btn-primary" type="submit" name="reporte" value="Crear Reporte">
                  
                </div>
              </div>
              </form>
            </div>
          </div>

        </div>

      </div>
    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <?php require_once "Componentes/footer.php"; ?>

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
  <script defer src="js/servicio.js"></script>
  <script defer src="js/solicitudes.js"></script>

</body>

</html>