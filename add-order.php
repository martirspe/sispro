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
	<title>Añadir Orden - SISPRO</title>

	<?php include "inc/stylesheets.php"; ?>
	
</head>

<body>
	<div class="wrapper">
		<?php require_once("inc/sidebar.php"); ?>

		<div class="main">
			<?php require_once("inc/navbar.php"); ?>

			<main class="content">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3 text-center">Añadir Orden</h1>

					<div class="row">
                        <?php
                        $query = "SELECT PRO_id FROM productos";
                        $results = mysqli_query($open_connection, $query);
                        if (mysqli_num_rows($results)>0) { ?>
                            <div class="col-12 col-md-10 offset-md-1 col-xl-8 offset-xl-2">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title">Nueva Orden</h5>
                                        <h6 class="card-subtitle text-muted">Ingrese datos en todos los campos a continuación.</h6>
                                    </div>
                                    <div class="card-body">
                                        <form name="f" id="add-order" action="inc/add-order.php" method="POST">
                                            <div class="form-row">
                                                <div class="form-group col-md-2">
                                                    <label class="form-label">N° de Orden</label>
                                                    <?php
                                                    $query = "SELECT ORD_id FROM ordenes";
                                                    $results = mysqli_query($open_connection,$query);
                                                    if (mysqli_num_rows($results) == 0) { ?>
                                                        <input type="number" name="id" class="form-control" value="0001" disabled>
                                                        <input type="number" name="id" class="form-control" value="0001" hidden>
                                                    <?php
                                                    } else {
                                                        $query = "SELECT LPAD(CONCAT(ORD_id+1), 4, '0') AS ORD_id FROM ordenes_detalles ORDER BY ORD_id DESC LIMIT 1";
                                                        $results = mysqli_query($open_connection,$query);
                                                        if (mysqli_num_rows($results) >  0) {
                                                            while ($row = mysqli_fetch_array($results)) { ?>
                                                            <input type="number" name="id" class="form-control" value="<?php echo $row['ORD_id'] ?>" disabled>
                                                            <input type="number" name="id" class="form-control" value="<?php echo $row['ORD_id'] ?>" hidden>
                                                            <?php
                                                            }
                                                        }
                                                    }                                             
                                                ?>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label class="form-label">Usuario</label>
                                                    <?php
                                                    if ($_SESSION['USU_tipo'] == 1) { ?>
                                                        <select name="usuario" class="form-control first-item" required>
                                                        <option value="">Elije un usuario</option>
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
                                                        <option value="">Elije un cliente</option>
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
                                                        <option value="">Elije una referencia</option>
                                                        <option value="Página Web">Página Web</option>
                                                        <option value="Facebook">Facebook</option>
                                                        <option value="Instagram">Instagram</option>
                                                        <option value="WhatsApp">WhatsApp</option>
                                                        <option value="Linio">Linio</option>
                                                        <option value="Mercado Libre">Mercado Libre</option>
                                                        <option value="Juntoz">Juntoz</option>
                                                        <option value="Otros">Otros</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-4">
                                                    <label class="form-label">Marca</label>
                                                    <select name="marca" class="form-control first-item" required>
                                                        <option value="">Elije una marca</option>
                                                        <option value="Maribú">Maribú</option>
                                                        <option value="Ikafree">Ikafree</option>
												    </select>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label class="form-label">Categoría</label>
                                                    <select name="categoria" class="form-control first-item" required>
                                                        <option value="">Elije una categoría</option>
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
                                                        <option value="">Elije un modelo</option>
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
                                                    <input type="text" name="material" class="form-control" placeholder="Cuero" required>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label class="form-label">Suela</label>
                                                    <input type="text" name="suela" class="form-control" placeholder="PVC Expanso" required>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label class="form-label">Color</label>
                                                    <input type="text" name="color" class="form-control" placeholder="Negro" required>
                                                </div>
                                            </div>
                                            <div class="form-row text-center">
                                                <div style="width:14.28%" class="form-group col-md-auto">
                                                    <label class="form-label">34</label>
                                                    <input type="number" name="talla34" placeholder="0" class="form-control text-center" min ="0" value="0">
                                                </div>
                                                <div style="width:14.28%" class="form-group col-md-auto">
                                                    <label class="form-label">35</label>
                                                    <input type="number" name="talla35" placeholder="0" class="form-control text-center" min ="0" value="0">
                                                </div>
                                                <div style="width:14.28%" class="form-group col-md-auto">
                                                    <label class="form-label">36</label>
                                                    <input type="number" name="talla36" placeholder="0" class="form-control text-center" min ="0" value="0">
                                                </div>
                                                <div style="width:14.28%" class="form-group col-md-auto">
                                                    <label class="form-label">37</label>
                                                    <input type="number" name="talla37" placeholder="0" class="form-control text-center" min ="0" value="0">
                                                </div>
                                                <div style="width:14.28%" class="form-group col-md-auto">
                                                    <label class="form-label">38</label>
                                                    <input type="number" name="talla38" placeholder="0" class="form-control text-center" min ="0" value="0">
                                                </div>
                                                <div style="width:14.28%" class="form-group col-md-auto">
                                                    <label class="form-label">39</label>
                                                    <input type="number" name="talla39" placeholder="0" class="form-control text-center" min ="0" value="0">
                                                </div>
                                                <div style="width:14.28%" class="form-group col-md-auto">
                                                    <label class="form-label">40</label>
                                                    <input type="number" name="talla40" placeholder="0" class="form-control text-center" min ="0" value="0">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label">Observación</label>
                                                <textarea class="form-control" name="observacion" placeholder="Escribe una observación corta para esta orden." rows="3"></textarea>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-3">
                                                    <label class="form-label">Fecha de entrega</label>
                                                    <input type="date" name="fechaEntrega" class="form-control" required>
                                                    <!-- <input type="text" name="fechaEntrega" class="form-control" data-mask="00/00/0000 00:00:00" placeholder="09/09/2019 15:30:00" required>
                                                    <span class="font-13 text-muted">ejem. "DD/MM/AAAA HH:MM:SS"</span> -->
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label class="form-label">Estado del Pago</label>
                                                    <select name="paymentstatus" class="form-control first-item" required>
                                                        <option value="">Elije una opción</option>
                                                        <option value="Depositado">Depositado</option>
                                                        <option value="Contra entrega">Contra entrega</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Añadir Orden</button>
                                            <button type="reset" class="btn btn-secondary">Limpiar</button>
                                        </form>
                                    </div>
                                </div>
                                <div class="mt-3" id="success-add-order"></div>
                            </div>
                        <?php 
                        } else { ?>
                            <div class="col-md-8 offset-md-2">
								<div class="alert alert-primary alert-outline-coloured alert-dismissible" role="alert">
								<div class="alert-icon">
									<i data-feather="alert-circle"></i>
								</div>
								<div class="alert-message">
                                    Es necesario agregar productos al inventario para generar órdenes.
								</div>
							</div>
                        <?php 
                        }?>
					</div>
				</div>
			</main>
<?php require_once("inc/footer.php"); ?>