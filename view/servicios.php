<?php require_once("Componentes/head.php"); ?>

<body>
    <?php require_once("Componentes/menu.php");
    require_once("Componentes/modal_hoja.php"); ?>

    <div class="pagetitle">
        <h1>Gestión de Hojas de Servicio</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="">Home</a></li>
                <li class="breadcrumb-item active">Gestión de Hojas de Servicio</li>
            </ol>
        </nav>
    </div> <!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Hojas de Servicio</h5>
                        <div class="d-flex justify-content-between">
                            <button type="button" class="btn btn-primary my-4" id="btn-registrar">
                                Nueva Hoja de Servicio
                            </button>
                        </div>
                        <div class="table-responsive">
                            <table class="table" id="tabla1">
                                <thead>
                                    <tr>
                                        <?php foreach ($cabecera as $campo)
                                            echo "<th scope='col'>$campo</th>"; ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Contenido dinámico -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Modal Detalles -->
    <div class="modal fade" id="modalDetalles" tabindex="-1" role="dialog" aria-labelledby="modalDetallesTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="modalDetallesTitle">Detalles de la Hoja de Servicio</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <h6>Solicitante:</h6>
                            <p id="detalle-solicitante"></p>
                        </div>
                        <div class="col-md-6">
                            <h6>Equipo:</h6>
                            <p id="detalle-equipo"></p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <h6>Motivo:</h6>
                            <p id="detalle-motivo"></p>
                        </div>
                        <div class="col-md-6">
                            <h6>Fecha Solicitud:</h6>
                            <p id="detalle-fecha-solicitud"></p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <h6>Resultado:</h6>
                            <p id="detalle-resultado"></p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <h6>Observación:</h6>
                            <p id="detalle-observacion"></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <h6>Detalles Técnicos:</h6>
                            <table class="table" id="tablaDetalles">
                                <thead>
                                    <tr>
                                        <th>Componente</th>
                                        <th>Detalle</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Contenido dinámico -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Fin Modal Detalles -->

    <?php require_once "Componentes/footer.php"; ?>

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
    <script defer src="assets/js/servicio.js"></script>
</body>

</html>