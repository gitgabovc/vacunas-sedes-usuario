<div class="container mt-5">
    <div class="row">        
        <div class="mt-3">
            <h3>Mascotas a vacunar</h3>

            <?php if(!empty(session()->getFlashdata('fail'))) : ?>
                        <div class="alert alert-danger"><?= session()->getFlashdata('fail'); ?></div>
            <?php endif ?>

            <?php if(!empty(session()->getFlashdata('success'))) : ?>
                <div class="alert alert-sucsess"><?= session()->getFlashdata('success'); ?></div>
            <?php endif ?>

            <div class="container py-5">
                <div class="row">
                    <div class="col-lg-5 mx-auto">
                        <div class="card card-body p-5 rounded border bg-white">
                            <h1 class="mb-4 text-center">Escáner QR</h1>
                            <form action="" method="POST" enctype="multipart/form-data">
                                <div class="mb-3">
                                    <label for="qrCode" class="form-label">Enfoque con su cámara o seleccione el archivo QR</label>
                                    <input class="form-control" type="file" accept="image/png" name="qrCode" id="qrCode" capture="camera">
                                </div>
                                <button type="submit" name="upload" class="btn btn-primary btn-md">
                                    Ver lista
                                </button>                                
                            </form>
                            <?php 
                            echo $msg;
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            
            <?php if(!$infopropietario): ?>
            
                <br />
                <br />
                <div class="alert alert-info" role="alert">
                  ¡No hay registros! Escanee primero el código QR
                </div>

            
            <?php else: ?>
                
                <table id="mascotas_table" class="table table-borderless table-hover">
                    <thead>
                        <tr class="text-center">
                            <th>#</th>
                            <th>Foto</th>
                            <th>Nombres</th>
                            <th>Edad Años</th>
                            <th>Edad Meses</th>
                            <th>Tipo</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        <?php 
                        $indice = 1;
                        foreach ($mascota as $row):
                        ?>
                            <tr
                                <?php
                                    if ($row['vacunado'] == "S") {
                                        ?> class="<?php echo "table-danger"; ?>"<?php
                                    }
                                ?>
                                >
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
                                    
                                    <input type="button" onclick="vacunado(<?php echo $row['idmascota']; ?>, <?php echo $brigadas['fechas_id']; ?>, 'S', <?php echo $brigadas['id']; ?>)" class="btn btn-primary" value="Si Vacunado"
                                    <?php
                                        if ($row['vacunado'] == "S") {
                                            echo "disabled";
                                        }
                                    ?>
                                    />
                                    <input type="button" onclick="vacunado(<?php echo $row['idmascota']; ?>, <?php echo $brigadas['fechas_id']; ?>, 'N', <?php echo $brigadas['id']; ?>)" class="btn btn-danger" value="No Vacunado"
                                    <?php
                                        if ($row['vacunado'] == "N") {
                                            echo "disabled";
                                        }
                                    ?>
                                    />
                                    <span id="msg" class="text-danger"></span>
                                    
                                </td>
                            </tr>
                        <?php
                        $indice++;
                        endforeach;
                        ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    </div>
</div>

<script>
  

function vacunado(idmascota, idfechas, vacunado, idbrigada){
    
    /* console.log(idmascota, idfechas, vacunado, idbrigada); */
    $.ajax({
        method:"POST",
        url:"<?php echo base_url('vacunado'); ?>",
        data:{
            'idmascota':idmascota,
            'idfechas':idfechas,
            'vacunado':vacunado,
            'idbrigada':idbrigada,
        },
        dataType:'JSON',
        
        success:function(data) {
            
            /* $('#vacunado_button').val('Si Vacunado');
            $('#vacunado_button').attr('disabled', false); */
            /* $("#mascotas_table").load(" #mascotas_table"); */
            location.reload(); 
            /* $('#mascotas_table').ajax.reload(); */            
            setTimeout(function(){
                $('#msg').html('');
            }, 5000);
        }
    });
}
</script>