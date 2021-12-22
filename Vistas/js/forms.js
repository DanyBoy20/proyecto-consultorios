/**
 * @author Dany Hernández <dhernandez@dhwebdesignmx.com>
 * @see <a href="https://dhwebdesignmx.com">dh Web Design</a>
 */

const anterior = document.getElementById("anterior");
const siguiente = document.getElementById("siguiente");
const botonCambiar = document.querySelectorAll(".boton__cambio");
const izquierda = document.getElementById("seccion__izquierda");
const derecha = document.getElementById("seccion__derecha");

botonCambiar.forEach((boton) => {
    boton.addEventListener("click", (e) => {
        const opcion = e.target.id;
        if(opcion == "siguiente"){
            derecha.classList.remove('ocultar');
            izquierda.classList.add('ocultar');
        } else{
            derecha.classList.add('ocultar');
            izquierda.classList.remove('ocultar');
        }
    });
});