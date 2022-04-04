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
	<title>Listado de Procesos - SISPRO</title>

	<?php include "inc/stylesheets.php"; ?>
	
</head>

<body>
    <div class="wrapper">
        <?php require_once("inc/sidebar.php"); ?>

        <div class="main">
            <?php require_once("inc/navbar.php"); ?>

            <main class="content">
                <div class="container-fluid p-0">
                    <h1 class="h3 mb-3">Procesos</h1>
                    <div class="row">
                        <div class="col-12 col-xl-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-actions float-right">
                                        <div class="dropdown show">
                                            <a href="#" data-toggle="dropdown" data-display="static"><i
                                                    class="align-middle" data-feather="more-horizontal"></i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="add-process.php">Añadir proceso</a>
                                            </div>
                                        </div>
                                    </div>
                                    <h5 class="card-title">Detalle de los Procesos</h5>
                                    <h6 class="card-subtitle text-muted">A continuación se muestra el detalle completo
                                        de todos los procesos.</h6>
                                </div>
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>N°</th>
                                            <th>Proceso</th>
                                            <th>Descripción</th>
                                            <th>Precio</th>
                                            <th>Encargado</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
										$query = "SELECT PROC.PROC_id, PROC.PROC_nombre, PROC.PROC_descripcion, PROC.PROC_precio, EMP.EMP_nombres, EMP.EMP_apellidos FROM procesos PROC INNER JOIN empleados EMP ON PROC.EMP_id = EMP.EMP_id WHERE PROC.PROC_estado = 1 ORDER BY PROC_id ASC";
										$results = mysqli_query($open_connection, $query);
										if (mysqli_num_rows($results)>0) {
											while ($row = mysqli_fetch_array($results)) { ?>
                                        <tr>
                                            <td><?php echo $row['PROC_id'] ?></td>
                                            <td><?php echo $row['PROC_nombre'] ?></td>
                                            <td><?php echo $row['PROC_descripcion'] ?></td>
                                            <td><?php echo $row['PROC_precio'] ?></td>
                                            <td><?php echo $row['EMP_nombres'] ?> <?php echo $row['EMP_apellidos'] ?>
                                            </td>
                                            <td class="table-action">
                                                <a href="#"><i class="align-middle mr-1" data-feather="plus"></i></a>
                                                <a class="link-edit" href="edit-process.php?id=<?php echo $row['PROC_id'] ?>"><i class="align-middle mr-1" data-feather="edit-2"></i></a>
                                                <a class="link-delete" id="delete-process" href="#" data-id="<?php echo $row['PROC_id'] ?>"><i class="align-middle" data-feather="trash"></i></a>
                                            </td>
                                        </tr>
                                        <?php }
										} else { ?>
                                        <td class="text-center" colspan="8"><i class="align-middle mr-1"
                                                data-feather="alert-circle"></i> No hay datos suficientes para mostrar.
                                        </td>
                                        <?php
										} ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="mt-3" id="success-delete-process"></div>
                        </div>
                    </div>
                </div>
            </main>
            <!-- MODALES -->
            <!-- BEGIN ADD modal
            <div class="modal fade" id="add-process" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Nuevo proceso</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body m-3">
                            <form id="add-process" action="inc/add-process.php" method="POST">
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label class="form-label">Proceso</label>
                                        <input type="text" name="proceso" class="form-control" placeholder="Corte"
                                            required>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label class="form-label">Precio</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">S/.</span>
                                            </div>
                                            <input type="text" name="precio" class="form-control" placeholder="29.00"
                                                required>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label class="form-label">Responsable</label>
                                        <input type="text" name="responsable" class="form-control"
                                            placeholder="Juan Carlos" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Descripción</label>
                                    <textarea class="form-control" name="descripcion"
                                        placeholder="Escribe una descripción corta para este proceso."
                                        rows="3"></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Añadir proceso</button>
                                <button type="reset" class="btn btn-secondary">Limpiar</button>
                            </form>
                            <div class="mt-3" id="success-add-process"></div>
                        </div>
                    </div>
                </div>
                END  modal -->
            <!-- </div> -->
            <?php require_once("inc/footer.php"); ?>