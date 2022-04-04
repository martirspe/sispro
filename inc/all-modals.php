<?php

//MODALS

//Ver usuarios
function users {
    echo '
    <!-- BEGIN  modal -->
    <div class="modal fade" id="view-user" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Detalles del usuario</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body m-3">
                    <div class="row">
                        <div class="col-md-4">
                            <img class="img-thumbnail rounded mr-2 mb-2" weight="300" height="300" src="<?php echo $row['USU_imagen'] ?>" alt="<?php echo $row['USU_nombres'] ?>">
                        </div>
                        <div class="col-md-8">
                            <h5>Nombre:</h5>
                            <p class="mb-2"><?php echo $row['USU_nombres'] ?> <?php echo $row['USU_apellidos'] ?></p>
                            <h5>Móvil:</h5>
                            <p class="mb-2"><?php echo $row['USU_movil'] ?></p>
                            <div class="row">
                                <div class="col">
                                    <h5>Usuario:</h5>
                                    <p class="mb-2"><?php echo $row['USU_usuario'] ?></p>
                                </div>
                                <div class="col">
                                    <h5>Correo:</h5>
                                    <p class="mb-2"><?php echo $row['USU_correo'] ?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <h5>Tipo de usuario:</h5>
                                    <p class="mb-2"><?php 
                                        
                                        if ($row['USU_tipo'==1]) {
                                            echo "Administrador";
                                        } else {
                                            echo "Usuario";
                                        }

                                    ?></p>
                                </div>
                                <div class="col">
                                    <h5>Fecha de creación:</h5>
                                    <p class="mb-0"><?php echo $row['USU_fechaCreacion'] ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary">Guardar cambios</button>
                </div> -->
            </div>
        </div>
    </div>
    <!-- END  modal -->
    ';
}


?>