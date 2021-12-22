<?php namespace Controladores;
/**
 * @author Daniel Hernandez <dhernandez@dhwebdesignmx.com>
 * @see <a href="https://dhwebdesignmx.com">dh Web Design</a>
 */

use Interfaces\IRegistroPagos;
use Modelos\RegistroPagosModelo;
use Servicios\RegistroPagoServicios;

class RegistroPagosControlador implements IRegistroPagos { 

    public function editar(){
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            if(isset($_POST['idrecibo'])){
                if($_POST['idrecibo'] == ""){
                    echo '<script type="text/javascript">alert("No se recibieron datos, intente nuevamente");</script>';
                    echo '<script>window.location.href = "inicio"</script>';
                }else{
                    $datosconsultorio = $_POST['idrecibo'];
                    $seleccionconsultorio = new RegistroPagosModelo();
                    $consultorio = $seleccionconsultorio->datosConsultorio($datosconsultorio);
                    $recibo = $seleccionconsultorio->datosRecibos($datosconsultorio);
                    RegistroPagoServicios::mostrarExpedienteRecibo($consultorio, $recibo);
                } 
            }else if(isset($_POST['idrecibo2'])){
                if($_POST['idrecibo2'] == ""){
                    echo '<script type="text/javascript">alert("No se recibieron datos, intente nuevamente");</script>';
                    echo '<script>window.location.href = "inicio"</script>';
                }else{
                    $hoy = date('Y-m-d');
                    $datosReciboPago = array(
                        "idrecibo" => $_POST['idrecibo2'],
                        "idformapago" => $_POST['formapago'],
                        "cvepago" => $hoy."RP".$_POST['idrecibo2'],
                        "fechapago" => $hoy,
                        "comentarios" => $_POST['mensaje'],
                        "estatus" => 0          
                     );
                    $guardarRegistroPago = new RegistroPagosModelo();
                    $resultado = $guardarRegistroPago->registroPago($datosReciboPago);
                    if($resultado){
                        $checarContador = $guardarRegistroPago->verificarContador($_POST['idconsultorio']);
                        if($checarContador['contador'] == 0){
                            echo '<script type=text/javascript">alert("VALOR" . $checarContador . ");</script>';
                            $actualizacontador = $guardarRegistroPago->actualizarContador();
                        }else{
                            echo '<script type="text/javascript">alert("VALOR 2" . $checarContador . ");</script>';
                            $actualizacontador = $guardarRegistroPago->actualizarContadorMenosUno($_POST['idconsultorio']);
                        }
                        if($actualizacontador){
                            $existerecargo = $guardarRegistroPago->verificarExistenciaRecargo($_POST['idrecibo2']);
                            if($existerecargo){
                                $existerecargo = $guardarRegistroPago->actualizarReciboRecargo($_POST['idrecibo2']);
                            }
                            echo '<script type="text/javascript">alert("PAGO REGISTRADO");</script>';
                            echo "<script>window.location.href='inicio'</script>";
                        }else{
                            echo '<script type="text/javascript">alert("ERROR EN LA ACTUALIZACION DEL REGISTRO DE PAGO - CONTADOR");</script>';
                            echo "<script>window.location.href='inicio'</script>";
                        }
                    }else{
                        echo '<script type="text/javascript">alert("NO SE PUDO GUARDAR EL REGISTRO DE PAGO, INTENTE MAS TARDE");</script>';
                        echo "<script>window.location.href='inicio'</script>";
                    }
                }    
            }else{
                echo '<script type="text/javascript">alert("NO SE RECIBIERON DATOS");</script>';
                echo "<script>window.location.href='inicio'</script>";
            }
        }        
    }


}

