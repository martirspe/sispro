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
    // Actualizando datos en la tabla "Órdenes".
    $query = "UPDATE ordenes SET USU_id = '$usuario', CLI_id = '$cliente' WHERE ORD_id = '$id'";
    $results = mysqli_query($open_connection, $query);
    if ($results == false) {
        echo '
            <div class="alert alert-danger alert-outline-coloured alert-dismissible" role="alert">
                <div class="alert-icon">
                    <i class="far fa-fw fa-bell"></i>
                </div>
                <div class="alert-message">
                <strong>Alerta!</strong> Error al actualizar orden.
                </div>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            ';
    } else {
        // Actualizando datos en la tabla "Órdenes_Detalles".
        $query_odet = "UPDATE ordenes_detalles SET ODET_referencia = '$referencia', ODET_material = '$material', ODET_suela = '$suela', ODET_color = '$color', ODET_observacion = '$observacion', ODET_pago = '$paymentstatus', ODET_fechaEntrega = '$fechaEntrega', PRO_id = '$modelo' WHERE ORD_id = '$id'";
        $results = mysqli_query($open_connection, $query_odet);
        if ($results == false) {
            echo '
                <div class="alert alert-danger alert-outline-coloured alert-dismissible" role="alert">
                    <div class="alert-icon">
                        <i class="far fa-fw fa-bell"></i>
                    </div>
                    <div class="alert-message">
                        <strong>Alerta!</strong> Error al actualizar orden.
                    </div>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
            ';
        } else {
            // Insertando datos en la tabla "Series".
            $query_ser = "UPDATE series SER INNER JOIN ordenes_detalles ODET ON SER.SER_id = ODET.SER_id SET SER_talla34='$talla34', SER_talla35='$talla35', SER_talla36='$talla36', SER_talla37='$talla37', SER_talla38='$talla38', SER_talla39='$talla39', SER_talla40='$talla40' WHERE ORD_id='$id'";
            $results = mysqli_query($open_connection, $query_ser);
            if ($results == false) {
                echo '
                    <div class="alert alert-danger alert-outline-coloured alert-dismissible" role="alert">
                        <div class="alert-icon">
                            <i class="far fa-fw fa-bell"></i>
                        </div>
                        <div class="alert-message">
                            <strong>Alerta!</strong> Error al actualizar orden.
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
                        <strong>Alerta!</strong> Orden actualizada correctamente.
                    </div>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                ';
            }
        }
    }
}
include "close-connection.php"; ?>