<main class="form-signin w-100 m-auto text-center">
    
    <form action="<?php echo base_url('save'); ?>" method="POST">

        <?= csrf_field(); ?>

        <?php if(!empty(session()->getFlashdata('fail'))) : ?>
            <div class="alert alert-danger"><?= session()->getFlashdata('fail'); ?></div>
        <?php endif ?>

        <?php if(!empty(session()->getFlashdata('success'))) : ?>
            <div class="alert alert-sucsess"><?= session()->getFlashdata('success'); ?></div>
        <?php endif ?>

        <img class="mb-4" src="" alt="" width="72" height="57">
        <h1 class="h3 mb-3 fw-normal">Registro de Usuario</h1>

        <div class="form-floating">
            <input type="text" class="form-control" name="nombre" id="floatingInput" placeholder="Ingrese su Nombre Completo" value="<?= set_value('nombre'); ?>">        
            <label for="floatingInput">Nombre Completo</label>
            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'nombre') : '' ?></span>
        </div>
        <div class="form-floating">
            <input type="text" class="form-control" name="usuario" id="floatingInput" placeholder="Ingrese su Correo Electrónico" value="<?= set_value('usuario'); ?>">
            <label for="floatingInput">Nombre de usuario</label>
            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'usuario') : '' ?></span>
        </div>
        <div class="form-floating">
            <input type="text" class="form-control" name="password" id="floatingPassword" placeholder="Ingrese su Password" value="<?= set_value('password'); ?>">
            <label for="floatingPassword">Contraseña</label>
            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'password') : '' ?></span>
        </div>
        <div class="form-floating">
            <input type="text" class="form-control" name="cpassword" id="floatingPassword" placeholder="Ingrese su Password" value="<?= set_value('cpassword'); ?>">
            <label for="floatingPassword">Confirme su Contraseña</label>
            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'cpassword') : '' ?></span>
        </div>
        <br>
        <button class="w-100 btn btn-lg btn-success">Registrarse</button>  
        <a href="<?php echo base_url('/'); ?>">Ya tengo mi cuenta de usuario, Ir a iniciar sesión</a>
    </form>
</main>