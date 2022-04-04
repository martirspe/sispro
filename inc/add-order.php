<?php

include "open-connection.php";

// Inicializando Zona Horaria.
ini_set('date.timezone', 'America/Bogota');

// Recepcionando datos del fomulario.
$id = $_POST['id'];
$referencia = $_POST['referencia'];
$usuario = $_POST['usuario'];
$cliente = $_POST['cliente'];
$marca = $_POST['marca'];
$modelo = $_POST['modelo'];
$categoria = $_POST['categoria'];
$material = $_POST['material'];
$suela = $_POST['suela'];
$color = $_POST['color'];
$talla34 = $_POST['talla34'];
$talla35 = $_POST['talla35'];
$talla36 = $_POST['talla36'];
$talla37 = $_POST['talla37'];
$talla38 = $_POST['talla38'];
$talla39 = $_POST['talla39'];
$talla40 = $_POST['talla40'];
$observacion = $_POST['observacion'];
$paymentstatus = $_POST['paymentstatus'];
$fechaEntrega = $_POST['fechaEntrega'];

// Verificando si existen campos vacíos en el formulario "Editar Orden"
if (empty($_POST['referencia']) || empty($_POST['usuario']) || empty($_POST['cliente']) || empty($_POST['marca']) || empty($_POST['modelo']) || empty($_POST['categoria']) || empty($_POST['material']) || empty($_POST['suela']) || empty($_POST['color']) || empty($_POST['fechaEntrega'])) {
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
    // Insertando datos en la tabla "Órdenes".
    $query = "INSERT INTO ordenes (USU_id, CLI_id) VALUES ('$usuario', '$cliente')";
    $results = mysqli_query($open_connection, $query);
    if ($results == false) {
        echo '
            <div class="alert alert-danger alert-outline-coloured alert-dismissible" role="alert">
                <div class="alert-icon">
                    <i class="far fa-fw fa-bell"></i>
                </div>
                <div class="alert-message">
                    <strong>Alerta!</strong> Error al generar orden.
                </div>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
        ';
    } else {       
        // Insertando datos en la tabla "Órdenes_Detalles".
        $query_odet = "INSERT INTO ordenes_detalles (ODET_referencia, ODET_material, ODET_suela, ODET_color, ODET_observacion, ODET_pago, ODET_fecha, ODET_fechaEntrega, PRO_id, SER_id)
        VALUES ('$referencia', '$material','$suela','$color','$observacion','$paymentstatus',NOW(),'$fechaEntrega','$modelo','$id');";
        $results = mysqli_query($open_connection, $query_odet);
        if ($results == false) {
            echo '
                <div class="alert alert-danger alert-outline-coloured alert-dismissible" role="alert">
                    <div class="alert-icon">
                        <i class="far fa-fw fa-bell"></i>
                    </div>
                    <div class="alert-message">
                        <strong>Alerta!</strong> Error al generar orden.
                    </div>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
            ';
        } else {
            // Insertando tallas a la tabla "Series"
            $query_ser = "INSERT INTO series (SER_talla34, SER_talla35, SER_talla36, SER_talla37, SER_talla38, SER_talla39, SER_talla40)
            VALUES ('$talla34', '$talla35', '$talla36', '$talla37', '$talla38', '$talla39', '$talla40')";
            $results = mysqli_query($open_connection, $query_ser);
            if ($results == false) {
                echo '
                    <div class="alert alert-danger alert-outline-coloured alert-dismissible" role="alert">
                        <div class="alert-icon">
                            <i class="far fa-fw fa-bell"></i>
                        </div>
                        <div class="alert-message">
                            <strong>Alerta!</strong> Error al generar orden.
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
                            <strong>Alerta!</strong> Orden generada correctamente.
                        </div>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                ';
            }
        }
    }
}

include "close-connection.php"; ?>