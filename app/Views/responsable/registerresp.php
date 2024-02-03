<main class="form-signin w-100 m-auto text-center">
    
    <form action="<?php echo base_url('saveresp'); ?>" method="POST" autocomplete="off">

        <?= csrf_field(); ?>

        <?php if(!empty(session()->getFlashdata('fail'))) : ?>
            <div class="alert alert-danger"><?= session()->getFlashdata('fail'); ?></div>
        <?php endif ?>

        <?php if(!empty(session()->getFlashdata('success'))) : ?>
            <div class="alert alert-sucsess"><?= session()->getFlashdata('success'); ?></div>
        <?php endif ?>

        <img class="mb-4" src="./assets/dogcat.jpg" alt="" width="72" height="57">
        <h1 class="h3 mb-3 fw-normal">Registro de Vacunadores</h1>

        <div class="col-12 mb-1">
            <div class="form-floating">
                <input type="text" class="form-control" name="codigo" id="floatingPassword" placeholder="Ingrese código para el registro de usuario" value="<?= set_value('codigo'); ?>">
                <label for="floatingPassword">Código de Establecimiento</label>
                <span class="text-danger"><?= isset($validation) ? display_error($validation, 'codigo') : '' ?></span>
            </div>
        </div>
        <div class="col-12 mb-1">
            <div class="form-floating">
                <input type="text" class="form-control" name="ci" id="floatingInput" placeholder="Ingrese su Carnet de Identidad" value="<?= set_value('ci'); ?>">
                <label for="floatingInput">Carnet de Identidad</label>
                <span class="text-danger"><?= isset($validation) ? display_error($validation, 'ci') : '' ?></span>
            </div>
        </div>
        <div class="col-12 mb-1">
            <div class="form-floating">
                <input type="text" class="form-control" name="nombre" id="floatingInput" placeholder="Ingrese su Nombre Completo" value="<?= set_value('nombre'); ?>">
                <label for="floatingInput">Nombre Completo</label>
                <span class="text-danger"><?= isset($validation) ? display_error($validation, 'nombre') : '' ?></span>
            </div>
        </div>
        <div class="col-12 mb-1">
            <div class="form-floating">
                <input type="password" class="form-control" name="password" id="floatingPassword" placeholder="Ingrese su Password" value="<?= set_value('password'); ?>">
                <label for="floatingPassword">Contraseña</label>
                <span class="text-danger"><?= isset($validation) ? display_error($validation, 'password') : '' ?></span>
            </div>
        </div>
        <div class="col-12 mb-1">
            <div class="form-floating">
                <input type="password" class="form-control" name="cpassword" id="floatingPassword" placeholder="Ingrese su Password" value="<?= set_value('cpassword'); ?>">
                <label for="floatingPassword">Confirme su Contraseña</label>
                <span class="text-danger"><?= isset($validation) ? display_error($validation, 'cpassword') : '' ?></span>
            </div>
        </div>
        
        <div class="col-12 mb-1">
            <button class="w-100 btn btn-md btn-dark">Registrarse</button>
        </div> 
        <p>
        <a class="w-100 btn btn-sm btn-danger" href="<?php echo base_url('/'); ?>" class="text-primary">Volver al inicio</a>
        </p>
    </form>
</main>