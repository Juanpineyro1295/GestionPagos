<footer class="pt-4 text-light" style="margin-top: auto; background-color: #000000;">
  <div class="d-lg-flex justify-content-evenly me-0">
    <div class="columna">
      <h2 class="fw-bold">Tu Futbol</h2>
      <p class="fw-thin">TuFutbol © 2022</p>
      <br>
      <br>
    </div>
    <div class="columna">
      <p class="fw-bold">Necesitas Ayuda?</p>
      <a href="<?= base_url('Consulta'); ?>">Consulta</a>
      <br>
      <a href="<?= base_url('Comercializacion'); ?>">Comercialización</a>
      <br>
      <br>
    </div>
    <div class="columna">
      <p class="fw-bold">Contacto</p>
      <p><i class="fa fa-map-marker"></i> 9 de Julio 1449 Resistencia, Chaco</p>
      <p><i class="fa fa-phone"></i> +54 362 4145527</p>
      <p><i class="fa fa-envelope"></i> seba_aleggre@hotmail.com</p>
      <br>
    </div>
    <div class="columna">
      <p class="fw-bold">Acerca de la empresa</p>
      <a href="<?= base_url('Quienes-Somos'); ?>">Quiénes Somos</a>
      <br>
      <a href="<?= base_url('Terminos-y-usos'); ?>">Términos y Usos</a>
      <br>
      <br>
    </div>
    <div class="columna">
      <p class="fw-bold">Siguenos en</p>
      <a href="https://www.facebook.com/facenaunneargentina/"><i class="fa-2xl fa-brands fa-facebook" style="color: #1A6ED8;"></i></a>
      <a href="https://twitter.com/facenaunne"><i class="fa-2xl fa-brands fa-twitter mx-1" style="color: #1A8CD8;"></i></a>
      <a href="https://www.instagram.com/facenaunne/"><i class="fa-2xl fa-brands fa-instagram" style="color: #DE001D;"></i></a>
    </div>
  </div>
</footer>
<style type="text/css">
  .columna a, p,.columna a:hover {
    font-weight: 300;
    text-decoration: none;
    color: whitesmoke;
  }

  @media (max-width: 991px){
  .columna {
    margin-left: 25vw;
  }
}
</style>