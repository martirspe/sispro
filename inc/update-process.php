<?php

include "open-connection.php";

// Recepcionando datos del fomulario.
$id = $_POST['id'];
$proceso = $_POST['proceso'];
$descripcion = $_POST['descripcion'];
$responsable = $_POST['responsable'];
$precio = $_POST['precio'];

// Insertando datos a la tabla "Procesos".
$query = "UPDATE procesos SET PROC_nombre='$proceso', PROC_descripcion='$descripcion', PROC_precio='$precio', EMP_id='$responsable' WHERE PROC_id = '$id'";
$results = mysqli_query($open_connection, $query);
    
if ($results == false) {
    echo '
        <div class="alert alert-danger alert-outline-coloured alert-dismissible" role="alert">
            <div class="alert-icon">
                <i class="far fa-fw fa-bell"></i>
            </div>
            <div class="alert-message">
                <strong>Alerta!</strong> Error al actualizar cliente.
            </div>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
    ';
} else {
    if (mysqli_affected_rows($open_connection) == 0) {
        echo '
            <div class="alert alert-warning alert-outline-coloured alert-dismissible" role="alert">
                <div class="alert-icon">
                    <i class="far fa-fw fa-bell"></i>
                </div>
                <div class="alert-message">
                    <strong>Alerta!</strong> No has hecho cambios para este cliente.
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
                    <strong>Alerta!</strong> Cliente actualizado correctamente.
                </div>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
        ';
    }
}

include "close-connection.php"; ?>