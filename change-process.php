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
	<title>Continuar Proceso - SISPRO</title>

	<?php include "inc/stylesheets.php"; ?>
	
</head>

<body>
	<div class="wrapper">
		<?php require_once("inc/sidebar.php"); ?>

		<div class="main">
			<?php require_once("inc/navbar.php"); ?>

			<main class="content">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3 text-center">Continuar Proceso</h1>

					<div class="row">
						<div class="col-12 col-md-10 offset-md-1 col-xl-8 offset-xl-2">
							<div class="card">
								<div class="card-header">
									<h5 class="card-title">Continuar Proceso</h5>
									<h6 class="card-subtitle text-muted">Edite los campos necesarios, no deje campos vacíos.</h6>
								</div>
								<div class="card-body">
									<form name="f" id="change-process" action="inc/change-process.php" method="POST">
                                        <div class="form-row">
                                            <div class="form-group col-md-2">
                                                <label class="form-label">N° de Orden</label>
                                                <?php
                                                $query = "SELECT LPAD(ORD_id, 4, '0') AS ORD_id FROM ordenes WHERE ORD_id = $id";
                                                $results = mysqli_query($open_connection, $query);
                                                while ($row = mysqli_fetch_array($results)) { ?>
                                                <input type="number" name="id" class="form-control" placeholder="0009" value="<?php echo $row['ORD_id'] ?>" disabled>
                                                <input type="number" name="id" class="form-control" placeholder="0009" value="<?php echo $row['ORD_id'] ?>" hidden>
                                                <?php } ?>
                                            </div>
                                            <div class="form-group col-md-5">
                                                <label class="form-label">Proceso</label>
                                                <select name="proceso" class="form-control first-item" required>
                                                    <?php
                                                    $query = "SELECT HPC.PC_id, PC.PC_nombre, EMP.EMP_nombres, EMP.EMP_apellidos FROM historial_procesos HPC INNER JOIN procesos PC ON PC.PC_id = HPC.PC_id INNER JOIN empleados EMP ON EMP.EMP_id = HPC.EMP_id WHERE HPC.ORD_id = $id ORDER BY PC.PC_id DESC LIMIT 1";
                                                    $results = mysqli_query($open_connection, $query);
                                                    while ($row = mysqli_fetch_array($results)) { ?>
                                                        <option value="<?php echo $row['PC_id'] ?>"><?php echo $row['PC_nombre'] ?></option>
                                                    <?php } ?>
                                                    <?php
                                                    $query = "SELECT PC_id, PC_nombre FROM procesos";
                                                    $results = mysqli_query($open_connection, $query);
                                                    while ($row = mysqli_fetch_array($results)) { ?>
                                                        <option value="<?php echo $row['PC_id'] ?>"><?php echo $row['PC_nombre'] ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-5">
                                                <label class="form-label">Encargado</label>
                                                <select name="encargado" class="form-control first-item" required>
                                                <?php
                                                $query = "SELECT HPC.PC_id, PC.PC_nombre, EMP.EMP_id, EMP.EMP_nombres, EMP.EMP_apellidos FROM historial_procesos HPC INNER JOIN procesos PC ON PC.PC_id = HPC.PC_id INNER JOIN empleados EMP ON EMP.EMP_id = HPC.EMP_id WHERE HPC.ORD_id = $id ORDER BY PC.PC_id DESC LIMIT 1";
                                                $results = mysqli_query($open_connection, $query);
                                                while ($row = mysqli_fetch_array($results)) { ?>
                                                    <option value="<?php echo $row['EMP_id'] ?>"><?php echo $row['EMP_nombres'] . ' ' . $row['EMP_apellidos'] ?></option>
                                                <?php } ?>
                                                <?php
                                                $query = "SELECT EMP_id, EMP_nombres, EMP_apellidos FROM empleados";
                                                $results = mysqli_query($open_connection, $query);
                                                while ($row = mysqli_fetch_array($results)) { ?>
                                                    <option value="<?php echo $row['EMP_id'] ?>"><?php echo $row['EMP_nombres'] . ' ' . $row['EMP_apellidos'] ?></option>
                                                <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-row text-center">
                                        <?php
                                        $query = "SELECT
                                        SER.SER_id,
                                        SER.SER_talla34,
                                        SER.SER_talla35,
                                        SER.SER_talla36,
                                        SER.SER_talla37,
                                        SER.SER_talla38,
                                        SER.SER_talla39,
                                        SER.SER_talla40
                                    FROM
                                        ordenes ORD
                                    INNER JOIN ordenes_detalles ODET ON
                                        ORD.ORD_id = ODET.ORD_id
                                    INNER JOIN series SER ON
                                        SER.SER_id = ODET.SER_id
                                    WHERE
                                        ORD.ORD_id = $id";
                                        $results = mysqli_query($open_connection, $query);
                                        while ($row = mysqli_fetch_array($results)) { ?>
                                                <div style="width:14.28%" class="form-group col-md-auto">
                                                    <label class="form-label">34</label>
                                                    <input type="text" name="" min="0" placeholder="0" class="form-control text-center" value="<?php echo $row['SER_talla34'] ?>" disabled>
                                                    <input type="text" name="talla34" min="0" placeholder="0" class="form-control text-center" value="<?php echo $row['SER_talla34'] ?>" onchange="cal()" onkeyup="cal()" hidden>
                                                </div>
                                                <div style="width:14.28%" class="form-group col-md-auto">
                                                    <label class="form-label">35</label>
                                                    <input type="text" name="" min="0" placeholder="0" class="form-control text-center" value="<?php echo $row['SER_talla35'] ?>" disabled>
                                                    <input type="text" name="talla35" min="0" placeholder="0" class="form-control text-center" value="<?php echo $row['SER_talla35'] ?>" onchange="cal()" onkeyup="cal()" hidden>
                                                </div>
                                                <div style="width:14.28%" class="form-group col-md-auto">
                                                    <label class="form-label">36</label>
                                                    <input type="text" name="" min="0" placeholder="0" class="form-control text-center" value="<?php echo $row['SER_talla36'] ?>" disabled>
                                                    <input type="text" name="talla36" min="0" placeholder="0" class="form-control text-center" value="<?php echo $row['SER_talla36'] ?>" onchange="cal()" onkeyup="cal()" hidden>
                                                </div>
                                                <div style="width:14.28%" class="form-group col-md-auto">
                                                    <label class="form-label">37</label>
                                                    <input type="text" name="" min="0" placeholder="0" class="form-control text-center" value="<?php echo $row['SER_talla37'] ?>" disabled>
                                                    <input type="text" name="talla37" min="0" placeholder="0" class="form-control text-center" value="<?php echo $row['SER_talla37'] ?>" onchange="cal()" onkeyup="cal()" hidden>
                                                </div>
                                                <div style="width:14.28%" class="form-group col-md-auto">
                                                    <label class="form-label">38</label>
                                                    <input type="text" name="" min="0" placeholder="0" class="form-control text-center" value="<?php echo $row['SER_talla38'] ?>" disabled>
                                                    <input type="text" name="talla38" min="0" placeholder="0" class="form-control text-center" value="<?php echo $row['SER_talla38'] ?>" onchange="cal()" onkeyup="cal()" hidden>
                                                </div>
                                                <div style="width:14.28%" class="form-group col-md-auto">
                                                    <label class="form-label">39</label>
                                                    <input type="text" name="" min="0" placeholder="0" class="form-control text-center" value="<?php echo $row['SER_talla39'] ?>" disabled>
                                                    <input type="text" name="talla39" min="0" placeholder="0" class="form-control text-center" value="<?php echo $row['SER_talla39'] ?>" onchange="cal()" onkeyup="cal()" hidden>
                                                </div>
                                                <div style="width:14.28%" class="form-group col-md-auto">
                                                    <label class="form-label">40</label>
                                                    <input type="text" name="" min="0" placeholder="0" class="form-control text-center" value="<?php echo $row['SER_talla40'] ?>" disabled>
                                                    <input type="text" name="talla40" min="0" placeholder="0" class="form-control text-center" value="<?php echo $row['SER_talla40'] ?>" onchange="cal()" onkeyup="cal()" hidden>
                                                </div>
                                            <?php } ?>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label class="form-label">Precio Unitario</label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">S/.</span>
                                                    </div>
                                                    <?php
                                                    $query = "SELECT HPC_precio FROM historial_procesos HPC INNER JOIN procesos PC ON PC.PC_id = HPC.PC_id WHERE ORD_id = $id ORDER BY PC.PC_id DESC LIMIT 1";
                                                    $results = mysqli_query($open_connection, $query);
                                                    if (mysqli_num_rows($results) == NULL) { ?>
                                                        <input type="number" step="0.01" name="preciou" min="0" class="form-control" value="0.00" onchange="cal()" onkeyup="cal()" required>
                                                    <?php }
                                                    while ($row = mysqli_fetch_array($results)) { ?>
                                                        <input type="number" step="0.01" name="preciou" min="0" class="form-control" value="<?php echo $row['HPC_precio'] ?>" onchange="cal()" onkeyup="cal()" required>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="form-label">Precio Total</label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">S/.</span>
                                                    </div>
                                                    <?php
                                                    $query = "SELECT HPC_ptotal FROM historial_procesos HPC INNER JOIN procesos PC ON PC.PC_id = HPC.PC_id WHERE ORD_id = $id ORDER BY PC.PC_id DESC LIMIT 1";
                                                    $results = mysqli_query($open_connection, $query);
                                                    if (mysqli_num_rows($results) == NULL) { ?>
                                                        <input type="number" name="preciotd" class="form-control" value="0.00" disabled>
                                                        <input type="number" name="preciot" class="form-control" value="0.00" hidden>
                                                    <?php }
                                                    while ($row = mysqli_fetch_array($results)) { ?>
                                                        <input type="number" name="preciotd" class="form-control" value="<?php echo $row['HPC_ptotal'] ?>" disabled>
                                                        <input type="number" name="preciot" class="form-control" value="<?php echo $row['HPC_ptotal'] ?>" hidden>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                        $query = "SELECT HPC.PC_id FROM historial_procesos HPC INNER JOIN procesos PC ON PC.PC_id = HPC.PC_id WHERE ORD_id = $id";
                                        $results = mysqli_query($open_connection, $query);
                                        $pc_id = 0;
                                        while ($row = mysqli_fetch_array($results)) {
                                            $pc_id = $row['PC_id'];
                                        }
                                        if (mysqli_num_rows($results) == 0 || mysqli_num_rows($results) > 0 && $pc_id != 4) { ?>
                                            <button type="submit" class="btn btn-primary">Actualizar Proceso</button>
                                        <?php }
                                        elseif ($pc_id == 4) { ?>
                                            <button type="submit" class="btn btn-primary" disabled>Actualizar Proceso</button>
                                        <?php } ?>
									</form>
								</div>
							</div>
                            <?php
                            $query = "SELECT HPC.PC_id FROM historial_procesos HPC INNER JOIN procesos PC ON PC.PC_id = HPC.PC_id WHERE ORD_id = $id";
                            $results = mysqli_query($open_connection, $query);
                            while ($row = mysqli_fetch_array($results)) {
                            if ($row['PC_id'] == 4) { ?>
                                <div class="alert alert-warning alert-outline-coloured alert-dismissible" role="alert">
                                    <div class="alert-icon">
                                        <i class="far fa-fw fa-bell"></i>
                                    </div>
                                    <div class="alert-message">
                                        <strong>Alerta!</strong> Esta orden ya alcanzó el último proceso.
                                    </div>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                </div>
                            <?php } } ?>
							<div class="mt-3" id="success-change-process"></div>
                        </div>
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
    document.f.preciotd.value = (a + b + c + d + e + f + g) * h;
    document.f.preciot.value = (a + b + c + d + e + f + g) * h;
  } catch (e) {
  }
}
</script>
<?php require_once("inc/footer.php"); ?>