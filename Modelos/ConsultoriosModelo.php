<?php namespace Modelos;
/**
 * @author Daniel Hernandez <dhernandez@dhwebdesignmx.com>
 * @see <a href="https://dhwebdesignmx.com">dh Web Design</a>
 */

use Exception;
use \PDOException;
require_once "Conexion.php";

class ConsultoriosModelo extends Conexion{

    private $bd;

    function __construct(){
        $this->bd = new Conexion;        
    }

    public function consultar($planta) : array {
        try {
            $this->bd->consultaSQL("SELECT contadorrecargos.contador, consultorios.idconsultorio, consultorios.cvecons, consultorios.dimensiones, consultorios. disponible, consultorios.estado, propietarios.titulo, propietarios.nombre, propietarios.apellidop, propietarios.apellidom FROM contadorrecargos INNER JOIN consultorios ON contadorrecargos.idconsultorio = consultorios.idconsultorio INNER JOIN propietarios ON consultorios.idconsultorio = propietarios.idconsultorio WHERE consultorios.idplanta = :planta");
            $this->bd->enlazarValor(':planta', $planta);
            $resultados = $this->bd->obtenerConjuntoRegistros1();
            return $resultados;
        } catch (PDOException $e) {
            /* echo $e->getMessage(); */
            $resultados = [];
            return $resultados;
        }
    }

    public function buscarConsultoriolista($valorBuscado, $nnivel){
        try {
            $this->bd->consultaSQL("SELECT contadorrecargos.contador, consultorios.idplanta, consultorios.idconsultorio, consultorios.cvecons, consultorios.dimensiones, consultorios. disponible, consultorios.estado, propietarios.titulo, propietarios.nombre, propietarios.apellidop, propietarios.apellidom FROM contadorrecargos INNER JOIN consultorios ON contadorrecargos.idconsultorio = consultorios.idconsultorio INNER JOIN propietarios ON consultorios.idconsultorio = propietarios.idconsultorio WHERE consultorios.idplanta = :planta AND propietarios.apellidop LIKE '" . $valorBuscado . "%'");      
            $this->bd->enlazarValor(':planta', $nnivel);
            $resultados = $this->bd->obtenerConjuntoRegistros1();
            return $resultados;
        } catch (PDOException $e) {
            $resultados = [];
            return $resultados;
        }     
    }

    public function datosExpedienteConsultorio($dato){
        $this->bd->consultaSQL("SELECT plantas.idplanta, plantas.cveplnt, plantas.descripcion, consultorios.idconsultorio, consultorios.cvecons,consultorios.dimensiones,  consultorios.dimensiones *  (SELECT conceptos.costo FROM conceptos WHERE idconcepto = 1) AS cantidadpagar, propietarios.idpropietario, propietarios.titulo, propietarios.nombre, propietarios.apellidop, propietarios.apellidom, propietarios.correo, propietarios.telefono FROM plantas INNER JOIN consultorios ON plantas.idplanta = consultorios.idplanta INNER JOIN propietarios ON consultorios.idconsultorio = propietarios.idpropietario WHERE consultorios.idconsultorio = :idconsultorio");            
        $this->bd->enlazarValor(':idconsultorio', $dato);
        $hospital = $this->bd->obtenerConjuntoRegistros1();
        return $hospital;
    }

    public function datosRecibosExpedienteConsultorio($dato){
        $estado = 1;
        $this->bd->consultaSQL("SELECT recibos.idrecibo, recibos.idconsultorio, recibos.fechaelaboracion, recibos.fechalimitepago, recibos.cverecibo, recibos.cantidad, recibos.estatus FROM recibos WHERE recibos.idconsultorio = :idconsultorio AND recibos.estatus = :estado");            
        $this->bd->enlazarValor(':idconsultorio', $dato);
        $this->bd->enlazarValor(':estado', $estado);
        $hospital = $this->bd->obtenerConjuntoRegistros1();
        return $hospital;
    }

}