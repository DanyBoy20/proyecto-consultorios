/**
 * @author Dany Hernández <dhernandez@dhwebdesignmx.com>
 * @see <a href="https://dhwebdesignmx.com">dh Web Design</a>
 */

import { campoFechareporte } from "./constantes.js";

let camposfecha = ["fecha inicial"];

const borrarError = (elemento) => {
  elemento.target.nextSibling.innerHTML = "";
};

const validarfecha1 = (elemento) => {
  var today = new Date();
  var inputDate = new Date(elemento.target.value);
  if (inputDate.value == "") {
    elemento.target.value = "";
    elemento.target.nextSibling.innerHTML = "Debe escribir una fecha valida";
  } else if (inputDate > today) {
    elemento.target.value = "";
    elemento.target.nextSibling.innerHTML = "fecha invalida.";
  } else {
    campoFechareporte.fechainicial = true;
  }
};

const validarFormulario = (identificadorFormulario) => {
  const valoresCampos = Object.values(campoFechareporte);
  const valido = valoresCampos.findIndex((value) => value === false);
  if (valido === -1) {
    identificadorFormulario.action = "./Docs/pagosxfecha.php";
    identificadorFormulario.target = "_blank";
    identificadorFormulario.submit();
  } else {
    alert("El campo " + camposfecha[valido] + " es obligatorio");
    return false;
  }
};

export const validarfechas = {
  validarFormulario,
  validarfecha1,
  borrarError,
};
