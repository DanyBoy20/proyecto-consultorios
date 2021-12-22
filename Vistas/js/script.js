/**
 * @author Dany Hernández <dhernandez@dhwebdesignmx.com>
 * @see <a href="https://dhwebdesignmx.com">dh Web Design</a>
 */

addEventListener('load', iniciar, false);

function iniciar(){
    desplegarmenuPerfil();
    desplegarMenuNavegacion();
    redimencionar();
    abrirMenuNav();
    cerrarMenuNavIcono();
}

const intercambiarClase = (elemento, nombreClase) => {
    if(elemento.classList.contains(nombreClase)){
        elemento.classList.remove(nombreClase);
    }else{
        elemento.classList.add(nombreClase);
    }
}

const desplegarmenuPerfil = () => {
    const avatarUsuario = document.getElementById('encabezado__avatar');    
    avatarUsuario.addEventListener('click', (e) => {
        const desplegable = document.getElementById('menu__avatar'); 
        intercambiarClase(desplegable, 'desplegable--activo');
    });
}

const desplegarMenuNavegacion = () => {
    const subencabezados = document.querySelectorAll('.listaNav__subencabezado');
    const abrirClaseSubEncabezado = 'listaNav__subencabezado--abrir';
    const cerrarClaseSubEncabezado = 'sublista--oculto';
    subencabezados.forEach((subElementoEncabezado) => {
        subElementoEncabezado.addEventListener('click', (e) => {
            const subElementoLista = e.target.nextElementSibling;
            intercambiarClase(subElementoEncabezado, abrirClaseSubEncabezado);
            subElementoLista.classList.toggle(cerrarClaseSubEncabezado);
            
        });
    });
}

const redimencionar = () => {    
    const menuNavegacion = document.getElementById('barraNavegacion');
    const gridPrincipal = document.getElementById('cuadrilla');
    const claseNavegacionActiva = 'navegacion--activa';
    const claseGridSinScroll = 'grid--nodesplazar';
    addEventListener('resize', (e) => {
        const ancho = window.innerWidth;
        if(ancho > 992){
            menuNavegacion.classList.remove(claseNavegacionActiva);
            gridPrincipal.classList.remove(claseGridSinScroll);
        }
    });
}

const abrirMenuNav = () => { 
    const menuNavegacion = document.getElementById('barraNavegacion');
    const gridPrincipal = document.getElementById('cuadrilla');
    const claseNavegacionActiva = 'navegacion--activa';
    const claseGridSinScroll = 'grid--nodesplazar';
    const menuCabeceraAbrirCerrar = document.getElementById('encabezado__menu');
    menuCabeceraAbrirCerrar.addEventListener('click', () => {
        menuNavegacion.classList.toggle(claseNavegacionActiva);
        gridPrincipal.classList.toggle(claseGridSinScroll);
    });
}

const cerrarMenuNavIcono = () => {
    const iconoCerrarMenuNav = document.getElementById('navegacion__marca-cerrar');
    const menuNavegacion = document.getElementById('barraNavegacion');
    const gridPrincipal = document.getElementById('cuadrilla');
    const claseNavegacionActiva = 'navegacion--activa';
    const claseGridSinScroll = 'grid--nodesplazar';
    iconoCerrarMenuNav.addEventListener('click', () => {
        menuNavegacion.classList.toggle(claseNavegacionActiva);
        gridPrincipal.classList.toggle(claseGridSinScroll);
    });   

}
