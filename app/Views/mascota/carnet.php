<div class="container">

    <div class="row d-flex justify-content-center">        
        <div class="col-md-10 mt-4 pt-5">

            <a href="<?= base_url('tablero') ?>" class="btn btn-dark">VOLVER</a>

            <div class="row z-depth-3">
                
                <div class="col-sm-3 bg-info rounded-left">
                    <div class="card-block text-center text-white">
                        <i class="fas fa-7x mt-5"></i>
                        <h2 class="fw-bold mt-4">CARNET DE VACUNAS</h2>
                            <div class="text-center">
                                <?php
                                if ($infomascota['foto']=="") {
                                    ?>
                                    <img src="<?php echo base_url(); ?>/uploads/fotom.png" width="200px">
                                    <?php
                                } else {
                                    ?>
                                    <img src="<?php echo base_url(); ?>/uploads/<?php echo $infomascota['foto']; ?>" width="200px">
                                    <?php
                                }
                                ?>
                            </div>
                        <p>LA RABIA ES MORTAL, VACUNE A SU PERRO Y GATO TODOS LOS AÑOS</p>
                        <i class="fas fa-2x mb-4"></i>
                    </div>
                </div>
                <div class="col-sm-8 bg-white rounded-right">
                    <h3 class="mt-3">Datos Propietario</h3>
                    <hr class="bg-primary">
                    <div class="row">
                        <div class="col-sm-6">
                            <p class="fw-bold">Nombre</p>
                            <h6 class="text-muted"><?php echo ucfirst($userInfo['nombre']); ?></h6>
                        </div>
                        <div class="col-sm-6">
                            <p class="fw-bold">Teléfono</p>
                            <h6 class="text-muted"><?php echo ucfirst($userInfo['telefono']); ?></h6>
                        </div>
                        <div class="col-sm-6">
                            <p class="fw-bold">Direccion</p>
                            <h6 class="text-muted"><?php echo ucfirst($userInfo['direccion']); ?></h6>
                        </div>                        
                    </div>
                    <h4 class="mt-3">Datos Mascota</h4>
                    <hr class="bg-primary">
                    <div class="row">
                        <div class="col-sm-6">
                            <p class="fw-bold">Nombre</p>
                            <h6 class="text-muted"><?= $infomascota['nombre'] ?></h6>
                        </div>
                        <div class="col-sm-6">
                            <p class="fw-bold">Tipo</p>
                            <h6 class="text-muted">
                                <?php switch ($infomascota['tipo']) {
                                case 'P':
                                    echo "Perro";
                                    break;
                                case 'G':
                                    echo "Gato";
                                    break;
                                } ?>
                            </h6>
                        </div>
                        <div class="col-sm-6">
                            <p class="fw-bold">Edad Años</p>
                            <h6 class="text-muted"><?= $infomascota['edad_anios'] ?></h6>
                        </div>
                        <div class="col-sm-6">
                            <p class="fw-bold">Edad Meses</p>
                            <h6 class="text-muted"><?= $infomascota['edad_meses'] ?></h6>
                        </div>
                        <div class="col-sm-6">
                            <p class="fw-bold">Color</p>
                            <h6 class="text-muted"><?= $infomascota['color'] ?></h6>
                        </div>
                        <div class="col-sm-6">
                            <p class="fw-bold">Sexo</p>
                            <h6 class="text-muted">
                            <?php switch ($infomascota['sexo']) {
                                case 'M':
                                    echo "Macho";
                                    break;
                                case 'H':
                                    echo "Hembra";
                                    break;
                                } ?>
                            </h6>
                        </div>
                    </div>
                    <h4 class="mt-3">Registro de Vacunas</h4>
                    <hr class="bg-primary">
                    <div class="row">
                        <div class="col-sm-12">
                            <table class="table table-bordered table-sm">
                                <thead>
                                    <tr class="text-center">
                                        <th>Fecha</th>
                                        <th>Nro. Brigada</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($vacunas as $vac) {
                                        if ($infomascota['id']==$vac['mascota_id'] && $vac['vacunado']=='S') {
                                        ?> 
                                    <tr>
                                        <td> <?php echo $vac['fecha_vacuna']; ?> </td> 
                                        <td> 
                                            <?php
                                            foreach ($brigadas as $brig) {
                                                if ($vac['brigadas_id']==$brig['id']) {
                                                    echo $brig['nrobrigada'];
                                                }
                                            }
                                            ?>
                                        </td>
                                        <?php
                                        } 
                                        ?>
                                    </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <hr class="bg-primary">
                </div>
            </div>
        </div>
    </div>

</div>