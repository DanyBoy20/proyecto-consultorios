<?php namespace Controladores;
/**
 * @author Daniel Hernandez <dhernandez@dhwebdesignmx.com>
 * @see <a href="https://dhwebdesignmx.com">dh Web Design</a>
 */

use Interfaces\IConsultorios;
use Modelos\ConsultoriosModelo;
use Modelos\PropietariosModelo;
use Servicios\ConsultoriosServicios;

class ConsultoriosControlador implements IConsultorios {

    private $errores = [];
    private $variablesIndefinidas = [];
    private $claveacceso;
    private $contraseniaActualizada; 
    private $nivel;

    
    public function consultarPB(){    
        
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if(!isset($_POST['correo']) || $_POST['correo'] == ""){
                echo '<script type="text/javascript">alert("NO SE RECIBIERON DATOS");</script>';
            }
        }else{
            $planta = $this->nivel = 1;
            $consultorios = new ConsultoriosModelo();
            $resultados = $consultorios->consultar($planta);
            $contador = 0;
            ConsultoriosServicios::tablaMostrarListaConsultoriosN1($resultados, $contador);
        }  
    }

    public function consultar1N(){
            $planta = $this->nivel = 2;
            $consultorios = new ConsultoriosModelo();
            $resultados = $consultorios->consultar($planta);
            $contador = 0;
            ConsultoriosServicios::tablaMostrarListaConsultoriosN1($resultados, $contador);
    }

    public function consultar2N(){
            $planta = $this->nivel = 3;
            $consultorios = new ConsultoriosModelo();
            $resultados = $consultorios->consultar($planta);
            $contador = 0;
            ConsultoriosServicios::tablaMostrarListaConsultoriosN1($resultados, $contador);
    }

    public function consultar3N(){
            $planta = $this->nivel = 4;
            $consultorios = new ConsultoriosModelo();
            $resultados = $consultorios->consultar($planta);
            $contador = 0;
            ConsultoriosServicios::tablaMostrarListaConsultoriosN1($resultados, $contador);
    }
    
    public function ver(){
        if(!isset($_POST['idconsultorio']) || $_POST['idconsultorio'] == ""){
            echo '<script type="text/javascript">alert("NO SE RECIBIERON DATOS");</script>';
            echo '<script>window.location.href="lista-Clientes"</script>';
        }else{
            /* $servicioClientes = new ClientesServicios();
            $servicioClientes->validarIdCliente($_POST['idcliente']);
            if(!empty($servicioClientes->errores)){
                $camposInvalidos = implode(",", $servicioClientes->errores);
                echo '<script type="text/javascript">alert("ERRORES EN LOS DATOS ENVIADOS: '.$camposInvalidos.'");</script>';
                echo '<script>window.location.href="lista-Clientes"</script>';
            }else{ */
                $consultorio = new ConsultoriosModelo();
                $datosconsultorio = $consultorio->datosExpedienteConsultorio($_POST['idconsultorio']);
                $datosrecibos = $consultorio->datosRecibosExpedienteConsultorio($_POST['idconsultorio']);               
                ConsultoriosServicios::mostrarExpedienteConsultorio($datosconsultorio, $datosrecibos);
            /* } */

        } 
    }

    public function editar(){
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            if(isset($_POST['idconsultorio'])){
                if($_POST['idconsultorio'] == ""){
                    echo '<script type="text/javascript">alert("NO SE RECIBIERON DATOS");</script>';
                    echo '<script>window.location.href="lista-Clientes"</script>';
                }else{
                    $consultorio = new ConsultoriosModelo();
                    $datosconsultorio = $consultorio->datosExpedienteConsultorio($_POST['idconsultorio']);              
                    ConsultoriosServicios::editarExpedienteConsultorio($datosconsultorio);
                }
            }else if(isset($_POST['correoelectronico']) && isset($_POST['celular']) && isset($_POST['idpropietario'])){
                $actualizarpropietarioC = new PropietariosModelo();
                $datosPropietario = array(
                    "correoelectronico" => $_POST['correoelectronico'],
                    "celular" => $_POST['celular'],
                    "idpropietario" => $_POST['idpropietario']            
                );
                $resultado = $actualizarpropietarioC->actualizarPropietario($datosPropietario);
                if($resultado){
                    echo '<script type="text/javascript">alert("REGISTRO ACTUALIZADO");</script>';
                    echo '<script>window.location.href="lista-Clientes"</script>';
                }else{
                    echo '<script type="text/javascript">alert("NO SE PUEDE EJECUTAR LA ACTUALIZACIÓN, INTENTE MÁS TARDE");</script>';
                    echo '<script>window.location.href="lista-Clientes"</script>';
                }
            }else{
                echo '<script type="text/javascript">alert("NO SE RECIBIERON DATOS PARA EDITAR");</script>';
                echo '<script>window.location.href="inicio"</script>';

            }

        }
    }

    public function actualizarContraseña(){}
    public function guardar(){}


}
