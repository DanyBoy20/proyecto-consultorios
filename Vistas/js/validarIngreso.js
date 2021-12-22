/**
 * @author Dany Hernández <dhernandez@dhwebdesignmx.com>
 * @see <a href="https://dhwebdesignmx.com">dh Web Design</a>
 */

import { validacionesIngreso as ingreso } from "./funciones/validarIngresoSistema.js";

/* -------------- FORMULARIO INGRESO --------------  */
const contactoForm = document.getElementById("ingreso");
const correoElectronico = document.getElementById("usuario");
const contrasenia = document.getElementById("contrasenia");
const botonValidarForm = document.getElementById("validarIngreso");

correoElectronico.addEventListener("focus", (e) => {
  ingreso.borrarError(e);
});

correoElectronico.addEventListener("focusout", (e) => {
  ingreso.validarCorreo(e);
});

contrasenia.addEventListener("focus", (e) => {
  ingreso.borrarError(e);
});

contrasenia.addEventListener("focusout", (e) => {
  ingreso.validarContrasenia(e);
});

botonValidarForm.addEventListener("click", () => {
  ingreso.validarIngreso(contactoForm);
});
