/**
 * @author Dany Hernández <dhernandez@dhwebdesignmx.com>
 * @see <a href="https://dhwebdesignmx.com">dh Web Design</a>
 */

 const generarRecibos = async (elemento) => {    
    try {
        const url = "Controladores/ApiFetchRecibos.php?todos=verdadero";
        const res = await fetch(url);
        const data = await res.json();
        if(data == "exito"){
            elemento.classList.add('ocultar');
            alert("RECIBOS GENERADOS CON EXITO");
        }else if(data == "errorupdate"){
            elemento.classList.add('ocultar');
            alert("ERROR EN LA ACTUALIZACION DE RECIBOS DEL MES");
        }else{
            alert("No se pudo generar los recibos, intente más tarde");
        }        
    } catch (error) {
        console.log(error);        
    } 
};

const verificarRecibos = async (boton) => {
    try {
        const url = "Controladores/ApiFetchRecibos.php?verificar=dato";
        const res = await fetch(url);
        const data = await res.json();
        switch (data) {
            case 'no_generar':
                boton.classList.remove('ocultar');
                alert('Se debe generar lo recibos de este mes');
                break;
            case 'si_generados':
                boton.classList.add('ocultar');
                break;
            case 'espera_fecha':
                boton.classList.add('ocultar');
                break;
          }
    } catch (error) {
        console.log(error);        
    }
};

const verificarRecargos = async (boton) => {
    try {
        const url = "Controladores/ApiFetchRecibos.php?verificarrecargos=dato";
        const res = await fetch(url);
        const data = await res.json();
        switch (data) {
            case 'no_generar':
                boton.classList.remove('ocultar');
                alert('Se deben generar los recargos de este mes');
                break;
            case 'si_generados':
                boton.classList.add('ocultar');
                break;
            case 'espera_fecha':
                boton.classList.add('ocultar');
                break;
          }
    } catch (error) {
        console.log(error);        
    }
};


const generarRecargos = async (elemento) => {    
    try {
        const url = "Controladores/ApiFetchRecibos.php?recargos=verdadero";
        const res = await fetch(url);
        const data = await res.json();
        if(data == "exito"){
            elemento.classList.add('ocultar');
            alert("RECARGOS GENERADOS CORRECTAMENTE");
        }else if(data == "error"){
            elemento.classList.remove('ocultar');
            alert("NO SE PUDO GENERAR LOS RECARGOS, INTENTE NUEVAMENTE");
        }else if(data == "errorcontador"){
            elemento.classList.add('ocultar');
            alert("EL CONTADOR DE RECARGOS NO PUDO ACTUALIZARSE, CONTACTE CON EL ADMINISTRADOR");
        }else if(data == "errorupdate"){
            elemento.classList.remove('ocultar');
            alert("ERROR EN LA ACTUALIZACION DEL MONTO DE RECARGO DEL MES");
        }else{
            alert("ERROR INESPERADO");
        }        
    } catch (error) {
        console.log(error);        
    } 
};

 export const serviciosRecibos = {
    verificarRecibos,
    generarRecibos,
    verificarRecargos,
    generarRecargos
  };