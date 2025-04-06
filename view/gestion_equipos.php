<?php require_once "Componentes/head.php" ?>

<body>
	<?php require_once "Componentes/menu.php" ?>
	<?php require_once "Componentes/alertjs.php" ?>

	<main id="main" class="main">
		<div class="pagetitle">
			<h1>Gestión de Equipos</h1>
			<nav>
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="">Home</a></li>
					<li class="breadcrumb-item active">Gestión de Equipos</li>
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
									<button class="btn btn-primary" id="btnreg" data-bs-toggle="modal" data-bs-target="#m_equipo">Registrar Equipo</button>
								</div>
								<form method="POST" class="" autocomplete="off">
									<button formtarget="_blank" class="col btn btn-primary" type="submit" name="reporte" >Reporte</button>
								</form>
							</div>
						</div>

						<div class="card-body table-responsive py-3">

							<div class="table-responsive">

								<table class="table" id="">
									<thead>
										<tr>
										<?php foreach ($cabecera as $campo) echo "<th scope='col'>$campo</th>"; ?>
										<th class="col-2">Acciones</th>
										</tr>
									</thead>
									<form method="POST" autocomplete="off">
										<tbody id="t_equipos"></tbody>
									</form>
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
	<?php require_once "Componentes/modal_equipo.php" ?>
	<script src="js/equipos.js"></script>
	<script src="js/equipo.js"></script>
</body>

</html>