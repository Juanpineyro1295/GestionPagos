<body style="">
	<?php 
		$session = session();
		$carrito = \Config\Services::cart();
		$cart = $carrito->contents();
	?>
  <div class="text-light mt-5 mb-5" style="margin:auto;width:95%;">
  	<div class="card bg-dark">
      <h2 class="card-header text-center">Carrito</h2>
      <div class="card-body table-responsive-xxl align-right">
    	 <?php if (session()->getFlashdata('msg')) { ?>
        <div class="alert alert-warning collapse show mb-2" id="collapseExample2">
          <?= session()->getFlashdata('msg'); ?>
          <a data-bs-toggle="collapse" href="#collapseExample2" role="button" aria-expanded="true" aria-controls="collapseExample2"><i class="fa-solid fa-xmark fa-xl" style="position: absolute; right: 15px; top: 27px; color:black;"></i></a>
        </div>
        <?php } ?>
        <?php if (count($cart) > 0) { ?>
      	<div class="d-flex">
          <a type="button" class="btn btn-light text-dark mb-3 ms-auto" href="<?= base_url('Carrito-Vaciar');?>"><i class="fa-solid fa-trash-can"></i> Vaciar Carrito</a>
        </div>
        <table id="users-list" class="sortable table table-dark table-bordered table-hover border border-1 mt-5">
          <thead class="table-light" style="height: 50px;">
            <tr>
              <th class="num" aria-sort="ascending" style="width: 50px;">
                <button>
                  ID
                  <span aria-hidden="true"></span>
                </button>
              </th>
              <th>
                <button>
                  Nombre
                  <span aria-hidden="true"></span>
                </button>
              </th>
              <th class="num">
                <button>
                  Precio
                  <span aria-hidden="true"></span>
                </button>
              </th>
              <th class="num">
                <button>
                  Cantidad
                  <span aria-hidden="true"></span>
                </button>
              </th>
              <th class="num">
                <button>
                  Precio Total
                  <span aria-hidden="true"></span>
                </button>
              </th>
              <th class="no-sort align-middle text-center user-select-none" style="width: 100px;">
                Imagen
                <span aria-hidden="true"></span>
              </th>
              <th class="no-sort align-middle text-center user-select-none">
                Eliminar
                <span aria-hidden="true"></span>
              </th>
            </tr>
          </thead>
          <tbody>
          	<?php foreach($cart as $row) { ?>
          	<tr>
              <td class="num text-center align-middle"><?= $row['id']; ?></td>
              <td class="num text-center align-middle"><?= $row['name']; ?></td>
              <td class="num text-center align-middle"><?= $row['price'];?></td>                  
              <td class="num text-center align-middle"><?= $row['qty']; ?></td>
              <td class="num text-center align-middle"><?= $row['subtotal']; ?></td>
              <td><img src="<?= base_url('public/assets/uploads/' .$row['id'] .$row['imagen_ext'] .'?' .$new = rand()); ?>" height="100" width="100" alt="User-Profile-Image"></td>
              <td class="text-center align-middle">
              	<a type="button" class="btn btn-danger" href="<?= base_url('Carrito-Borrar-Producto/' .$row['rowid']);?>"><i class="fa-solid fa-minus" style="color: white;"></i></a>
              </td>              
            </tr>
          	<?php } ?>      
          </tbody>
        </table>
        <p class="text-end">Cantidad de productos en el carrito: <?= $carrito->totalItems(); ?></p>
        <h2 class="text-end">Total: $<?= $carrito->total(); ?></h2>
        <div class="d-flex mt-3">
        <a type="button" class="btn btn-success ms-auto" href="<?= base_url('Carrito-Comprar/' .session()->get('id'));?>">Comprar</a>
        </div>
        <?php } else { ?>
        <p class="text-center">No hay productos en tu carrito</p>
        <?php } ?>
      </div>
    </div>
  </div>
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