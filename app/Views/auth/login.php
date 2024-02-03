<main class="form-signin w-100 m-auto text-center">
<?php
echo 'Probando la conexión';
$db = \Config\Database::connect();
$query   = $db->query('SELECT ci, nombre, telefono FROM propietario');
$results = $query->getResultArray();

foreach ($results as $row) {
    echo $row['ci'];
    echo $row['nombre'];
    echo $row['telefono'];
}

?>
    
    <form action="<?php echo base_url('check') ?>" method="POST">

        <?= csrf_field(); ?>

        <?php if(!empty(session()->getFlashdata('fail'))) : ?>
            <div class="alert alert-dan"><?= session()->getFlashdata(('fail')); ?></div>
        <?php endif ?>

        <img class="mb-4" src="./assets/dogcat.jpg" alt="Petcam" width="72" height="57">
        <h1 class="h3 mb-3 fw-normal">Inicio de Sesión</h1>

        <div class="form-floating">
        <input type="text" class="form-control" name="usuario" id="floatingInput" placeholder="Ingrese su Correo Electrónico" value="<?= set_value('usuario') ?>">
        <span class="text-danger"><?= isset($validation) ? display_error($validation, 'usuario') : '' ?></span>
        <label for="floatingInput">Nombre de usuario</label>
        </div>
        <div class="form-floating">
        <input type="text" class="form-control" name="password" id="floatingPassword" placeholder="Ingrese su Password">
        <span class="text-danger"><?= isset($validation) ? display_error($validation, 'password') : '' ?></span>
        <label for="floatingPassword">Contraseña</label>
        </div>

        <div class="checkbox mb-3">
        <label>
            <input type="checkbox" value="remember-me"> Recordarme
        </label>
        </div>
        <button class="w-100 btn btn-lg btn-success">Iniciar Sesión</button>  
    </form>
    <a class="w-100 btn btn-lg btn-danger" href="<?php echo base_url('register'); ?>">Crear Usuario</a>
    <p class="mt-5 mb-3 text-muted">&copy; SEDES-2022</p>    
</main>