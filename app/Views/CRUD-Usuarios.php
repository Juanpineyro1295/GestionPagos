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
  } );
  </script>
  <?php
    Use App\Models\Usuarios_model;
    Use App\Models\Idioma_model;
    Use App\Models\Tipo_usuario_model;

    $usuarios_model = new Usuarios_model();
    $tipos_de_usuarios = new Tipo_usuario_model();
    $session = session();
    $tipo_view = $session->get('id_tipo_usuario');
     ?>
      <div class="text-light mt-5 mb-5" style="width:95%; margin:auto;">
        <div class="card bg-dark">
          <div class= "card-header text-center">
            <?php switch ($tipo_view) {
                    case 1: ?>
                      <h2>Gestionar Usuarios</h2>
              <?php break;
                    case 2: ?>
                      <h2>Seleccionar Alumno</h2>
              <?php break;
                  } ?>
          </div>
          <div class="card-body table-responsive-xxl align-right">
            <?php if (session()->getFlashdata('msg')) { ?>
              <div class="alert alert-warning collapse show mb-2" id="collapseExample2">
                <?= session()->getFlashdata('msg'); ?>
                <a data-bs-toggle="collapse" href="#collapseExample2" role="button" aria-expanded="true" aria-controls="collapseExample2"><i class="fa-solid fa-xmark fa-xl" style="position: absolute; right: 15px; top: 27px;color: black;"></i></a>
              </div>
            <?php } 
            if ($tipo_view == 1) {
            ?>
            <div class="d-flex">
              <a type="button" style="margin-left: auto;" class="btn btn-light text-dark mb-3" href="<?= base_url('Crear-Cuenta');?>">Agregar Usuario</a>
            </div>
          <?php }?>
            <table id="users-list" class="sortable table table-dark table-bordered table-hover border border-1 mt-5">
              </div>
              <thead class="table-light">
                <tr>
                  <th class="num text-center" aria-sort="ascending" style="width: 50px;">
                    <button>
                      ID
                      <span aria-hidden="true"></span>
                    </button>
                  </th>
                  <th class="text-center">
                    <button>
                      Nombre
                      <span aria-hidden="true"></span>
                    </button>
                  </th>
                  <th class="text-center">
                    <button>
                      Apellido
                      <span aria-hidden="true"></span>
                    </button>
                  </th>
                  <th class="num text-center">
                    <button>
                      DNI
                      <span aria-hidden="true"></span>
                    </button>
                  </th>
                  <?php if ($tipo_view == 1) { ?>
                  <th class="text-center">
                    <button>
                      Email
                      <span aria-hidden="true"></span>
                    </button>
                  </th>
                  <th class="num text-center">
                    <button>
                      Telefono
                      <span aria-hidden="true"></span>
                    </button>
                  </th>
                  <th class="text-center" style="width: 100px;">
                    <button>
                      Tipo
                      <span aria-hidden="true"></span>
                    </button>
                  </th>
                  <th class="text-center">
                    <button>
                      Sexo
                      <span aria-hidden="true"></span>
                    </button>
                  </th>
                  <th class="text-center" style="width: 80px;">
                    <button>
                      Habilitado
                      <span aria-hidden="true"></span>
                    </button>
                  </th>
                  <?php } ?>
                  <th class="no-sort align-top user-select-none" style="width: 180px; text-align: center;  padding-right: 10px; padding-left: 10px;">
                    <?php if ($tipo_view == 1){ 
                            echo 'Modificar'; 
                          } else { 
                            echo 'Seleccionar';
                          } ?>
                  </th>
                </tr>
              </thead>
              <tbody>
    <?php
    $usuarios = $usuarios_model->findAll();
    if (count($usuarios) > 0) { 
      foreach($usuarios as $usuario) {
        if ($tipo_view == 2 && $usuario['id_tipo_usuario'] == 3){ ?>
          <tr>
            <td class="num text-center"><?= $usuario["id_usuario"]?></td>
            <td class="text-center"><?= $usuario["usuario_nombre"]?></td>
            <td class="text-center"><?= $usuario["usuario_apellido"]?></td>
            <td class="num text-center"><?= $usuario["usuario_dni"]?></td>
            <td>
              <a type="button" class="btn btn-success btn-outline-light d-block" onclick="<?php $session->set('pago_alumno', $usuario['id_usuario']);?>" href="<?php echo base_url('Pago-Empleado-Cuota');?>">Seleccionar Alumno</a>
            </td>
          </tr>
  <?php } else if ($tipo_view == 1) { ?>
          <tr>
            <td class="num text-center"><?= $usuario["id_usuario"]?></td>
            <td class="text-center"><?= $usuario["usuario_nombre"]?></td>
            <td class="text-center"><?= $usuario["usuario_apellido"]?></td>
            <td class="num text-center"><?= $usuario["usuario_dni"]?></td>
            <td class="text-end "><?= $usuario["usuario_email"]?></td>
            <td class="text-center"><?= $usuario["usuario_telefono"]?></td>
            <?php $tipo = $tipos_de_usuarios->where('id_tipo_usuario', $usuario["id_tipo_usuario"])->first();?>
            <td class="text-center"><?= $tipo['tipo_usuario_descripcion']?></td>
            <td class="text-center"><?= $usuario["usuario_sexo"]?></td>
            <td class="text-center"><?= $usuario["usuario_habilitado"]?></td>                  
            <td>
              <a type="button" class="btn btn-success btn-outline-light me-2 btn-sm" href="<?= base_url('modificar-usuario/'.$usuario["id_usuario"]);?>">Modificar</a>
        <?php if ($usuario['usuario_habilitado'] == 'NO') { ?>
                <a type="button" class="btn btn-primary btn-outline-light btn-sm ms-1" href="<?= base_url('baja-usuario/'.$usuario["id_usuario"]);?>" style="width: 67px;">Alta</a>
        <?php } else { ?>
                <a type="button" class="btn btn-danger btn-outline-light btn-sm ms-1" href="<?= base_url('baja-usuario/'.$usuario["id_usuario"]);?>" style="width: 67px;">Baja</a>
        <?php } ?>
            </td>
          </tr>
      <?php } 
    }?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
  <?php } else { ?>
            <div class="text-light mt-5" style="width:95%; margin:auto;">
              <div class="card bg-dark">
                <div class= "card-header text-center">
                  <h2>Gestionar Usuarios</h2>
                </div>
                <div class="card-body text-center">
                  <p>NO HAY USUARIOS EN LA BASE DE DATOS</p>
                </div>
              </div>
            </div>
  <?php } ?>
</body>

<style type="text/css">
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

table.sortable td,
table.sortable th {
  
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

/* Focus and hover styling */

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

// Initialize sortable table buttons
window.addEventListener('load', function () {
  var sortableTables = document.querySelectorAll('table.sortable');
  for (var i = 0; i < sortableTables.length; i++) {
    new SortableTable(sortableTables[i]);
  }
});
</script>