/**
 * @author Dany Hernández <dhernandez@dhwebdesignmx.com>
 * @see <a href="https://dhwebdesignmx.com">dh Web Design</a>
 */

import { soloTextoNumeroDir, camposRegistroPago } from "./constantes.js";

let camposPagosRegistro = ["tipopago", "comentarios"];

const borrarError = (elemento) => {
  elemento.target.nextSibling.innerHTML = "";
};

const borrarErrorTextArea = (elemento) => {
  elemento.target.nextSibling.nextElementSibling.innerHTML = "";
};

const validarFormaPago = (campoLista) => {
  if (campoLista.target.value == "undefined") {
    campoLista.target.nextSibling.innerHTML =
      "Debe elegir una opcion valida de la lista";
  } else {
    campoLista.target.nextSibling.innerHTML = "";
    camposRegistroPago.tipopago = true;
  }
};

const validarComentarios = (elemento) => {
  let longitudTexto1 = elemento.target.value.trim().length;
  if (longitudTexto1 === 0) {
    elemento.target.value = "";
    elemento.target.nextSibling.nextElementSibling.innerHTML =
      "El campo comentarios es obligatorio.";
  } else if (longitudTexto1 > 150) {
    elemento.target.value = "";
    elemento.target.nextSibling.nextElementSibling.innerHTML =
      "Debe ingresar un comentario valido.";
  } else if (!soloTextoNumeroDir.test(elemento.target.value)) {
    elemento.target.value = "";
    elemento.target.nextSibling.nextElementSibling.innerHTML =
      "Solo se permiten letras y numeros en este campo.";
  } else {
    camposRegistroPago.comentarios = true;
  }
};

const validarFormulario = (identificadorFormulario) => {
  const valoresCampos = Object.values(camposRegistroPago);
  const valido = camposPagosRegistro.findIndex((value) => value === false);
  if (valido == -1) {
    identificadorFormulario.submit();
  } else {
    alert("Hay campos vacios o con datos invalidos");
    return false;
  }
};

export const nuevosDatosEmpleados = {
  borrarError,
  validarFormaPago,
  validarComentarios,
  borrarErrorTextArea,
  validarFormulario,
};
