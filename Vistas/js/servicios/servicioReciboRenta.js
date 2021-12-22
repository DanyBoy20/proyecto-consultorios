/**
 * @author Dany Hernández <dhernandez@dhwebdesignmx.com>
 * @see <a href="https://dhwebdesignmx.com">dh Web Design</a>
 */

 const formatoMoneda = new Intl.NumberFormat('en-MX', {
    style: 'currency',
    currency: 'MXN',
    /* minimumFractionDigits: 0, 2 DECIMALES
    maximumFractionDigits: 0, REDONDEA */
  });

 const cargarConsultorios = async (elemento) => {
    elemento.innerHTML = "";
    try {
        const url = "Controladores/ApiFetchAdeudos.php?adeudos=verdadero";
        const res = await fetch(url);
        const data = await res.json();
        console.log(data);
        construirListaConsultorios(data, elemento);
    } catch (error) {
        elemento.innerHTML = "";
        elemento.innerHTML = "<tr><td colspan='6' class='celda__contenido'>Por el momento, no podemos procesar su solicitud. Intente mas tarde</td></tr>";
    }      
};

const cargarConsultorioFiltrado = async (entrada, elemento) => {    
    try {
        const url = `Controladores/ApiFetchAdeudos.php?busqueda=${entrada.value}`;
        const res = await fetch(url);
        const data = await res.json();
        if(data.length === 0){
            elemento.innerHTML = "";
            elemento.innerHTML = "<tr><td colspan='6' class='celda__contenido'>Su busqueda no arrojo ningun dato</td></tr>";
        }else{
            elemento.innerHTML = "";
            construirListaConsultorios(data, elemento);
        }
    } catch (error) {
        elemento.innerHTML = "";
        elemento.innerHTML = "<tr><td colspan='6' class='celda__contenido'>Por el momento no podemos ejecutar su busqueda, intente más tarde</td></tr>";
    }
}

const valorBuscado = (event, elemento) => {
    let entrada = event.target;
    let caracteresMinimos = 0;
    let soloTexto = /^[0-9A-Za-zñáéíóúÑÁÉÍÓÚüÜ;¡!¿?\.\s\-,\d\(\)\-]+$/;
    if(entrada.value.length < caracteresMinimos){
        elemento.innerHTML = "";    
        return;
    }else if(!soloTexto.test(event.target.value)){
        alert("Solo se aceptan letras en el campo de busqueda");
        nombre.value = "";
        cargarConsultorios(elemento);

    }else if(event.keyCode == 32){
        alert("Debe escribir los datos del consultorio a buscar");
        nombre.value = "";
        cargarConsultorios(elemento);    

    }else{
        cargarConsultorioFiltrado(entrada, elemento);
    }
}

 const construirListaConsultorios = (datos, elementoFormulario) => {
    const fragment = document.createDocumentFragment();
        for (const elementos of datos) {
            const fila = document.createElement("TR");
                const celdaidconsultorio = document.createElement("TD");
                const celdapropietario = document.createElement("TD");
                const celdarecibo = document.createElement("TD");
                const celdafechalimite = document.createElement("TD");
                const celdacantidad = document.createElement("TD");
                const celdaaccion = document.createElement("TD");
                celdaidconsultorio.setAttribute("class", "celda__contenido");
                celdapropietario.setAttribute("class", "celda__contenido");
                celdarecibo.setAttribute("class", "celda__contenido");
                celdafechalimite.setAttribute("class", "celda__contenido");
                celdacantidad.setAttribute("class", "celda__contenido");
                celdaaccion.setAttribute("class", "celda__contenido");                
                
                var formVer = document.createElement("FORM");
                formVer.setAttribute("class", "formeliminar");
                formVer.setAttribute("name", "form");
                formVer.setAttribute("method", "post");
                formVer.setAttribute("action", "recibo"); 
                var valorVer = document.createElement("INPUT");
                valorVer.setAttribute("type", "hidden");
                valorVer.setAttribute("name", "idrecibo");
                valorVer.setAttribute("value", elementos.idrecibo);           
                var verSubmit = document.createElement("INPUT");
                verSubmit.setAttribute("class", "btnVerde5");
                verSubmit.setAttribute("type", "submit");
                verSubmit.setAttribute("value", "Ver");
                formVer.appendChild(valorVer);          
                formVer.appendChild(verSubmit); 
                
                var formEditar = document.createElement("FORM");
                formEditar.setAttribute("class", "formeliminar");
                formEditar.setAttribute("name", "form");
                formEditar.setAttribute("method", "post");
                formEditar.setAttribute("action", "registro-pagos"); 
                var valorEditar = document.createElement("INPUT");
                valorEditar.setAttribute("type", "hidden");
                valorEditar.setAttribute("name", "idrecibo");
                valorEditar.setAttribute("value", elementos.idrecibo); 
                var valorEditar2 = document.createElement("INPUT");
                valorEditar2.setAttribute("type", "hidden");
                valorEditar2.setAttribute("name", "idconsultorio");
                valorEditar2.setAttribute("value", elementos.idconsultorio); 
                var editarSubmit = document.createElement("INPUT");
                editarSubmit.setAttribute("class", "btnAzul");
                editarSubmit.setAttribute("type", "submit");
                editarSubmit.setAttribute("value", "Registrar pago");                   
                formEditar.appendChild(valorEditar);    
                formEditar.appendChild(valorEditar2);             
                formEditar.appendChild(editarSubmit); 

                celdaidconsultorio.innerHTML = elementos.cvecons;
                celdapropietario.innerHTML = elementos.titulo + " " + elementos.nombre + " " + elementos.apellidop + " " + elementos.apellidom;
                celdarecibo.innerHTML = elementos.cverecibo;
                celdafechalimite.innerHTML = elementos.fechalimitepago;
                celdacantidad.innerHTML = formatoMoneda.format(elementos.cantidad);
                celdaaccion.appendChild(formVer);
                celdaaccion.appendChild(formEditar);

            fila.appendChild(celdaidconsultorio);
            fila.appendChild(celdapropietario);
            fila.appendChild(celdarecibo);
            fila.appendChild(celdafechalimite);
            fila.appendChild(celdacantidad);
            fila.appendChild(celdaaccion);
            fragment.append(fila);
        }
        elementoFormulario.appendChild(fragment);
}

 export const serviciosConsultorios = {
    cargarConsultorios,
    valorBuscado,
    cargarConsultorioFiltrado
  };