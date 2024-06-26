<body>
  <style type="text/css">
    @media (max-width: 500px){
      .container .card {
        max-width: 90vw;
      }
    }
  </style>
  <div class="container mt-2 mb-5"style="max-width: 470px; margin:auto;">
    <div class="card bg-dark text-light" >
      <div class= "card-header text-center">
        <h2>Crear Cuenta</h2>
      </div>
      <?php $validation = \Config\Services::validation(); ?>
      <form method="post" action="<?php echo base_url('enviar-form') ?>">
        <div class="card-body">
          <?php if (session()->getFlashdata('msg')) { ?>
            <div class="alert alert-warning collapse show" id="collapseExample2">
              <?= session()->getFlashdata('msg');?>
              <a data-bs-toggle="collapse" href="#collapseExample2" role="button" aria-expanded="true" aria-controls="collapseExample2"><i class="fa-solid fa-xmark fa-xl" style="position: absolute; right: 15px; top: 27; color:black;"></i></a>
            </div>
          <?php } ?>
          <div class="mb-3">
            <label for="usuario_nombre" class="form-label">Nombre</label>
            <input name="usuario_nombre" type="text" class="form-control" id="usuario_nombre">
            <?php if($validation->getError('usuario_nombre')) {?>
              <div class='alert alert-danger mt-2'>
                <?= $error = $validation->getError('usuario_nombre'); ?>
              </div>
            <?php }?>
          </div>

          <div class="mb-3">
            <label for="usuario_apellido" class="form-label">Apellido</label>
            <input name="usuario_apellido" type="text" class="form-control" id="usuario_apellido">
            <?php if($validation->getError('usuario_apellido')) {?>
              <div class='alert alert-danger mt-2'>
                <?= $error = $validation->getError('usuario_apellido'); ?>
              </div>
            <?php }?>
          </div>

          <div class="mb-3">
            <label for="usuario_dni" class="form-label">Dni</label>
            <input name="usuario_dni" type="text" class="form-control" id="usuario_dni">
            <?php if($validation->getError('usuario_dni')) {?>
              <div class='alert alert-danger mt-2'>
                <?= $error = $validation->getError('usuario_dni'); ?>
              </div>
            <?php }?>
          </div>

          <div class="mb-3">
            <label for="usuario_telefono" class="form-label">Teléfono</label>
            <input name="usuario_telefono" type="text" class="form-control" id="usuario_telefono">
            <?php if($validation->getError('usuario_telefono')) {?>
              <div class='alert alert-danger mt-2'>
                <?= $error = $validation->getError('usuario_telefono'); ?>
              </div>
            <?php }?>
          </div>

          <div class="input-group mt-4">
            <label for="inputGroupSelect02" class="input-group-text">Tipo de Usuario</label>
            <select name="id_tipo_usuario" class="form-select text-end" id="inputGroupSelect02">
                <option value="1">Administrador</option>
                <option value="2" selected>Empleado</option>
                <option value="3">Alumno</option>
            </select>
          </div>

          <div class="input-group mt-4">
            <label for="inputGroupSelect02" class="input-group-text">Sexo</label>
            <select name="usuario_sexo" class="form-select text-end" id="inputGroupSelect02">
                <option value="H" selected>Hombre</option>
                <option value="M">Mujer</option>
            </select>
          </div>

          <div class="mb-3">
            <label for="usuario_email" class="form-label">Correo Electrónico</label>
            <input name="usuario_email" type="email" class="form-control" id="usuario_email" placeholder="name@example.com">
            <?php if($validation->getError('usuario_email')) {?>
              <div class='alert alert-danger mt-2'>
                <?= $error = $validation->getError('usuario_email'); ?>
              </div>
            <?php }?>
          </div>          
          
          <label for="usuario_contraseña" class="form-label">Contraseña</label>
          <div class="input-group">
            <input name="usuario_contraseña" type="password" class="form-control" id="usuario_contraseña">
            <div class="input-group-append">
              <span class="input-group-text" style="cursor: pointer;" onclick="password_show_hide();">&nbsp
                <i class="fas fa-eye-slash" id="hide_eye"></i>
                <i class="fas fa-eye d-none" id="show_eye"></i>&nbsp
              </span>
            </div>
          </div>
          <?php if($validation->getError('usuario_contraseña')) {?>
            <div class='alert alert-danger mt-2'>
              <?= $error = $validation->getError('usuario_contraseña'); ?>
            </div>
          <?php }?>

          <label for="pass" class="form-label mt-3">Confirmar Contraseña</label>
          <div class="input-group">
            <input name="passconf" type="password" class="form-control" id="pass">
            <div class="input-group-append">
              <span class="input-group-text" style="cursor: pointer;" onclick="password_show_hide2();">&nbsp
                <i class="fas fa-eye-slash" id="hide_eye2"></i>
                <i class="fas fa-eye d-none" id="show_eye2"></i>&nbsp
              </span>
            </div>
          </div>
          <?php if($validation->getError('passconf')) {?>
            <div class='alert alert-danger mt-2'>
              <?= $error = $validation->getError('passconf'); ?>
            </div>
          <?php }?>
          <div class="d-flex justify-content-center mt-5">
          <input type="submit" value="Crear Cuenta" class="btn btn-light" style="">
          </div>
        </div>
      </form>
    </div>
  </div>
</body>