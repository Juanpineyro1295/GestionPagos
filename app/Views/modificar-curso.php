<body>
  <div class="container mt-5 mb-5">
    <div class="card bg-dark text-light" style="width: 50vh; margin:auto;">
      <div class= "card-header text-center">
        <h2>Modificar Curso</h2>
      </div>
      <?php $validation = \Config\Services::validation(); ?>
      <form method="post" action="<?php echo base_url('validar-edit-curso/' .$curso_buscar['id_curso']); ?>">
        <div class="card-body">
          <div class="mb-3">
            <label for="curso_descripcion" class="form-label">Nombre</label>
            <input name="curso_descripcion" type="text" class="form-control" id="curso_descripcion" value="<?php echo $curso_buscar['curso_descripcion'];?>">
            <?php if($validation->getError('curso_descripcion')) {?>
              <div class='alert alert-danger mt-2'>
                <?= $error = $validation->getError('curso_descripcion'); ?>
              </div>
            <?php }?>
          </div>

          <div class="mb-3">
            <label for="curso_precio" class="form-label">Precio</label>
            <input name="curso_precio" type="text" class="form-control" id="curso_precio" value="<?php echo $curso_buscar['curso_precio']; ?>">
            <?php if($validation->getError('curso_precio')) {?>
              <div class='alert alert-danger mt-2'>
                <?= $error = $validation->getError('curso_precio'); ?>
              </div>
            <?php }?>
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
                  if ($idioma['id_idioma'] == $curso_buscar['id_idioma']) {
              ?>
                  <option value="<?= $idioma['id_idioma'] ?>" selected><?= $idioma['idioma_descripcion'] ?></option>
            <?php } else { ?>
                  <option value="<?= $idioma['id_idioma'] ?>"><?= $idioma['idioma_descripcion'] ?></option>
              <?php
                }
              }}
              ?>
            </select>
          </div>
          <div class="input-group mt-4">
            <label for="inputGroupSelect01" class="input-group-text">Habilitado?</label>
            <select name="curso_habilitado" class="form-select text-end" id="inputGroupSelect01">
              <option value="<?php echo $curso_buscar['curso_habilitado'];?>" selected><?php echo $curso_buscar['curso_habilitado'];?></option>
              <?php if($curso_buscar['curso_habilitado'] == 'NO'){?>
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