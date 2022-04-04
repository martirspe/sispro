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
	<title>Añadir Proceso - SISPRO</title>

	<?php include "inc/stylesheets.php"; ?>
	
</head>

<body>
    <div class="wrapper">
        <?php require_once("inc/sidebar.php"); ?>

        <div class="main">
            <?php require_once("inc/navbar.php"); ?>

            <main class="content">
                <div class="container-fluid p-0">

                    <h1 class="h3 mb-3 text-center">Añadir Proceso</h1>

                    <div class="row">
                        <div class="col-12 col-md-10 offset-md-1 col-xl-8 offset-xl-2">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">Nuevo Proceso</h5>
                                    <h6 class="card-subtitle text-muted">Ingrese datos en todos los campos a
                                        continuación.</h6>
                                </div>
                                <div class="card-body">
                                    <form id="add-process" action="inc/add-process.php" method="POST">
                                        <div class="form-row">
                                            <div class="form-group col-md-4">
                                                <label class="form-label">Proceso</label>
                                                <input type="text" name="proceso" class="form-control"
                                                    placeholder="Corte" required>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label class="form-label">Precio</label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">S/.</span>
                                                    </div>
                                                    <input type="text" name="precio" class="form-control"
                                                        placeholder="29.00" required>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label class="form-label">Encargado</label>
                                                <select name="encargado" class="form-control first-item" required>
                                                    <option value="">Elige un encargado</option>
                                                    <?php
                                                        $query = "SELECT EMP_id, EMP_nombres, EMP_apellidos FROM empleados";
                                                        $results = mysqli_query($open_connection,$query);
                                                        while ($row = mysqli_fetch_array($results)) { ?>
                                                        <option value="<?php echo $row['EMP_id'] ?>"><?php echo $row['EMP_nombres'] ?> <?php echo $row['EMP_apellidos'] ?></option>
                                                    <?php } ?>
                                                </select>
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
                                </div>
                            </div>
                            <div class="mt-3" id="success-add-process"></div>
                        </div>
                    </div>
                </div>
            </main>
            <?php require_once("inc/footer.php"); ?>