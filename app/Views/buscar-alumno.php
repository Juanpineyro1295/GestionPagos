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
        <h2>Buscar Cuotas de Alumno</h2>
      </div>
      <?php $validation = \Config\Services::validation(); ?>
      <form method="post" action="<?php echo base_url('buscar-cuotas-alumno') ?>">
        <div class="card-body">
          <?php if (session()->getFlashdata('msg')) { ?>
            <div class="alert alert-warning collapse show" id="collapseExample2">
              <?= session()->getFlashdata('msg');?>
              <a data-bs-toggle="collapse" href="#collapseExample2" role="button" aria-expanded="true" aria-controls="collapseExample2"><i class="fa-solid fa-xmark fa-xl" style="position: absolute; right: 15px; top: 27; color:black;"></i></a>
            </div>
          <?php } ?>
          <div class="mb-3">
            <label for="alumno_dni" class="form-label">Dni Alumno</label>
            <input name="alumno_dni" type="text" class="form-control" id="alumno_dni" required="required"
              oninvalid="this.setCustomValidity('Ingrese un DNI')"
              oninput ="this.setCustomValidity('')"
              onchange="this.setCustomValidity('')">
          </div>
          
          <div class="d-flex justify-content-center mt-5">
          <input type="submit" value="Buscar Cuotas" class="btn btn-light" style="">
          </div>
        </div>
      </form>
    </div>
  </div>
</body>