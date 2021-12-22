<?php namespace Controladores;
/**
 * @author Daniel Hernandez <dhernandez@dhwebdesignmx.com>
 * @see <a href="https://dhwebdesignmx.com">dh Web Design</a>
 */

use Interfaces\IRecibosRenta;
use Modelos\RecibosRentaModelo;
use Servicios\RecibosRentaServicios;

class RecibosRentaControlador implements IRecibosRenta {

    public function consultar(){    
            $consultorios = new RecibosRentaModelo();
            $resultados = $consultorios->consultar();
            $contador = 0;
            RecibosRentaServicios::tablaMostrarListaRecibos($resultados, $contador);        
    }

    public function ver(){
        if(isset($_POST['idrecibo'])){
            $idcap = trim($_POST['idrecibo']);
            if($idcap == ""){
                echo '<script type="text/javascript">alert("No se recibieron datos");</script>';
                echo '<script>window.location.href = "inicio"</script>';
            }else{
                $buscarrecibo = new RecibosRentaModelo();
                $recibo = $buscarrecibo->verRecibo($idcap);
                if($recibo){
                    $recargo = $buscarrecibo->verRecargos($idcap);
                    RecibosRentaServicios::tablaMostrarRecibo($recibo, $recargo);                        
                }else{
                    echo '<script type="text/javascript">alert("SU CONSULTA NO ARROJO NINGUN DATO");</script>';
                    echo '<script>window.location.href = "inicio"</script>';
                }                    
            }            
        }
    }

}
