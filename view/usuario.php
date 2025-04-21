<?php require_once("Componentes/head.php");?>

<body>
<?php require_once("Componentes/menu.php");
      require_once("Componentes/modal_crear_usuario.php");?>

  <main id="main" class="main">
          
    <div class="pagetitle">
      <h1>Gestión de Usuarios</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="">Home</a></li>
          <li class="breadcrumb-item active">Gestión de Usuarios</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <?php 
      if (isset($confirmacion)) {
    ?>
      <div class="alert alert-<?php echo $color; ?> alert-dismissible fade show" role="alert">
         <strong><?php echo $confirmacion; ?></strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    <?php 
      }
     ?>
    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body table-responsive py-3">
            <button class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#crear_usuario">Crear usuario</button>

            <div class="table-responsive">
                <table class="table display" id="tabla1">
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
                              <form action="" method="post" autocomplete="off">
                            <?php if($informacion["rol"]!="ADMINISTRADOR"){ ?>
                              <input type="text" hidden name="<?php echo $btn_name?>" value="<?php echo "$informacion[$btn_value]"; ?>">
                              <button id="eliminar" class="btn btn-sm btn-<?php echo $btn_color?>" type="button"><i class="bi bi-<?php echo $btn_icon?>" title="Eliminar"></i></button><?php } ?>
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

  <?php require_once "Componentes/footer.php"; ?>
  <script defer src="assets/js/usuarios.js"></script>

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

</body>

</html>