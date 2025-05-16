<!-- Sidebar -->
<aside id="sidebar" class="sidebar">
  <div class="sidebar-header">
    <h1 class="logo">
      <img src="assets/img/logo.jpg" style="width: 1.5em; border-radius: 2px" alt="Logo" class="img-logo">
      <span class="ms-2" id="logo-text">OFITIC</span>
    </h1>
    <button id="collapse-btn" class="collapse-btn">
      <i class="fas fa-chevron-left"></i>
    </button>
  </div>

  <div class="sidebar-content">
    <nav class="sidebar-menu">
      <ul>
        <li class="menu-item <?php echo ($page == "home") ? "active" : "" ?>">
          <a href="?page=home">
            <i class="fas fa-home"></i>
            <span class="menu-text">Dashboard</span>
          </a>
        </li>
        <li class="menu-item <?php echo ($page == "mis_servicios") ? "active" : "" ?>">
          <a href="?page=mis_servicios">
            <i class="fa-solid fa-list-check"></i>
            <span class="menu-text">Mis Solicitudes</span>
          </a>
        </li>

        <?php if ($datos["rol"] == "Super usuario" or $datos["rol"] == "ADMINISTRADOR") { ?>
          <li class="menu-item <?php echo ($page == "servicios") ? "active" : "" ?>">
            <a href="?page=servicios">
              <i class="fa-solid fa-clipboard-check"></i>
              <span class="menu-text">Servicios</span>
            </a>
          </li>
        <?php } ?>

        <?php if ($datos["rol"] == "Super usuario" or $datos["rol"] == "ADMINISTRADOR") { ?>

          <li class="menu-item <?php echo ($page == "solicitudes") ? "active" : "" ?>">
            <a href="?page=solicitudes">
              <i class="fa-solid fa-clipboard-list"></i>
              <span class="menu-text">Solicitudes</span>
            </a>
          </li>

          <ul>
            <li class="menu-item <?php echo ($page == "gestion_equipos" || $page == "Configuracion") ? "active" : "" ?>">
              <a class="nav-link collapsed" data-bs-target="#icons-nava" data-bs-toggle="collapse" href="#">
                <i class="fas fa-cog"></i>
                <span class="menu-text">Gestion de equipos</span>
                <i class="fa-solid fa-angle-right"></i>
              </a>
            </li>

            <ul id="icons-nava" style="margin-left: 1em;" class="nav-content <?php echo ($page == "gestion_equipos") ? "" : "collapse" ?>" data-bs-parent="#sidebar-nav">

              <li class="menu-item <?php echo (isset($_GET['dato']) && $_GET['dato'] == "unidad") ? "active" : "" ?>">
                <a href="?page=gestion_equipos">
                  <i class="fa-solid fa-computer"></i>
                  <span class="menu-text">Equipos</span>
                </a>
              </li>
              <li class="menu-item <?php echo (isset($_GET['dato']) && $_GET['dato'] == "Bien") ? "active" : "" ?>">
                <a href="?page=gestion_bienes">
                  <i class="fas fa-cog"></i>
                  <span class="menu-text">Bienes</span>
                </a>
              </li>

            </ul>

            <li class="menu-item <?php echo ($page == "solicitantes") ? "active" : "" ?>">
              <a href="?page=solicitantes">
                <i class="fa-solid fa-address-book"></i>
                <span class="menu-text">Gestión de Solicitantes</span>
              </a>
            </li>

            <li class="menu-item <?php echo ($page == "solicitantes") ? "active" : "" ?>">
              <a href="?page=material">
                <i class="fa-solid fa-toolbox"></i>
                <span class="menu-text">Gestión de Materiales</span>
              </a>
            </li>
            <li class="menu-item <?php echo ($page == "solicitantes") ? "active" : "" ?>">
              <a href="?page=edificio">
                <i class="fa-solid fa-building"></i>
                <span class="menu-text">Gestión de Edificios</span>
              </a>
            </li>
            <li class="menu-item <?php echo ($page == "solicitantes") ? "active" : "" ?>">
              <a href="?page=piso">
                <i class="fa-solid fa-stairs"></i>
                <span class="menu-text">Gestión de Pisos</span>
              </a>
            </li>
            <li class="menu-item <?php echo ($page == "solicitantes") ? "active" : "" ?>">
              <a href="?page=oficina">
                <i class="fa-solid fa-building-user"></i>
                <span class="menu-text">Gestión de Oficinas</span>
              </a>
            </li>

            <ul>
              <?php if ($datos["rol"] == "ADMINISTRADOR" || $datos["rol"] == "Super usuario") { ?>
                <li class="menu-item <?php echo ($page == "Mantenimiento") ? "active" : "" ?>">
                  <a class="nav-link collapsed" data-bs-target="#icons-nave" data-bs-toggle="collapse" href="#">
                    <i class="fas fa-cog"></i>
                    <span class="menu-text">Mantenimiento</span>
                    <i class="fa-solid fa-angle-right"></i>
                  </a>
                </li>

                <ul id="icons-nave" style="margin-left: 1em;" class="nav-content <?php echo ($page == "Mantenimiento") ? "" : "collapse" ?>" data-bs-parent="#sidebar-nav">

                  <li class="menu-item <?php echo (isset($_GET['dato']) && $_GET['dato'] == "backup") ? "active" : "" ?>">
                    <a href="?page=backup">
                      <i class="fas fa-cog"></i>
                      <span class="menu-text">Backup</span>
                    </a>
                  </li>
                  <li class="menu-item <?php echo ($page == "usuario") ? "active" : "" ?>">
                    <a href="?page=bitacora">
                      <i class="fa-solid fa-user-clock"></i>
                      <span class="menu-text">Bitácora</span>
                    </a>
                  </li>
                  <li class="menu-item <?php echo ($page == "usuario") ? "active" : "" ?>">
                    <a href="?page=usuario">
                      <i class="fa-solid fa-users-rectangle"></i>
                      <span class="menu-text">Gestión de Usuarios</span>
                    </a>
                  </li>

                </ul>

              <?php } ?>

            </ul>

          <?php } ?>


          <!-- <li class="menu-item">
          <a href="#">
            <i class="fas fa-chart-bar"></i>
            <span class="menu-text">Analytics</span>
          </a>
        </li>
        <li class="menu-item">
          <a href="#">
            <i class="fas fa-building"></i>
            <span class="menu-text">Organization</span>
          </a>
        </li>
        <li class="menu-item">
          <a href="#">
            <i class="fas fa-folder"></i>
            <span class="menu-text">Projects</span>
          </a>
        </li>
        <li class="menu-item">
          <a href="#">
            <i class="fas fa-wallet"></i>
            <span class="menu-text">Transactions</span>
          </a>
        </li>
        <li class="menu-item">
          <a href="#">
            <i class="fas fa-receipt"></i>
            <span class="menu-text">Invoices</span>
          </a>
        </li>
        <li class="menu-item">
          <a href="#">
            <i class="fas fa-credit-card"></i>
            <span class="menu-text">Payments</span>
          </a>
        </li>
        <li class="menu-item">
          <a href="#">
            <i class="fas fa-users"></i>
            <span class="menu-text">Usuarios</span>
          </a>
        </li>
        <li class="menu-item">
          <a href="#">
            <i class="fas fa-shield-alt"></i>
            <span class="menu-text">Permissions</span>
          </a>
        </li>
        <li class="menu-item">
          <a href="#">
            <i class="fas fa-comment"></i>
            <span class="menu-text">Chat</span>
          </a>
        </li>
        <li class="menu-item">
          <a href="#">
            <i class="fas fa-video"></i>
            <span class="menu-text">Meetings</span>
          </a>
        </li> -->

          </ul>
    </nav>
  </div>

  <div class="sidebar-footer">
    <ul>

      <?php if ($datos["rol"] == "ADMINISTRADOR" || $datos["rol"] == "Super usuario") { ?>

        <li class="menu-item <?php echo ($page == "Configuracion") ? "active" : "" ?>">
          <a class="nav-link collapsed" data-bs-target="#icons-nav" data-bs-toggle="collapse" href="#">
            <i class="fas fa-cog"></i>
            <span class="menu-text">Configuración</span>
            <i class="fa-solid fa-angle-right"></i>
          </a>
        </li>

        <ul id="icons-nav" style="margin-left: 1em;" class="nav-content <?php echo ($page == "Configuracion") ? "" : "collapse" ?>" data-bs-parent="#sidebar-nav">

          <li class="menu-item <?php echo (isset($_GET['dato']) && $_GET['dato'] == "unidad") ? "active" : "" ?>">
            <a href="?page=Configuracion&dato=unidad">
              <i class="fa-solid fa-users-gear"></i>
              <span class="menu-text">Unidad</span>
            </a>
          </li>
          <li class="menu-item <?php echo (isset($_GET['dato']) && $_GET['dato'] == "dependencia") ? "active" : "" ?>">
            <a href="?page=Configuracion&dato=dependencia">
              <i class="fa-solid fa-users-gear"></i>
              <span class="menu-text">Dependencia</span>
            </a>
          </li>
          <li class="menu-item <?php echo (isset($_GET['dato']) && $_GET['dato'] == "marca") ? "active" : "" ?>">
            <a href="?page=marca">
              <i class="fa-solid fa-trademark"></i>
              <span class="menu-text">Marca</span>
            </a>
          </li>
          <li class="menu-item <?php echo (isset($_GET['dato']) && $_GET['dato'] == "tipo_servicio") ? "active" : "" ?>">
            <a href="?page=tipo_servicio">
              <i class="fa-solid fa-screwdriver-wrench"></i>
              <span class="menu-text">Tipo de Servicio</span>
            </a>
          </li>
          <li class="menu-item <?php echo (isset($_GET['dato']) && $_GET['dato'] == "cargo") ? "active" : "" ?>">
            <a href="?page=cargo">
              <i class="fa-solid fa-screwdriver-wrench"></i>
              <span class="menu-text">Cargo</span>
            </a>
          </li>
        </ul>
      <?php } ?>

      <li class="menu-item <?php echo ($page == "ayuda") ? "active" : "" ?>">
        <a href="?page=ayuda">
          <i class="fas fa-question-circle"></i>
          <span class="menu-text">Ayuda</span>
        </a>
      </li>

    </ul>
  </div>
</aside>

<!-- Main Content -->
<div class="main-content">
  <!-- Header/Top Navigation -->
  <header class="top-nav">
    <div class="container-fluid">
      <div class="row align-items-center">
        <div class="col-auto d-lg-none">
          <button id="sidebar-toggle" class="sidebar-toggle">
            <i class="fas fa-bars" style="pointer-events: none;"></i>
          </button>
        </div>

        <div class="col d-none d-md-block">
          <nav class="breadcrumb-nav">
            <a href="#" class="breadcrumb-item">Home</a>
            <span class="breadcrumb-separator">/</span>
            <a href="#" class="breadcrumb-item">Dashboard</a>
          </nav>
        </div>

        <div class="col-auto ms-auto">
          <div class="top-nav-actions">
            <div class="action-item notification-dropdown">
              <button class="notification-btn">
                <i class="fas fa-bell"></i>
                <span class="notification-badge"></span>
              </button>
              <div class="dropdown-menu notification-menu">
                <div class="dropdown-header">
                  <h6>Notifications</h6>
                  <button class="close-dropdown">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
                <div class="dropdown-body">
                  <div class="notification-item">
                    <div class="notification-icon info">
                      <i class="fas fa-info"></i>
                    </div>
                    <div class="notification-content">
                      <p class="notification-title">New Feature</p>
                      <p class="notification-text">
                        Check out our new budget tracking tool!
                      </p>
                      <p class="notification-time">2 hours ago</p>
                    </div>
                  </div>
                  <div class="notification-item">
                    <div class="notification-icon warning">
                      <i class="fas fa-exclamation-triangle"></i>
                    </div>
                    <div class="notification-content">
                      <p class="notification-title">Account Alert</p>
                      <p class="notification-text">
                        Unusual activity detected on your account.
                      </p>
                      <p class="notification-time">1 day ago</p>
                    </div>
                  </div>
                  <div class="notification-item">
                    <div class="notification-icon danger">
                      <i class="fas fa-credit-card"></i>
                    </div>
                    <div class="notification-content">
                      <p class="notification-title">Payment Due</p>
                      <p class="notification-text">
                        Your credit card payment is due in 3 days.
                      </p>
                      <p class="notification-time">3 days ago</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="action-item">
              <button id="theme-toggle" class="theme-toggle">
                <i class="fas fa-moon dark-icon"></i>
                <i class="fas fa-sun light-icon"></i>
              </button>
            </div>

            <div class="action-item user-dropdown">
              <button class="user-dropdown-toggle">
                <div class="avatar">
                  <img
                    src="https://hebbkx1anhila5yf.public.blob.vercel-storage.com/38184074.jpg-M4vCjTSSWVw5RwWvvmrxXBcNVU8MBU.jpeg"
                    alt="User Avatar" />
                </div>
              </button>
              <div class="dropdown-menu user-menu">
                <div class="dropdown-header">
                  <h6><?php echo $datos["nombres"] . " " . $datos["apellidos"]; ?></h6>
                  <span><?php echo $datos["unidad"] . "/" . $datos["dependencia"]; ?></span>
                </div>
                <div class="dropdown-body">
                  <ul>
                    <li class="menu-item <?php echo ($page == "users-profile") ? "active" : "" ?>">
                      <a href="?page=users-profile">
                        <i class="menu-text-p fas fa-question-circle"></i>
                        <span class="menu-text-p">Perfil</span>
                      </a>
                    </li>

                    <li class="menu-item">
                      <a href="?page=closet">
                        <i class="menu-text-p fa-solid fa-arrow-right-to-bracket"></i>
                        <span class="menu-text-p">Cerrar Sesión</span>
                      </a>
                    </li>

                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>

  <!-- Page Content -->
  <main class="page-content" style="flex: 1;">



    </head>
    <link rel="icon" href="assets/img/favicon.ico">

    <head>

      <head>
        <!-- Agregar referencias a DataTables -->
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
      </head>