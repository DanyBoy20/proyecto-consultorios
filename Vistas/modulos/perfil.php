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
    <div class="contenedor__secciones_titulos">
        <div class="seccion__titulo color_titulo_seccion">
            <div class="contenedor__seccion__descripcion">
                <h3 class="contenedor__seccion__titulo texto-normal">
                    <?php echo $_SESSION['nombre'] . " " . $_SESSION['apellidop'] ." ". $_SESSION['apellidom']; ?>
                </h3>
            </div>
        </div>
    </div>
    <div class="principal1">
        <section class="division_secciones">
            <div class="contenedor_izq_der">
                <div class="caja__izq_perfil">
                    <div class="foto_perfil">
                        <img class="imagen_perfil" src="<?php echo $_SESSION['foto']; ?>" alt="">
                    </div>
                    <div class="datos">
                        <h2 class="usuario_campo">Rol:</h2>
                        <p id="tel" class="usuario_valor"><?php echo $_SESSION['rol']; ?></p>
                    </div>
                </div>
                <form id="idformularioactualizar" method="post" class="caja__der">
                    <fieldset id="seccion__izquierda" class="seccion__izquierda">
                        <p class="titulo__fieldset">Contraseña: al menos una letra mayúscula, una letra minúscula, un número y un símbolo.</p>
                        <div class="contenedor_elementos_fieldset">
                            <div class="elemento_individual_form">
                                <label for="email">Usuario</label>
                                <h2 id="email" name="email" class="email elemento_individual_form_self8"><?php echo $_SESSION['correo']; ?></h2>
                            </div>
                            <div class="elemento_individual_form">
                                <label for="contrasenia"><div class="dato_obligatorio"></div>Nueva contraseña</label>
                                <input type="password" id="contrasenia" name="contrasenia" placeholder="8 Caracteres" class="contactoForm_elemento-dimension" minlength="8" maxlength="8" required /><span class="avisoError"></span>
                            </div>
                            <div class="elemento_individual_form">
                                <label for="repetircontrasenia"><div class="dato_obligatorio"></div>Vuelva a escribir la contraseña</label>
                                <input type="password" id="repetircontrasenia" name="repetircontrasenia" placeholder="8 Caracteres" class="contactoForm_elemento-dimension" minlength="8" maxlength="8" required /><span class="avisoError"></span>
                            </div>
                            <div class="elemento_individual_form_self2">
                                <button class="btnVerde4" id="btnactualizar">GUARDAR<i class="icono_contenidos iconoGuardar"></i></button>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </section>
    </div>
</main>
<script src="Vistas/js/actualizarEmpleado.js" type="module"></script>
<?php
$modulo = new Controladores\EmpleadosControlador();
$modulo->actualizarContraseña();