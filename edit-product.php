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
	<title>Actualizar Producto - SISPRO</title>

	<?php include "inc/stylesheets.php"; ?>
	
</head>

<body>
	<div class="wrapper">
		<?php require_once("inc/sidebar.php"); ?>

		<div class="main">
			<?php require_once("inc/navbar.php"); ?>

			<main class="content">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3 text-center">Editar Producto</h1>

					<div class="row">
						<?php
						$query = "SELECT LPAD(PRO.PRO_id, 4, '0') AS PRO_id, PRO.PRO_imagen, PRO.PRO_nombre, PRO.PRO_marca, PRO.PRO_modelo, PRO.PRO_material, PRO.PRO_suela, PRO.PRO_color, PRO.PRO_precio, PRO.PRO_descripcion, PRO.CAT_id, CAT.CAT_nombre FROM productos PRO INNER JOIN categorias CAT ON CAT.CAT_id = PRO.CAT_id WHERE PRO.PRO_id='$id'";
						$results = mysqli_query($open_connection, $query);
						while ($row = mysqli_fetch_array($results)) { ?>
						<div class="col-12 col-md-10 offset-md-1 col-xl-8 offset-xl-2">
							<div class="card">
								<div class="card-header">
									<h5 class="card-title">Actualizar Producto</h5>
									<h6 class="card-subtitle text-muted">Edite los campos necesarios, no deje campos vacíos.</h6>
								</div>
								<div class="card-body">
									<form id="update-product" action="inc/update-product.php" method="POST" enctype="multipart/form-data">
										<div class="form-group">
											<label class="form-label">Nombre del Producto</label>
											<input type="text" name="nombre"class="form-control" placeholder="Calzado de Puro Cuero" value="<?php echo $row['PRO_nombre'] ?>">
										</div>
										<div class="form-row">
											<div class="form-group col-md-4">
												<label class="form-label">Código</label>
												<input type="number" name="id" class="form-control" placeholder="1020" value="<?php echo $row['PRO_id'] ?>" disabled>
												<input type="number" name="id" class="form-control" value="<?php echo $row['PRO_id'] ?>" hidden>
											</div>
											<div class="form-group col-md-4">
												<label class="form-label">Marca</label>
												<select name="marca" class="form-control first-item" required>
													<option value="<?php echo $row['PRO_marca'] ?>"><?php echo $row['PRO_marca'] ?></option>
													<option value="Maribú">Maribú</option>
													<option value="Ikafree">Ikafree</option>
												</select>
											</div>
											<div class="form-group col-md-4">
												<label class="form-label">Categoría</label>
												<select name="categoria" class="form-control first-item" required>
													<option value="<?php echo $row['CAT_id'] ?>"><?php echo $row['CAT_nombre'] ?></option>
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
											<input type="text" name="modelo" class="form-control" placeholder="MD-508" value="<?php echo $row['PRO_modelo'] ?>" required>
                                        </div>
                                        <div class="form-group col-md-4">
											<label class="form-label">Material</label>
											<input type="text" name="material" class="form-control" placeholder="Cuero" value="<?php echo $row['PRO_material'] ?>" required>
                                        </div>
                                        <div class="form-group col-md-4">
											<label class="form-label">Suela</label>
											<input type="text" name="suela" class="form-control" placeholder="PVC Expanso" value="<?php echo $row['PRO_suela'] ?>" required>
										</div>
                                        </div>
                                        <div class="form-row">
                                        <div class="form-group col-md-6">
											<label class="form-label">Color</label>
											<input type="text" name="color" class="form-control" placeholder="Negro" value="<?php echo $row['PRO_color'] ?>" required>
										</div>
                                        <div class="form-group col-md-6">
											<label class="form-label">Precio</label>
											<div class="input-group mb-3">
												<div class="input-group-prepend">
													<span class="input-group-text">S/.</span>
												</div>
												<input type="number" name="precio" class="form-control" placeholder="89.90" value="<?php echo $row['PRO_precio'] ?>" required>
											</div>
										</div>
                                        </div>
										<div class="form-group">
											<label class="form-label">Descripción</label>
											<textarea class="form-control" name="descripcion" placeholder="Escribe una descripción corta para este producto." rows="3"><?php echo $row['PRO_descripcion'] ?></textarea>
										</div>
										<div class="form-row">
											<div class="form-group col-md-3">
												<label class="form-label">Imagen</label>
												<p><img class="img-thumbnail rounded mr-2 mb-2" src="<?php echo $row['PRO_imagen']?> " alt="Placeholder" width="100%" height="100%"></p>
											</div>
											<div class="form-group col-md-9 align-self-center">
												<label class="form-label w-100">Cambiar Imagen</label>
												<input type="file" name="imagen">
												<small class="form-text text-muted">Elija una nueva imagen para este producto.</small>
											</div>
										</div>
										<button type="submit" class="btn btn-primary">Actualizar Producto</button>
										<a href="/" class="btn btn-secondary">Salir</a>
									</form>
								</div>
							</div>
							<div class="mt-3" id="success-update-product"></div>
						</div>
					<?php } ?>
					</div>
				</div>
			</main>
<?php require_once("inc/footer.php"); ?>