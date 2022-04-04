<?php

include "inc/open-connection.php";
session_start();
if (empty($_SESSION['active'])) {
    header("location: login.php");
}

$id = $_GET['id'];

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
	<title>Actualizar Empleado - SISPRO</title>

	<?php include "inc/stylesheets.php"; ?>
	
</head>

<body>
	<div class="wrapper">
		<?php require_once("inc/sidebar.php"); ?>

		<div class="main">
			<?php require_once("inc/navbar.php"); ?>

			<main class="content">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3 text-center">Editar Categoría</h1>

					<div class="row">
						<?php
						$query = "SELECT LPAD(CAT_id, 4, '0') AS CAT_id, CAT_imagen, CAT_nombre, CAT_descripcion FROM categorias WHERE CAT_id = '$id'";
						$results = mysqli_query($open_connection, $query);
						while ($row = mysqli_fetch_array($results)) { ?>
						<div class="col-12 col-md-10 offset-md-1 col-xl-8 offset-xl-2">
							<div class="card">
								<div class="card-header">
									<h5 class="card-title">Actualizar Categoría</h5>
									<h6 class="card-subtitle text-muted">Edite los campos necesarios, no deje campos vacíos.</h6>
								</div>
								<div class="card-body">
									<form id="update-category" action="inc/update-category.php" method="POST" enctype="multipart/form-data">
										<div class="form-row">
                                            <div class="form-group col-md-10">
                                                <label class="form-label">Nombre de la Categoría</label>
                                                <input type="text" name="nombre"class="form-control" placeholder="Calzado" value="<?php echo $row['CAT_nombre'] ?>">
                                            </div>
											<div class="form-group col-md-2">
												<label class="form-label">Código</label>
												<input type="number" name="id" class="form-control" placeholder="1020" value="<?php echo $row['CAT_id'] ?>" disabled>
												<input type="number" name="id" class="form-control" value="<?php echo $row['CAT_id'] ?>" hidden>
                                            </div>
                                        </div>
										<div class="form-group">
											<label class="form-label">Descripción</label>
											<textarea class="form-control" name="descripcion" placeholder="Escribe una descripción corta para esta categoría." rows="3"><?php echo $row['CAT_descripcion'] ?></textarea>
										</div>
										<div class="form-row">
										<div class="form-group col-md-3">
											<label class="form-label">Imagen</label>
											<p><img class="img-thumbnail rounded mr-2 mb-2" src="<?php echo $row['CAT_imagen']?>" alt="<?php echo $row['CAT_nombre']?>" width="100%" height="100%"></p>
										</div>
										<div class="form-group col-md-9 align-self-center">
											<label class="form-label w-100">Cambiar Imagen</label>
											<input type="file" name="imagen">
											<small class="form-text text-muted">Elija una nueva imagen para este producto.</small>
										</div>
										</div>
										<button type="submit" class="btn btn-primary">Actualizar Categoría</button>
										<a href="/" class="btn btn-secondary">Salir</a>
									</form>
								</div>
							</div>
							<div class="mt-3" id="success-update-category"></div>
						</div>
					<?php } ?>
					</div>
				</div>
			</main>
<?php require_once("inc/footer.php"); ?>