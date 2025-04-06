<?php require_once("Componentes/head.php");?>

<body>
<?php require_once("Componentes/menu.php"); 
require_once("Componentes/modal_solicitar.php");?>


  <main id="main" class="main">
    <?php require_once "Componentes/mi_servicio.php";?>
    <div class="pagetitle">
      <h1>Mis Servicios</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="">Home</a></li>
          <li class="breadcrumb-item active"><a href="">Mis servicios</a></li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Mis Solicitudes</h5>     
              <button type="button" class="btn btn-primary mx-auto my-4" data-bs-toggle="modal" data-bs-target="#Falla">
      Hacer Solicitud
    </button>    
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
                                  <form method="post" autocomplete="off">
                                  <?php if ($informacion[3]=="Finalizado") {?><button formtarget="_blank" class="btn btn-sm btn-<?php echo $btn_color?>" type="submit" name="reporte" value="<?php echo "$origen $informacion[$btn_value]"; ?>" data-bs-toggle="tooltip" data-bs-placement="top"
                                  data-bs-custom-class="custom-tooltip"
                                  data-bs-title="Generar reporte"><i class="bi bi-<?php echo $btn_icon?>"></i></button><?php } ?>
                                  </form>
                              </td>
                          </tr>
                          <?php  }?>
                      </tbody>
                  </table>
              </div>
            </div>
          </div>

        </div>

      </div>
    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <?php require_once "Componentes/footer.php"; ?>

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
  <script src="js/mis_servicios.js"></script>

</body>

</html>