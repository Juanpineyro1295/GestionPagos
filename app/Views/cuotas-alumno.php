<body>  
  <script>
    $(document).ready( function () {
      $('#users-list').DataTable({
        "autoWidth": false,
        "ordering": false,
        "language": {
          "paginate": {
            "previous": "Anterior",
            "next": "Siguiente"
          },
          "lengthMenu": 'Mostrar <select>'+
            '<option value="10">10</option>'+
            '<option value="20">20</option>'+
            '<option value="30">30</option>'+
            '<option value="40">40</option>'+
            '<option value="50">50</option>'+
            '<option value="100">100</option>'+
            '</select> resultados',
          "search": "Buscar: ",
          "zeroRecords": "No se encontraron resultados",
          "emptyTable": "No hay datos registrados en la tabla",
          "info": "Mostrando _END_ / _TOTAL_ resultados",
          "infoEmpty": "Mostrando 0 / 0 resultados",
          "infoFiltered": "(Busqueda hecha en _MAX_ resultados)",
        },
      });
    });
  </script>
  <?php
    Use App\Models\Usuarios_model;
    Use App\Models\Idioma_model;
    Use App\Models\Cuota_detalle_model;
    Use App\Models\Cuota_model;
    Use App\Models\Curso_model;
    Use App\Models\Pago_model;

    $db = \Config\Database::connect();
    
    $pago_model = new Pago_model();
    $usuario_model = new Usuarios_model();
    $curso_model = new Curso_model();
    $cuota_detalle_model = new Cuota_detalle_model();
    $idioma_model = new Idioma_model();
    $cuota_model = new Cuota_model();

    $session = session();
    $tipo_view = $session->get('id_tipo_usuario');
    if ($session->get('pago_alumno') == '') {
      $id_usuario = $session->get('id_usuario');
      $nombre = $session->get('usuario_nombre');
    } else {
      $id_usuario = $session->get('pago_alumno');
      $alumno = $usuario_model->where('id_usuario',$session->get('pago_alumno'))->first();
      $nombre = $alumno['usuario_nombre'];
      $id_cuota_modal = 0;
    } ?>    
  <div class="text-light mt-5 mb-5" style="width:95%; margin:auto;">
    <div class="card bg-dark">
      <div class= "card-header text-center">
        <h2>Cuotas de <?= $nombre; ?></h2>
      </div>
      <div class="card-body table-responsive-xxl align-right">
        <?php if (session()->getFlashdata('msg')) { ?>
          <div class="alert alert-warning collapse show mb-2" id="collapseExample2">
            <?= session()->getFlashdata('msg'); ?>
            <a data-bs-toggle="collapse" href="#collapseExample2" role="button" aria-expanded="true" aria-controls="collapseExample2"><i class="fa-solid fa-xmark fa-xl" style="position: absolute; right: 15px; top: 27px;color: black;"></i></a>
          </div>
        <?php }
        if ($tipo_view == 2) {?>
          <a type="button" class="btn btn-danger btn-outline-light" href="<?php echo base_url('Pago-Empleado-Alumno');?>">
            <i class="fa-solid fa-arrow-left fa-xl"></i>Volver
          </a>

    <?php }
    $cuotas = $cuota_model->findAll();
    if (count($cuotas) > 0) { 
      ?>
        <table id="users-list" class="table-striped sortable table table-dark table-bordered table-hover border border-1 mt-5">
          <thead class="table-light" style="height: 20px;">
            <tr>
              <th class="num" aria-sort="ascending">
                <button>
                  Curso
                  <span aria-hidden="true"></span>
                </button>
              </th>
              <th class="num">
                <button>
                  Idioma
                  <span aria-hidden="true"></span>
                </button>
              </th>
              <th>
                <button>
                  Monto Curso
                  <span aria-hidden="true"></span>
                </button>
              </th>
              <th>
                <button>
                  Fecha
                  <span aria-hidden="true"></span>
                </button>
              </th>
              <th>
                <button>
                  Monto Total
                  <span aria-hidden="true"></span>
                </button>
              </th>
              <th class="num" style="width: 150px;">
                <button>
                  Pago Realizado
                  <span aria-hidden="true"></span>
                </button>
              </th>
            </tr>
          </thead>
          <tbody>
          <?php
              $cuotas_alumno = $cuota_model->where('id_usuario_alumno', $id_usuario)->findAll();
              foreach($cuotas_alumno as $cuota) {
                $cuota_detalle = $cuota_detalle_model->where('id_cuota', $cuota["id_cuota"])->findAll();
                if (count($cuota_detalle) > 1) {
                  $cuota_precio = 0; 
                  $cant_detalles = count($cuota_detalle);
                  $i = 0;
                  ?>

            <?php foreach ($cuota_detalle as $detalle) {
                    $curso = $curso_model->where('id_curso', $detalle["id_curso"])->first();
                    $idioma = $idioma_model->where('id_idioma', $curso["id_idioma"])->first();?>
                  <tr>
                    <td  class="text-center align-middle"><?= $curso["curso_descripcion"]; ?></td>
                    <td  class="text-center align-middle"><?= $idioma["idioma_descripcion"]; ?></td>
                    <td  class="text-center align-middle"><?= $detalle["cuota_detalle_monto"]; ?></td>
              <?php if ($i == 0) {?>
                    <td rowspan="<?= $cant_detalles?>" class="text-center align-middle"><?= $cuota["cuota_fecha"]; ?></td>
                    <td rowspan="<?= $cant_detalles?>" class="text-center align-middle"><?= $cuota["cuota_monto"]; ?></td>
                    <?php
                    $pago = $pago_model->where('id_cuota', $cuota['id_cuota'])->first();
                    if (!$pago && $tipo_view == 2) {?>
                    <td rowspan="<?= $cant_detalles?>">
                      <a type="button" class="btn btn-success btn-outline-light d-block" onclick="<?php $session->set('pago_cuota', $cuota["id_cuota"]);?>" href="<?php echo base_url('Pago-Empleado-Cliente');?>">
                        Seleccionar Cuota
                      </a>
                    </td>

                    <?php } else {?>
                      <td>Comprobante</td>
                    <?php } ?>
              <?php }?>
                  </tr>
          <?php
                    $i++;
                  } ?>

          <?php } else {
                $detalle = $cuota_detalle_model->where('id_cuota', $cuota["id_cuota"])->first();
                $curso = $curso_model->where('id_curso', $detalle["id_curso"])->first();
                $idioma = $idioma_model->where('id_idioma', $curso["id_idioma"])->first();?>

                  <tr>
                    <td class="text-center align-middle"><?= $curso["curso_descripcion"]; ?></td>
                    <td class="text-center align-middle"><?= $idioma["idioma_descripcion"]; ?></td>
                    <td class="text-center align-middle"><?= $detalle["cuota_detalle_monto"]; ?></td>
                    <td class="text-center align-middle"><?= $cuota["cuota_fecha"]; ?></td>
                    <td class="text-center align-middle"><?= $cuota["cuota_monto"]; ?></td>
                    <?php
                    $pago = $pago_model->where('id_cuota', $cuota['id_cuota'])->first();
                    if (!$pago && $tipo_view == 2) {?>
                      <td>
                      <a type="button" class="btn btn-success btn-outline-light d-block" onclick="<?php $session->set('pago_cuota', $cuota["id_cuota"]);?>" href="<?php echo base_url('Pago-Empleado-Cliente');?>">
                        Seleccionar Cuota
                      </a>
                    </td>

                    <?php } else {?>
                      <td>Comprobante</td>

                    <?php } ?>
                  </tr>

                <?php }
              } ?>
          </tbody>



        </table>
      </div>
    </div>
  </div>
        <?php } else { ?>
            <p class="text-center">NO HAY FACTURAS EN LA BASE DE DATOS</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php } ?>
</body>

<style type="text/css">
  .image_with_badge_container {
    display: inline-block; /* keeps the img with the badge if the img is forced to a new line */
    position: relative;
    margin-bottom: 5px;
  }
  .badge-on-image-blue {
    position: absolute;
    bottom: 0%; /* position where you want it */
    right: 80%;
  }
  .badge-on-image-red {
    position: absolute;
    bottom: 85%; /* position where you want it */
    left: 90%;
  }

  .dataTables_wrapper .dataTables_length, .dataTables_wrapper .dataTables_filter, .dataTables_wrapper .dataTables_info, .dataTables_wrapper .dataTables_processing, .dataTables_wrapper .dataTables_paginate {
    color: #FFFFFF;
    margin-bottom: 20px;
  }

  table.dataTable thead th {
    padding: ;
  }

  table.dataTable {
    margin-bottom: 20px;
  }

  .dataTables_wrapper .dataTables_filter input {    
    background-color: #FFFFFF;    
  }

  .dataTables_wrapper .dataTables_paginate .paginate_button.current, .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
    color: #FFFFFF!important;
    background: null!important;
  }

  .dataTables_wrapper .dataTables_length select {
    background-color: #FFFFFF;
  }

  .dataTables_wrapper .dataTables_paginate .paginate_button.disabled, .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:hover, .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:active {
    color: #ffffff !important;
  }

  .dataTables_wrapper .dataTables_paginate .paginate_button {
    color: #ffffff !important;
  }

  table.sortable td, table.sortable th {
  
  }

  table.sortable th {
    font-weight: bold;
    position: relative;
  }

  table.sortable th.no-sort {
    padding-top: 0.35em;
  }
  
  table.sortable th:nth-child(5) {
    width: 10em;
  }
  
  table.sortable th button {
    padding: 4px;
    margin: 1px;
    font-size: 100%;
    font-weight: bold;
    background: transparent;
    border: none;
    display: inline;
    width: 100%;
    text-align: left;
    outline: none;
    cursor: pointer;
    color: dark;
  }

  table.sortable th button span {
    position: absolute;
    right: 4px;
  }

  table.sortable th[aria-sort="descending"] span::after {
    content: "▼";
    color: currentcolor;
    font-size: 100%;
    top: 0;
  }

  table.sortable th[aria-sort="ascending"] span::after {
    content: "▲";
    color: currentcolor;
    font-size: 100%;
  }

  table.show-unsorted-icon th:not([aria-sort]) button span::after {
    content: "♢";
    color: currentcolor;
    font-size: 100%;
    position: relative;
    top: -3px;
    left: -4px;
  }

  table.sortable td.num {
    text-align: right;
  }

  table.sortable tbody tr:nth-child(odd) {
    background-color: #ddd;
  }

  table.sortable th button:focus,
  table.sortable th button:hover {
    background-color:white;
    color: black;
    font-size: 100%;
  }
  
  table.sortable th button:focus span,
  table.sortable th button:hover span {
    right: 4px;
    font-size: 100%;
  }

  table.sortable th:not([aria-sort]) button:focus span::after,
  table.sortable th:not([aria-sort]) button:hover span::after {
    content: "▼";
    color: white;
    font-size: 100%;
    top: 0;
  }
</style>
<script type="text/javascript">
  $(".pop").on("click", function() {
    $('.imagepreview').attr('src', $(this).find('img').attr('src')); // here asign the image to the modal when the user click the enlarge link
    $('#exampleModal').modal('show'); // imagemodal is the id attribute assigned to the bootstrap modal, then i use the show function
  });

  class SortableTable {
  constructor(tableNode) {
    this.tableNode = tableNode;

    this.columnHeaders = tableNode.querySelectorAll('thead th');

    this.sortColumns = [];

    for (var i = 0; i < this.columnHeaders.length; i++) {
      var ch = this.columnHeaders[i];
      var buttonNode = ch.querySelector('button');
      if (buttonNode) {
        this.sortColumns.push(i);
        buttonNode.setAttribute('data-column-index', i);
        buttonNode.addEventListener('click', this.handleClick.bind(this));
      }
    }

    this.optionCheckbox = document.querySelector(
      'input[type="checkbox"][value="show-unsorted-icon"]'
    );

    if (this.optionCheckbox) {
      this.optionCheckbox.addEventListener(
        'change',
        this.handleOptionChange.bind(this)
      );
      if (this.optionCheckbox.checked) {
        this.tableNode.classList.add('show-unsorted-icon');
      }
    }
  }

  setColumnHeaderSort(columnIndex) {
    if (typeof columnIndex === 'string') {
      columnIndex = parseInt(columnIndex);
    }

    for (var i = 0; i < this.columnHeaders.length; i++) {
      var ch = this.columnHeaders[i];
      var buttonNode = ch.querySelector('button');
      if (i === columnIndex) {
        var value = ch.getAttribute('aria-sort');
        if (value === 'descending') {
          ch.setAttribute('aria-sort', 'ascending');
          this.sortColumn(
            columnIndex,
            'ascending',
            ch.classList.contains('num')
          );
        } else {
          ch.setAttribute('aria-sort', 'descending');
          this.sortColumn(
            columnIndex,
            'descending',
            ch.classList.contains('num')
          );
        }
      } else {
        if (ch.hasAttribute('aria-sort') && buttonNode) {
          ch.removeAttribute('aria-sort');
        }
      }
    }
  }

  sortColumn(columnIndex, sortValue, isNumber) {
    function compareValues(a, b) {
      if (sortValue === 'ascending') {
        if (a.value === b.value) {
          return 0;
        } else {
          if (isNumber) {
            return a.value - b.value;
          } else {
            return a.value < b.value ? -1 : 1;
          }
        }
      } else {
        if (a.value === b.value) {
          return 0;
        } else {
          if (isNumber) {
            return b.value - a.value;
          } else {
            return a.value > b.value ? -1 : 1;
          }
        }
      }
    }

    if (typeof isNumber !== 'boolean') {
      isNumber = false;
    }

    var tbodyNode = this.tableNode.querySelector('tbody');
    var rowNodes = [];
    var dataCells = [];

    var rowNode = tbodyNode.firstElementChild;

    var index = 0;
    while (rowNode) {
      rowNodes.push(rowNode);
      var rowCells = rowNode.querySelectorAll('th, td');
      var dataCell = rowCells[columnIndex];

      var data = {};
      data.index = index;
      data.value = dataCell.textContent.toLowerCase().trim();
      if (isNumber) {
        data.value = parseFloat(data.value);
      }
      dataCells.push(data);
      rowNode = rowNode.nextElementSibling;
      index += 1;
    }

    dataCells.sort(compareValues);

    // remove rows
    while (tbodyNode.firstChild) {
      tbodyNode.removeChild(tbodyNode.lastChild);
    }

    // add sorted rows
    for (var i = 0; i < dataCells.length; i += 1) {
      tbodyNode.appendChild(rowNodes[dataCells[i].index]);
    }
  }

  /* EVENT HANDLERS */

  handleClick(event) {
    var tgt = event.currentTarget;
    this.setColumnHeaderSort(tgt.getAttribute('data-column-index'));
  }

  handleOptionChange(event) {
    var tgt = event.currentTarget;

    if (tgt.checked) {
      this.tableNode.classList.add('show-unsorted-icon');
    } else {
      this.tableNode.classList.remove('show-unsorted-icon');
    }
  }
  }

  window.addEventListener('load', function () {
    var sortableTables = document.querySelectorAll('table.sortable');
    for (var i = 0; i < sortableTables.length; i++) {
      new SortableTable(sortableTables[i]);
    }
  });
</script>