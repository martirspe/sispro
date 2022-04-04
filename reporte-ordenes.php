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
    <title>Listado de Órdenes - SISPRO</title>

    <?php include "inc/stylesheets.php"; ?>

</head>

<body>
    <div class="wrapper">
        <?php require_once("inc/sidebar.php"); ?>

        <div class="main">
            <?php require_once("inc/navbar.php"); ?>

            <main class="content">
                <div class="container-fluid p-0">
                    <h1 class="h3 mb-3">Listado de Órdenes</h1>
                    <div class="row">
                        <div class="card-deck">
                            <?php
                $id_user = $_SESSION['USU_tipo'];

                mysqli_query($open_connection, "SET lc_time_names = 'es_PE'");
                $query = "SELECT
                LPAD(ORD.ORD_id, 4, '0') AS ORD_id,
                USU.USU_id,
                USU.USU_nombres,
                USU.USU_apellidos,
                PRO.PRO_modelo,
                PRO.PRO_imagen,
                PRO.PRO_nombre,
                PRO.PRO_modelo,
                CLI.CLI_nombres,
                CLI.CLI_apellidos,
                ODET.ODET_material,
                ODET.ODET_suela,
                ODET.ODET_color,
                ODET.ODET_observacion,
                ODET.ODET_pago,
                DATE_FORMAT(ODET.ODET_fecha, '%d de %M, %Y') AS ODET_fecha,
                DATE_FORMAT(
                    ODET.ODET_fechaEntrega,
                    '%d de %M, %Y'
                ) AS ODET_fechaEntrega,
                SER.SER_talla34,
                SER.SER_talla35,
                SER.SER_talla36,
                SER.SER_talla37,
                SER.SER_talla38,
                SER.SER_talla39,
                SER.SER_talla40
                FROM
                usuarios USU
                INNER JOIN ordenes ORD ON
                USU.USU_id = ORD.USU_id
                INNER JOIN ordenes_detalles ODET ON
                ORD.ORD_id = ODET.ORD_id
                INNER JOIN series SER ON
                SER.SER_id = ODET.SER_id
                INNER JOIN productos PRO ON
                ODET.PRO_id = PRO.PRO_id
                INNER JOIN clientes CLI ON
                CLI.CLI_id = ORD.CLI_id
                WHERE
                ORD.ORD_estado = 1 AND USU.USU_id = $id_user
                ORDER BY
                ORD.ORD_id
                DESC";

                $results = mysqli_query($open_connection, $query);
                while ($row = mysqli_fetch_array($results)) {
                    $SER_talla34 = "";
                    $SER_talla35 = "";
                    $SER_talla36 = "";
                    $SER_talla37 = "";
                    $SER_talla38 = "";
                    $SER_talla39 = "";
                    $SER_talla40 = "";
                    
                    if ($row['SER_talla34'] > 0) {
                        $SER_talla34 = "4";
                    }
                    if ($row['SER_talla35'] > 0) {
                        $SER_talla35 = "5";
                    }
                    if ($row['SER_talla36'] > 0) {
                        $SER_talla36 = "6";
                    }
                    if ($row['SER_talla37'] > 0) {
                        $SER_talla37 = "7";
                    }
                    if ($row['SER_talla38'] > 0) {
                        $SER_talla38 = "8";
                    }
                    if ($row['SER_talla39'] > 0) {
                        $SER_talla39 = "9";
                    }
                    if ($row['SER_talla40'] > 0) {
                        $SER_talla40 = "0";
                    }
                ?>
                            <div class="card">
                                <img class="card-img-top" src="<?php echo $row['PRO_imagen'] ?>"
                                    alt="<?php echo $row['PRO_nombre'] ?>">
                                <?php
                                if (empty($_SESSION['active']) == false) { ?>
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Detalles de la Orden</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="text-muted">Responsable</div>
                                            <strong>
                                                <?php echo $row['USU_nombres'] ?> <?php echo $row['USU_apellidos'] ?>
                                            </strong>
                                            <hr class="my-2">
                                            <div class="text-muted">Fecha de entrega</div>
                                            <strong>
                                                <?php echo $row['ODET_fechaEntrega'] ?>
                                            </strong>
                                        </div>
                                        <div class="col-md-6 text-md-right">
                                            <div class="text-muted">Cliente</div>
                                            <strong>
                                                <?php echo $row['CLI_nombres'] ?> <?php echo $row['CLI_apellidos'] ?>
                                            </strong>
                                            <hr class="my-2">
                                            <div class="text-muted">Estado del Pago</div>
                                            <strong>
                                                <?php echo $row['ODET_pago'] ?>
                                            </strong>
                                        </div>
                                    </div>
                                </div>
                                <hr class="mb-0">
                                <?php } ?>
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Detalles del Producto</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row mb-2">
                                        <div class="col-md-6">
                                            <div class="text-muted">Modelo</div>
                                            <strong>
                                                <?php echo $row['PRO_modelo'] ?>
                                            </strong>
                                            <hr class="my-2">
                                            <div class="text-muted">Material</div>
                                            <strong>
                                                <?php echo $row['ODET_material'] ?>
                                            </strong>
                                            <hr class="my-2">
                                        </div>
                                        <div class="col-md-6 text-md-right">
                                            <div class="text-muted">Color</div>
                                            <strong>
                                                <?php echo $row['ODET_color'] ?>
                                            </strong>
                                            <hr class="my-2">
                                            <div class="text-muted">Suela</div>
                                            <strong>
                                                <?php echo $row['ODET_suela'] ?>
                                            </strong>
                                            <hr class="my-2">
                                        </div>
                                        <div class="col-md-12">
                                            <div class="text-muted">Serie</div>
                                            <div class="form-row text-center">
                                                <div style="width:14.28%" class="form-group col-md-auto" disabled>
                                                    <label class="form-label">34</label>
                                                    <input type="text" name="talla34" placeholder="0"
                                                        class="form-control text-center"
                                                        value="<?php echo $row['SER_talla34'] ?>" disabled>
                                                </div>
                                                <div style="width:14.28%" class="form-group col-md-auto">
                                                    <label class="form-label">35</label>
                                                    <input type="text" name="talla35" placeholder="0"
                                                        class="form-control text-center"
                                                        value="<?php echo $row['SER_talla35'] ?>" disabled>
                                                </div>
                                                <div style="width:14.28%" class="form-group col-md-auto">
                                                    <label class="form-label">36</label>
                                                    <input type="text" name="talla36" placeholder="0"
                                                        class="form-control text-center"
                                                        value="<?php echo $row['SER_talla36'] ?>" disabled>
                                                </div>
                                                <div style="width:14.28%" class="form-group col-md-auto">
                                                    <label class="form-label">37</label>
                                                    <input type="text" name="talla37" placeholder="0"
                                                        class="form-control text-center"
                                                        value="<?php echo $row['SER_talla37'] ?>" disabled>
                                                </div>
                                                <div style="width:14.28%" class="form-group col-md-auto">
                                                    <label class="form-label">38</label>
                                                    <input type="text" name="talla38" placeholder="0"
                                                        class="form-control text-center"
                                                        value="<?php echo $row['SER_talla38'] ?>" disabled>
                                                </div>
                                                <div style="width:14.28%" class="form-group col-md-auto">
                                                    <label class="form-label">39</label>
                                                    <input type="text" name="talla39" placeholder="0"
                                                        class="form-control text-center"
                                                        value="<?php echo $row['SER_talla39'] ?>" disabled>
                                                </div>
                                                <div style="width:14.28%" class="form-group col-md-auto">
                                                    <label class="form-label">40</label>
                                                    <input type="text" name="talla40" placeholder="0"
                                                        class="form-control text-center"
                                                        value="<?php echo $row['SER_talla40'] ?>" disabled>
                                                </div>
                                            </div>
                                            <hr class="my-2">
                                        </div>
                                        <div class="col-md-6">
                                            <div class="text-muted">Fecha de orden</div>
                                            <strong>
                                                <?php echo $row['ODET_fecha'] ?>
                                            </strong>
                                            <hr class="my-2">
                                        </div>
                                        <div class="col-md-6 text-md-right">
                                            <div class="text-muted">Fecha de entrega</div>
                                            <strong>
                                                <?php echo $row['ODET_fechaEntrega'] ?>
                                            </strong>
                                            <hr class="my-2">
                                        </div>
                                        <div class="col-md-12 mt-3">
                                            <div class="text-muted">Observación</div>
                                            <strong>
                                                <?php echo $row['ODET_observacion'] ?>
                                            </strong>
                                            <hr class="my-2">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </main>
<?php require_once("inc/footer.php"); ?>