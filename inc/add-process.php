<?php

include "open-connection.php";

// Recepcionando datos del fomulario.
$proceso = $_POST['proceso'];
$descripcion = $_POST['descripcion'];
$encargado = $_POST['encargado'];
$precio = $_POST['precio'];

if (empty($_POST['proceso']) || empty($_POST['encargado']) || empty($_POST['precio'])) {
    echo '
    <div class="alert alert-warning alert-outline-coloured alert-dismissible" role="alert">
        <div class="alert-icon">
            <i class="far fa-fw fa-bell"></i>
        </div>
        <div class="alert-message">
            <strong>Alerta!</strong> Faltan completar algunos campos.
        </div>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    </div>
    ';
} else {
    // Verificando que el Proceso ingresado en el formulario no este registrado.
    $query = "SELECT PROC_nombre FROM procesos WHERE PROC_nombre = '$proceso'";
    $results = mysqli_query($open_connection, $query);

    if (mysqli_num_rows($results)>0) {
        echo '
            <div class="alert alert-warning alert-outline-coloured alert-dismissible" role="alert">
                <div class="alert-icon">
                    <i class="far fa-fw fa-bell"></i>
                </div>
                <div class="alert-message">
                    <strong>Alerta!</strong> Ya existe un proceso con el mismo nombre.
                </div>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
        ';
    } else {
        $query = "INSERT INTO procesos (PROC_nombre, PROC_descripcion, PROC_precio, EMP_id) VALUES ('$proceso','$descripcion','$precio','$encargado')";
        $results = mysqli_query($open_connection, $query);
        
        if ($results == false) {
            echo '
                <div class="alert alert-danger alert-outline-coloured alert-dismissible" role="alert">
                    <div class="alert-icon">
                        <i class="far fa-fw fa-bell"></i>
                    </div>
                    <div class="alert-message">
                        <strong>Alerta!</strong> Error al guardar proceso.
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
                        <strong>Alerta!</strong> Proceso guardado correctamente.
                    </div>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
            ';
        }
    }
}

include "close-connection.php"; ?>