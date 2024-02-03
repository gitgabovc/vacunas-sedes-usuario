<nav class="navbar navbar-expand-lg bg-success fixed-top">
  <div class="container-fluid">
    <a class="navbar-brand text-white" href="<?php echo base_url(); ?>">PETCAN</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="">Inicio</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="">Link</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Desplegable
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="">Acciones</a></li>
            <li><a class="dropdown-item" href="">Otras acciones</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="">Algunas cosas aquí</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled">Disabled</a>
        </li>
        
      </ul>      
      <!-- <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form> -->
      <ul class="navbar-nav mb-2 mb-lg-0 align-item-right">
        <li class="nav-item">
          <a class="nav-link disabled" href="">Bienvenido: <?= ucfirst($userInfo['nombre']); ?></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo base_url('propietariologout'); ?>">Cerrar Sesión</a>
        </li>
      </ul>
    </div>
  </div>
</nav>