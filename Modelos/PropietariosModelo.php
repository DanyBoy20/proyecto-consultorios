<?php namespace Modelos;
/**
 * @author Daniel Hernandez <dhernandez@dhwebdesignmx.com>
 * @see <a href="https://dhwebdesignmx.com">dh Web Design</a>
 */

use Exception;
use \PDOException;
require_once "Conexion.php";

class PropietariosModelo extends Conexion{

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

    
    public function actualizarPropietario($datos){
        try {            
            $estado = 0;
            $this->bd->consultaSQL("UPDATE propietarios SET correo = :correo, telefono = :telefono WHERE idpropietario  = :idpropietario");            
            $this->bd->enlazarValor(':correo', $datos['correoelectronico']);
            $this->bd->enlazarValor(':telefono', $datos['celular']);
            $this->bd->enlazarValor(':idpropietario', $datos['idpropietario']);
            $this->bd->ejecutar();
            return true;
        } catch (PDOException $e) {
            return false;
        }     
    }


    

}