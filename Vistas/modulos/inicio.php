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
    <div class="contenido-cabecera">
        <div class="contenido-cabecera__contenedor">
            <div class="contenido-cabecera__bienvenida">
                <div class="contenido-cabecera__bienvenida-subtitulo texto-normal">
                    Hola <?php echo $_SESSION['nombre'] . " " . $_SESSION['apellidop'] ?>
                </div>
            </div>
        </div>
    </div>
    <?php
    $modulo = new Controladores\InicioControlador();
    $modulo->ver($_SESSION['idrol']);
    ?>
</main>