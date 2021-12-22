/**
 * @author Dany Hernández <dhernandez@dhwebdesignmx.com>
 * @see <a href="https://dhwebdesignmx.com">dh Web Design</a>
 */

 import { serviciosConsultorios as consultorio } from "./servicios/servicioReciboRenta.js";

const nombre = document.getElementById('nombre');
const filaconsultorio = document.getElementById("fila_consultorio");

addEventListener("load", () => {
    nombre.addEventListener("keyup", (event) => {
        if(event.target.value == ""){
            consultorio.cargarConsultorios(filaconsultorio);
        }else{
            filaconsultorio.innerHTML = "";
            consultorio.valorBuscado(event, filaconsultorio);
        }
    });
});
