<?php namespace Controladores;
/**
 * @author Daniel Hernandez <dhernandez@dhwebdesignmx.com>
 * @see <a href="https://dhwebdesignmx.com">dh Web Design</a>
 */

use Modelos\EnlacesModelos;

class EnlacesControlador{

    public $respuesta;

    public function enlacesControlador(){
        $enlaces = (isset($_GET["action"])) ? $enlaces = $_GET["action"] : $enlaces = "index";
        $modulo = new EnlacesModelos();
        $respuesta = $modulo->enlacesModelo($enlaces);       
        include $respuesta;       
    }

}