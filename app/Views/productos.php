<body>
  <?php
  Use App\Models\Productos_model;
    $db = \Config\Database::connect();
    $productos = $db->query('SELECT * FROM productos');
    $categorias = $db->query('SELECT * FROM categorias');
  ?>
  <div class="text-light mt-5 mb-5">
    <div class="card container" style="min-width: 95vw; background-color: #141414;">
      <div class="card-body">
        <h2 class="card-header text-center">Productos</h2>
      </div>
      <?php if (session()->getFlashdata('msg')) { ?>
        <div class="alert alert-warning collapse show mb-2" id="collapseExample2">
          <?= session()->getFlashdata('msg'); ?>
          <a data-bs-toggle="collapse" href="#collapseExample2" role="button" aria-expanded="true" aria-controls="collapseExample2"><i class="fa-solid fa-xmark fa-xl" style="position: absolute; right: 15px; top: 27px;"></i></a>
        </div>
      <?php } if ($productos->getNumRows() > 0) { ?>
      <div class="row pt-3 me-2 ms-2 mb-4 bg-dark">
        <div class="col-xl-2 bg-dark">
          <div class="list-group ms-2" style="max-width: 300px;">
            <h2 class="mb-4 fw-light">Categorias</h2>
            <?php if (isset($filtro)) { ?>
              <a class="text-light mb-3" href="<?= base_url('Productos');?>">Reiniciar Filtros</a>
            <?php }
            foreach($categorias->getResult() as $row) {?>
              <a href="<?= base_url('Productos/' .$row->id);?>" class="list-group-item list-group-item-action bg-dark text-light border-light border-top mb-2 rounded-3"><?= $row->descripcion?></a>
            <?php } ?>
          </div>          
        </div>
        <div class="col-xl-10 card bg-dark pt-3">
          <div class="row row-cols-xxl-4">
        <?php
        if (isset($filtro)) {
          if (count($filtro) > 0) {          
            foreach($filtro as $row) {
              if (($row['stock'] > $row['stock_min']) && ($row['eliminado'] != 'SI')) { ?>
            <div class="col mb-5 d-flex justify-content-center">
              <div class="card bg-light text-dark"style="width: 250px;">
                <img src="<?= base_url('public/assets/uploads/' .$row['id'] .$row['imagen_ext'] .'?' .$new = rand()); ?>" class="card-img-top" height="250" alt="User-Profile-Image">
                <div class="card-body">
                  <h5 class="card-title text-center"><?= $row['club']; ?></h5>
                </div>
                <div class="d-flex card-footer">
                  <h1 class="mx-auto" style="font-size: 30px;">$ <?= $row['precio'];?></h1>
                  <a href="
                  <?php if (session()->get('perfil_id') == 2) {
                          echo base_url('Carrito-Añadir/' .$row['id']);                         
                        } else {
                          echo base_url('Ingresar');
                        }
                  ?>" class="my-auto" style="" role="button"><i class="fa-solid fa-cart-plus fa-xl" style="color:orange;"></i></a>
                </div>
              </div>
            </div>
        <?php }
            }
          } else { ?>
            <div class="col mb-5 d-flex justify-content-center">
              <p>No hay productos de esa categoria</p>
            </div>
        <?php }
        } else {
          foreach($productos->getResult() as $row) {
            $categoria = $categorias->getRow($row->categoria_id - 1);
            if (($row->stock > $row->stock_min) && ($row->eliminado != 'SI')) { ?>
            <div class="col mb-5 d-flex justify-content-center">
              <div class="card bg-light text-dark"style="width: 250px;">
                <img src="public/assets/uploads/<?= $row->id .$row->imagen_ext .'?' .$new = rand();?>" class="card-img-top" height="250" alt="User-Profile-Image">
                <div class="card-body">
                  <h5 class="card-title text-center"><?= $row->club; ?></h5>
                </div>
                <div class="d-flex card-footer">
                  <h1 class="mx-auto" style="font-size: 30px;">$ <?= $row->precio;?></h1>
                  <a href="
                  <?php if (session()->get('perfil_id') == 2) {
                          echo base_url('Carrito-Añadir/' .$row->id);                         
                        } else {
                          echo base_url('Ingresar');
                        }
                  ?>" class="my-auto" style="" role="button"><i class="fa-solid fa-cart-plus fa-xl" style="color:orange;"></i></a>
                </div>
              </div>
            </div>
            <?php }
             }
         } ?>
          </div>
        </div>
      </div>
    </div>
  </div>
        <?php } else { ?>
            <p class="text-center">NO HAY PRODUCTOS EN LA BASE DE DATOS</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php } $db->close(); ?>
</body>
<style type="text/css">
  a.list-group-item:hover {
      background-color: #ffffff !important;
      color: #141414 !important;
  }
  .fa-cart-plus:hover {
    color: green !important;
  }
</style>
<script type="text/javascript">
   $(document).ready(function () {
        $('.fa-heart').hover(function () {
            $(this).addClass('fa-solid');
            $(this).removeClass('fa-regular');
        }, function () {
            $(this).addClass('fa-regular');
            $(this).removeClass('fa-solid');
        });
    });
</script>