/**
 * @author Dany Hernández <dhernandez@dhwebdesignmx.com>
 * @see <a href="https://dhwebdesignmx.com">dh Web Design</a>
 */

 import { evaluar } from "./funciones/validarConsultorioPago.js";

const idformulario = document.getElementById('formRegistroSolicitud');
const botonValidarForm = document.getElementById("guardarSolicitud");
const cliente = document.getElementById("cliente");

cliente.addEventListener("focus", (e) => {
    evaluar.borrarError(e);
  });
  
  cliente.addEventListener("blur", (e) => {
    evaluar.validarCliente(e);
  });

botonValidarForm.addEventListener("click", (event) => {
    event.preventDefault();
    evaluar.validarFormulario(idformulario, descuentoJubilado, descuentoPensionado, resp, vldesc);
  });