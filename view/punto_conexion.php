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
    require_once("Componentes/modal_punto_conexion.php"); ?>

    <div class="pagetitle">
        <h1>Gestionar Punto de Conexión</h1>
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
                        <h5 class="card-title">Gestionar Punto de Conexión</h5>

                        <div class="d-flex justify-content-between">
                            <button type="button" class="btn btn-primary my-4" id="btn-registrar" title="Asignar un nuevo Punto de Conexión">
                                Asignar Punto de Conexión
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
 
    <?php require_once "Componentes/footer.php"; ?>

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>
    <script defer src="assets/js/punto_conexion.js"></script>
    </div>
</body>

</html>