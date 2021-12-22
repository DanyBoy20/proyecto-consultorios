<?php
if(isset($_SESSION['validar'])){
    echo '<script>window.location.href="inicio"</script>';
}
$iniciarSesion = new Controladores\IngresoControlador;
$iniciarSesion->inicioSesionControlador();
?>
<div class="contenedor__ingreso">
    <div class="contenedor_sesionini">
        <div class="sesionini1">
            <div class="contenedor__logo__ingreso">
                <img class="logo__ingreso" src="Vistas/img/LOGO-PROYECTO.png" alt="">
            </div>
        </div>
        <div class="sesionini2">
        <div class="contenedor__login">    
            <form name="formulario" method="post" id="ingreso">
                <div class="contenedor_elementos_formulario">
                    <label class="lbldata" for="usuario"><i class="icono iconoUsuarioAcceso"></i>Usuario</label>
                    <input type="email" id="usuario" name="usuario" placeholder="Escriba su correo electrónico" class="contactoForm_elemento-dimension" minlength="10" maxlength="50" required /><span class="avisoErrorSesion"></span>
                </div>
                <div class="contenedor_elementos_formulario">
                    <label class="lbldata" for="contrasenia"><i class="icono__login iconoContrasenia"></i>&nbsp;Contraseña</label>
                    <input type="password" id="contrasenia" name="contrasenia" placeholder="Escriba su contraseña" class="contactoForm_elemento-dimension" minlength="8" maxlength="8" required /><span class="avisoErrorSesion"></span>
                </div>
                <div class="contenedor_submit">
                    <button class="btnGris1" id="validarIngreso">Entrar<i class="icono_contenidos iconoLogIn"></i></button>
                </div>
            </form>
        </div>
        </div>
    </div>
</div>
<script src="Vistas/js/validarIngreso.js" type="module"></script>