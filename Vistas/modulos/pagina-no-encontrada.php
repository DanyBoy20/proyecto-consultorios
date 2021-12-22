<?php
if (!isset($_SESSION['validar'])) {
  echo '<script>window.location.href="index"</script>';
  exit();
}
if (!$_SESSION['validar']) {
  echo '<script>window.location.href="index"</script>';
  exit();
}
include 'Vistas/modulos/cabecera.php';
include 'Vistas/modulos/navegacion.php';
?>
<main class="contenido">
  <div class="contenedor__secciones_titulos">
    <div class="seccion__titulo color_titulo_seccion">
      <div class="contenedor__seccion__descripcion">
        <h3 class="contenedor__seccion__titulo texto-normal">
          ERROR
        </h3>
      </div>
    </div>
  </div>
  <div class="principal1">
    <section class="division_secciones">
      <div class="contenedor_izq_der">
        <div class="caja__izq_perfil">
          <div class="imagen_error">
            <img class="imagen_perfil" src="Vistas/img/error-404.svg" alt="">
          </div>
        </div>
        <div class="caja__der">
          <div class="contenido-atajo">
            <div class="atajo">
              <h2 class="mensaje_error_pagina">La página a la cual está intentando ingresar no existe en este dominio.</h2>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</main>