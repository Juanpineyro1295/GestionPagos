<body>
  <style type="text/css">
    @media (max-width: 500px){
      .container .card {
        max-width: 90vw;
      }
    }

    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
      -webkit-appearance: none;
      margin: 0;
    }

    .custom-file-button input[type=file] {
  margin-left: -2px !important;
}

.custom-file-button input[type=file]::-webkit-file-upload-button {
  display: none;
}

.custom-file-button input[type=file]::file-selector-button {
  display: none;
}

.custom-file-button:hover label {
  background-color: #dde0e3;
  cursor: pointer;
}
  </style>
  <div class="container mt-5">
    <div class="card bg-dark text-light" style="width: 470px; margin:auto;">
      <div class= "card-header text-center">
        <h2>Agregar Camiseta</h2>
      </div>
      <?php $validation = \Config\Services::validation(); ?>
      <form method="post" action="<?= base_url('error-producto') ?>" enctype="multipart/form-data">
        <div class="card-body">
          <?php if (session()->getFlashdata('msg')) { ?>
            <div class="alert alert-warning collapse show" id="collapseExample2">
              <?= session()->getFlashdata('msg');?>
              <a data-bs-toggle="collapse" href="#collapseExample2" role="button" aria-expanded="true" aria-controls="collapseExample2"><i class="fa-solid fa-xmark fa-xl" style="position: absolute; right: 15px; top: 27;"></i></a>
            </div>
          <?php } ?>

          <div class="form-floating mb-3">
            <input name="nombre" type="text" class="form-control" id="nombre" placeholder="A" required>
            <label for="nombre" class="text-dark">Nombre de Club</label>
            <?php if($validation->getError('nombre')) { ?>
              <div class='alert alert-danger mt-2'>
                <?= $error = $validation->getError('nombre');?>
              </div>
            <?php }?>
          </div>            

          <div class="input-group mb-3">
            <label for="liga" class="input-group-text">Liga</label>
            <select name="categoria_id" class="form-select" id="liga" required>
              <option value="" disabled selected>Seleccione la liga en la que compite el equipo</option>
              <option value="1">Premier League</option>
              <option value="2">La Liga</option>
              <option value="3">Serie A</option>
              <option value="4">Bundesliga</option>
              <option value="5">Ligue 1</option>
              <option value="6">Primera División Argentina</option>
            </select>
          </div>

          <div class="row mb-3">
            <div class="col form-floating">
              <input name="precio" type="number" class="form-control text-end" id="precio" placeholder="A" required>
              <label for="precio" class="text-dark" style="margin-left:11px;">Precio</label>
              <?php if($validation->getError('precio')) { ?>
                <div class='alert alert-danger mt-2'>
                  <?= $error = $validation->getError('precio');?>
                </div>
              <?php } ?>
            </div>            
            <div class="col form-floating">
              <input name="stock" type="number" class="form-control text-end" id="stock" placeholder="A" required>
              <label for="stock" class="text-dark" style="margin-left:11px;">Stock</label>
              <?php if($validation->getError('stock')) { ?>
                <div class='alert alert-danger mt-2'>
                  <?= $error = $validation->getError('stock');?>
                </div>
              <?php } ?>
            </div>
          </div>
          <div class="mb-3">
            <div class="input-group custom-file-button">
              <label class="input-group-text" for="imagen">Seleccionar imagen</label>
              <input name="imagen" type="file" class="form-control" id="imagen" accept="image/*" required>
            </div>
            <?php if($validation->getError('imagen')) {?>
              <div class='alert alert-danger mt-2'>
                <?= $error = $validation->getError('imagen');?>
              </div>
            <?php }?>
          </div>
          <div class="d-flex justify-content-center mt-5">
          <input type="submit" value="Agregar Camiseta" class="btn btn-light" style="">
          </div>
        </div>
      </form>
    </div>
  </div>
</body>