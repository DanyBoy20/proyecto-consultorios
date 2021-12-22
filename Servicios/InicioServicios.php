<?php
namespace Servicios;
use Exception;
/**
 * @author Daniel Hernandez <dhernandez@dhwebdesignmx.com>
 * @see <a href="https://dhwebdesignmx.com">dh Web Design</a>
 */

class InicioServicios {

    static function mostrarDatosInicio(array $resultados1, array $resultados2, array $resultados3, array $resultados4, array $resultados5, string $rol){
        if(empty($resultados1) || empty($resultados2) || empty($resultados3) || empty($resultados4) || empty($resultados5)){
            echo '<script type="text/javascript">alert("NO HAY REGISTROS PARA MOSTRAR");</script>';
        }else{
            if($rol == 1 || $rol == 2){        
            echo 
                "
                <div class='contenido-atajo'>
                    <a class='linkMenu' href='adeudos'>
                    <div class='atajo color_tarjeta'>
                        <div class='atajo-icono atajo__iconoFondo--clientes'>
                            <i class='icono__atajos iconoPrestamos'></i>
                        </div>
                        <div class='atajo-descripcion'>
                            <h3 class='atajo-titulo texto-normal'>
                                Adeudos pendientes
                            </h3>
                            <p class='atajo-subtitulo'>MX$ " . number_format($resultados1[0]['adeudos'], 2, ".", ",") . "</p>
                        </div>
                    </div>
                    </a>
                    <a class='linkMenu' href='./Docs/pagomes.php' target='_blank'>
                    <div class='atajo color_tarjeta'>
                        <div class='atajo-icono atajo__iconoFondo--clientes'>
                            <i class='icono__atajos2 iconoPago'></i>
                        </div>
                        <div class='atajo-descripcion'>
                            <h3 class='atajo-titulo text-normal'>
                                Pagos del mes actual
                            </h3>
                            <p class='atajo-subtitulo'>MX$ " . number_format($resultados1[0]['ingresos'], 2, ".", ",") . "</p>
                        </div>
                    </div>
                    </a>
                    <a class='linkMenu' href='./Docs/adeudos.php' target='_blank'>
                    <div class='atajo color_tarjeta'>
                        <div class='atajo-icono atajo__iconoFondo--clientes'>
                            <i class='icono__atajos3 iconoPendiente'></i>
                        </div>
                        <div class='atajo-descripcion'>
                            <h3 class='atajo-titulo texto-normal'>
                                Consultorios con recargos
                            </h3>
                            <p class='atajo-subtitulo'>" . $resultados1[0]['cantidadconsultorios'] . "</p>
                        </div>
                    </div>
                    </a>
                </div>
                <div class='contenido__tarjetas'>
                    <div class='tarjeta'>
                        <div class='tarjeta__cabecera'>
                            <div class='tarjeta__cabecera-titulo texto-normal'>
                                Planta baja
                            </div>
                            <div class='tarjeta__cabecera_icono'>
                                <a class='linkMenu' href='planta-baja'>
                                Expedientes&nbsp;&nbsp;<i class='icono__subtitulos iconoCarpeta'></i>
                                </a>
                            </div>
                        </div>
                        <div class='tarjeta'>
                            <div class='tabla__contenidos' tabindex='0'>
                                <table class='tabla__general'>
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Propietario</th>
                                            <th>Accion</th>
                                        </tr>
                                    </thead>
                                    <tbody>";
                                    foreach ($resultados2 as $consultorios) {
                                        echo "
                                        <tr>
                                            <td class='celda__contenido'>" . $consultorios['cvecons'] . "</td>
                                            <td class='celda__contenido'>" . $consultorios['titulo'] . " " . $consultorios['nombre'] . " " . $consultorios['apellidop'] . " " . $consultorios['apellidom'] . "</td>
                                            <td class='celda__contenido'>
                                                <form class='formeliminar' method='post' action='expediente-consultorio'>
                                                <input type='hidden' name='idconsultorio' value='" . $consultorios["idconsultorio"] . "'>
                                                <button class='btnAzulBr2' id='validarIngreso'><i class='icono2 iconoVer'></i></button>
                                                </form>&nbsp;
                                                <form class='formeliminar' method='post' action='editar-datos-propietario'>
                                                <input type='hidden' name='idconsultorio' value='" . $consultorios["idconsultorio"] . "'>
                                                <button class='btnAzulBr2' id='validarIngreso'><i class='icono2 iconoEditar'></i></button>
                                                </form>
                                            </td>    
                                        </tr>
                                        ";
                                    }
                                    echo "  
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class='tarjeta'>
                        <div class='tarjeta__cabecera'>
                            <div class='tarjeta__cabecera-titulo texto-normal'>
                                Primer nivel
                            </div>
                            <div class='tarjeta__cabecera_icono'>
                                <a class='linkMenu' href='primer-nivel'>
                                Expedientes&nbsp;&nbsp;<i class='icono__subtitulos iconoCarpeta'></i>
                                </a>
                            </div>
                        </div>
                        <div class='tarjeta'>
                            <div class='tabla__contenidos' tabindex='0'>
                                <table class='tabla__general'>
                                    <thead>
                                        <tr>
                                        <th>ID</th>
                                        <th>Propietario</th>
                                        <th>Accion</th>
                                        </tr>
                                    </thead>
                                    <tbody>";
                                    foreach ($resultados3 as $consultorios) {
                                        echo "
                                        <tr>
                                            <td class='celda__contenido'>" . $consultorios['cvecons'] . "</td>
                                            <td class='celda__contenido'>" . $consultorios['titulo'] . " " . $consultorios['nombre'] . " " . $consultorios['apellidop'] . " " . $consultorios['apellidom'] . "</td>
                                            <td class='celda__contenido'>
                                                <form class='formeliminar' method='post' action='expediente-consultorio'>
                                                <input type='hidden' name='idconsultorio' value='" . $consultorios["idconsultorio"] . "'>
                                                <button class='btnAzulBr2' id='validarIngreso'><i class='icono2 iconoVer'></i></button>
                                                </form>&nbsp;
                                                <form class='formeliminar' method='post' action='editar-datos-propietario'>
                                                <input type='hidden' name='idconsultorio' value='" . $consultorios["idconsultorio"] . "'>
                                                <button class='btnAzulBr2' id='validarIngreso'><i class='icono2 iconoEditar'></i></button>
                                                </form>
                                            </td>    
                                        </tr>
                                        ";
                                    }
                                    echo "  
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                ";
                echo "
                <div class='contenido__tarjetas'>
                    <div class='tarjeta'>
                        <div class='tarjeta__cabecera'>
                            <div class='tarjeta__cabecera-titulo texto-normal'>
                                Segundo nivel
                            </div>
                            <div class='tarjeta__cabecera_icono'>
                                <a class='linkMenu' href='segundo-nivel'>
                                Expedientes&nbsp;&nbsp;<i class='icono__subtitulos iconoCarpeta'></i>
                                </a>
                            </div>
                        </div>
                        <div class='tarjeta'>
                            <div class='tabla__contenidos' tabindex='0'>
                                <table class='tabla__general'>
                                    <thead>
                                        <tr>
                                        <th>ID</th>
                                        <th>Propietario</th>
                                        <th>Accion</th>
                                        </tr>
                                    </thead>
                                    <tbody>";
                                    foreach ($resultados4 as $consultorios) {
                                        echo "
                                        <tr>
                                            <td class='celda__contenido'>" . $consultorios['cvecons'] . "</td>
                                            <td class='celda__contenido'>" . $consultorios['titulo'] . " " . $consultorios['nombre'] . " " . $consultorios['apellidop'] . " " . $consultorios['apellidom'] . "</td>
                                            <td class='celda__contenido'>
                                                <form class='formeliminar' method='post' action='expediente-consultorio'>
                                                <input type='hidden' name='idconsultorio' value='" . $consultorios["idconsultorio"] . "'>
                                                <button class='btnAzulBr2' id='validarIngreso'><i class='icono2 iconoVer'></i></button>
                                                </form>&nbsp;
                                                <form class='formeliminar' method='post' action='editar-datos-propietario'>
                                                <input type='hidden' name='idconsultorio' value='" . $consultorios["idconsultorio"] . "'>
                                                <button class='btnAzulBr2' id='validarIngreso'><i class='icono2 iconoEditar'></i></button>
                                                </form>
                                            </td>    
                                        </tr>
                                        ";
                                    }
                                    echo "  
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class='tarjeta'>
                        <div class='tarjeta__cabecera'>
                            <div class='tarjeta__cabecera-titulo texto-normal'>
                                Tercer nivel
                            </div>
                            <div class='tarjeta__cabecera_icono'>
                                <a class='linkMenu' href='tercer-nivel'>
                                    Expedientes&nbsp;&nbsp;<i class='icono__subtitulos iconoCarpeta'></i>
                                </a>
                            </div>
                        </div>
                        <div class='tarjeta'>
                            <div class='tabla__contenidos' tabindex='0'>
                                <table class='tabla__general'>
                                    <thead>
                                        <tr>
                                        <th>ID</th>
                                        <th>Propietario</th>
                                        <th>Accion</th>
                                        </tr>
                                    </thead>
                                    <tbody>";
                                    foreach ($resultados5 as $consultorios) {
                                        echo "
                                        <tr>
                                            <td class='celda__contenido'>" . $consultorios['cvecons'] . "</td>
                                            <td class='celda__contenido'>" . $consultorios['titulo'] . " " . $consultorios['nombre'] . " " . $consultorios['apellidop'] . " " . $consultorios['apellidom'] . "</td>
                                            <td class='celda__contenido'>
                                                <form class='formeliminar' method='post' action='expediente-consultorio'>
                                                <input type='hidden' name='idconsultorio' value='" . $consultorios["idconsultorio"] . "'>
                                                <button class='btnAzulBr2' id='validarIngreso'><i class='icono2 iconoVer'></i></button>
                                                </form>&nbsp;
                                                <form class='formeliminar' method='post' action='editar-datos-propietario'>
                                                <input type='hidden' name='idconsultorio' value='" . $consultorios["idconsultorio"] . "'>
                                                <button class='btnAzulBr2' id='validarIngreso'><i class='icono2 iconoEditar'></i></button>
                                                </form>
                                            </td>    
                                        </tr>
                                        ";
                                    }
                                    echo "  
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                ";
            }else{
                echo '<script type="text/javascript">alert("MOSTRAR OPCIONES DIFERENTE USUARIO");</script>';
            }
        }
    }
    
}
