/**
 * @author Dany Hernández <dhernandez@dhwebdesignmx.com>
 * @see <a href="https://dhwebdesignmx.com">dh Web Design</a>
 */

 import { validarContrasenias as actualizaContra } from "./funciones/validarCambioPws.js";

const formularioActualizar = document.getElementById('idformularioactualizar');
const contrasenia = document.getElementById('contrasenia');
const repetircontrasenia = document.getElementById('repetircontrasenia');
const btnActualizar = document.getElementById('btnactualizar');

contrasenia.addEventListener('focus', (e) => {
    actualizaContra.borrarError(e);
});

contrasenia.addEventListener('blur', (e) => {
    actualizaContra.validarContraUno(e);
});

repetircontrasenia.addEventListener('focus', (e) => {
    actualizaContra.borrarError(e);
});

repetircontrasenia.addEventListener('blur', (e) => {
    actualizaContra.validarContraDos(e);
});

btnActualizar.addEventListener("click", () => {
    actualizaContra.validarFormulario(formularioActualizar);
});