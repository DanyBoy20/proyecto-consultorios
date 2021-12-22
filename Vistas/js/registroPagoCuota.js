/**
 * @author Dany Hernández <dhernandez@dhwebdesignmx.com>
 * @see <a href="https://dhwebdesignmx.com">dh Web Design</a>
 */

 import { nuevosDatosEmpleados as registropago } from "./funciones/validarRegistroPagoCuota.js";
 
 const idFormulario = document.getElementById("formregistropago");
 const mensaje = document.getElementById("mensaje");
 const formapago = document.getElementById("formapago");
 const botonValidarForm = document.getElementById("validarRegistro");
  
 mensaje.addEventListener("focus", (e) => {
    registropago.borrarErrorTextArea(e);
  });
  
 mensaje.addEventListener("blur", (e) => {
    registropago.validarComentarios(e);
  });
  
 formapago.addEventListener("focus", (e) => {
   registropago.borrarError(e);
 });
 
 formapago.addEventListener("change", (e) => {
   registropago.validarFormaPago(e);
 });

 botonValidarForm.addEventListener("click", () => {
   registropago.validarFormulario(idFormulario);
 });
 