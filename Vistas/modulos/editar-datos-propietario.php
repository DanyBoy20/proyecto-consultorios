<?php
if(!isset($_SESSION['validar'])){
    echo '<script>window.location.href="index"</script>';
    exit();
}
if(!$_SESSION['validar']){
    echo '<script>window.location.href="index"</script>';
    exit();
}                     
include 'Vistas/modulos/cabecera.php';
include 'Vistas/modulos/navegacion.php';
?>
<main class="contenido">
    <?php
    $modulo = new Controladores\ConsultoriosControlador();
    $modulo->editar();
    ?>
</main>
<script src="Vistas/js/editarDatosPropietario.js" type="module"></script>