<style>
  .nav-link {
    color: #ffffff; 
    font-weight: 500;
  }
  .nav-link:hover {
    background-color: #ffffff;
    color: #000000;  
    font-weight: 500;
  }
</style>
<?php $session = session();
$nombre = $session->get('usuario_nombre');
$perfil_id = $session->get('id_tipo_usuario');?>

<nav class="navbar sticky-top navbar-expand-xl" style="background-color: #000000;">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand text-light" href="">
        <img src="<?= base_url('public/assets/img/IdiomasModernos.jpg')?>" alt="" width="30" height="30"> Gestion De Pagos
      </a>
    </div>
    <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
      <span class="navbar-toggler-icon"><i class="fas fa-bars" style="color:#fff; font-size:28px;"></i></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
      <div class="navbar-nav ms-auto">
          <?php if (($perfil_id == '1')) /* Admin */ {?>
            <a class="nav-link me-1" href="<?=base_url('Usuarios-Admin'); ?>">Usuarios</a>
            <a class="nav-link me-1" href="<?=base_url('Cursos-Admin'); ?>">Cursos</a>
          <div class="dropdown">
            <button type="button" class="btn btn-dark btn-outline-light dropdown-toggle" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-solid fa-circle-user me-1"></i>
              Bienvenido Admin <?= $nombre?>
            </button>
            <ul class="dropdown-menu position-absolute end-0" aria-labelledby="dropdownMenuButton2">
              <li><a class="dropdown-item" href="<?= base_url('Cerrar-Sesion'); ?>">Cerrar Sesión</a></li>
            </ul>
          </div>
        <?php } else if (($perfil_id == '2')) /* Empleado */ {;?>
          <a class="nav-link me-1" href="<?=base_url('Pago-Empleado-Alumno'); ?>">Realizar Pago</a>
          <a class="nav-link me-1" href="<?=base_url('Pago-Empleado-Alumno'); ?>">Ver Cuotas</a>
          <div class="dropdown">
            <button type="button" class="btn btn-dark btn-outline-light dropdown-toggle" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-solid fa-circle-user me-1"></i>
              Bienvenido Empleado <?= $nombre?>
            </button>
            <ul class="dropdown-menu position-absolute end-0" aria-labelledby="dropdownMenuButton2">
              <li><a class="dropdown-item" href="<?= base_url('Cerrar-Sesion'); ?>">Cerrar Sesión</a></li>
            </ul>
          </div>
        <?php } else if (($perfil_id == '3')) /* Alumno */ {;?>
          <a class="nav-link me-1" href="<?=base_url('Cuotas_Alumno'); ?>">Cuotas</a>
          <div class="dropdown">
            <button type="button" class="btn btn-dark btn-outline-light dropdown-toggle" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-solid fa-circle-user me-1"></i>
              Bienvenido Alumno <?= $nombre?>
            </button>
            <ul class="dropdown-menu position-absolute end-0" aria-labelledby="dropdownMenuButton2">
              <li><a class="dropdown-item" href="<?= base_url('Cerrar-Sesion'); ?>">Cerrar Sesión</a></li>
            </ul>
          </div>
        <?php } else { ?>
            <a type="button" class="btn btn-dark btn-outline-light" href="<?= base_url('Ingresar'); ?>">Ingresar</a>
          <?php } ?>
  </div>
      </div>
    </div>
  </div>
</nav>