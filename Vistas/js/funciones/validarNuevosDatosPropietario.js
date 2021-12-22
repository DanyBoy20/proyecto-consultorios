/**
 * @author Dany Hernández <dhernandez@dhwebdesignmx.com>
 * @see <a href="https://dhwebdesignmx.com">dh Web Design</a>
 */

import { soloNumero, soloEmail, campoEditarPropietario } from "./constantes.js";

let camposPropietario = ["correo", "telefono"];

const borrarError = (elemento) => {
  elemento.target.nextSibling.innerHTML = "";
};

const validarCorreoElectronico = (elemento) => {
  console.log(elemento);
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
    campoEditarPropietario.correo = true;
  }
};

const validarNumeroCelular = (elemento) => {
  console.log(elemento);
  let longitudNumero = elemento.target.value.trim().length;
  if (longitudNumero == "") {
    elemento.target.value = "";
    elemento.target.nextSibling.innerHTML =
      "El campo numero de celular es obligatorio.";
  } else if (longitudNumero < 7 || longitudNumero > 11) {
    elemento.target.value = "";
    elemento.target.nextSibling.innerHTML =
      "Debe incluir un numero completo sin espacios.";
  } else if (!soloNumero.test(elemento.target.value)) {
    elemento.target.value = "";
    elemento.target.nextSibling.innerHTML =
      "Solo se aceptan numeros en este campo.";
  } else {
    campoEditarPropietario.telefono = true;
  }
};

const validarFormulario = (identificadorFormulario) => {
  const valoresCampos = Object.values(campoEditarPropietario);
  const valido = valoresCampos.findIndex((value) => value === false);
  if (valido == -1) {
    identificadorFormulario.submit();
  } else {
    alert("El campo " + camposPropietario[valido] + " es obligatorio");
    return false;
  }
};

export const nuevosDatosPropietario = {
  borrarError,
  validarNumeroCelular,
  validarCorreoElectronico,
  validarFormulario,
};
