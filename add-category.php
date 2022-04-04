<?php

include "inc/open-connection.php";
session_start();
if (empty($_SESSION['active'])) {
    header("location: login.php");
}

?>

<!DOCTYPE html>
<html lang="es">

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Sistema para la gestión de Producción.">
	<meta name="author" content="MartiPE">
	<meta name="theme-color" content="#2979ff" />
	<title>Añadir Categoría - SISPRO</title>

	<?php include "inc/stylesheets.php"; ?>
	
</head>

<body>
	<div class="wrapper">
		<?php require_once("inc/sidebar.php"); ?>

		<div class="main">
			<?php require_once("inc/navbar.php"); ?>

			<main class="content">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3 text-center">Añadir Categoría</h1>

					<div class="row">
						<div class="col-12 col-md-10 offset-md-1 col-xl-8 offset-xl-2">
							<div class="card">
								<div class="card-header">
									<h5 class="card-title">Nueva Categoría</h5>
									<h6 class="card-subtitle text-muted">Ingrese datos en todos los campos a continuación.</h6>
								</div>
								<div class="card-body">
									<form id="add-category" action="inc/add-category.php" method="POST" enctype="multipart/form-data">
                                        <div class="form-group">
											<label class="form-label">Nombre de la Categoría</label>
											<input type="text" name="nombre" class="form-control" placeholder="Calzado" required>
                                        </div>
                                        <div class="form-group">
											<label class="form-label">Descripción</label>
											<textarea class="form-control" name="descripcion" placeholder="Ingrese una descripción para esta categoría." rows="3"></textarea>
										</div>
										<div class="form-group">
											<label class="form-label w-100">Imagen</label>
											<input type="file" name="imagen">
											<small class="form-text text-muted">Elija la imagen para la categoría que va añadir.</small>
										</div>
										<button type="submit" class="btn btn-primary">Añadir Categoría</button>
										<button type="reset" class="btn btn-secondary">Limpiar</button>
									</form>
								</div>
							</div>
							<div class="mt-3" id="success-add-category"></div>
						</div>
					</div>
				</div>
			</main>
<?php require_once("inc/footer.php"); ?>