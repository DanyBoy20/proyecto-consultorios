<?php
namespace Servicios;
use Exception;
/**
 * @author Daniel Hernandez <dhernandez@dhwebdesignmx.com>
 * @see <a href="https://dhwebdesignmx.com">dh Web Design</a>
 */

class RecibosRentaServicios {

    static function tablaMostrarListaRecibos(array $resultados, int $contador){
        if (!empty($resultados)) {
            foreach ($resultados as $recibo) {
                echo '<tr>
                    <td class="celda__contenido">'.$recibo["cvecons"].'</td>
                    <td class="celda__contenido">'.$recibo["titulo"].' '.$recibo["nombre"].' '.$recibo["apellidop"].' '.$recibo["apellidom"].'</td>
                    <td class="celda__contenido">'.$recibo["cverecibo"].'</td>                    
                    <td class="celda__contenido">'.$recibo["fechalimitepago"].'</td>
                    <td class="celda__contenido">MX$'.number_format($recibo["cantidad"], 2, ".", ",").'</td>
                    <td class="celda__contenido">
                    <form class="formeliminar" name="form' . ++$contador . '" method="post" action="recibo">
                        <input type="hidden" name="idrecibo" value="' . $recibo["idrecibo"] . '">
                        <input class="btnVerde5" type="submit" value="Ver">
                    </form>
                    <form class="formeliminar" name="form' . ++$contador . '" method="post" action="registro-pagos">
                        <input type="hidden" name="idrecibo" value="' . $recibo["idrecibo"] . '">
                        <input type="hidden" name="idconsultorio" value="' . $recibo['idconsultorio'] . '">
                        <input class="btnVerde5" type="submit" value="Registrar pago">
                    </form>
                    </td>                 
                </tr>';
            }
        } else {
            echo '<tr>
                    <td colspan="5" class="celda__contenido">Por el momento no podemos realizar su consulta, intente mas tarde</td>                 
                </tr>';
        }
    }

    static function tablaMostrarRecibo(array $resultados, array $recargos){
        if (!empty($resultados)) {
            echo "
                <div class='contenedor__secciones_titulos'>
                    <div class='seccion__titulo color_titulo_seccion'>
                        <div class='contenedor__seccion__descripcion'>
                            <h3 class='contenedor__seccion__titulo texto-normal'>
                                RECIBO
                            </h3>
                        </div>
                    </div>
                </div>                
                <div class='principal1'>
                    <section class='division_secciones'>
                        <div class='contenedor_izq_der'>
            ";
            foreach ($resultados as $recibo) {
                echo "
                <div class='caja__der'>
                    <fieldset id='seccion__izquierda' class='seccion__izquierda'>
                        <img class='logo_docus' src='Vistas/img/LOGO-PROYECTO.png' alt='Logo CEM'>
                        <div class='titulos_docs'><h1>" . strtoupper($recibo['descripcion']) . "<h1></div>
                            <div class='contenedor_elementos_fieldset'>
                                <div class='elemento_individual_form'>
                                    <label for='nombre'>Fecha elaboración:</label>
                                    <p>" . $recibo['fechaelaboracion'] . "</p>
                                </div>
                                <div class='elemento_individual_form'>
                                    <label for='nombre'>Recibo:</label>
                                    <p>" . $recibo['cverecibo'] . "</p>
                                </div>
                                <div class='elemento_individual_form'>
                                    <label for='nombre'>Consultorio:</label>
                                    <p id='fechasolicitud'>" . $recibo['cvecons'] . "</p>
                                </div>
                                <div class='elemento_individual_form'>
                                    <label for='nombre'>Propietario:</label>
                                    <p>" . $recibo['titulo'] . " " . $recibo['nombre'] . " " . $recibo['apellidop'] . " " . $recibo['apellidom'] . "</p>
                                </div>
                                <div class='elemento_individual_form'>
                                    <label for='nombre'>Cuota:</label>
                                    <p id='fechasolicitud'>MX$ " . number_format($recibo['mensualidad'], 2, ".", ",") . "</p>
                                </div>
                                ";
                            if(!empty($recargos)){
                            echo "
                                <div class='elemento_individual_form'>
                                    <label for='nombre'>Cantidad a pagar:</label>
                                    <p>MX$ " . number_format($recibo['cantidad'], 2, ".", ",") . "</p>
                                </div>";
                            }else{
                                echo "
                                <div class='elemento_individual_form'>
                                    <label for='nombre'>Cantidad a pagar:</label>
                                    <p>MX$ " . number_format($recibo['cantidad'], 2, ".", ",") . "</p>
                                </div>
                                <div class='elemento_individual_form'>
                                    <label for='nombre'>Fecha limite de pago:</label>
                                    <p>" . $recibo['fechalimitepago'] . "</p>
                                </div>
                                <div class='elemento_individual_form'>
                                    <label for='nombre'>Comentarios:</label>
                                    <p>" . $recibo['comentarios'] . "</p>
                                </div>";
                            }
                            echo "
                                <div class='elemento_individual_form_self'>
                                    <form id='imprimir' class='formeliminar' name='form' method='post' action='./Docs/recibo.php' target='_blank'>
                                        <input type='hidden' name='id' value='" . $recibo["idrecibo"] . "'>                                    
                                        <button class='boton__cambio btnAzulBr' id='botonImprimir'>IMPRIMIR</button> 
                                    </form>
                                </div>
                                <div class='espacio1'>                                
                                    <p>&nbsp;</p>
                                </div>
                            </div>
                    </fieldset>                    
                </div>";
            }
            echo "
                    </div>
                </section>
            </div>
            ";
            if(!empty($recargos)){
                echo "
            <div class='seccion__derecha'>
                <div class='tarjeta__cabecera'>
                    <div class='tarjeta__cabecera-titulo texto-normal'>
                        Recargos
                    </div>
                </div>
                <div class='tarjeta'>
                    <div class='tabla__contenidos' tabindex='0'>
                        <table class='tabla__general'>
                            <thead>
                                <tr>
                                    <th>Concepto</th>
                                    <th>Fecha de aplicación</th>
                                    <th>Interes</th>
                                    <th>Recargo</th>
                                </tr>
                            </thead>
                            <tbody>";
                                $contador = 0;
                                foreach ($recargos as $recargo) {
                                    $interes = $recargo['costo']*100;

                                    echo "
                                    <tr>
                                        <td class='celda__contenido'>" . $recargo['descripcion'] . "</td>
                                        <td class='celda__contenido'>" . $recargo['fecharecargo'] . "</td>
                                        <td class='celda__contenido'>" . $interes . "%</td>
                                        <td class='celda__contenido'>MX$ " . number_format($recargo["cantidad"], 2, ".", ",") . "</td>";
                                }                                
                            echo "  
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            ";                
            }
        } else {
            echo '<tr>
                    <td colspan="5" class="celda__contenido">Por el momento no podemos realizar su consulta, intente mas tarde</td>                 
                </tr>';
        }
    }
}
