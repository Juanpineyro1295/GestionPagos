<body>
  <div class="container mt-5 mb-5">
    <div class="card bg-dark text-light" style="width: 50vh; margin:auto;">
      <div class= "card-header text-center">
        <h2>Modificar Usuario</h2>
      </div>
      <?php $validation = \Config\Services::validation(); ?>
      <form method="post" action="<?php echo base_url('validar-edit-usuario/' .$usuario_buscar['id_usuario']); ?>">
        <div class="card-body">
          <div class="mb-3">
            <label for="usuario_nombre" class="form-label">Nombre</label>
            <input name="usuario_nombre" type="text" class="form-control" id="usuario_nombre" value="<?php echo $usuario_buscar['usuario_nombre'];?>">
            <?php if($validation->getError('usuario_nombre')) {?>
              <div class='alert alert-danger mt-2'>
                <?= $error = $validation->getError('usuario_nombre'); ?>
              </div>
            <?php }?>
          </div>

          <div class="mb-3">
            <label for="usuario_apellido" class="form-label">Apellido</label>
            <input name="usuario_apellido" type="text" class="form-control" id="usuario_apellido" value="<?php echo $usuario_buscar['usuario_apellido']; ?>">
            <?php if($validation->getError('usuario_apellido')) {?>
              <div class='alert alert-danger mt-2'>
                <?= $error = $validation->getError('usuario_apellido'); ?>
              </div>
            <?php }?>
          </div>

          <div class="mb-3">
            <label for="usuario_dni" class="form-label">Dni</label>
            <input name="usuario_dni" type="text" class="form-control" id="usuario_dni" value="<?php echo $usuario_buscar['usuario_dni']; ?>">
            <?php if($validation->getError('usuario_dni')) {?>
              <div class='alert alert-danger mt-2'>
                <?= $error = $validation->getError('usuario_dni'); ?>
              </div>
            <?php }?>
          </div> 

          <div class="mb-3">
            <label for="usuario_telefono" class="form-label">Telefono</label>
            <input name="usuario_telefono" type="text" class="form-control" id="usuario_telefono" value="<?php echo $usuario_buscar['usuario_telefono']; ?>">
            <?php if($validation->getError('usuario_telefono')) {?>
              <div class='alert alert-danger mt-2'>
                <?= $error = $validation->getError('usuario_telefono'); ?>
              </div>
            <?php }?>
          </div> 

          <div class="mb-3">
            <label for="usuario_email" class="form-label">Correo Electrónico</label>
            <input name="usuario_email" type="email" class="form-control" id="usuario_email" value="<?php echo $usuario_buscar['usuario_email']; ?>">
            <?php if($validation->getError('usuario_email')) {?>
              <div class='alert alert-danger mt-2'>
                <?= $error = $validation->getError('usuario_email'); ?>
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
            <select name="id_tipo_usuario" class="form-select text-end" id="inputGroupSelect02">
              <?php if($usuario_buscar['id_tipo_usuario'] == '2'){?>
                <option value="<?= $usuario_buscar['id_tipo_usuario'];?>" selected>Empleado</option>
                <option value="1">Administrador</option>                
                <option value="3">Alumno</option>
              <?php } else if ($usuario_buscar['id_tipo_usuario'] == '1') {?>
                <option value="<?= $usuario_buscar['id_tipo_usuario'];?>" selected>Administrador</option>
                <option value="2">Empleado</option>
                <option value="3">Alumno</option>
              <?php } else {?>                
                <option value="<?= $usuario_buscar['id_tipo_usuario'];?>" selected>Administrador</option>
                <option value="1">Administrador</option>
                <option value="2">Empleado</option>
              <?php }?>
            </select>
          </div>
          <div class="input-group mt-4">
            <label for="inputGroupSelect01" class="input-group-text">Sexo</label>
            <select name="usuario_sexo" class="form-select text-end" id="inputGroupSelect01">
              <option value="<?php echo $usuario_buscar['usuario_sexo'];?>" selected><?php echo $usuario_buscar['usuario_sexo'];?></option>
              <?php if($usuario_buscar['usuario_sexo'] == 'H'){?>
                <option value="M">M</option>
              <?php } else {?>
                <option value="H">H</option>
              <?php }?>
            </select>
          </div>

          <div class="input-group mt-4">
            <label for="inputGroupSelect01" class="input-group-text">Habilitado?</label>
            <select name="baja" class="form-select text-end" id="inputGroupSelect01">
              <option value="<?php echo $usuario_buscar['usuario_habilitado'];?>" selected><?php echo $usuario_buscar['usuario_habilitado'];?></option>
              <?php if($usuario_buscar['usuario_habilitado'] == 'NO'){?>
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