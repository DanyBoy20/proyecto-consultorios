<header class="encabezado">
    <i id="encabezado__menu" class="iconoHamburguesa icono__atajos encabezado__menu"></i>
    <div class="encabezado__titulo">
        Administración | Consultorios CEM
    </div>
    <div id="encabezado__avatar" class="encabezado__avatar">
        <img src="<?php echo $_SESSION['foto']; ?>" alt="">
        <div id="menu__avatar" class="desplegable">
            <ul class="desplegable__lista">
                <a class="linkMenu" href="perfil">
                    <li class="desplegable__lista-item">
                        <i class="icono iconoPerfil"></i>
                        <span class="desplegable__titulo">
                            Datos
                        </span>
                    </li>
                </a>
                <a class="linkMenu" href="salir">
                    <li class="desplegable__lista-item">
                        <span class="desplegable__icono"><i class="icono iconoCerrar"></i></span>
                        <span class="desplegable__titulo">
                            Salir
                        </span>
                    </li>
                </a>
            </ul>
        </div>
    </div>
</header>