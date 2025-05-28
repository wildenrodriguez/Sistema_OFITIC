<?php require_once("Componentes/head.php"); ?>

<body>
    <?php require_once("Componentes/menu.php"); ?>

    <div class="pagetitle">
        <h1>Gestión de Backups</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="">Home</a></li>
                <li class="breadcrumb-item active"><a href="">Gestión de Backups</a></li>
            </ol>
        </nav>
    </div> <!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Gestión de Backups</h5>
                        <form method="POST" action="?page=backup">
                            <button type="submit" name="generar" class="btn btn-primary my-4">
                                Generar Backup
                            </button>
                        </form>
                        <div class="table-responsive">
                            <table class="table" id="tablaBackups">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nombre del Archivo</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (isset($backups['archivos'])): ?>
                                        <?php foreach ($backups['archivos'] as $index => $archivo): ?>
                                            <tr>
                                                <td><?= $index + 1 ?></td>
                                                <td><?= $archivo ?></td>
                                                <td>
                                                    <form method="POST" action="?page=backup" style="display:inline;">
                                                        <input type="hidden" name="filename" value="<?= $archivo ?>">
                                                        <button type="submit" name="eliminar" class="btn btn-danger">
                                                            <i class="fa-solid fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="3">No hay backups disponibles.</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <?php require_once "Componentes/footer.php"; ?>

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>
</body>

</html>