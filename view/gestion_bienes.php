<?php require_once "Componentes/head.php" ?>

<body>
    <?php require_once "Componentes/menu.php" ?>
    <?php require_once "Componentes/alertjs.php" ?>

    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Gestión de Bienes</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="">Home</a></li>
                    <li class="breadcrumb-item active">Gestión de Bienes</li>
                </ol>
            </nav>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex gap-2">
                                <div>
                                    <button class="btn btn-primary" id="btn-registrar" data-bs-toggle="modal" data-bs-target="#modal-bien">
                                        <i class="bi bi-plus-circle"></i> Registrar Bien
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover" id="tabla-bienes">
                                    <thead>
                                        <tr>
                                            <?php foreach ($cabecera as $campo) echo "<th>$campo</th>"; ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Datos cargados via AJAX -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <?php require_once "Componentes/modal_bien.php"; ?>

    <?php require_once "Componentes/footer.php"; ?>
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <script src="assets/js/bienes.js"></script>
</body>
</html>
