/**
 * @author Dany Hernández <dhernandez@dhwebdesignmx.com>
 * @see <a href="https://dhwebdesignmx.com">dh Web Design</a>
 */

export const soloTexto = /^[A-Za-zñáéíóúÑÁÉÍÓÚüÜ;¡!¿?\.\s\-,]+$/;
export const soloTextoNumeroDir =
  /^[0-9A-Za-zñáéíóúÑÁÉÍÓÚüÜ;¡!¿?\.\s\-,\d\(\)\-]+$/;
export const soloNumero = /^[0-9\-\(\)\/\+\s]*$/;
export const soloNumeroTel = /^[0-9\-\(\)\/\+\s]*$/;
export const soloEmail =
  /^(([-\w\d]+)(\.[-\w\d]+)*@([-\w\d]+)(\.[-\w\d]+)*(\.([a-zA-Z]{2,5}|[\d]{1,3})){1,2})$/;
export const expresioncontrasenia =
  /^(?=.{8,12}$)(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).*$/;
export const tipoArchivos = /.(jpg|jpeg|png)$/i;
export const regExContrasenia =
  /^(?=.{6,8}$)(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).*$/;

export const camposValidarIngreso = {
  campoCorreo: false,
  campoContrasenia: false,
};

export const camposActualizarContrasenia = {
  claveActualizar: false,
  repetirclaveActualizar: false,
};

export const camposRegistroPago = {
  tipopago: false,
  comentarios: false,
};

export const campoBusquedaReciboPago = {
  idrecibo: false,
};

export const campoEditarPropietario = {
  correo: false,
  telefono: false,
};

export const campoFechareporte = {
  fechainicial: false,
};
