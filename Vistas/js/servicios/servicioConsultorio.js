/**
 * @author Dany Hernández <dhernandez@dhwebdesignmx.com>
 * @see <a href="https://dhwebdesignmx.com">dh Web Design</a>
 */

 const cargarConsultorios = async (elemento, nivel) => {
    console.log(nivel.value);
    elemento.innerHTML = "";
    try {
        const url = `Controladores/ApiFetchConsultorios.php?todos=${nivel.value}`;
        const res = await fetch(url);
        const data = await res.json();
        construirListaConsultorios(data, elemento);
    } catch (error) {
        elemento.innerHTML = "";
        elemento.innerHTML = "<tr><td colspan='6' class='celda__contenido'>Por el momento, no podemos procesar su solicitud. Intente mas tarde</td></tr>";
    }      
};

const cargarConsultorioFiltrado = async (entrada, elemento, nivel) => { 
    try {
        const url = `Controladores/ApiFetchConsultorios.php?busqueda=${entrada.value}&niveln=${nivel.value}`;
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

const valorBuscado = (event, elemento, nivel) => {
    let entrada = event.target;
    let caracteresMinimos = 0;
    let soloTexto = /^[0-9A-Za-zñáéíóúÑÁÉÍÓÚüÜ;¡!¿?\.\s\-,\d\(\)\-]+$/;
    if(entrada.value.length < caracteresMinimos){
        elemento.innerHTML = "";    
        return;
    }else if(!soloTexto.test(event.target.value)){
        alert("Solo se aceptan letras en el campo de busqueda");
        nombre.value = "";
        cargarConsultorios(elemento, nivel);

    }else if(event.keyCode == 32){
        alert("Debe escribir los datos del consultorio a buscar");
        nombre.value = "";
        cargarConsultorios(elemento, nivel);    

    }else{
        cargarConsultorioFiltrado(entrada, elemento, nivel);
    }
}

 const construirListaConsultorios = (datos, elementoFormulario) => {
    const fragment = document.createDocumentFragment();
        for (const elementos of datos) {            
            const fila = document.createElement("TR");
                const celdaclave = document.createElement("TD");
                const celdadimensiones = document.createElement("TD");
                const celdapropietario = document.createElement("TD");
                const celdaaccion = document.createElement("TD");
                celdaclave.setAttribute("class", "celda__contenido");
                celdadimensiones.setAttribute("class", "celda__contenido");
                celdapropietario.setAttribute("class", "celda__contenido");
                celdaaccion.setAttribute("class", "celda__contenido");                
                
                var formVer = document.createElement("FORM");
                formVer.setAttribute("class", "formeliminar");
                formVer.setAttribute("name", "form");
                formVer.setAttribute("method", "post");
                formVer.setAttribute("action", "expediente-consultorio");
                var valorVer = document.createElement("INPUT");
                valorVer.setAttribute("type", "hidden");
                valorVer.setAttribute("name", "idconsultorio");
                valorVer.setAttribute("value", elementos.idconsultorio);           
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
                formEditar.setAttribute("action", "editar-datos-propietario");            
                var valorEditar = document.createElement("INPUT");
                valorEditar.setAttribute("type", "hidden");
                valorEditar.setAttribute("name", "idconsultorio");
                valorEditar.setAttribute("value", elementos.idconsultorio);  
                var editarSubmit = document.createElement("INPUT");
                editarSubmit.setAttribute("class", "btnAzul");
                editarSubmit.setAttribute("type", "submit");
                editarSubmit.setAttribute("value", "Editar");                   
                formEditar.appendChild(valorEditar);                 
                formEditar.appendChild(editarSubmit); 

                celdaclave.innerHTML = elementos.cvecons;
                celdadimensiones.innerHTML = elementos.dimensiones + "m<sup>2</sup>";
                celdapropietario.innerHTML = elementos.titulo + " " + elementos.nombre + " " + elementos.apellidop + " " + elementos.apellidom;
                celdaaccion.appendChild(formVer);
                celdaaccion.appendChild(formEditar);

            fila.appendChild(celdaclave);
            fila.appendChild(celdadimensiones);
            fila.appendChild(celdapropietario);
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