<?php
namespace Servicios;
use Exception;
/**
 * @author Daniel Hernandez <dhernandez@dhwebdesignmx.com>
 * @see <a href="https://dhwebdesignmx.com">dh Web Design</a>
 */
class ConsultoriosServicios{
    static function tablaMostrarListaConsultoriosN1(array $resultados, int $contador){
        if (!empty($resultados)) {
            foreach ($resultados as $consultorio) {
                echo '<tr>
                    <td class="celda__contenido">' . $consultorio["cvecons"] . '</td>
                    <td class="celda__contenido">' . $consultorio["dimensiones"] . 'm<sup>2</sup></td>
                    <td class="celda__contenido">' . $consultorio["titulo"] . ' ' . $consultorio["nombre"] . ' ' . $consultorio["apellidop"] . ' ' . $consultorio["apellidom"] . '</td>
                    <td class="celda__contenido">
                    <form class="formeliminar" name="form' . ++$contador . '" method="post" action="expediente-consultorio">
                        <input type="hidden" name="idconsultorio" value="' . $consultorio["idconsultorio"] . '">
                        <input class="btnVerde5" type="submit" value="Ver">
                    </form>
                    <form class="formeliminar" name="form' . ++$contador . '" method="post" action="editar-datos-propietario">
                        <input type="hidden" name="idconsultorio" value="' . $consultorio["idconsultorio"] . '">
                        <input class="btnAzul" type="submit" value="Editar">
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

    static function mostrarExpedienteConsultorio(array $consultorio, array $recibos){
        if (!empty($consultorio)) {
            echo "
            <div class='contenedor__secciones_titulos'>
                <div class='seccion__titulo color_titulo_seccion'>
                    <div class='contenedor__seccion__descripcion'>
                        <h3 class='contenedor__seccion__titulo texto-normal'>Consultorio " . $consultorio[0]['cvecons'] . "
                        </h3>
                    </div>
                </div>
            </div>
            <div class='principal1'>
                <section class='division_secciones'>
                    <div class='contenedor_izq_der'>
                        <div class='caja__izq_perfil2'>
                            <div class='datos'>
                                <h2 class='elemento_individual_form_self8 usuario_campo2'>Ubicación:</h2>
                                <p id='tel' class='usuario_valor2'>&nbsp;" . $consultorio[0]['descripcion'] . "</p>
                                <h2 class='elemento_individual_form_self8 usuario_campo2'>Dimensión:</h2>
                                <p id='celu' class='usuario_valor2'>&nbsp;" . $consultorio[0]['dimensiones'] . "m<sup>2</sup></p>
                                <br>&nbsp;
                                <hr>
                                <br>&nbsp;
                            </div>
                        </div>
                        <div class='caja__der'>
                            <div id='seccion__izquierda' class='seccion__izquierda'>
                                <div class='contenedor_elementos_fieldset'>
                                    <div class='elemento_individual_form'>
                                        <h2 id='email' name='email' class='fondot elemento_individual_form_self8'>&nbsp;Propietario</h2>
                                        <p for='email'>&nbsp;" . $consultorio[0]['titulo'] . " " . $consultorio[0]['nombre'] . " " . $consultorio[0]['apellidop'] . " " . $consultorio[0]['apellidom'] . "</p>
                                    </div>
                                    <div class='elemento_individual_form'>                            
                                        <h2 id='email' name='email' class='fondot elemento_individual_form_self8'>&nbsp;Correo</h2>
                                        <p for='email'>&nbsp;" . $consultorio[0]['correo'] . "</p>
                                    </div>
                                    <div class='elemento_individual_form'>                            
                                        <h2 id='email' name='email' class='fondot elemento_individual_form_self8'>&nbsp;Teléfono</h2>
                                        <p for='email'>&nbsp;" . $consultorio[0]['telefono'] . "</p>
                                    </div>  
                                    <div class='elemento_individual_form'>                            
                                        <h2 id='email' name='email' class='fondot elemento_individual_form_self8'>&nbsp;Costo cuota mensual:</h2>
                                        <p for='email'>&nbsp;MX$ " . number_format($consultorio[0]['cantidadpagar'], 2, ".", ",") . "</p>
                                    </div>                                                                                        
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <div class='seccion__derecha'>
                <div class='tarjeta__cabecera'>
                    <div class='tarjeta__cabecera-titulo texto-normal'>
                        Cuotas pendientes
                    </div>
                </div>
                <!-- Contenido -->
                <div class='tarjeta'>
                    <div class='tabla__contenidos' tabindex='0'>
                        <table class='tabla__general'>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Fecha elaboración</th>
                                    <th>Fecha limite de pago</th>
                                    <th>Cantidad</th>
                                    <th>Estado</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody>";
            if (empty($recibos)) {
                echo "
                                <tr>
                                    <td colspan='6' class='celda__contenido'>NO TIENE RECIBOS PENDIENTES DE PAGO</td>
                                </tr>";
            } else {
                $contador = 0;
                foreach ($recibos as $recibo) {
                    echo "
                                    <tr>
                                        <td class='celda__contenido'>" . $recibo['cverecibo'] . "</td>
                                        <td class='celda__contenido'>" . $recibo['fechaelaboracion'] . "</td>
                                        <td class='celda__contenido'>" . $recibo['fechalimitepago'] . "</td>
                                        <td class='celda__contenido'>MX$ " . number_format($recibo["cantidad"], 2, ".", ",") . "</td>";
                    if ($recibo['estatus'] == 1) {
                        echo "<td class='celda__contenido'>ADEUDO</td>";
                    }
                    echo "
                                        <td class='celda__contenido'>
                                            <form class='formeliminar' name='form'" . ++$contador . "' method='post' action='recibo'>
                                                <input type='hidden' name='idrecibo' value='" . $recibo['idrecibo'] . "'>
                                                <input class='btnVerde5' type='submit' value='IMPRIMIR'>
                                            </form>
                                            <form class='formeliminar' name='formeditar'" . ++$contador . "' method='post' action='registro-pagos'>
                                                <input type='hidden' name='idrecibo' value='" . $recibo['idrecibo'] . "'>
                                                <input type='hidden' name='idconsultorio' value='" . $recibo['idconsultorio'] . "'>
                                                <input class='btnVerde5' type='submit' value='REGISTRAR PAGO'>
                                            </form>
                                            <a href='mailto:".$consultorio[0]['correo']."?cc=copia@correo.com&subject=Recibo%20de%20pago&body=Se%20genero%20su%20recibo%20de%20pago%0D%0AFecha:%20%20".$recibo['fechaelaboracion']."%0D%0AAdeudo:%20%20MX$".number_format($recibo["cantidad"], 2, ".", ",")."%0D%0AFecha%20limite%20de%20pago:%20%20".$recibo['fechalimitepago']."%0D%0ANumero%20de%20referencia:%20%20".$recibo['cverecibo'].".' class='btnVerde5'><i class='icono__subtitulos iconoEnviarEmail'></i></a>
                                        </td>
                                    </tr>
                                ";
                }
            }
            echo "  
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            ";
        } else {
            echo '<script type="text/javascript">alert("Por el momento no podemos ejecutar su consulta, intente más tarde");</script>';
        }
    }

    static function editarExpedienteConsultorio(array $consultorio){
        if (!empty($consultorio)) {
            echo "
            <form id='formpropietario' method='POST'>
                <div class='contenedor__secciones_titulos'>
                    <div class='seccion__titulo color_titulo_seccion'>
                        <div class='contenedor__seccion__descripcion'>
                            <h3 class='contenedor__seccion__titulo texto-normal'>Consultorio " . $consultorio[0]['cvecons'] . "
                            </h3>
                        </div>
                    </div>
                </div>
                <div class='principal1'>
                    <section class='division_secciones'>
                        <div class='contenedor_izq_der'>
                            <div class='caja__izq_perfil2'>
                                <div class='datos'>
                                    <h2 class='elemento_individual_form_self8 usuario_campo2'>Ubicación:</h2>
                                    <p id='tel' class='usuario_valor2'>&nbsp;" . $consultorio[0]['descripcion'] . "</p>
                                    <h2 class='elemento_individual_form_self8 usuario_campo2'>Dimensión:</h2>
                                    <p id='celu' class='usuario_valor2'>&nbsp;" . $consultorio[0]['dimensiones'] . "m<sup>2</sup></p>
                                    <br>&nbsp;
                                    <hr>
                                    <br>&nbsp;
                                </div>
                            </div>
                            <div class='caja__der'>
                                <div id='seccion__izquierda' class='seccion__izquierda'>
                                    <div class='contenedor_elementos_fieldset'>
                                        <div class='elemento_individual_form'>
                                            <h2 name='email' class='fondot elemento_individual_form_self8'>&nbsp;Propietario</h2>
                                            <p for='email'>&nbsp;" . $consultorio[0]['titulo'] . " " . $consultorio[0]['nombre'] . " " . $consultorio[0]['apellidop'] . " " . $consultorio[0]['apellidom'] . "</p>
                                        </div>
                                        <div class='elemento_individual_form'>                            
                                            <h2 name='email' class='fondot elemento_individual_form_self8'>&nbsp;Costo cuota mensual:</h2>
                                            <p for='email'>&nbsp;MX$ " . number_format($consultorio[0]['cantidadpagar'], 2, ".", ",") . "</p>
                                        </div>
                                        <div class='elemento_individual_form'>                            
                                            <h2 class='fondot elemento_individual_form_self8'>&nbsp;Actualiar correo</h2>

                                            <input type='email' id='correoelectronico' name='correoelectronico' placeholder='Ingrese su correo electrónico' class='contactoForm_elemento-dimension' minlength='10' maxlength='50' required />
                                            
                                            <span class='avisoError'></span>
                                        </div>
                                        <div class='elemento_individual_form'>                            
                                            <h2 class='fondot elemento_individual_form_self8'>&nbsp;Actualizar teléfono</h2>

                                            <input type='tel' id='celular' name='celular' placeholder='10 dígitos' class='contactoForm_elemento-dimension' minlength='10' maxlength='10' />
                                            
                                            <span class='avisoError'></span>
                                            <input type='hidden' name='idpropietario' value='" . $consultorio[0]['idpropietario'] . "'>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
                <div class='seccion__derecha'>
                        <div class='elemento_individual_form_self'>
                            <button class='btnAzulBr' id='validarIngreso'>GUARDAR<i class='icono_contenidos iconoGuardar'></i></button>
                        </div>
                </div>
            </form>
            ";
        } else {
            echo '<script type="text/javascript">alert("Por el momento no podemos ejecutar su consulta, intente más tarde");</script>';
        }
    }
}
