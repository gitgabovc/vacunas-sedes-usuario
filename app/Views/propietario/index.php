<div class="container mt-5">
    <div class="row">        
        <div class="col-md-10 mt-3">
            <h3>Mis Mascotas</h3>

            <?php if(!empty(session()->getFlashdata('fail'))) : ?>
                        <div class="alert alert-danger"><?= session()->getFlashdata('fail'); ?></div>
            <?php endif ?>

            <?php if(!empty(session()->getFlashdata('success'))) : ?>
                <div class="alert alert-sucsess"><?= session()->getFlashdata('success'); ?></div>
            <?php endif ?>
            
            <button type="button" class="btn btn-success dropdown-toggle" data-bs-toggle="collapse" data-bs-target="#collapseForm" aria-expanded="false" aria-controls="collapseForm">
                Registrar Mascota
            </button>

            <div class="collapse" id="collapseForm">
                <div class="card card-body col-md-8 col-sm-12">

                    <form action="<?php echo base_url('guardarm'); ?>" method="POST" autocomplete="off" enctype="multipart/form-data">

                    <?= csrf_field(); ?>                    

                    <!-- <h1 class="h3 mb-3 fw-normal">Registro de Mascota</h1> -->
                    <div>
                        <input type="hidden" class="form-control" name="propietario_id" value="<?php echo ucfirst($userInfo['id']); ?>">
                    </div>
                    
                    <div class="col-12 mb-1">
                        <div class="input-group">
                            <div class="col-4 form-floating">
                                <select class="form-select" name="raza_id" id="floatingInput" required>
                                    <option class="disabled" value="disabled" disabled>Seleccionar...</option>
                                    <?php
                                    foreach($raza as $row)
                                    {
                                        echo '<option value="'.$row["id"].'">'.$row["descripcion"].'</option>';
                                    }
                                    ?>
                                </select>
                                <label for="floatingSelect">Selecciona la raza</label>
                            </div>
                            &nbsp;
                            &nbsp;
                            <div class="col6 form-floating">
                                <input type="text" class="form-control" name="nombre" id="floatingInput" placeholder="" required maxlength="20" style="text-transform:uppercase;">
                                <label for="floatingInput">Nombre</label>
                                
                            </div>
                        </div>                        
                    </div>

                    <div class="form-floating my-3">                        
                        <div class="form-check form-check-inline">                            
                            <label class="form-check-label" >Sexo: </label>
                        </div>
                        <div class="form-check form-check-inline">                            
                            <input class="form-check-input" type="radio" name="sexo" id="radMac" value="M" required>
                            <label class="form-check-label" for="radMac">Macho</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="sexo" id="radHem" value="H">
                            <label class="form-check-label" for="radHem">Hembra</label>
                        </div>
                    </div>
                    
                    <div class="col-12 mb-1 align-center">
                        <div class="input-group">
                            <div class="col-4 form-floating">
                                <select class="form-select" name="edad_anios" id="edadAnios">                            
                                    <?php
                                    for ($i=0; $i < 21; $i++) { 
                                        echo '<option value="'.$i.'">'.$i.'</option>';
                                    }
                                    ?>
                                </select>
                                <label for="floatingSelect">Edad Años</label>                        
                            </div>
                            &nbsp;
                            &nbsp;
                            <div class="col-4 form-floating">
                                <select class="form-select" name="edad_meses" id="edadMeses">                            
                                    <?php
                                    for ($i=0; $i < 12; $i++) { 
                                        echo '<option value="'.$i.'">'.$i.'</option>';
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
                        <input type="text" class="form-control" name="color" id="floatingInput" required maxlength="16" style="text-transform:uppercase;">
                        <label for="floatingInput">Color</label>
                    </div>
                    <div class="form-floating my-3">
                    <div class="form-check form-check-inline">                            
                            <label class="form-check-label">Tipo: </label>
                        </div>
                        <div class="form-check form-check-inline">                            
                            <input class="form-check-input" type="radio" name="tipo" id="radPer" value="P" required>
                            <label class="form-check-label" for="radPer">Perro</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="tipo" id="radGat" value="G">
                            <label class="form-check-label" for="radGat">Gato</label>
                        </div>
                    </div>

                    <br>
                    <button class="w-100 btn btn-sm btn-success">Guardar</button>

                    </form>
                </div>
            </div>
            
            <form class="btn" action="" id="formularioQR">
                <input type="hidden" id="codeqr" value="<?php echo ucfirst($userInfo['id']); ?>"/>
                <button type="" class="btn btn-success dropdown-toggle <?php if (count($mascota)<=0) {echo "disabled";} ?>" data-bs-toggle="collapse" data-bs-target="#collapseQR" aria-expanded="false" aria-controls="collapseQR">
                    Generar QR
                </button>
            </form>
            <div class="collapse" id="collapseQR">
                <div class="card card-body col-md-4 col-sm-12">
                    
                    <div class="mx-auto d-block" id="contenedorQR"></div>

                </div>
            </div>
            
            <?php   if(count($mascota)>0): ?>
            <table class="table table-borderless table-hover">
                <thead>
                    <tr class="text-center">
                        <th scope="col">#</th>
                        <th scope="col">Foto</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Edad Años</th>
                        <th scope="col">Edad Meses</th>
                        <th scope="col">Tipo</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    <?php 
                    $indice = 1;
                    foreach ($mascota as $row): ?>
                        <tr>
                            <td>
                                <p class="d-none d-sm-block"><?php echo $indice; ?></p>    
                                <td class="d-sm-none" data-titulo="<?php echo $indice; ?> de <?php echo count($mascota); ?>"></td>
                            </td>
                            <td class="text-center">
                                <?php
                                if ($row['foto']=="") {
                                    ?>
                                    <img src="<?php echo base_url(); ?>/uploads/fotom.png" width="75px">
                                    <?php
                                } else {
                                    ?>
                                    <img src="<?php echo base_url(); ?>/uploads/<?php echo $row['foto']; ?>" width="75px">
                                    <?php
                                }
                                ?>
                            </td>
                            <td data-titulo="Nombre: "><?php echo $row['nombre']; ?></td>                            
                            <td data-titulo="Edad años: "><?php echo $row['edad_anios']; ?></td>
                            <td data-titulo="Edad meses: "><?php echo $row['edad_meses']; ?></td>
                            <td data-titulo="Tipo: "><?php switch ($row['tipo']) {
                                case 'P':
                                    echo "Perro";
                                    break;
                                case 'G':
                                    echo "Gato";
                                    break;
                            } ?>
                            </td>

                            <td class="text-center">
                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                <a type="submit" href="<?= base_url("mascota/modificar/".$row['id']) ?>" class="btn btn-warning">Modificar</a>
                                <a type="submit" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#deleteModal" data-bs-id="<?php echo $row['id']; ?>" data-bs-name="<?php echo $row['nombre']; ?>">Quitar</a>
                                <a type="submit" href="<?= base_url("mascota/carnet/".$row['id']) ?>" class="btn btn-secondary">Ver Carnet</a>
                            </td>

                        </tr>
                    <?php 
                    $indice++;
                    endforeach;
                    ?>
                </tbody>
            </table>
            <?php 
                else:
                ?>
                <br />
                <br />
                <div class="alert alert-info" role="alert">
                  ¡No tiene ninguna mascota registrada!
                </div>

            <?php 
                endif;
                ?>
        </div>

        <!-- Modal DELETE -->
        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Eliminar Mascota <span></span></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ¿Está seguro de quitar el registro de su lista de mascotas?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Volver</button>
                    <form id="deleteForm" data-bs-action="mascota/delete/" action="" method="POST">
                        <button type="submit" class="btn btn-dark">Dar Baja</button>
                    </form>                    
                </div>
                </div>
            </div>
        </div>

    </div>    
</div>

<script>
    var deleteModal = document.getElementById('deleteModal')
    deleteModal.addEventListener('show.bs.modal', function (event){
        var button = event.relatedTarget
        // GET Base de datos
        var id = button.getAttribute('data-bs-id')
        var name = button.getAttribute('data-bs-name')
        // Modal tiltulo
        var modalTitle = deleteModal.querySelector('.modal-title span')
        modalTitle.textContent = name
        // Modal form
        var deleteForm = deleteModal.querySelector('#deleteForm')
        var action = deleteForm.getAttribute("data-bs-action")
        deleteForm.setAttribute("action",action+id)
    })
</script>

<script src="<?php echo base_url(); ?>/assets/qrcode.min.js"></script>
<script src="<?php echo base_url(); ?>/assets/appqr.js"></script>