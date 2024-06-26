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
        <h2>Crear Curso</h2>
      </div>
      <?php $validation = \Config\Services::validation(); ?>
      <form method="post" action="<?php echo base_url('validar-curso') ?>">
        <div class="card-body">
          <?php if (session()->getFlashdata('msg')) { ?>
            <div class="alert alert-warning collapse show" id="collapseExample2">
              <?= session()->getFlashdata('msg');?>
              <a data-bs-toggle="collapse" href="#collapseExample2" role="button" aria-expanded="true" aria-controls="collapseExample2"><i class="fa-solid fa-xmark fa-xl" style="position: absolute; right: 15px; top: 27; color:black;"></i></a>
            </div>
          <?php } ?>
          <div class="mb-3">
            <?php if($validation->getError('curso_descripcion')) { ?>
              <div class='alert alert-danger mt-2'>
                <?= $error = $validation->getError('curso_descripcion'); ?>
              </div>
            <?php }?>
            <label for="curso_descripcion" class="form-label">Nombre de Curso</label>
            <input name="curso_descripcion" type="text" class="form-control" id="curso_descripcion">           
          </div>
          <div class="input-group mb-3 mt-4">
            <label for="curso_idioma" class="input-group-text">Idioma</label>
            <select name="curso_idioma" class="form-select text-end" id="curso_idioma">
              <?php 
              Use App\Models\Idioma_model;
              $idiomas_model = new Idioma_model();
              $idiomas = $idiomas_model->findAll();
              if (count($idiomas) > 0) {
                foreach($idiomas as $idioma) {
              ?>
                  <option value="<?= $idioma['id_idioma'] ?>"><?= $idioma['idioma_descripcion'] ?></option>
              <?php
                }
              }
              ?>
            </select>
          </div>
          <?php if($validation->getError('curso_precio')) {?>
              <div class='alert alert-danger mt-2'>
                <?= $error = $validation->getError('curso_precio'); ?>
              </div>
            <?php }?>
          <div class="input-group mb-3">
            <label for="curso_precio" class="input-group-text">Precio</label>
            <input name="curso_precio" type="text" class="form-control" id="curso_precio">            
          </div>
          <div class="d-flex justify-content-center mt-5">
            <input type="submit" value="Crear Curso" class="btn btn-light" style="">
          </div>
        </div>
      </form>
    </div>
  </div>
</body>