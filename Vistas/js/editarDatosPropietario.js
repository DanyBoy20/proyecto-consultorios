/**
 * @author Dany Hernández <dhernandez@dhwebdesignmx.com>
 * @see <a href="https://dhwebdesignmx.com">dh Web Design</a>
 */

 import { nuevosDatosPropietario as actualizarEmpleado } from "./funciones/validarNuevosDatosPropietario.js";

 const idFormulario = document.getElementById("formpropietario");
 const celular = document.getElementById("celular");
 const email = document.getElementById("correoelectronico");
 const botonValidarForm = document.getElementById("validarIngreso");

 email.addEventListener("focus", (e) => {
    actualizarEmpleado.borrarError(e);
  });
  
  email.addEventListener("blur", (e) => {
    actualizarEmpleado.validarCorreoElectronico(e);
  });
 
 celular.addEventListener("focus", (e) => {
   actualizarEmpleado.borrarError(e);
 });

 celular.addEventListener("blur", (e) => {
   actualizarEmpleado.validarNumeroCelular(e);
 });
 
 botonValidarForm.addEventListener("click", (event) => {
  event.preventDefault();
   actualizarEmpleado.validarFormulario(idFormulario);
 });
 