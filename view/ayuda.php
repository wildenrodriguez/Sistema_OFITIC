<?php require_once("Componentes/head.php");?>

<body>
<?php require_once("Componentes/menu.php");
      require_once("Componentes/modal_crear_usuario.php");?>

  <main id="main" class="main">

          
    <div class="pagetitle">
      <h1>Ayuda</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="">Home</a></li>
          <li class="breadcrumb-item active">Ayuda</li>
        </ol>
      </nav>
    </div>


    <section class="section">
      <div class="row">
            
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Ayuda</h5>
              

              <div class=" row">
        
        <div class="col-md-6 col-lg-4 mb-4 video-container">
          <video class="img-fluid" controls>
            <source src="img/videos/login.mp4" type="video/mp4">
          </video>
          <div class="caption-container">
          <p class="gallery-caption">Como ingresar al sistema</p>
        </div>
        </div>

        <div class="col-md-6 col-lg-4 mb-4 video-container">
          <video class="img-fluid" controls>
            <source src="img/videos/mis servicios.mp4" type="video/mp4">
          </video>
          <div class="caption-container">
          <p class="gallery-caption">Uso del modulo Mis servicios</p>
        </div>
        </div>

        <div class="col-md-6 col-lg-4 mb-4 video-container">
          <video class="img-fluid" controls>
            <source src="img/videos/perfil.mp4" type="video/mp4">
          </video>
          <div class="caption-container">
          <p class="gallery-caption">Uso del modulo Perfil</p>
        </div>
        </div>

        <?php if($datos["rol"] == "Super usuario" or $datos["rol"] == "Técnico"){ ?>

        <div class="col-md-6 col-lg-4 mb-4 video-container">
          <video class="img-fluid" controls>
            <source src="img/videos/servicios.mp4" type="video/mp4">
          </video>
          <div class="caption-container">
          <p class="gallery-caption">Uso del modulo servicios</p>
        </div>
        </div>

        <?php } ?>

        <?php if($datos["rol"] == "Super usuario" or $datos["rol"] == "Administrador"){ ?>

        <div class="col-md-6 col-lg-4 mb-4 video-container">
          <video class="img-fluid" controls>
            <source src="img/videos/gestion de solicitante.mp4" type="video/mp4">
          </video>
          <div class="caption-container">
          <p class="gallery-caption">Uso del modulo de gestion de solicitantes</p>
        </div>
        </div>

        <div class="col-md-6 col-lg-4 mb-4 video-container">
          <video class="img-fluid" controls>
            <source src="img/videos/equipos.mp4" type="video/mp4">
          </video>
          <div class="caption-container">
          <p class="gallery-caption">Uso del modulo de equipos</p>
        </div>
        </div>

        <div class="col-md-6 col-lg-4 mb-4 video-container">
          <video class="img-fluid" controls>
            <source src="img/videos/solicitudes.mp4" type="video/mp4">
          </video>
          <div class="caption-container">
          <p class="gallery-caption">Uso del modulo de solicitudes</p>
        </div>
        </div>

        <?php } ?>

        <?php if($datos["rol"] == "Super usuario"){ ?>

        <div class="col-md-6 col-lg-4 mb-4 video-container">
          <video class="img-fluid" controls>
            <source src="img/videos/gestion de usuarios.mp4" type="video/mp4">
          </video>
          <div class="caption-container">
          <p class="gallery-caption">Uso del modulo gestion de usuarios</p>
        </div>
        </div>

        <div class="col-md-6 col-lg-4 mb-4 video-container">
          <video class="img-fluid" controls>
            <source src="img/videos/configuracion.mp4" type="video/mp4">
          </video>
          <div class="caption-container">
          <p class="gallery-caption">Uso del modulo configuracion del sistema</p>
        </div>
        </div>

        <?php } ?>
        
      </div>


            </div>
          </div>
        </div>
      </div>
    </section>


  </main><!-- End #main -->

  <?php require_once "Componentes/footer.php"; ?>

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

</body>

</html>