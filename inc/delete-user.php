<?php

include "open-connection.php";

// Recepcionando datos del fomulario.
$id = $_GET['id'];

if ($_GET['id'] = 1) {
    echo '
        <div class="alert alert-warning alert-outline-coloured alert-dismissible" role="alert">
            <div class="alert-icon">
                <i class="far fa-fw fa-bell"></i>
            </div>
            <div class="alert-message">
                <strong>Alerta!</strong> No puedes eliminar a un administrador.
            </div>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
    ';
} else {
    // Buscando el usuario en la base de datos para eliminar.
    $query = "UPDATE usuarios SET USU_estado = 0 WHERE USU_id = '$id'";
    $results = mysqli_query($open_connection, $query);

    if ($results == false) {
        echo '
            <div class="alert alert-danger alert-outline-coloured alert-dismissible" role="alert">
                <div class="alert-icon">
                    <i class="far fa-fw fa-bell"></i>
                </div>
                <div class="alert-message">
                    <strong>Alerta!</strong> Error al eliminar usuario.
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
                    <strong>Alerta!</strong> Usuario eliminado correctamente.
                </div>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
        ';
    }
}


include "close-connection.php";