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
	<title>Actualizar Orden - SISPRO</title>

	<?php include "inc/stylesheets.php"; ?>
	
</head>

<body>
	<div class="wrapper">
		<?php require_once("inc/sidebar.php"); ?>

		<div class="main">
			<?php require_once("inc/navbar.php"); ?>

			<main class="content">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3 text-center">Editar Orden</h1>

					<div class="row">
                        <?php
						$query = "SELECT
                        LPAD(ORD.ORD_id, 4, '0') AS ORD_id,
                        USU.USU_id,
                        USU.USU_nombres,
                        USU.USU_apellidos,
                        CLI.CLI_id,
                        CLI.CLI_nombres,
                        CLI.CLI_apellidos,
                        PRO.PRO_id,
                        PRO.PRO_imagen,
                        PRO.PRO_nombre,
                        PRO.PRO_modelo,
                        PRO.PRO_marca,
                        CAT.CAT_id,
                        CAT.CAT_nombre,
                        SER.SER_talla34,
                        SER.SER_talla35,
                        SER.SER_talla36,
                        SER.SER_talla37,
                        SER.SER_talla38,
                        SER.SER_talla39,
                        SER.SER_talla40,
                        ODET.ODET_material,
                        ODET.ODET_suela,
                        ODET.ODET_color,
                        ODET.ODET_observacion,
                        ODET.ODET_referencia,
                        ODET.ODET_pago,
                        ODET.ODET_fecha,
                        ODET.ODET_fechaEntrega
                    FROM
                        ordenes ORD
                    INNER JOIN ordenes_detalles ODET ON
                        ORD.ORD_id = ODET.ORD_id
                    INNER JOIN usuarios USU ON
                        USU.USU_id = ORD.USU_id
                    INNER JOIN productos PRO ON
                        ODET.PRO_id = PRO.PRO_id
                    INNER JOIN categorias CAT ON
                        CAT.CAT_id = PRO.CAT_id
                    INNER JOIN clientes CLI ON
                        CLI.CLI_id = ORD.CLI_id
                    INNER JOIN series SER ON
                        SER.SER_id = ODET.SER_id
                    WHERE
                        ORD.ORD_id = $id";
						$results = mysqli_query($open_connection, $query);
						while ($row = mysqli_fetch_array($results)) { ?>
						<div class="col-12 col-md-10 offset-md-1 col-xl-8 offset-xl-2">
							<div class="card">
								<div class="card-header">
									<h5 class="card-title">Actualizar Orden</h5>
									<h6 class="card-subtitle text-muted">Edite los campos necesarios, no deje campos vacíos.</h6>
								</div>
								<div class="card-body">
									<form name="f" id="update-order" action="inc/update-order.php" method="POST">
                                        <div class="form-row">
                                            <div class="form-group col-md-2">
                                                <label class="form-label">N° de Orden</label>
                                                <input type="number" name="id" class="form-control" placeholder="0009" value="<?php echo $row['ORD_id'] ?>" disabled>
                                                <input type="number" name="id" class="form-control" placeholder="0009" value="<?php echo $row['ORD_id'] ?>" hidden>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label class="form-label">Usuario</label>
                                                <?php
                                                    if ($_SESSION['USU_tipo'] == 1) { ?>
                                                        <select name="usuario" class="form-control first-item" required>
                                                        <option value="<?php echo $row['USU_id'] ?>"><?php echo $row['USU_nombres'] ?> <?php echo $row['USU_apellidos'] ?></option>
                                                        <?php
                                                        $query = "SELECT USU_id, USU_nombres, USU_apellidos FROM usuarios";
                                                        $results = mysqli_query($open_connection,$query);
                                                        while ($row_u = mysqli_fetch_array($results)) { ?>
                                                        <option value="<?php echo $row_u['USU_id'] ?>"><?php echo $row_u['USU_nombres'] ?> <?php echo $row_u['USU_apellidos'] ?></option>
                                                        <?php } ?>
                                                    </select>
                                                    <?php
                                                    } else { ?>
                                                        <input type="text" name="" class="form-control" value="<?php echo $_SESSION['USU_nombres'] ?> <?php echo $_SESSION['USU_apellidos'] ?>" disabled>
                                                        <input type="text" name="usuario" class="form-control" value="<?php echo $_SESSION['USU_id'] ?>" hidden>
                                                    <?php
                                                    } ?>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label class="form-label">Cliente</label>
                                                <select name="cliente" class="form-control first-item" required>
                                                    <option value="<?php echo $row['CLI_id'] ?>"><?php echo $row['CLI_nombres'] ?> <?php echo $row['CLI_apellidos'] ?></option>
                                                    <?php
                                                    $query = "SELECT CLI_id, CLI_nombres, CLI_apellidos FROM clientes";
                                                    $results = mysqli_query($open_connection,$query);
                                                    while ($row_c = mysqli_fetch_array($results)) { ?>
                                                    <option value="<?php echo $row_c['CLI_id'] ?>"><?php echo $row_c['CLI_nombres'] ?> <?php echo $row_c['CLI_apellidos'] ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label class="form-label">Referencia</label>
                                                <select name="referencia" class="form-control first-item" required>
                                                    <option value="<?php echo $row['ODET_referencia'] ?>"><?php echo $row['ODET_referencia'] ?></option>
                                                    <option value="Facebook">Facebook</option>
                                                    <option value="Linio">Linio</option>
                                                    <option value="Mercado Libre">Mercado Libre</option>
                                                    <option value="Juntoz">Juntoz</option>
                                                    <option value="Instagram">Instagram</option>
                                                    <option value="Otros">Otros</option>
                                                </select>
                                            </div>
                                        </div>
										<div class="form-row">
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
                                                    while ($row_ct = mysqli_fetch_array($results)) { ?>
                                                    <option value="<?php echo $row_ct['CAT_id'] ?>"><?php echo $row_ct['CAT_nombre'] ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label class="form-label">Modelo</label>
                                                <select name="modelo" class="form-control first-item" required>
                                                    <option value="<?php echo $row['PRO_id'] ?>"><?php echo $row['PRO_modelo'] ?></option>
                                                    <?php
                                                    $query = "SELECT PRO_id, PRO_modelo FROM productos";
                                                    $results = mysqli_query($open_connection,$query);
                                                    while ($row_p = mysqli_fetch_array($results)) { ?>
                                                    <option value="<?php echo $row_p['PRO_id'] ?>"><?php echo $row_p['PRO_modelo'] ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-4">
                                                <label class="form-label">Material</label>
                                                <input type="text" name="material" class="form-control" placeholder="Cuero" value="<?php echo $row['ODET_material'] ?>" required>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label class="form-label">Suela</label>
                                                <input type="text" name="suela" class="form-control" placeholder="PVC Expanso" value="<?php echo $row['ODET_suela'] ?>" required>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label class="form-label">Color</label>
                                                <input type="text" name="color" class="form-control" placeholder="Negro" value="<?php echo $row['ODET_color'] ?>" required>
                                            </div>
                                        </div>
                                        <div class="form-row text-center">
                                                <div style="width:14.28%" class="form-group col-md-auto">
                                                    <label class="form-label">34</label>
                                                    <input type="text" name="talla34" placeholder="0" class="form-control text-center" min ="0" value="<?php echo $row['SER_talla34'] ?>" onchange="cal()" onkeyup="cal()">
                                                </div>
                                                <div style="width:14.28%" class="form-group col-md-auto">
                                                    <label class="form-label">35</label>
                                                    <input type="text" name="talla35" placeholder="0" class="form-control text-center" min ="0" value="<?php echo $row['SER_talla35'] ?>" onchange="cal()" onkeyup="cal()">
                                                </div>
                                                <div style="width:14.28%" class="form-group col-md-auto">
                                                    <label class="form-label">36</label>
                                                    <input type="text" name="talla36" placeholder="0" class="form-control text-center" min ="0" value="<?php echo $row['SER_talla36'] ?>" onchange="cal()" onkeyup="cal()">
                                                </div>
                                                <div style="width:14.28%" class="form-group col-md-auto">
                                                    <label class="form-label">37</label>
                                                    <input type="text" name="talla37" placeholder="0" class="form-control text-center" min ="0" value="<?php echo $row['SER_talla37'] ?>" onchange="cal()" onkeyup="cal()">
                                                </div>
                                                <div style="width:14.28%" class="form-group col-md-auto">
                                                    <label class="form-label">38</label>
                                                    <input type="text" name="talla38" placeholder="0" class="form-control text-center" min ="0" value="<?php echo $row['SER_talla38'] ?>" onchange="cal()" onkeyup="cal()">
                                                </div>
                                                <div style="width:14.28%" class="form-group col-md-auto">
                                                    <label class="form-label">39</label>
                                                    <input type="text" name="talla39" placeholder="0" class="form-control text-center" min ="0" value="<?php echo $row['SER_talla39'] ?>" onchange="cal()" onkeyup="cal()">
                                                </div>
                                                <div style="width:14.28%" class="form-group col-md-auto">
                                                    <label class="form-label">40</label>
                                                    <input type="text" name="talla40" placeholder="0" class="form-control text-center" min ="0" value="<?php echo $row['SER_talla40'] ?>" onchange="cal()" onkeyup="cal()">
                                                </div>
                                        </div>
										<div class="form-group">
											<label class="form-label">Observación</label>
											<textarea class="form-control" name="observacion" placeholder="Escribe una observación corta para esta orden." rows="3"><?php echo $row['ODET_observacion'] ?></textarea>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-4">
                                                <label class="form-label">Fecha de entrega</label>
                                                <input type="date" name="fechaEntrega" class="form-control" value="<?php echo $row['ODET_fechaEntrega'] ?>" required>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label class="form-label">Estado del Pago</label>
                                                <select name="paymentstatus" class="form-control first-item" required>
                                                    <option value="<?php echo $row['ODET_pago'] ?>"><?php echo $row['ODET_pago'] ?></option>
                                                    <option value="Depositado">Depositado</option>
                                                    <option value="Contra entrega">Contra entrega</option>
                                                </select>
                                            </div>
                                        </div>
										<button type="submit" class="btn btn-primary">Actualizar Orden</button>
										<a href="/" class="btn btn-secondary">Salir</a>
									</form>
								</div>
							</div>
							<div class="mt-3" id="success-update-order"></div>
                        </div>
                        <?php } ?>
					</div>
				</div>
			</main>
<!-- Operaciones matemáticas -->
<script>
function cal() {
  try {
    var a = parseInt(document.f.talla34.value),
        b = parseInt(document.f.talla35.value),
        c = parseInt(document.f.talla36.value),
        d = parseInt(document.f.talla37.value),
        e = parseInt(document.f.talla38.value),
        f = parseInt(document.f.talla39.value),
        g = parseInt(document.f.talla40.value),
        h = parseFloat(document.f.preciou.value);
    document.f.preciot.value = (a + b + c + d + e + f + g) * h;
  } catch (e) {
  }
}
</script>
<?php require_once("inc/footer.php"); ?>