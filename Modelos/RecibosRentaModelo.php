<?php namespace Modelos;
/**
 * @author Daniel Hernandez <dhernandez@dhwebdesignmx.com>
 * @see <a href="https://dhwebdesignmx.com">dh Web Design</a>
 */

use Exception;
use \PDOException;
require_once "Conexion.php";

class RecibosRentaModelo extends Conexion{

    private $bd;

    function __construct(){
        $this->bd = new Conexion;        
    }

    public function consultar() : array {
        try {
            $this->bd->consultaSQL("SELECT propietarios.idconsultorio, propietarios.titulo, propietarios.nombre, propietarios.apellidop, propietarios.apellidom, consultorios.cvecons, recibos.idrecibo, recibos.fechaelaboracion, recibos.fechalimitepago, recibos.cverecibo, recibos.cantidad, recibos.comentarios, recibos.estatus, conceptos.descripcion FROM propietarios INNER JOIN consultorios ON propietarios.idconsultorio = consultorios.idconsultorio INNER JOIN recibos ON consultorios.idconsultorio = recibos.idconsultorio INNER JOIN conceptos ON recibos.idconcepto = conceptos.idconcepto WHERE recibos.estatus = 1");
            $resultados = $this->bd->obtenerConjuntoRegistros1();
            return $resultados;
        } catch (PDOException $e) {
            /* echo $e->getMessage(); */
            $resultados = [];
            return $resultados;
        }
    }

    public function verRecibo($dato) : array {
        $this->bd->consultaSQL("SELECT propietarios.titulo, propietarios.nombre, propietarios.apellidop, propietarios.apellidom, consultorios.cvecons, recibos.idrecibo, recibos.fechaelaboracion, recibos.fechalimitepago, recibos.cverecibo, recibos.mensualidad, recibos.cantidad, recibos.comentarios, recibos.estatus, conceptos.descripcion FROM propietarios INNER JOIN consultorios ON propietarios.idconsultorio = consultorios.idconsultorio INNER JOIN recibos ON consultorios.idconsultorio = recibos.idconsultorio INNER JOIN conceptos ON recibos.idconcepto = conceptos.idconcepto WHERE recibos.idrecibo = :idrecibo");            
        $this->bd->enlazarValor(':idrecibo', $dato);
        $reciboConsultorio = $this->bd->obtenerConjuntoRegistros1();
        return $reciboConsultorio;
    }


    public function verRecargos($dato) : array {
        $this->bd->consultaSQL("SELECT conceptos.descripcion, conceptos.costo, recargos.fecharecargo, recargos.cantidad FROM conceptos INNER JOIN recargos ON conceptos.idconcepto = recargos.idconcepto WHERE recargos.idrecibo = :idrecibo");            
        $this->bd->enlazarValor(':idrecibo', $dato);
        $recargosConsultorio = $this->bd->obtenerConjuntoRegistros1();
        return $recargosConsultorio;

    }

}