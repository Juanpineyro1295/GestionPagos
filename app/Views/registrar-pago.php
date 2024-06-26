<body>
  <style type="text/css">
    @media (max-width: 500px){
      .container .card {
        max-width: 90vw;
      }
    }
  </style>
  <?php
  Use App\Models\Pago_model;
  Use App\Models\Usuarios_model;
  Use App\Models\Cliente_model;
  Use App\Models\Cuota_model;
  Use App\Models\Curso_model;
  Use App\Models\Cuota_detalle_model;

  $session = session();
  $cuota_id = $session->get('pago_cuota');
  $alumno_id = $session->get('pago_alumno');
  $cliente_dni = $session->get('id_tipo_usuario');

helper('date');

$tz = 'America/Argentina/Buenos_Aires';
$timestamp = time();
$dt = new DateTime("now", new DateTimeZone($tz)); //first argument "must" be a string
$dt->setTimestamp($timestamp); //adjust the object to correct timestamp
$hora = $dt->format('H:i:s');

  $usuario_model = new Usuarios_model();
  $cuota_model = new Cuota_model();
  $cliente_model = new Cliente_model();

  $alumno = $usuario_model->where('id_usuario', $session->get('pago_alumno'))->first();
  $cliente = $cliente_model->where('dni_cliente', $session->get('pago_cliente'))->first();
  $cuota = $cuota_model->where('id_cuota', $session->get('pago_cuota'))->first();
  ?>
  <div class="container mt-2 mb-5"style="max-width: 470px; margin:auto;">
    <div class="card bg-dark text-light" >
      <div class= "card-header text-center">
        <h2>Confirmar Pago</h2>
      </div>
      <?php $validation = \Config\Services::validation(); ?>
      <form method="post" action="<?php echo base_url('realizar-pago');?>">
        <div class="card-body">
          <?php if (session()->getFlashdata('msg')) { ?>
            <div class="alert alert-warning collapse show" id="collapseExample2">
              <?= session()->getFlashdata('msg');?>
              <a data-bs-toggle="collapse" href="#collapseExample2" role="button" aria-expanded="true" aria-controls="collapseExample2"><i class="fa-solid fa-xmark fa-xl" style="position: absolute; right: 15px; top: 27; color:black;"></i></a>
            </div>
          <?php } ?>

          <ul class="list-group">
            <li class="list-group-item"><?= 'Alumno: ' .$alumno['usuario_nombre'].' '.$alumno['usuario_apellido'].' - DNI: '.$alumno['usuario_dni'];?></li>
            <li class="list-group-item"><?= 'Cliente: ' .$cliente['cliente_nombre'].' '.$cliente['cliente_apellido'].' - DNI: '.$cliente['dni_cliente'];?></li>
            <li class="list-group-item"><?= 'Fecha cuota: ' .$cuota['cuota_fecha'];?></li>
            <li class="list-group-item"><?= 'Monto cuota: ' .$cuota['cuota_monto'];?></li>
          </ul>

          <div class="input-group mt-4">
            <label for="id_tipo_pago" class="input-group-text">Tipo de Pago</label>
            <select name="id_tipo_pago" class="form-select text-end" id="id_tipo_pago">
                <option value="1">Tarjeta</option>
                <option value="2" selected>Efectivo</option>
            </select>
          </div>

          <div class="d-flex justify-content-center mt-5">
            <a type="button" class="btn btn-danger btn-outline-light me-2 btn-sm" href="<?= base_url('Pago-Empleado-Alumno');?>">Cancelar</a>
            <input type="submit" value="Confirmar Pago" class="btn btn-light" style="">
          </div>
        </div>
      </form>
    </div>
  </div>
</body>