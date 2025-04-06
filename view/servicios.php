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
              <h5 class="card-title">Servicio</h5>
              
              <div class="table-responsive">
                <table class="table" id="tabla">
                    <thead>
                        <tr>
                            <?php foreach ($cabecera as $campo) echo "<th scope='col'>$campo</th>"; ?>
                            <th scope='col'></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($registros as $nro => $informacion){ ?>
                        <tr>
                            <?php foreach ($informacion as $campo) echo "<td>$campo</td>"; ?>
                            <td>
                                <form action="?page=hoja" method="post" autocomplete="off">
                                <button class="btn btn-sm btn-<?php echo $btn_color?>" type="submit" name="<?php echo $btn_name?>" value="<?php echo $nro; ?>" title="Modificar"><i class="bi bi-<?php echo $btn_icon?>"></i></button>
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
  <script defer src="js/servicio.js"></script>

</body>

</html>