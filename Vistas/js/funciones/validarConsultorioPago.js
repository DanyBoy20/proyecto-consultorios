/**
 * @author Dany Hernández <dhernandez@dhwebdesignmx.com>
 * @see <a href="https://dhwebdesignmx.com">dh Web Design</a>
 */

import { soloTextoNumeroDir, campoBusquedaReciboPago } from "./constantes.js";

let camposEmpleados = ["idrecibo"];

const borrarError = (elemento) => {
  elemento.target.nextSibling.innerHTML = "";
};

const validarCliente = (elemento) => {
  let longitudTexto1 = elemento.target.value.trim().length;
  if (longitudTexto1 <= 0) {
    elemento.target.value = "";
    elemento.target.nextSibling.innerHTML = "Campo obligatorio.";
  } else if (!soloTextoNumeroDir.test(elemento.target.value)) {
    elemento.target.value = "";
    elemento.target.nextSibling.innerHTML = "Caracteres no validos.";
  } else {
    campoBusquedaReciboPago.idrecibo = true;
  }
};

const validarFormulario = (identificadorFormulario) => {
  const valoresCampos = Object.values(campoBusquedaReciboPago);
  const valido = valoresCampos.findIndex((value) => value === false);
  if (valido === -1) {
    identificadorFormulario.action = "registro-pagos";
    identificadorFormulario.target = "_self";
    identificadorFormulario.submit();
  } else {
    alert("El campo " + camposEmpleados[valido] + " es obligatorio");
    return false;
  }
};

export const evaluar = {
  validarCliente,
  validarFormulario,
  borrarError,
};
