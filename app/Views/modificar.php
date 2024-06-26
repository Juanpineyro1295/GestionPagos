<body>
  <div class="container mt-5 mb-5">
    <div class="card bg-dark text-light" style="width: 50vh; margin:auto;">
      <div class= "card-header text-center">
        <h2>Modificar Usuario</h2>
      </div>
      <?php $validation = \Config\Services::validation(); ?>
      <form method="post" action="<?= base_url('edit-form/' .$usuario_buscar['id']) ?>">
        <div class="card-body">
          <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input name="nombre" type="text" class="form-control" id="nombre" value="<?php echo $usuario_buscar['nombre'];?>">
            <?php if($validation->getError('nombre')) {?>
              <div class='alert alert-danger mt-2'>
                <?= $error = $validation->getError('nombre'); ?>
              </div>
            <?php }?>
          </div>

          <div class="mb-3">
            <label for="apellido" class="form-label">Apellido</label>
            <input name="apellido" type="text" class="form-control" id="apellido" value="<?php echo $usuario_buscar['apellido']; ?>">
            <?php if($validation->getError('apellido')) {?>
              <div class='alert alert-danger mt-2'>
                <?= $error = $validation->getError('apellido'); ?>
              </div>
            <?php }?>
          </div>

          <div class="mb-3">
            <label for="email" class="form-label">Correo Electrónico</label>
            <input name="email" type="email" class="form-control" id="email" value="<?php echo $usuario_buscar['email']; ?>">
            <?php if($validation->getError('email')) {?>
              <div class='alert alert-danger mt-2'>
                <?= $error = $validation->getError('email'); ?>
              </div>
            <?php }?>
          </div>
          
          <div class="mb-3">
            <label for="usuario" class="form-label">Nombre de Usuario</label>
            <input name="usuario" type="text" class="form-control" id="usuario" value="<?php echo $usuario_buscar['usuario']; ?>">
            <?php if($validation->getError('usuario')) {?>
              <div class='alert alert-danger mt-2'>
                <?= $error = $validation->getError('usuario'); ?>
              </div>
            <?php }?>
          </div> 
          
          <a class="btn btn-dark" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample" style="position: relative; right: 10px;"> Cambiar Contraseña <i class="fa-solid fa-angle-down"></i></a>
          <div class="collapse" id="collapseExample">
            <div class="input-group mt-2">
              <input name="pass" type="password" class="form-control" id="password" value="">
              <div class="input-group-append">
                <span class="input-group-text" style="cursor: pointer;  width: 50px" onclick="password_show_hide();">&nbsp
                  <i class="fas fa-eye-slash" id="hide_eye"></i>
                  <i class="fas fa-eye d-none" id="show_eye"></i>&nbsp
                </span>              
              </div>
            </div>
            <?php if($validation->getError('pass')) {?>
              <div class='alert alert-danger mt-2'>
                <?= $error = $validation->getError('pass'); ?>
              </div>
            <?php }?>
            <label for="pass" class="form-label mt-3">Confirmar Contraseña</label>
            <div class="input-group mt-2">
              <input name="passconf" type="password" class="form-control" id="pass" value="">
              <div class="input-group-append">
                <span class="input-group-text text-center" style="cursor: pointer; width: 50px;" onclick="password_show_hide2();">&nbsp
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
          </div>

          <div class="input-group mt-4">
            <label for="inputGroupSelect02" class="input-group-text">Perfil de Usuario</label>
            <select name="perfil_id" class="form-select text-end" id="inputGroupSelect02">
              <?php if($usuario_buscar['perfil_id'] == '2'){?>
                <option value="<?= $usuario_buscar['perfil_id'];?>" selected>Usuario Normal</option>
                <option value="1">Administrador</option>
              <?php } else {?>
                <option value="<?= $usuario_buscar['perfil_id'];?>" selected>Administrador</option>
                <option value="2">Usuario Normal</option>
              <?php }?>                
            </select>
          </div>

          <div class="input-group mt-4">
            <label for="inputGroupSelect01" class="input-group-text">Usuario de Baja?</label>
            <select name="baja" class="form-select text-end" id="inputGroupSelect01">
              <option value="<?php echo $usuario_buscar['baja'];?>" selected><?php echo $usuario_buscar['baja'];?></option>
              <?php if($usuario_buscar['baja'] == 'NO'){?>
                <option value="SI">SI</option>
              <?php } else {?>
                <option value="NO">NO</option>
              <?php }?>
            </select>
          </div>
          <div class="d-flex">
            <input type="submit" value="Guardar Cambios" class="btn btn-light mt-3">
            <a type="button" style="margin-left: auto;" class="btn btn-danger text-light mt-3" href="<?= base_url('CRUD-Usuarios');?>">Cancelar</a>
          </div>
        </div>
      </form>
    </div>
  </div>
</body>