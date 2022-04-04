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
	<title>Añadir Producto - SISPRO</title>

	<?php include "inc/stylesheets.php"; ?>
	
</head>

<body>
	<div class="wrapper">
		<?php require_once("inc/sidebar.php"); ?>

		<div class="main">
			<?php require_once("inc/navbar.php"); ?>

			<main class="content">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3 text-center">Añadir Producto</h1>

					<div class="row">
						<?php
                        $query = "SELECT CAT_id FROM categorias";
                        $results = mysqli_query($open_connection, $query);
                        if (mysqli_num_rows($results)>0) { ?>
							<div class="col-12 col-md-10 offset-md-1 col-xl-8 offset-xl-2">
								<div class="card">
									<div class="card-header">
										<h5 class="card-title">Nuevo Producto</h5>
										<h6 class="card-subtitle text-muted">Ingrese datos en todos los campos a continuación.</h6>
									</div>
									<div class="card-body">
										<form id="add-product" action="inc/add-product.php" method="POST" enctype="multipart/form-data">
											<div class="form-row">
											<div class="form-group col-md-6">
												<label class="form-label">Nombre del Producto</label>
												<input type="text" name="nombre" class="form-control" placeholder="Calzado de Puro Cuero">
											</div>
											<div class="form-group col-md-3">
												<label class="form-label">Marca</label>
												<select name="marca" class="form-control first-item" required>
													<option value="Maribú">Maribú</option>
													<option value="Ikafree">Ikafree</option>
												</select>
											</div>
											<div class="form-group col-md-3">
												<label class="form-label">Categoría</label>
												<select name="categoria" class="form-control first-item" required>
													<option value="">Elije</option>
													<?php
													$query = "SELECT CAT_id, CAT_nombre FROM categorias";
													$results = mysqli_query($open_connection,$query);
													while ($row_u = mysqli_fetch_array($results)) { ?>
													<option value="<?php echo $row_u['CAT_id'] ?>"><?php echo $row_u['CAT_nombre'] ?></option>
													<?php } ?>
												</select>
											</div>
											</div>
											<div class="form-row">
											<div class="form-group col-md-4">
												<label class="form-label">Modelo</label>
												<input type="text" name="modelo" class="form-control" placeholder="508" required>
											</div>
											<div class="form-group col-md-4">
												<label class="form-label">Material</label>
												<input type="text" name="material" class="form-control" placeholder="Cuero" required>
											</div>
											<div class="form-group col-md-4">
												<label class="form-label">Suela</label>
												<input type="text" name="suela" class="form-control" placeholder="PVC Expanso" required>
											</div>
											</div>
											<div class="form-row">
											<div class="form-group col-md-6">
												<label class="form-label">Color</label>
												<input type="text" name="color" class="form-control" placeholder="Negro" required>
											</div>
											<div class="form-group col-md-6">
												<label class="form-label">Precio</label>
												<div class="input-group mb-3">
													<div class="input-group-prepend">
														<span class="input-group-text">S/.</span>
													</div>
													<input type="number" name="precio" class="form-control" placeholder="89.90" required>
												</div>
											</div>
											</div>
											
											<div class="form-group">
												<label class="form-label">Descripción</label>
												<textarea class="form-control" name="descripcion" placeholder="Escribe una descripción corta para este producto." rows="3"></textarea>
											</div>
											<div class="form-group">
												<label class="form-label w-100">Imagen</label>
												<input type="file" name="imagen">
												<small class="form-text text-muted">Elija la imagen del producto que va añadir.</small>
											</div>
											<button type="submit" class="btn btn-primary">Añadir Producto</button>
											<button type="reset" class="btn btn-secondary">Limpiar</button>
										</form>
									</div>
								</div>
								<div class="mt-3" id="success-add-product"></div>
							</div>
						<?php 
						} else { ?>
							<div class="col-md-8 offset-md-2">
								<div class="alert alert-primary alert-outline-coloured alert-dismissible" role="alert">
								<div class="alert-icon">
									<i data-feather="alert-circle"></i>
								</div>
								<div class="alert-message">
									Es necesario agregar categorías para luego añadir productos.
								</div>
							</div>
                        <?php 
                        }?>
					</div>
				</div>
			</main>
<?php require_once("inc/footer.php"); ?>