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
                    Reporte de pagos por fecha
                </h3>
            </div>
        </div>
    </div>
    <div class="principal1">
        <section class="division_secciones">
            <div class="contenedor_izq_der">
                <form id="formvalidarfecha" method="post" class="caja__der">
                    <fieldset id="seccion__izquierda" class="seccion__izquierda">
                        <p class="titulo__fieldset">Seleccione una fecha inicial y final.</p>
                        <div class="contenedor_elementos_fieldset">
                            <div class='elemento_individual_form_self2'>
                                <label for='fechainicio'>
                                    <div class='dato_obligatorio'></div>Fecha inicial:
                                </label>
                                <input type='date' id='fechainicio' name='fechainicio'>
                                <span class='avisoError'></span>
                            </div>
                            <div class='elemento_individual_form_self2'>
                                <label for='fechafin'>
                                    <div class='dato_obligatorio'></div>Fecha final:
                                </label>
                                <input type='date' id='fechafin' name='fechafin'>
                                <span class='avisoError'></span>
                            </div>
                            <div class="elemento_individual_form_self2">
                                <button class="btnVerde4" id="btnfechaval">BUSCAR<i class="icono_contenidos iconoGuardar"></i></button>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </section>
    </div>
</main>
<script src="Vistas/js/validarFechaReporte.js" type="module"></script>