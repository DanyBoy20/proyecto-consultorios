<?php namespace Controladores;
/**
 * @author Daniel Hernandez <dhernandez@dhwebdesignmx.com>
 * @see <a href="https://dhwebdesignmx.com">dh Web Design</a>
 */

use Interfaces\IDocumentos;
use Modelos\RecibosRentaModelo;
require_once "../Interfaces/IDocumentos.php";
require_once "../Modelos/RecibosRentaModelo.php";

class Documentos implements IDocumentos {
    
    public $respuesta = [];

    public function ver($dato){
        $id = (int)$dato;
        $buscarrecibo = new RecibosRentaModelo();
        $reciboid = $buscarrecibo->verRecibo($id);
        $this->respuesta = $reciboid;
        return $this->respuesta;
    }

    public function consultar($dato2){  
        $id = (int)$dato2;
        $buscarrecibo = new RecibosRentaModelo();
        $reciboid = $buscarrecibo->verRecargos($id);
        $this->respuesta = $reciboid;
        return $this->respuesta;
    }
    
    public function guardar(){}

    public function editar(){}
    
    public function actualizarContraseña(){}   


}
