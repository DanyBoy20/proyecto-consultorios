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
                    Consultorios segundo nivel.
                </h3>
            </div>
            <div class="contenedor__seccion__descripcion">
                <h3 class="contenedor__seccion__titulo texto-normal">
                    <?php
                    date_default_timezone_set('America/Mexico_City');
                    echo date("d/m/Y");
                    ?>
                </h3>
            </div>
        </div>
    </div>
    <div class="principal1">
        <section class="division_secciones">
            <div class="contenedor_izq_der">
                <div class="caja__izq">
                    <h2>Buscar por:</h2>
                    <div class="elemento_individual_form">
                        <input type="text" id="nombre" name="nombre" placeholder="Apellido paterno" class="contactoForm_elemento-dimension" minlength="4" maxlength="35" required />
                    </div>
                </div>
                <div class="caja__der">
                    <div id="contenedor_lista_hospitales" class="contenedor__tablas">
                        <div class="tabla__contenidos" tabindex="0">
                            <table class="tabla__general">
                                <thead>
                                    <tr>
                                        <th>Clave</th>
                                        <th>Dimensiones</th>
                                        <th>Propietario</th>
                                        <th>Acción</th>
                                    </tr>
                                </thead>
                                <tbody id="fila_consultorio" data-value="3">
                                    <?php
                                    $modulo = new Controladores\ConsultoriosControlador();
                                    $modulo->consultar2N();
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</main>
<script src="Vistas/js/apiFetchConsultorios.js" type="module"></script>