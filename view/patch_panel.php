<?php 

    require_once("Componentes/head.php"); 
?>
<style>
     #tabla1 td,
     #tabla1 th {
       text-align: center;
     }
   </style>
<body>

    <?php require_once("Componentes/menu.php");
    require_once("Componentes/modal_patch_panel.php"); ?>

    <div class="pagetitle">
        <h1>Gestionar Patch Panel</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="">Home</a></li>
                <li class="breadcrumb-item active"><a href="">Gestionar Patch Panel</a>
                </li>
            </ol>
        </nav>
    </div> <!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Gestionar Patch Panel</h5>

                        <div class="d-flex justify-content-between">
                            <button type="button" class="btn btn-primary my-4" id="btn-registrar" title="Agregar nuevo Patch Panel">
                                Registrar Patch Panel
                            </button>
                            <button type="button" class="btn btn-primary my-4" id="btn-consultar-eliminados" title="Consulta los Patch Panel Eliminados">
                                Patch Panel Eliminados <i class="fa-solid fa-recycle"></i>
                            </button>
                        </div>

                        <div class="table-responsive">
                            <table class="table" id="tabla1" title="Campo de Consulta de Patch Panel">
                                <thead>
                                    <tr >
                                        <?php foreach ($cabecera as $campo)
                                            echo "<th scope='col'style='text-align: center;'>$campo</th>"; ?>
                                    </tr>
                                </thead>

                                <tbody>
                                </tbody>

                            </table>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>

    </main><!-- End #main -->

    <!-- Modal Eliminados -->
    <div class="modal fade" id="modalEliminadas" tabindex="-1" role="dialog" aria-labelledby="modalEliminadasTitle" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h5 class="modal-title text-white" id="modalEliminadasTitle">Patch Eliminados</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" title="Cerrar Modal"></button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table" id="tablaEliminadas" title="Campo de Consulta de Patch Panel">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Código Bien</th>
                                    <th>Tipo de Patch Panel</th>
                                    <th>Cantidad de Puertos</th>
                                    <th>Serial</th>
                                    <th>Restaurar</th>
                                </tr>
                            </thead>

                            <tbody>
                                
                            </tbody>

                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" title="Cerrar Modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- ModalEliminados -->
    
    <?php require_once "Componentes/footer.php"; ?>

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>
    <script defer src="assets/js/patch_panel.js"></script>
    </div>
</body>

</html>