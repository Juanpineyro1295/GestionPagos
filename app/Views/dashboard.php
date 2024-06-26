<body>
  <?php $session = session();?>
  <h2 class="mt-5 text-light" style="margin: auto;">Bienvenido <?= $session->get('usuario_nombre');?></h2>    
</body>