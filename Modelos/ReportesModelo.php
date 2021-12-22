<?php namespace Modelos;
/**
 * @author Daniel Hernandez <dhernandez@dhwebdesignmx.com>
 * @see <a href="https://dhwebdesignmx.com">dh Web Design</a>
 */

use Exception;
use \PDOException;
require_once "Conexion.php";

class ReportesModelo extends Conexion{

    private $bd;
    private $plantabaja = 1;
    private $nivel1 = 2;
    private $nivel2 = 3;
    private $nivel3 = 4;

    function __construct(){
        $this->bd = new Conexion;        
    }

    public function seleccionarNiveles() : array {
        try {
            $this->bd->consultaSQL("SELECT idplanta, descripcion FROM plantas");
            $resultados = $this->bd->obtenerConjuntoRegistros1();
            return $resultados;
        } catch (PDOException $e) {
            /* echo $e->getMessage(); */
            $resultados = [];
            return $resultados;
        }
    }

    public function seleccionarCuota() : array {
        try {
            $this->bd->consultaSQL("SELECT descripcion, costo FROM conceptos");
            $resultados = $this->bd->obtenerConjuntoRegistros1();
            return $resultados;
        } catch (PDOException $e) {
            /* echo $e->getMessage(); */
            $resultados = [];
            return $resultados;
        }
    }

    public function reporteGeneral() : array {
        try {
            $this->bd->consultaSQL("SELECT propietarios.titulo, propietarios.nombre, propietarios.apellidop, propietarios.apellidom, consultorios.idconsultorio, consultorios.cvecons, consultorios.dimensiones, plantas.idplanta, plantas.descripcion FROM propietarios INNER JOIN consultorios ON propietarios.idconsultorio = consultorios.idconsultorio INNER JOIN plantas ON consultorios.idplanta = plantas.idplanta");
            $resultados = $this->bd->obtenerConjuntoRegistros1();
            return $resultados;
        } catch (PDOException $e) {
            /* echo $e->getMessage(); */
            $resultados = [];
            return $resultados;
        }
    }

    public function totales() : array {
        try {
            $this->bd->consultaSQL("SELECT consultorios.idplanta, SUM(consultorios.dimensiones) AS totaldimension, SUM(recibos.mensualidad) AS totalmensualidad, SUM(conceptos.costo) AS totalcosto FROM consultorios INNER JOIN recibos ON consultorios.idconsultorio = recibos.idconsultorio INNER JOIN conceptos ON recibos.idconcepto = conceptos.idconcepto GROUP BY consultorios.idplanta");
            $resultados = $this->bd->obtenerConjuntoRegistros1();
            return $resultados;
        } catch (PDOException $e) {
            /* echo $e->getMessage(); */
            $resultados = [];
            return $resultados;
        }
    }

    public function adeudos() : array {
        try {
            $this->bd->consultaSQL("SELECT plantas.cveplnt, consultorios.cvecons, propietarios.titulo, propietarios.nombre, propietarios.apellidop, propietarios.apellidom, recibos.fechaelaboracion, recibos.fechalimitepago, recibos.cverecibo, recibos.mensualidad, recibos.cantidad FROM plantas INNER JOIN consultorios ON plantas.idplanta = consultorios.idplanta INNER JOIN propietarios ON consultorios.idconsultorio = propietarios.idconsultorio INNER JOIN recibos ON consultorios.idconsultorio = recibos.idconsultorio WHERE recibos.estatus != 0");
            $resultados = $this->bd->obtenerConjuntoRegistros1();
            return $resultados;
        } catch (PDOException $e) {
            /* echo $e->getMessage(); */
            $resultados = [];
            return $resultados;
        }        
    }

    public function adeudoPB(){
        try {
            $this->bd->consultaSQL("SELECT plantas.cveplnt, consultorios.cvecons, propietarios.titulo, propietarios.nombre, propietarios.apellidop, propietarios.apellidom, recibos.fechaelaboracion, recibos.fechalimitepago, recibos.cverecibo, recibos.mensualidad, recibos.cantidad FROM plantas INNER JOIN consultorios ON plantas.idplanta = consultorios.idplanta INNER JOIN propietarios ON consultorios.idconsultorio = propietarios.idconsultorio INNER JOIN recibos ON consultorios.idconsultorio = recibos.idconsultorio  WHERE consultorios.idplanta = :idplanta AND recibos.estatus != 0");
            $this->bd->enlazarValor(':idplanta', $this->plantabaja);
            $resultados = $this->bd->obtenerConjuntoRegistros1();
            return $resultados;
        } catch (PDOException $e) {
            /* echo $e->getMessage(); */
            $resultados = [];
            return $resultados;
        }
    }

    public function adeudoPN(){
        try {
            $this->bd->consultaSQL("SELECT plantas.cveplnt, consultorios.cvecons, propietarios.titulo, propietarios.nombre, propietarios.apellidop, propietarios.apellidom, recibos.fechaelaboracion, recibos.fechalimitepago, recibos.cverecibo, recibos.mensualidad, recibos.cantidad FROM plantas INNER JOIN consultorios ON plantas.idplanta = consultorios.idplanta INNER JOIN propietarios ON consultorios.idconsultorio = propietarios.idconsultorio INNER JOIN recibos ON consultorios.idconsultorio = recibos.idconsultorio  WHERE consultorios.idplanta = :idplanta AND recibos.estatus != 0");
            $this->bd->enlazarValor(':idplanta', $this->nivel1);
            $resultados = $this->bd->obtenerConjuntoRegistros1();
            return $resultados;
        } catch (PDOException $e) {
            /* echo $e->getMessage(); */
            $resultados = [];
            return $resultados;
        }
    }

    public function adeudoSN(){
        try {
            $this->bd->consultaSQL("SELECT plantas.cveplnt, consultorios.cvecons, propietarios.titulo, propietarios.nombre, propietarios.apellidop, propietarios.apellidom, recibos.fechaelaboracion, recibos.fechalimitepago, recibos.cverecibo, recibos.mensualidad, recibos.cantidad FROM plantas INNER JOIN consultorios ON plantas.idplanta = consultorios.idplanta INNER JOIN propietarios ON consultorios.idconsultorio = propietarios.idconsultorio INNER JOIN recibos ON consultorios.idconsultorio = recibos.idconsultorio  WHERE consultorios.idplanta = :idplanta AND recibos.estatus != 0");
            $this->bd->enlazarValor(':idplanta', $this->nivel2);
            $resultados = $this->bd->obtenerConjuntoRegistros1();
            return $resultados;
        } catch (PDOException $e) {
            /* echo $e->getMessage(); */
            $resultados = [];
            return $resultados;
        }
    }

    public function adeudoTN(){
        try {
            $this->bd->consultaSQL("SELECT plantas.cveplnt, consultorios.cvecons, propietarios.titulo, propietarios.nombre, propietarios.apellidop, propietarios.apellidom, recibos.fechaelaboracion, recibos.fechalimitepago, recibos.cverecibo, recibos.mensualidad, recibos.cantidad FROM plantas INNER JOIN consultorios ON plantas.idplanta = consultorios.idplanta INNER JOIN propietarios ON consultorios.idconsultorio = propietarios.idconsultorio INNER JOIN recibos ON consultorios.idconsultorio = recibos.idconsultorio  WHERE consultorios.idplanta = :idplanta AND recibos.estatus != 0");
            $this->bd->enlazarValor(':idplanta', $this->nivel3);
            $resultados = $this->bd->obtenerConjuntoRegistros1();
            return $resultados;
        } catch (PDOException $e) {
            /* echo $e->getMessage(); */
            $resultados = [];
            return $resultados;
        }
    }

    public function pagosMes(){
        try {
            $this->bd->consultaSQL("SELECT conceptos. descripcion, conceptos.costo, recargos.idconcepto, recargos.cantidad AS costorecargo, recibos.cverecibo, recibos.cantidad, pagos.cvepago, pagos.fechapago, pagos.comentarios, consultorios.cvecons FROM conceptos INNER JOIN recargos ON conceptos.idconcepto = recargos.idconcepto RIGHT OUTER JOIN recibos ON recargos.idrecibo = recibos.idrecibo INNER JOIN pagos ON recibos.idrecibo = pagos.idrecibo INNER JOIN consultorios ON recibos.idconsultorio = consultorios.idconsultorio WHERE recibos.estatus = 0 AND MONTH(pagos.fechapago) = MONTH(now()) AND YEAR(pagos.fechapago) = YEAR(now())");
            /* $this->bd->enlazarValor(':idplanta', $this->nivel3); */
            $resultados = $this->bd->obtenerConjuntoRegistros1();
            return $resultados;
        } catch (PDOException $e) {
            /* echo $e->getMessage(); */
            $resultados = [];
            return $resultados;
        }
    }

    public function pagosAnio(){
        try {
            $this->bd->consultaSQL("SELECT conceptos. descripcion, conceptos.costo, recargos.idconcepto, recargos.cantidad AS costorecargo, recibos.cverecibo, recibos.cantidad, pagos.cvepago, pagos.fechapago, pagos.comentarios, consultorios.cvecons FROM conceptos INNER JOIN recargos ON conceptos.idconcepto = recargos.idconcepto RIGHT OUTER JOIN recibos ON recargos.idrecibo = recibos.idrecibo INNER JOIN pagos ON recibos.idrecibo = pagos.idrecibo INNER JOIN consultorios ON recibos.idconsultorio = consultorios.idconsultorio WHERE recibos.estatus = 0 AND YEAR(pagos.fechapago) = YEAR(now())");
            /* $this->bd->enlazarValor(':idplanta', $this->nivel3); */
            $resultados = $this->bd->obtenerConjuntoRegistros1();
            return $resultados;
        } catch (PDOException $e) {
            /* echo $e->getMessage(); */
            $resultados = [];
            return $resultados;
        }
    }

    public function pagosPorFecha($fecha1, $fecha2){
        try {
            $this->bd->consultaSQL("SELECT conceptos. descripcion, conceptos.costo, recargos.idconcepto, recargos.cantidad AS costorecargo, recibos.cverecibo, recibos.cantidad, pagos.cvepago, pagos.fechapago, pagos.comentarios, consultorios.cvecons FROM conceptos INNER JOIN recargos ON conceptos.idconcepto = recargos.idconcepto RIGHT OUTER JOIN recibos ON recargos.idrecibo = recibos.idrecibo INNER JOIN pagos ON recibos.idrecibo = pagos.idrecibo INNER JOIN consultorios ON recibos.idconsultorio = consultorios.idconsultorio WHERE recibos.estatus = 0 AND pagos.fechapago BETWEEN :fechainicial AND :fechafinal");
            $this->bd->enlazarValor(':fechainicial', $fecha1);
            $this->bd->enlazarValor(':fechafinal', $fecha2);
            $resultados = $this->bd->obtenerConjuntoRegistros1();
            return $resultados;
        } catch (PDOException $e) {
            /* echo $e->getMessage(); */
            $resultados = [];
            return $resultados;
        }
    }



}