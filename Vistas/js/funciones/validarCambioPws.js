/**
 * @author Dany Hernández <dhernandez@dhwebdesignmx.com>
 * @see <a href="https://dhwebdesignmx.com">dh Web Design</a>
 */

import { regExContrasenia, camposActualizarContrasenia } from "./constantes.js";

const borrarError = (elemento) => {
  elemento.target.nextSibling.innerHTML = "";
};

const validarContraUno = (elemento) => {
  let longitudNumero = elemento.target.value.trim().length;
  if (longitudNumero == "" || longitudNumero != 8) {
    elemento.target.value = "";
    elemento.target.nextSibling.innerHTML =
      "La contraseña debe ser de 8 caracteres";
  } else if (!regExContrasenia.test(elemento.target.value)) {
    elemento.target.value = "";
    elemento.target.nextSibling.innerHTML =
      "La contraseña debe tener al menos 1 letra mayúscula, 1 letra minúscula, un número y un símbolo";
  } else {
    camposActualizarContrasenia.claveActualizar = true;
  }
};

const validarContraDos = (elemento) => {
  let longitudcontra2 = elemento.target.value.trim().length;
  if (longitudcontra2 == "" || longitudcontra2 != 8) {
    elemento.target.value = "";
    elemento.target.nextSibling.innerHTML =
      "La contraseña debe ser de 8 caracteres";
  } else if (!regExContrasenia.test(elemento.target.value)) {
    elemento.target.value = "";
    elemento.target.nextSibling.innerHTML =
      "La contraseña debe tener al menos 1 letra mayúscula, 1 letra minúscula, un número y un símbolo";
  } else if (contrasenia.value !== repetircontrasenia.value) {
    elemento.target.value = "";
    elemento.target.nextSibling.innerHTML =
      "Debe ser la misma contraseña en ambos campos";
  } else {
    camposActualizarContrasenia.repetirclaveActualizar = true;
  }
};

const validarFormulario = (identificadorFormulario) => {
  const valoresCampos = Object.values(camposActualizarContrasenia);
  const valido = valoresCampos.findIndex((value) => value === false);
  if (valido == -1) {
    identificadorFormulario.submit();
  } else {
    alert("Hay campos vacíos o con datos inválidos");
    return false;
  }
};

export const validarContrasenias = {
  borrarError,
  validarContraUno,
  validarContraDos,
  validarFormulario,
};
