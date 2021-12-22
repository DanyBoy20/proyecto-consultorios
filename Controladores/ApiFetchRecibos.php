<?php 
/**
 * @author Daniel Hernandez <dhernandez@dhwebdesignmx.com>
 * @see <a href="https://dhwebdesignmx.com">dh Web Design</a>
 */

use Modelos\RecibosModelo;
require_once "../Modelos/RecibosModelo.php";

class ApiFetchRecibos{

    public $costoMetro;
    public $respuesta = "no";

    public function verificarExistenciaRecibos(){
        date_default_timezone_set('America/Mexico_City');
        $fecha = date("Y-m-d");
        $recibos = new RecibosModelo;    
        $iniciomes = $recibos->seleccionarInicioMes();
        $iniciodiacuatro = $recibos->seleccionarDiaCuatroMes();
        $diauno = $iniciomes->primer_dia;
        $diacuatro = $iniciodiacuatro->cuarto_dia;  
        if (($fecha >= $diauno) && ($fecha <= $diacuatro)){            
            $validarmes = date('F', strtotime($fecha));
            $validaranio = date('Y', strtotime($fecha));
            $resultado = $recibos->verificarRecibosGenerados($validarmes, $validaranio);
            if($resultado->estado == "no"){ 
                $this->respuesta = 'no_generar';
            }else{
                $this->respuesta = "si_generados";
            }    
        }else{
            $this->respuesta = "espera_fecha";
        }   
        echo json_encode($this->respuesta);  
    }

    public function GenerarRecibosPagos(){
        $recibos = new RecibosModelo;
        date_default_timezone_set('America/Mexico_City');
        $fecha = date("Y-m-d");     
        $costoMe = $recibos->seleccionarCostoMetroCuadrado();
        $fechaN = explode( '-', $fecha );
        $anio = $fechaN[0];
        $mes = $fechaN[1];
        $concepto = (int)1;
        $estatus = (int)1;
        $diadiezmes = $recibos->seleccionarDiaDiezMes();
        $consultorios = $recibos->seleccionarConsultoriosDimensiones();   
        $salidaDatos = array();
        foreach($consultorios as $item){
            $salidaDatos[] = array(
                "idconsultorio" => $item['idconsultorio'],
                "idconcepto" => $concepto,
                "fechaelaboracion" => $fecha,
                "fechalimitepago" => $diadiezmes->dia_diez,
                "cverecibo" => "RM".$anio.$mes."-".$item['idconsultorio'],
                "mensualidad" => (float)$item['dimensiones'] * $costoMe->costo,
                "cantidad" => (float)$item['dimensiones'] * $costoMe->costo,                
                "comentarios" => "Evite cargos moratorios, pague antes del dia " . $diadiezmes->dia_diez,
                "estatus" => $estatus
                
            );
        }
        $respuestaServer = $recibos->registrarRecibosRenta($salidaDatos);
        if($respuestaServer){  
            $fecha1 = date("Y-m-d");          
            $mes = date('F', strtotime($fecha1));
            $anio = date('Y', strtotime($fecha1));
            $estado = "si";
            $result = $recibos->nuevaFechaRecibos($mes, $anio, $estado);          
            if($result){ 
                $this->respuesta = "exito";
            }else{
                $this->respuesta = "errorupdate";
            }  
        }else{
            $this->respuesta = "error";
        }  
        echo json_encode($this->respuesta); 
    }

    public function verificarRecargos(){
        date_default_timezone_set('America/Mexico_City');
        $fecha = date("Y-m-d");
        $recibos = new RecibosModelo;    
        $mesdiadiez = $recibos->seleccionarDiaDiezMes(); 
        $diadiez = $mesdiadiez->dia_diez;      
        if (($fecha > $diadiez)){            
            $validarmes = date('F', strtotime($fecha));
            $validaranio = date('Y', strtotime($fecha));
            $resultado = $recibos->verificarRecargosGenerados($validarmes, $validaranio);
            if($resultado->estado == "no"){ 
                $this->respuesta = 'no_generar';
            }else{
                $this->respuesta = "si_generados";
            }    
        }else{
            $this->respuesta = "espera_fecha";
        }   
        echo json_encode($this->respuesta);  
    }

    public function generarRecibosRecargos(){
        $recibosrecargos = new RecibosModelo;
        date_default_timezone_set('America/Mexico_City');
        $fecha = date("Y-m-d");     
        $consultorios = $recibosrecargos->seleccionarConsultoriosDatosrecargos();         
        $datosReciboRecargos = array();
        $datosActualizarRecibos = array();
        $datosActualizarContadorrecargos = array();  
        foreach($consultorios as $campo){
            $porcentaje = 0.05;
            $interes = 5;
            $conceptocargo = 2; 
            /* if($campo['contador'] >= 2){  a partir del tercer mes*/
                if($campo['contador'] >= 1){  # a partir del segundo mes
                $porcentaje = 0.10;
                $interes = 10;
                $conceptocargo = 3; 
            }
            $datosReciboRecargos[] = array(
                "idrecibo" => $campo['idrecibo'],
                "idconcepto" => $conceptocargo,
                "fecharecargo" => $fecha,         
                "cantidad" => $campo['cantidad'] * $porcentaje,
                "estatus" => 1
            );
            $datosActualizarRecibos[] = array(                
                "cantidad" => $campo['cantidad'] * pow(1 + ($interes/100),1),
                "idrecibo" => $campo['idrecibo']
            );
            $datosActualizarContadorrecargos[] = array(
                "contador" => $campo['contador'] + 1,
                "idconsultorio" => $campo['idconsultorio']
            );
        }
        $respuestaServer = $recibosrecargos->registrarRecibosRecargos($datosReciboRecargos);
        if($respuestaServer){  
            $fecha1 = date("Y-m-d");          
            $mes = date('F', strtotime($fecha1));
            $anio = date('Y', strtotime($fecha1));
            $estado = "si";
            $respuestaNuevaFechaRecargo = $recibosrecargos->nuevaFechaRecargos($mes, $anio, $estado);
            if($respuestaNuevaFechaRecargo){ 
                $respuestaactualizacion = $recibosrecargos->actualizarRecibosNuevaCantidad($datosActualizarRecibos);
                if($respuestaactualizacion){
                    $respuestaContadorRecargos = $recibosrecargos->actualizarContadorRecargos($datosActualizarContadorrecargos);
                    if($respuestaContadorRecargos){
                        $this->respuesta = "exito";
                    }else{
                        $this->respuesta = "errorcontador";
                    }
                }
            }else{
                $this->respuesta = "errorupdate";
            }              
        }else{
            $this->respuesta = "error";
        }  
        echo json_encode($this->respuesta);
    }

    public function listaAdeudos(){
        $adeudoslista = new RecibosModelo();        
        $respuesta = $adeudoslista->consultar();
		echo json_encode($respuesta);
    }

}

if(isset($_GET['todos'])){
    $generar = new ApiFetchRecibos;
    $generar->GenerarRecibosPagos();
}

if(isset($_GET['verificar'])){
    $verificar = new ApiFetchRecibos;
    $verificar->verificarExistenciaRecibos();
}

if(isset($_GET['verificarrecargos'])){
    $verificar = new ApiFetchRecibos;
    $verificar->verificarRecargos();
}

if(isset($_GET['recargos'])){
    $verificar = new ApiFetchRecibos;
    $verificar->generarRecibosRecargos();
}


if(isset($_GET['adeudos'])){
    $listaadeudos = new ApiFetchRecibos;
    $listaadeudos->listaAdeudos();
}

