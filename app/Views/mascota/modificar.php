<div class="container mt-5">
    <div class="row">        
        <div class="col-md-10 mt-3">
            
            <div class="card col-md-8 col-sm-12" id="">
                <div class="card-header">
                    <h3>Actualizar Datos de Mascota
                        <a href="<?= base_url('tablero') ?>" class="btn btn-dark float-end">VOLVER</a>
                    </h3>
                </div>
                <div class="card-body">

                    <form action="<?= base_url('mascota/update/'.$infomascota['id']); ?>" method="POST" autocomplete="off" enctype="multipart/form-data">
                    <input type="hidden" name="_method" value="PUT" />

                    <?= csrf_field(); ?>

                    <?php if(!empty(session()->getFlashdata('fail'))) : ?>
                        <div class="alert alert-danger"><?= session()->getFlashdata('fail'); ?></div>
                    <?php endif ?>

                    <?php if(!empty(session()->getFlashdata('success'))) : ?>
                        <div class="alert alert-sucsess"><?= session()->getFlashdata('success'); ?></div>
                    <?php endif ?>

                    <!-- <h1 class="h3 mb-3 fw-normal">Registro de Mascota</h1> -->
                                        
                    <div class="col-12 mb-1">
                        <div class="input-group">
                            <div class="col-4 form-floating">
                                <select class="form-select" name="raza_id" id="floatingInput" value="">
                                    <option class="disabled" value="disabled">Seleccionar...</option>
                                    <?php
                                    foreach($raza as $row)
                                    {
                                        echo '<option value="'.$row["id"].'" ';
                                        if($row["id"]==$infomascota['raza_id']) echo 'selected';
                                        echo '>'.$row["descripcion"].'</option>';
                                    }
                                    ?>
                                </select>
                                <label for="floatingSelect">Selecciona la raza</label>
                                <span class="text-danger"><?= isset($validation) ? display_error($validation, 'raza_id') : '' ?></span>
                            </div>
                            &nbsp;
                            &nbsp;
                            <div class="col6 form-floating">
                                <input type="text" class="form-control" name="nombre" id="floatingInput" placeholder="" value="<?= $infomascota['nombre'] ?>">
                                <label for="floatingInput">Nombre</label>
                                <span class="text-danger"><?= isset($validation) ? display_error($validation, 'nombre') : '' ?></span>
                            </div>                            
                        </div>                        
                    </div>
                    <div class="form-floating my-3">                        
                        <div class="form-check form-check-inline">                            
                            <label class="form-check-label" >Sexo: </label>
                        </div>
                        <div class="form-check form-check-inline">                            
                            <input class="form-check-input" type="radio" name="sexo" id="radMac" value="M" <?php if($infomascota['sexo']=='M') echo 'checked'; ?>>
                            <label class="form-check-label" for="radMac">Macho</label>
                        </div>
                        <div class="form-check form-check-inline    ">
                            <input class="form-check-input" type="radio" name="sexo" id="radHem" value="H" <?php if($infomascota['sexo']=='H') echo 'checked'; ?>>
                            <label class="form-check-label" for="radHem">Hembra</label>
                        </div>
                        <span class="text-danger"><?= isset($validation) ? display_error($validation, 'sexo') : '' ?></span>
                    </div>                    
                    <div class="col-12 mb-1 align-center">
                        <div class="input-group">
                            <div class="col-4 form-floating">
                                <select class="form-select" name="edad_anios" id="edadAnios">                            
                                    <?php
                                    for ($i=0; $i < 21; $i++) { 
                                        echo '<option value="'.$i.'" ';
                                        if($i==$infomascota['edad_anios']) echo 'selected';
                                        echo '>'.$i.'</option>';
                                    }
                                    ?>
                                </select>
                                <label for="floatingSelect">Edad Años</label>                        
                            </div>
                            &nbsp;
                            <div class="col-4 form-floating">
                                <select class="form-select" name="edad_meses" id="edadMeses">                            
                                    <?php
                                    for ($i=0; $i < 12; $i++) { 
                                        echo '<option value="'.$i.'" ';
                                        if($i==$infomascota['edad_meses']) echo 'selected';
                                        echo '>'.$i.'</option>';
                                    }
                                    ?>
                                </select>
                                <label for="floatingSelect">Edad meses</label>                        
                            </div>                            
                        </div>                    
                    </div>
                    <div class="form-floating">
                        <label for="formFile" class="form-label" id="fileFoto"></label>
                        <input class="form-control" type="file" name="foto" id="formFile" capture="camera" accept="image/jpeg,image/jpg,image/png">
                    </div>
                    <div class="form-floating">
                        <input type="text" class="form-control" name="color" id="floatingInput" value="<?= $infomascota['color'] ?>">
                        <label for="floatingInput">Color</label>
                        <span class="text-danger"><?= isset($validation) ? display_error($validation, 'color') : '' ?></span>
                    </div>
                    <div class="form-floating my-3">
                    <div class="form-check form-check-inline">                            
                            <label class="form-check-label">Tipo: </label>
                        </div>
                        <div class="form-check form-check-inline">                            
                            <input class="form-check-input" type="radio" name="tipo" id="radPer" value="P" <?php if($infomascota['tipo']=='P') echo 'checked'; ?>>
                            <label class="form-check-label" for="radPer">Perro</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="tipo" id="radGat" value="G" <?php if($infomascota['tipo']=='G') echo 'checked'; ?>>
                            <label class="form-check-label" for="radGat">Gato</label>
                        </div>
                        <span class="text-danger"><?= isset($validation) ? display_error($validation, 'tipo') : '' ?></span>
                    </div>

                    <br>
                    <button class="w-100 btn btn-sm btn-success">Guardar Cambios</button>

                    </form>
                    
                </div>
            </div>
        </div>
    </div>    
</div>