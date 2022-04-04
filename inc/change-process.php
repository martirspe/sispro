<?php

include "open-connection.php";

// Inicializando Zona Horaria.
ini_set('date.timezone', 'America/Bogota');

// Recepcionando datos del fomulario.
$id = $_POST['id'];
$proceso = $_POST['proceso'];
$encargado = $_POST['encargado'];
$preciou = $_POST['preciou'];
$preciot = $_POST['preciot'];

// Verificando procesos duplicados en la tabla "Historial de Procesos".
$query_verify = "SELECT HPC.PC_id, PC_nombre FROM historial_procesos HPC INNER JOIN procesos PC ON PC.PC_id = HPC.PC_id WHERE HPC.ORD_id = $id";
$results = mysqli_query($open_connection, $query_verify);
$verify_p = 0;
while ($row = mysqli_fetch_array($results)) {
    $verify_p = $row['PC_id'];
}

if ($proceso == $verify_p) {
    echo '
        <div class="alert alert-danger alert-outline-coloured alert-dismissible" role="alert">
            <div class="alert-icon">
                <i class="far fa-fw fa-bell"></i>
            </div>
            <div class="alert-message">
                <strong>Alerta!</strong> La orden ya pasó por este proceso.
            </div>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
    ';
} else {
    // Insertando datos a la tabla "Historial de Procesos".
    $query = "INSERT INTO historial_procesos(PC_id, HPC_precio, HPC_ptotal, HPC_fecha, EMP_id, ORD_id) VALUES ('$proceso', '$preciou', '$preciot', NOW(), '$encargado', '$id')";
    $results = mysqli_query($open_connection, $query);
        
    if ($results == false) {
        echo '
            <div class="alert alert-danger alert-outline-coloured alert-dismissible" role="alert">
                <div class="alert-icon">
                    <i class="far fa-fw fa-bell"></i>
                </div>
                <div class="alert-message">
                    <strong>Alerta!</strong> Error al actualizar proceso.
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
                        <strong>Alerta!</strong> No has hecho cambios para esta orden.
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
                        <strong>Alerta!</strong> Proceso actualizado correctamente.
                    </div>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
            ';
        }
    }
}

// Recuperando precios totales por procesos de producción.
$query_pt = "SELECT SUM(HPC.HPC_ptotal) AS p_total, EMP.EMP_nombres, EMP.EMP_apellidos FROM procesos PC INNER JOIN historial_procesos HPC ON PC.PC_id = HPC.PC_id INNER JOIN empleados EMP ON EMP.EMP_id = HPC.EMP_id WHERE HPC.EMP_id = $encargado";
$results = mysqli_query($open_connection, $query_pt);
if (mysqli_num_rows($results) > 0) {
    while ($row = mysqli_fetch_array($results)) {
        $p_total = $row['p_total'];
    }
    // Actualizando pagos.
    $query_up = "UPDATE pagos SET PAG_mensual = $p_total WHERE EMP_id = $encargado";
    $results = mysqli_query($open_connection, $query_up);
} else {
    // Insertando pagos.
    $query_pag = "INSERT INTO pagos(PAG_mensual, PAG_fecha, EMP_id) VALUES ($p_total, NOW(), $encargado)";
    $results = mysqli_query($open_connection, $query_pag);
}

include "close-connection.php"; ?>