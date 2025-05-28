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
        <li class="menu-item <?php echo ($page == "home") ? "active" : "" ?>" title="Dashboard">
          <a href="?page=home">
            <i class="fas fa-home"></i>
            <span class="ms-2 me-2 menu-text">Dashboard</span>
          </a>
        </li>
        <li class="menu-item <?php echo ($page == "mis_servicios") ? "active" : "" ?>">
          <a href="?page=mis_servicios">
            <i class="fa-solid fa-list-check" title="Mis Solicitudes"></i>
            <span class="ms-2 me-2 menu-text">Mis Solicitudes</span>
          </a>
        </li>

        <?php if ($datos["rol"] == "SUPERUSUARIO" or $datos["rol"] == "ADMINISTRADOR") { ?>
          <li class="menu-item <?php echo ($page == "servicios") ? "active" : "" ?>" title="Servicios">
            <a href="?page=servicios">
              <i class="fa-solid fa-clipboard-check"></i>
              <span class="ms-2 me-2 menu-text">Servicios</span>
            </a>
          </li>
        <?php } ?>

        <?php if ($datos["rol"] == "SUPERUSUARIO" or $datos["rol"] == "ADMINISTRADOR") { ?>

          <li class="menu-item <?php echo ($page == "solicitudes") ? "active" : "" ?>" title="Solicitudes">
            <a href="?page=solicitud">
              <i class="fa-solid fa-clipboard-list"></i>
              <span class="ms-2 me-2 menu-text">Solicitudes</span>
            </a>
          </li>

          <ul>
            <li class="menu-item <?php echo ($page == "gestion_equipos" || $page == "Configuracion") ? "active" : "" ?>"
              title="Gestión de Equipos">
              <a class="nav-link collapsed" data-bs-target="#icons-nava" data-bs-toggle="collapse" href="#">
                <i class="fas fa-cog"></i>
                <span class="ms-2 me-2 menu-text">Gestion de Equipos</span>
                <i class="fa-solid fa-angle-right"></i>
              </a>
            </li>

            <ul id="icons-nava" style="margin-left: 1em;"
              class="nav-content <?php echo ($page == "gestion_equipos") ? "" : "collapse" ?>"
              data-bs-parent="#sidebar-nav">

              <li class="menu-item <?php echo (isset($_GET['dato']) && $_GET['dato'] == "unidad") ? "active" : "" ?>"
                title="Equipos">
                <a href="?page=equipo">
                  <i class="fa-solid fa-computer"></i>
                  <span class="ms-2 me-2 menu-text">Equipos</span>
                </a>
              </li>
              <li class="menu-item <?php echo (isset($_GET['dato']) && $_GET['dato'] == "Bien") ? "active" : "" ?>"
                title="Bienes">
                <a href="?page=bien">
                  <i class="fas fa-cog"></i>
                  <span class="ms-2 me-2 menu-text">Bienes</span>
                </a>
              </li>
            </ul>
            <ul>
              <li class="menu-item <?php echo ($page == "gestion_equipos" || $page == "Configuracion") ? "active" : "" ?>"
                title="Gestión de Redes">
                <a class="nav-link collapsed" data-bs-target="#icons-network" data-bs-toggle="collapse" href="#">
                  <i class="fas fa-cog"></i>
                  <span class="ms-2 me-2 menu-text">Gestion de Redes</span>
                  <i class="fa-solid fa-angle-right"></i>
                </a>
              </li>

              <ul id="icons-network" style="margin-left: 1em"
                class="nav-content <?php echo ($page == "gestion_equipos") ? "" : "collapse" ?>"
                data-bs-parent="#sidebar-nav">

                <li class="menu-item <?php echo (isset($_GET['dato']) && $_GET['dato'] == "unidad") ? "active" : "" ?>"
                  title="Gestión de Switches">
                  <a href="?page=Switch_">
                    <i class="fa-solid fa-server"></i>
                    <span class="ms-2 me-2 menu-text">Gestión de Switches</span>
                  </a>
                </li>
                <li class="menu-item <?php echo (isset($_GET['dato']) && $_GET['dato'] == "Bien") ? "active" : "" ?>"
                  title="Gestión de Interconexiones">
                  <a href="?page=interconexion">
                    <i class="fa-solid fa-network-wired"></i>
                    <span class="ms-2 me-2 menu-text">Gestión de Interconexiones</span>
                  </a>
                </li>
                <li class="menu-item <?php echo (isset($_GET['dato']) && $_GET['dato'] == "unidad") ? "active" : "" ?>"
                  title="Gestión de Patch Panel">
                  <a href="?page=patch_panel">
                    <i class="fa-solid fa-server"></i>
                    <span class="ms-2 me-2 menu-text">Gestión de Patch Panel</span>
                  </a>
                </li>
                <li class="menu-item <?php echo (isset($_GET['dato']) && $_GET['dato'] == "Bien") ? "active" : "" ?>"
                  title="Gestión de Puntos de Conexión">
                  <a href="?page=punto_conexion">
                    <i class="fa-solid fa-ethernet"></i>
                    <span class="ms-2 me-2 menu-text">Gestión de Puntos de Conexión</span>
                  </a>
                </li>

              </ul>

              <li class="menu-item <?php echo ($page == "solicitantes") ? "active" : "" ?>" title="Gestión de Empleados">
                <a href="?page=empleado">
                  <i class="fa-solid fa-id-card"></i>
                  <span class="ms-2 me-2 menu-text">Gestión de Empleados</span>
                </a>
              </li>
              <li class="menu-item <?php echo ($page == "solicitantes") ? "active" : "" ?>" title="Gestión de Técnicos">
                <a href="?page=tecnico">
                  <i class="fa-solid fa-id-card"></i>
                  <span class="ms-2 me-2 menu-text">Gestión de Técnicos</span>
                </a>
              </li>

              <li class="menu-item <?php echo ($page == "solicitantes") ? "active" : "" ?>"
                title="Gestionar de Materiales">
                <a href="?page=material">
                  <i class="fa-solid fa-toolbox"></i>
                  <span class="ms-2 me-2 menu-text">Gestión de Materiales</span>
                </a>
              </li>
              <li class="menu-item <?php echo ($page == "solicitantes") ? "active" : "" ?>" title="Gestión de Pisos">
                <a href="?page=piso">
                  <i class="fa-solid fa-stairs"></i>
                  <span class="ms-2 me-2 menu-text">Gestión de Pisos</span>
                </a>
              </li>
              <li class="menu-item <?php echo ($page == "solicitantes") ? "active" : "" ?>">
                <a href="?page=oficina">
                  <i class="fa-solid fa-building-user"></i>
                  <span class="ms-2 me-2 menu-text">Gestión de Oficinas</span>
                </a>
              </li>

              <ul>
                <?php if ($datos["rol"] == "ADMINISTRADOR" || $datos["rol"] == "SUPERUSUARIO") { ?>
                  <li class="menu-item <?php echo ($page == "Mantenimiento") ? "active" : "" ?>"
                    title="Gestión de Seguridad">
                    <a class="nav-link collapsed" data-bs-target="#icons-nave" data-bs-toggle="collapse" href="#">
                      <i class="fa-solid fa-shield-halved"></i>
                      <span class="ms-2 me-2 menu-text">Mòdulo de Seguridad</span>
                      <i class="fa-solid fa-angle-right"></i>
                    </a>
                  </li>

                  <ul id="icons-nave" style="margin-left: 1em;"
                    class="nav-content <?php echo ($page == "Mantenimiento") ? "" : "collapse" ?>"
                    data-bs-parent="#sidebar-nav">

                    <li class="menu-item <?php echo (isset($_GET['dato']) && $_GET['dato'] == "backup") ? "active" : "" ?>"
                      title="BackUp">
                      <a href="?page=backup">
                        <i class="fa-solid fa-database"></i>
                        <span class="ms-2 me-2 menu-text">BackUp</span>
                      </a>
                    </li>
                    <li class="menu-item <?php echo ($page == "usuario") ? "active" : "" ?>" title="Bitácora">
                      <a href="?page=bitacora">
                        <i class="fa-solid fa-user-clock"></i>
                        <span class="ms-2 me-2 menu-text">Bitácora</span>
                      </a>
                    </li>
                    <li class="menu-item <?php echo ($page == "usuario") ? "active" : "" ?>" title="Gestión de Usuarios">
                      <a href="?page=usuario">
                        <i class="fa-solid fa-users-rectangle"></i>
                        <span class="ms-2 me-2 menu-text">Gestión de Usuarios</span>
                      </a>
                    </li>
                    <li class="menu-item <?php echo ($page == "usuario") ? "active" : "" ?>" title="Roles y Permisos">
                      <a href="?page=rol">
                        <i class="fa-solid fa-users-rectangle"></i>
                        <span class="ms-2 me-2 menu-text">Roles y Permisos</span>
                      </a>
                    </li>
                  </ul>

                <?php } ?>

              </ul>

            <?php } ?>
          </ul>
    </nav>
  </div>

  <div class="sidebar-footer">
    <ul>

      <?php if ($datos["rol"] == "ADMINISTRADOR" || $datos["rol"] == "SUPERUSUARIO") { ?>

        <li class="menu-item <?php echo ($page == "Configuracion") ? "active" : "" ?>" title="Configuración">
          <a class="nav-link collapsed" data-bs-target="#icons-nav" data-bs-toggle="collapse" href="#">
            <i class="fas fa-cog"></i>
            <span class="ms-2 me-2 menu-text">Configuración</span>
            <i class="fa-solid fa-angle-right"></i>
          </a>
        </li>

        <ul id="icons-nav" style="margin-left: 1em"
          class="nav-content <?php echo ($page == "Configuracion") ? "" : "collapse" ?>" data-bs-parent="#sidebar-nav">

          <li class="menu-item <?php echo (isset($_GET['dato']) && $_GET['dato'] == "unidad") ? "active" : "" ?>"
            title="Unidad">
            <a href="?page=unidad">
              <i class="fa-solid fa-users-gear"></i>
              <span class="ms-2 me-2 menu-text">Unidades</span>
            </a>
          </li>
          <li class="menu-item <?php echo (isset($_GET['dato']) && $_GET['dato'] == "dependencia") ? "active" : "" ?>"
            title="Dependencia">
            <a href="?page=dependencia">
              <i class="fa-solid fa-users-gear"></i>
              <span class="ms-2 me-2 menu-text">Dependencias</span>
            </a>
          </li>
          <li class="menu-item <?php echo ($page == "solicitantes") ? "active" : "" ?>">
            <a href="?page=ente">
              <i class="fa-solid fa-building"></i>
              <span class="ms-2 me-2 menu-text">Entes</span>
            </a>
          </li>
          <li class="menu-item <?php echo (isset($_GET['dato']) && $_GET['dato'] == "marca") ? "active" : "" ?>"
            title="Marca">
            <a href="?page=marca">
              <i class="fa-solid fa-trademark"></i>
              <span class="ms-2 me-2 menu-text">Marca</span>
            </a>
          </li>
          <li class="menu-item <?php echo (isset($_GET['dato']) && $_GET['dato'] == "tipo_servicio") ? "active" : "" ?>"
            title="Tipo de Servicio">
            <a href="?page=tipo_servicio">
              <i class="fa-solid fa-screwdriver-wrench"></i>
              <span class="ms-2 me-2 menu-text">Tipo de Servicio</span>
            </a>
          </li>
          <li class="menu-item <?php echo (isset($_GET['dato']) && $_GET['dato'] == "cargo") ? "active" : "" ?>"
            title="Cargo">
            <a href="?page=cargo">
              <i class="fa-solid fa-screwdriver-wrench"></i>
              <span class="ms-2 me-2 menu-text">Cargo</span>
            </a>
          </li>
          <li class="menu-item <?php echo (isset($_GET['dato']) && $_GET['dato'] == "tipo_bien") ? "active" : "" ?>"
            title="Tipo de Bien">
            <a href="?page=tipo_bien">
              <i class="fa-solid fa-screwdriver-wrench"></i>
              <span class="ms-2 me-2 menu-text">Tipo de Bien</span>
            </a>
          </li>
        </ul>
      <?php } ?>

      <li class="menu-item <?php echo ($page == "ayuda") ? "active" : "" ?>" title="Ayuda">
        <a href="?page=ayuda">
          <i class="fas fa-question-circle"></i>
          <span class="ms-2 me-2 menu-text">Ayuda</span>
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
                  <img src="<?php echo $foto; ?>" alt="User Avatar" />
                </div>
              </button>
              <div class="dropdown-menu user-menu">
                <div class="dropdown-header">
                  <h6><?php echo $datos["nombres"] . " " . $datos["apellidos"]; ?></h6>
                  <span><?php echo $datos["cedula"] . "/" . $datos["rol"]; ?></span>
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