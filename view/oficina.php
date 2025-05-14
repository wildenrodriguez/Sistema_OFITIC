<?php require_once("Componentes/head.php"); ?>

<body>
<?php require_once("Componentes/menu.php"); 
require_once("Componentes/modal_oficina.php"); ?>

<main id="main" class="main">
    <div class="pagetitle">
        <h1>Gestionar Oficinas</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="">Home</a></li>
                <li class="breadcrumb-item active"><a href="">Gestionar Oficinas</a></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Gestionar Oficinas</h5>
                        <button type="button" class="btn btn-primary mx-auto my-4" id="btn-registrar">
                            Registrar Oficina
                        </button>
                        <div class="table-responsive">
                            <table class="table" id="tabla1" style="width: 1024px;">
                                <thead>
                                    <tr>
                                        <?php foreach ($cabecera as $campo) echo "<th scope='col'>$campo</th>"; ?>
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

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
<script defer src="assets/js/oficina.js"></script>

</body>
</html>
