<div class="container mt-5">
    <div class="row">        
        <div class="col-md-10 mt-3">
            <div class="container">
                <div class="row">
                    <div class="col-lg-5 mx-auto">
                        <div class="card card-body rounded border bg-white">
                            <h2 class="text-center">REGISTRO DE BRIGADA</h2>
                            <div class="mb-3">
                                <label for="qrCode" class="form-label">Por favor registre los datos de brigada antes de proceder al scaner QR para vacunación</label>

                                <form action="<?php echo base_url('savebrigada'); ?>" method="POST" autocomplete="off" enctype="multipart/form-data">

                                    <?= csrf_field(); ?>

                                    <div class="col-12 mb-1">
                                        <div class="form-floating">
                                            <input type="hidden" class="form-control" name="idresponsable" id="floatingidresponsable" value="<?php echo ucfirst($userInfo['id']); ?>">
                                            <label for="floatingidresponsable">id responsable</label>
                                        </div>
                                    </div>
                                    <div class="col-12 mb-1">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" name="nrobrigada" id="floatingnrobrigada" placeholder="Ingrese Nro de su brigada" value="<?= set_value('nrobrigada'); ?>" required maxlength="5">
                                            <label for="floatingnrobrigada">Nro. Brigada</label>
                                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'nrobrigada') : '' ?></span>
                                        </div>
                                    </div>
                                    <div class="col-12 mb-1">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" name="lugar" id="floatinglugar" placeholder="Ingrese el lugar de vacunación" style="text-transform: uppercase" value="<?= set_value('lugar'); ?>" required maxlength="20">
                                            <label for="floatinglugar">Lugar de vacunación</label>
                                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'lugar') : '' ?></span>
                                        </div>
                                    </div>
                                    <div class="col-12 mb-1">
                                    <div class="form-floating">
                                        <input type="hidden" class="form-control" name="idfecha" id="floatingidfecha" placeholder="idfecha" value="<?= $fechas_info['id']; ?>">
                                        <label for="floatingidfecha">id fecha</label>
                                    </div>
                                    </div>
                                    <div class="col-12 mb-1">
                                    <div class="form-floating">
                                        <input type="number" class="form-control" name="dosis" id="floatingdosis" placeholder="Dosis asignadas" value="<?= set_value('dosis'); ?>" required min="0">
                                        <label for="floatingInput">Cantidad de dosis asignadas</label>
                                        <span class="text-danger"><?= isset($validation) ? display_error($validation, 'dosis') : '' ?></span>
                                    </div>
                                    </div>
                                    

                                    <div class="col-12 mb-1">
                                        <button class="w-100 btn btn-md btn-dark">Guardar</button>
                                    </div> 
                                    <p>
                                    <a class="w-100 btn btn-sm btn-danger" href="<?php echo base_url('propietariologout'); ?>" class="text-primary">Salir</a>
                                    </p>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>    
</div>