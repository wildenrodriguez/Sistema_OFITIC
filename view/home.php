<?php require_once("Componentes/head.php"); ?>

<body>
  <?php require_once("Componentes/menu.php"); ?>

    <div class="pagetitle">
      <h1><?php echo $titulo ?></h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item active"><a href="">Dashboa</a></li>
        </ol>
      </nav>
    </div><!-- End Page Title -->


    <div class="row">
      <div class="col-md-6 mb-6">
        <div class="card">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0">Puntos de Red</h5>
            <i class="fa-solid fa-server text-muted"></i>
          </div>
          <div class="card-body">
            <h2 class="total-balance mb-3">30 Disponibles</h2>
            <p class="text-muted mb-4">
              Piso 5
            </p>
            <div class="account-list">
              <div class="account-item d-flex justify-content-between mb-2">
                <span class="account-name">Chequeados</span>
                <span class="account-balance">28</span>
              </div>
              <div class="account-item d-flex justify-content-between mb-2">
                <span class="account-name">funcionando</span>
                <span class="account-balance">18</span>
              </div>
              <div class="account-item d-flex justify-content-between">
                <span class="account-name">Fuera de servicio</span>
                <span class="account-balance">10</span>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-6 mb-6">
        <div class="card">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0">Account Overview</h5>
            <i class="fas fa-wallet text-muted"></i>
          </div>
          <div class="card-body">
            <h2 class="total-balance mb-3">30 Disponibles</h2>
            <p class="text-muted mb-4">
              Total balance across all accounts
            </p>
            <div class="account-list">
              <div class="account-item d-flex justify-content-between mb-2">
                <span class="account-name">Checking</span>
                <span class="account-balance">$5,240.23</span>
              </div>
              <div class="account-item d-flex justify-content-between mb-2">
                <span class="account-name">Savings</span>
                <span class="account-balance">$12,750.89</span>
              </div>
              <div class="account-item d-flex justify-content-between">
                <span class="account-name">Investment</span>
                <span class="account-balance">$2,839.33</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>



  </main>

  <!-- ======= Footer ======= -->
  <?php require_once "Componentes/footer.php"; ?>

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center">
    <i class="bi bi-arrow-up-short"></i>
  </a>
  <script src="js/Configuracion.js"></script>

</body>

</html>