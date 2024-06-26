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

    $usuarios = new Usuarios_model();
    $cursos = new Curso_model();
    $cuotas_detalle = new Cuota_detalle_model();
    $idiomas = new Idioma_model();
    $cuotas_model = new Cuota_model();
    $pago_model = new Pago_model();

    $id_usuario = $usuario['id_usuario'];
    $nombre = $usuario['usuario_nombre'];
  ?>    
  <div class="text-light mt-5 mb-5" style="width:95%; margin:auto;">
    <div class="card bg-dark">
      <div class= "card-header text-center">
        <h2>Cuotas de <?= $nombre?></h2>
      </div>
      <div class="card-body table-responsive-xxl align-right">
        <?php if (session()->getFlashdata('msg')) { ?>
          <div class="alert alert-warning collapse show mb-2" id="collapseExample2">
            <?= session()->getFlashdata('msg'); ?>
            <a data-bs-toggle="collapse" href="#collapseExample2" role="button" aria-expanded="true" aria-controls="collapseExample2"><i class="fa-solid fa-xmark fa-xl" style="position: absolute; right: 15px; top: 27px;color: black;"></i></a>
          </div>
        <?php } 
          $cuotas_alumno = $cuotas_model->where('id_usuario_alumno', $id_usuario)->findAll();
          if (count($cuotas_alumno) > 0) { ?>
        <table id="users-list" class="sortable table table-dark table-bordered table-hover border border-1 mt-5">
          <thead class="table-light" style="height: 80px;">
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
                  Fecha
                  <span aria-hidden="true"></span>
                </button>
              </th>
              <th>
                <button>
                  Monto
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
              foreach($cuotas_alumno as $row) {
            $cuota_detalle = $cuotas_detalle->where('id_cuota', $row["id_cuota"])->first();            

              $cursos_cuota = $cuotas_detalle->where('id_cuota', $row["id_cuota"])->findAll();
              
              foreach ($cursos_cuota as $curso) { 
                $curso_alumno = $cursos->where('id_curso', $curso["id_curso"])->first();
                $idioma = $idiomas->where('id_idioma', $curso_alumno["id_idioma"])->first();?>

            <tr>
              <td class="text-center align-middle"><?= $curso_alumno["curso_descripcion"]; ?></td>
              <td class="text-center align-middle"><?= $idioma["idioma_descripcion"]; ?></td>
              <td class="text-center align-middle"><?= $row["cuota_fecha"]; ?></td>
              <td class="text-center align-middle"><?= $curso_alumno["curso_precio"]; ?></td>

              <?php
              $pago_alumno = $pago_model->where('id_cuota', $row['id_cuota'])->first();
              if ($pago_alumno) {
              ?>
              <td class="text-center align-middle"><a href="<?= base_url('comprobante/'.$row["id_cuota"]);?>">Comprobante</a></td>
              <?php
              } else {
              ?>
              <td><a type="button" class="btn btn-success btn-outline-light d-block" href="<?= $this->session->set_userdata('pago_cuota', $row["id_cuota"]); echo base_url('CRUD-Clientes');?>">Realizar Pago</a></td>
              <?php 
              }
              ?>
              </tr>
              <?php 
            }  } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
        <?php } else { ?>
            <p class="text-center">ESTE ALUMNO NO TIENE CUOTAS</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php }
  ?>
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content" height="1000" width="1000">
        <div class="modal-header">
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <img src="" id="" class="img-radius w-100 imagepreview" style="" alt="User-Profile-Image">
        </div>
      </div>
    </div>
  </div>
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