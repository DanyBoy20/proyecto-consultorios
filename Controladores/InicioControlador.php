<?php namespace Controladores;
/**
 * @author Daniel Hernandez <dhernandez@dhwebdesignmx.com>
 * @see <a href="https://dhwebdesignmx.com">dh Web Design</a>
 */

use Interfaces\IInicio;
use Modelos\InicioModelo;
use Servicios\InicioServicios;

class InicioControlador implements IInicio {

    public function ver($rol){  
        $verdatosiniciales = new InicioModelo();
        $resultados = $verdatosiniciales->consultar();
        list($res1, $res2, $res3, $res4, $res5) = $resultados;
        InicioServicios::mostrarDatosInicio($res1, $res2, $res3, $res4, $res5, $rol); 
    }

    public function editar(){}

    public function consultar(){}    
    
    public function guardar(){}
    
    public function actualizarContraseña(){}


}
