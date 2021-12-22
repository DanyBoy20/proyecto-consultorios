/**
 * @author Dany Hernández <dhernandez@dhwebdesignmx.com>
 * @see <a href="https://dhwebdesignmx.com">dh Web Design</a>
 */

 import { validarfechas as fechas } from "./funciones/validarFechaReport.js";

 const idFormulario = document.getElementById("formvalidarfecha");
 const fechainicial = document.getElementById("fechainicio"); 
/*  const fechafinal = document.getElementById("fechafin"); */ 
 const botonValidarForm = document.getElementById("btnfechaval");

 fechainicial.addEventListener("blur", (e) => {
   fechas.validarfecha1(e);
 });

 /* fechafinal.addEventListener("blur", (e) => {
    fechas.validarfecha2(e);
  }); */
 
 botonValidarForm.addEventListener("click", (event) => {
   event.preventDefault();
   fechas.validarFormulario(idFormulario);
 });
 