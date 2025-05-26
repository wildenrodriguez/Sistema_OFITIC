<?php require_once("Componentes/head.php"); ?>

<body>
  <?php require_once("Componentes/menu.php");
  require_once("Componentes/modal_crear_usuario.php"); ?>

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
              <h5 class="card-title">Modulo ayuda</h5>
              <div>
                <input type="text" id="buscador" class="form-control mb-2 mt-2" placeholder="Buscar...">
                <h3 id="resultado-busqueda"></h3>
              </div>

              <div class=" row">
                <!-- Comienzo cards -->
                <div class="card m-2">
                  <div class="card-body">
                    <h5 class="card-title">Como iniciar sesion</h5>
                    <p class="card-title">Para poder iniciar sesion tenemos que entrar en el sistema, ya estando adentro del sistema aparecera </p>
                  </div>
                  <div id="imageCarousel" class="carousel slide text-center" data-bs-ride="carousel">
                    <div class="carousel-inner">
                      <div class="carousel-item active">
                        <img src="assets/img/1.jpg" class="d-block w-50" alt="First slide">
                      </div>
                      <div class="carousel-item">
                        <img src="assets/img/2.jpeg" class="d-block w-50" alt="Second slide">
                      </div>
                      <div class="carousel-item">
                        <img src="assets/img/3.jpeg" class="d-block w-50" alt="Third slide">
                      </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#imageCarousel" data-bs-slide="prev">
                      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                      <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#imageCarousel" data-bs-slide="next">
                      <span class="carousel-control-next-icon" aria-hidden="true"></span>
                      <span class="visually-hidden">Next</span>
                    </button>
                  </div>
                  <p class="card-text"><small class="text-body-secondary">Ultima modificacion 3 minutos atras</small></p>
                </div>
                <!-- Fin cards -->
                <div class="card m-2">

                  <div class="card-body">
                    <h1 class="card-title">Dashboard</h1>
                    <p class="card-title">Para poder iniciar sesion tenemos que entrar en el sistema, ya estando adentro del sistema aparecera </p>

                  </div>
                  <div id="imageCarousel" class="carousel slide text-center" data-bs-ride="carousel">
                    <div class="carousel-inner">
                      <div class="carousel-item active">
                        <img src="assets/img/1.jpg" class="d-block w-50" alt="First slide">
                      </div>
                      <div class="carousel-item">
                        <img src="assets/img/2.jpeg" class="d-block w-50" alt="Second slide">
                      </div>
                      <div class="carousel-item">
                        <img src="assets/img/3.jpeg" class="d-block w-50" alt="Third slide">
                      </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#imageCarousel" data-bs-slide="prev">
                      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                      <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#imageCarousel" data-bs-slide="next">
                      <span class="carousel-control-next-icon" aria-hidden="true"></span>
                      <span class="visually-hidden">Next</span>
                    </button>
                  </div>
                  <p class="card-text"><small class="text-body-secondary">Ultima modificacion 3 minutos atras</small></p>
                </div>



                <?php if ($datos["rol"] == "SUPERUSUARIO" or $datos["rol"] == "Técnico") { ?>

                  <div class="card m-2">
                    <div class="card-body">
                      <h1 class="card-title">Servicio tecnico</h1>
                      <p class="card-title">Para poder iniciar sesion tenemos que entrar en el sistema, ya estando adentro del sistema aparecera </p>

                    </div>
                    <div id="imageCarousel" class="carousel slide text-center" data-bs-ride="carousel">
                      <div class="carousel-inner">
                        <div class="carousel-item active">
                          <img src="assets/img/1.jpg" class="d-block w-50" alt="First slide">
                        </div>
                        <div class="carousel-item">
                          <img src="assets/img/2.jpeg" class="d-block w-50" alt="Second slide">
                        </div>
                        <div class="carousel-item">
                          <img src="assets/img/3.jpeg" class="d-block w-50" alt="Third slide">
                        </div>
                      </div>
                      <button class="carousel-control-prev" type="button" data-bs-target="#imageCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                      </button>
                      <button class="carousel-control-next" type="button" data-bs-target="#imageCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                      </button>
                    </div>
                    <p class="card-text"><small class="text-body-secondary">Ultima modificacion 3 minutos atras</small></p>
                  </div>

                <?php } ?>

                <?php if ($datos["rol"] == "SUPERUSUARIO" or $datos["rol"] == "Administrador") { ?>

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

                <?php if ($datos["rol"] == "SUPERUSUARIO") { ?>

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
  <script src="assets/js/ayuda.js"></script>
</body>

</html>