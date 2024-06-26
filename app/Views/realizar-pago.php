<body>
  <style type="text/css">
    @media (max-width: 500px){
      .container .card {
        max-width: 90vw;
      }
    }
  </style>
  <?php
  $session = session();
  $cuota_id = $session->get('pago_cuota');
  $alumno_id = $session->get('pago_alumno');
  $cliente_dni = $session->get('id_tipo_usuario');
  ?>
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
            <input name="usuario_nombre" type="text" class="form-control" id="usuario_nombre" value="<?= ?>" readonly >          
          </div>


          <div class="d-flex justify-content-center mt-5">
          <input type="submit" value="Crear Cuenta" class="btn btn-light" style="">
          </div>
        </div>
      </form>
    </div>
  </div>
</body>