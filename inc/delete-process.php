<?php

include "open-connection.php";

// Recepcionando datos del fomulario.
$id = $_GET['id'];

// Buscando el producto en la base de datos para eliminar.
$query = "UPDATE procesos SET PROC_estado = 0 WHERE PROC_id = '$id'";
$results = mysqli_query($open_connection, $query);

if ($results == false) {
    echo '
        <div class="alert alert-danger alert-outline-coloured alert-dismissible" role="alert">
	        <div class="alert-icon">
				<i class="far fa-fw fa-bell"></i>
			</div>
			<div class="alert-message">
				<strong>Alerta!</strong> Error al eliminar proceso.
			</div>
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		</div>
    ';
} else {
    echo '
        <div class="alert alert-success alert-outline-coloured alert-dismissible" role="alert">
            <div class="alert-icon">
                <i class="far fa-fw fa-bell"></i>
            </div>
            <div class="alert-message">
                <strong>Alerta!</strong> Proceso eliminado correctamente.
            </div>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
    ';
}

include "close-connection.php"; ?>