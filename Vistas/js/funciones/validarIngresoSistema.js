/**
 * @author Dany Hernández <dhernandez@dhwebdesignmx.com>
 * @see <a href="https://dhwebdesignmx.com">dh Web Design</a>
 */

import {
  soloEmail,
  expresioncontrasenia,
  camposValidarIngreso,
} from "./constantes.js";

const borrarError = (elemento) => {
  elemento.target.nextSibling.innerHTML = "";
};

const validarCorreo = (elemento) => {
  let longitudNumero = elemento.target.value.trim().length;
  if (longitudNumero == "") {
    elemento.target.value = "";
    elemento.target.nextSibling.innerHTML = "El campo correo es obligatorio.";
  } else if (longitudNumero < 10 || longitudNumero > 50) {
    elemento.target.value = "";
    elemento.target.nextSibling.innerHTML =
      "El correo debe tener cuando menos 10 caracteres";
  } else if (!soloEmail.test(elemento.target.value)) {
    elemento.target.value = "";
    elemento.target.nextSibling.innerHTML = "El correo no es valido.";
  } else {
    camposValidarIngreso.campoCorreo = true;
  }
};

const validarContrasenia = (elemento) => {
  let longitudNumero = elemento.target.value.trim().length;
  if (longitudNumero == "" || longitudNumero != 8) {
    elemento.target.value = "";
    elemento.target.nextSibling.innerHTML =
      "&nbsp;&nbsp;La contraseña debe ser de 8 caracteres&nbsp;&nbsp;";
  } else if (!expresioncontrasenia.test(elemento.target.value)) {
    elemento.target.value = "";
    elemento.target.nextSibling.innerHTML =
      "&nbsp;&nbsp;Contraseña no valida&nbsp;&nbsp;";
  } else {
    camposValidarIngreso.campoContrasenia = true;
  }
};

const validarIngreso = (formulario) => {
  const valoresCampos = Object.values(camposValidarIngreso);
  const valido = valoresCampos.findIndex((value) => value === false);
  if (valido == -1) {
    formulario.submit();
  } else {
    alert("Todos los campos son obligatorios");
    return false;
  }
};

export const validacionesIngreso = {
  borrarError,
  validarCorreo,
  validarContrasenia,
  validarIngreso,
};
