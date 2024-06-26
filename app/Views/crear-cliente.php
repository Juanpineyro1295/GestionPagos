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
        <h2>Crear Cliente</h2>
      </div>

      <?php $validation = \Config\Services::validation(); ?>
      <form method="post" action="<?php echo base_url('validar-cliente') ?>">
        <div class="card-body">
          <a type="button" class="btn btn-danger btn-outline-light" href="<?php echo base_url('Pago-Empleado-Cliente');?>">
            <i class="fa-solid fa-arrow-left fa-xl"></i>Volver
          </a>
          <?php if (session()->getFlashdata('msg')) { ?>
            <div class="alert alert-warning collapse show" id="collapseExample2">
              <?= session()->getFlashdata('msg');?>
              <a class="" data-bs-toggle="collapse" href="#collapseExample2" role="button" aria-expanded="true" aria-controls="collapseExample2"><i class="fa-solid fa-xmark fa-xl" style="position: absolute; right: 15px; top: 27; color:black;"></i></a>
            </div>
          <?php } ?>
          <div class="mt-3 mb-3">
            <label for="cliente_nombre" class="form-label">Nombre</label>
            <input name="cliente_nombre" type="text" class="form-control" id="cliente_nombre">
            <?php if($validation->getError('cliente_nombre')) {?>
              <div class='alert alert-danger mt-2'>
                <?= $error = $validation->getError('cliente_nombre'); ?>
              </div>
            <?php }?>
          </div>

          <div class="mb-3">
            <label for="cliente_apellido" class="form-label">Apellido</label>
            <input name="cliente_apellido" type="text" class="form-control" id="cliente_apellido">
            <?php if($validation->getError('cliente_apellido')) {?>
              <div class='alert alert-danger mt-2'>
                <?= $error = $validation->getError('cliente_apellido'); ?>
              </div>
            <?php }?>
          </div>

          <div class="mb-3">
            <label for="dni_cliente" class="form-label">Dni</label>
            <input name="dni_cliente" type="text" class="form-control" id="dni_cliente">
            <?php if($validation->getError('dni_cliente')) {?>
              <div class='alert alert-danger mt-2'>
                <?= $error = $validation->getError('dni_cliente'); ?>
              </div>
            <?php }?>
          </div>
          <div class="d-flex justify-content-center mt-5">
          <input type="submit" value="Crear Cliente" class="btn btn-light" style="">
          </div>
        </div>
      </form>
    </div>
  </div>
</body>