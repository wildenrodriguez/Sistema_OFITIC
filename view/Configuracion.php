<?php require_once("Componentes/head.php"); ?>

<body>
  <?php require_once("Componentes/menu.php"); ?>

  <main id="main" class="main">
    <div class="pagetitle">
      <h1><?php echo $titulo ?></h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="">Config</a></li>
          <li class="breadcrumb-item active"><?php echo $titulo ?></li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <?php

    foreach ($tablas as $tabla) {
      $cabecera = array('#', $tabla);
      $registros = $datos_tablas[$tabla];
      $btn_color = "danger";
      $btn_icon = "x-lg";
      $btn_name = "eliminar";
      $btn_value = "codigo";
      $origen = $tabla;
    ?>
      <div class="row">
        <section class="section">
          <div class="row">
            <div class="col-lg-6">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title"><?php echo $tabla; ?></h5>
                  <?php require "Componentes/tabla.php"; ?>
                </div>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title"><?php echo $tabla; ?></h5>
                  <form method="post" class="row g-3 needs-validation" autocomplete="off">
                    <div class="col-sm-12">
                      <label for="nombre" class="form-label">Ingrese <?php echo $tabla; ?></label>
                      <input type="text" name="nombre" class="form-control disabled nombre" id="<?php echo $tabla; ?>" placeholder="Ingrese el nombre" value="" maxlength="30">
                      <div class="invalid-feedback">Ingresa el nombre!</div>
                      <span id="<?php echo "s" . $tabla; ?>"></span>
                      <!-- <span class="error" id="<?php echo "s" . $tabla; ?>" >Error</span> -->
                    </div>
                    <?php ?>
                </div>
                <div class="row mt-sm-5 my-3 mx-5 gap-3">
                  <button class="col btn btn-primary <?php echo $tabla; ?>" type="submit" name="registrar" id="<?php echo $tabla; ?>" value="<?php echo $tabla; ?>">Registrar</button>
                  <button formtarget="_blank" class="col btn btn-primary" type="submit" name="reporte" value="<?php echo $tabla; ?>">Reporte</button>
                </div>
                </form>

              </div>
            </div>
          </div>
      </div>
      </section>
      </div>


    <?php } ?>



  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <?php require_once "Componentes/footer.php"; ?>

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
  <script src="js/Configuracion.js"></script>

</body>

</html>