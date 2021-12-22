/**
 * @author Dany Hernández <dhernandez@dhwebdesignmx.com>
 * @see <a href="https://dhwebdesignmx.com">dh Web Design</a>
 */

 import { serviciosRecibos as recibo } from "./servicios/servicioRecibos.js";

const recibosGenerar = document.getElementById('recibos');
const recargosGenerar = document.getElementById('recargos');

addEventListener("load", () => {
    recibo.verificarRecibos(recibosGenerar);
    recibosGenerar.addEventListener("click", () => {
        recibo.generarRecibos(recibosGenerar);
    });
    recibo.verificarRecargos(recargosGenerar);
    recargosGenerar.addEventListener("click", () => {
        recibo.generarRecargos(recargosGenerar);
    });
});


