<div class="signin">
    <main class="form-signin w-100 m-auto text-center">
        
        <form action="<?php echo base_url('checkresp') ?>" method="POST" autocomplete="off">

            <?= csrf_field(); ?>

            <img class="mb-4" src="./assets/dogcat.jpg" alt="" width="72" height="57">
            <h1 class="h3 mb-3 fw-normal">Sólo Vacunadores</h1>

            <div class="col-12 mb-1">
                <div class="form-floating">
                    <input type="text" class="form-control" name="ci" id="floatingInput" placeholder="Ingrese su Carnet de Identidad" value="<?= set_value('ci') ?>">
                    <span class="text-danger"><?= isset($validation) ? display_error($validation, 'ci') : '' ?></span>
                    <label for="floatingInput">Carnet de Identidad</label>
                </div>
            </div>
            <div class="col-12 mb-1">
                <div class="form-floating">
                    <input type="password" class="form-control" name="password" id="floatingPassword" placeholder="Ingrese su Password">
                    <span class="text-danger"><?= isset($validation) ? display_error($validation, 'password') : '' ?></span>
                    <label for="floatingPassword">Contraseña</label>
                </div>
            </div>
            <?php if(!empty(session()->getFlashdata('fail'))) : ?>
                <div class="alert alert-danger"><?= session()->getFlashdata(('fail')); ?></div>
            <?php endif ?>
            <!-- div class="checkbox mb-3">
            <label>
                <input type="checkbox" value="remember-me"> Recordarme
            </label>
            </div -->
            <div class="col-12 mb-1">
            <button class="w-100 btn btn-md btn-dark">Iniciar Sesión</button>
            </div>
        </form>
            <div class="col-12 mb-1">
                <a class="w-100 btn btn-md btn-info" href="<?php echo base_url('registerresp'); ?>">Crear Usuario</a>
            </div>
        <p class="mt-5 mb-3 text-muted">&copy; SEDES-2022</p>
    </main>
</div>