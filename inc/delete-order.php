<?php

include "open-connection.php";

// Recepcionando datos del fomulario.
$id = $_GET['id'];

// Eliminando datos en la tabla "Órdenes".
$query = "UPDATE ordenes SET ORD_estado = 0 WHERE ORD_id = '$id'";
$results = mysqli_query($open_connection, $query);
if ($results == false) {
    echo '
        <div class="alert alert-danger alert-outline-coloured alert-dismissible" role="alert">
	        <div class="alert-icon">
				<i class="far fa-fw fa-bell"></i>
			</div>
			<div class="alert-message">
				<strong>Alerta!</strong> Error al eliminar orden.
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
                <strong>Alerta!</strong> Orden eliminada correctamente.
            </div>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
    ';
}

include "close-connection.php"; ?>