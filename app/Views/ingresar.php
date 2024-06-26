<body>
  <div class="container mt-5 mb-5">
    <div class="card bg-dark text-light" style="max-width: 470px; margin:auto;">
      <div class= "card-header text-center">
        <h2>Ingresar</h2>
      </div>
      <?php $validation = \Config\Services::validation(); ?>
      <form method="post" action="<?php echo base_url('enviar-login') ?>">
        <div class="card-body">
          <?php if(session()->getFlashdata('msg')):?>
            <div class="alert alert-warning">
              <?= session()->getFlashdata('msg') ?>
            </div>
          <?php endif;?>
          <div class="mb-3">
            <label for="usuario_email" class="form-label">Correo Electrónico</label>
            <input name="usuario_email" type="email" class="form-control" id="usuario_email" placeholder="name@example.com">
            <?php if($validation->getError('email')) {?>
              <div class='alert alert-danger mt-2'>
                <?= $error = $validation->getError('email'); ?>
              </div>
            <?php }?>
          </div>          
          <label for="usuario_contraseña" class="form-label">Contraseña</label>
          <div class="input-group">            
            <input name="usuario_contraseña" type="password" class="form-control" id="pass">
            <div class="input-group-append">
                <span class="input-group-text" style="cursor: pointer;" onclick="password_show_hide2();">&nbsp
                  <i class="fas fa-eye-slash" id="hide_eye2"></i>
                  <i class="fas fa-eye d-none" id="show_eye2"></i>&nbsp
                </span>
            </div>
          </div>
          <?php if($validation->getError('usuario_contraseña')) {?>
            <div class='alert alert-danger mt-2'>
              <?= $error = $validation->getError('usuario_contraseña'); ?>
            </div>
          <?php }?>
        <div class="mt-5">
          <input type="submit" value="Ingresar" class="btn btn-light ">
        </div>
          
        </div>
      </form>
    </div>
  </div>
</body>