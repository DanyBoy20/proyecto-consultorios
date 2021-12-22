<?php namespace Modelos;
/**
 * @author Daniel Hernandez <dhernandez@dhwebdesignmx.com>
 * @see <a href="https://dhwebdesignmx.com">dh Web Design</a>
 */

use Exception;
use \PDOException;
require_once "Conexion.php";


class RecibosModelo extends Conexion {

    private $respuesta = true;

    function __construct(){
        $this->bd = new Conexion;        
    }

    public function verificarRecibosGenerados($validarmes, $validaranio){
        try {
            $this->bd->consultaSQL("SELECT mes, anio, estado FROM generacionrecibos WHERE mes = '$validarmes' AND anio = '$validaranio'");
            $resultados = $this->bd->obtenerRegistro1();
            return $resultados;
        } catch (PDOException $e) {
            $resultados = [];
            return $resultados;
        }
    }

    public function verificarRecargosGenerados($validarmes, $validaranio){
        try {
            $this->bd->consultaSQL("SELECT mes, anio, estado FROM generacionrecargos WHERE mes = '$validarmes' AND anio = '$validaranio'");
            $resultados = $this->bd->obtenerRegistro1();
            return $resultados;
        } catch (PDOException $e) {
            $resultados = [];
            return $resultados;
        }
    }

    public function seleccionarCostoMetroCuadrado(){
        try {
            $this->bd->consultaSQL("SELECT costo FROM conceptos WHERE idconcepto = 1");
            $resultados = $this->bd->obtenerRegistro1();
            return $resultados;
        } catch (PDOException $e) {
            /* echo $e->getMessage(); */
            $resultados = [];
            return $resultados;
        }
    }

    public function seleccionarConsultoriosDimensiones(){
        try {
            $this->bd->consultaSQL("SELECT idconsultorio, dimensiones FROM consultorios");
            $resultados = $this->bd->obtenerConjuntoRegistros1();
            return $resultados;
        } catch (PDOException $e) {
            /* echo $e->getMessage(); */
            $resultados = [];
            return $resultados;
        }
    }

    public function seleccionarInicioMes(){
        try {
            // SELECCIONAR 1 DE CADA MES
            $this->bd->consultaSQL("SELECT DATE_SUB(LAST_DAY(NOW()),INTERVAL DAY(LAST_DAY(NOW()))- 1 DAY) AS primer_dia");
            $resultados = $this->bd->obtenerRegistro1();
            return $resultados;
        } catch (PDOException $e) {
            /* echo $e->getMessage(); */
            $resultados = [];
            return $resultados;
        }
    }

    public function seleccionarDiaCuatroMes(){
        try {
            // SELECCIONAR 4 DE CADA MES
            $this->bd->consultaSQL("SELECT DATE_SUB(LAST_DAY(NOW()),INTERVAL DAY(LAST_DAY(NOW()))- 8 DAY) AS cuarto_dia");
            $resultados = $this->bd->obtenerRegistro1();
            return $resultados;
        } catch (PDOException $e) {
            /* echo $e->getMessage(); */
            $resultados = [];
            return $resultados;
        }
    }

    public function seleccionarDiaDiezMes(){
        try {
            // SELECCIONAR 10 DE CADA MES
            $this->bd->consultaSQL("SELECT DATE_SUB(LAST_DAY(NOW()),INTERVAL DAY(LAST_DAY(NOW()))- 10 DAY) AS dia_diez");
            $resultados = $this->bd->obtenerRegistro1();
            return $resultados;
        } catch (PDOException $e) {
            /* echo $e->getMessage(); */
            $resultados = [];
            return $resultados;
        }
    }

    public function seleccionarFinMes(){
        try {
            // SELECCIONAR ULTIMO DIA DEL MES
            $this->bd->consultaSQL("SELECT last_day(curdate()) AS ultimo_dia");
            $resultados = $this->bd->obtenerConjuntoRegistros1();
            return $resultados;
        } catch (PDOException $e) {
            /* echo $e->getMessage(); */
            $resultados = [];
            return $resultados;
        }
    }

    public function seleccionarDiaveinte(){
        try {
            // SELECCIONAR 20, DIA ULTIMO - 10 DIAS | SERA 21 SI TERMINA EN 30 EL MES, O 20 SI TIENE 30 DIAS
            $this->bd->consultaSQL("SELECT DATE_SUB(last_day(curdate()), INTERVAL 10 DAY) AS veinte");
            $resultados = $this->bd->obtenerConjuntoRegistros1();
            return $resultados;
        } catch (PDOException $e) {
            /* echo $e->getMessage(); */
            $resultados = [];
            return $resultados;
        }

    }

    public function registrarRecibosRenta(array $datos){
        try{
            $this->bd->iniciarTransaccion();
            $this->bd->consultaSQL("INSERT INTO recibos (idconsultorio, idconcepto, fechaelaboracion, fechalimitepago, cverecibo, mensualidad, cantidad, comentarios, estatus) VALUES (:idconsultorio, :idconcepto, :fechaelaboracion, :fechalimitepago, :cverecibo, :mensualidad, :cantidad, :comentarios, :estatus)");
            foreach($datos as $fila){
                foreach($fila as $column => $valor){
                    $this->bd->enlazarValor(":{$column}", $valor);
                    }
                $this->bd->ejecutar();
            }
            $this->bd->ejecutarTransaccion();
            return true;
        }catch(PDOException$e){
            $this->bd->deshacerTransaccion();
            echo $e->getMessage();
            return false;
        }
    }


    public function nuevaFechaRecibos($mes, $anio, $estado){ 

        $fecha1 = date("Y-m-d");
        $nuevafecha = date('Y-m-d', strtotime($fecha1. ' + 1 month'));
        $nuevomes =  date('F', strtotime($nuevafecha));
        $nuevoanio = date('Y', strtotime($nuevafecha));
        $estadoN =  "no";

        try{
            $this->bd->iniciarTransaccion();
            $this->bd->consultaSQL("UPDATE generacionrecibos SET estado = :estado WHERE mes = :mes AND anio = :anio");
            $this->bd->enlazarValor(':estado', $estado);
            $this->bd->enlazarValor(':mes', $mes);
            $this->bd->enlazarValor(':anio', $anio);
            if($this->bd->ejecutar() === false){
                $this->bd->deshacerTransaccion();
                $this->respuesta = false;
            }else{
                $this->bd->consultaSQL("INSERT INTO generacionrecibos (mes, anio, estado) VALUES (:nuevomes, :nuevoanio, :estadoN)");
                $this->bd->enlazarValor(':estadoN', $estadoN);
                $this->bd->enlazarValor(':nuevomes', $nuevomes);
                $this->bd->enlazarValor(':nuevoanio', $nuevoanio);
                $this->bd->ejecutar();
                $this->bd->ejecutarTransaccion();
            }  
            return $this->respuesta;         
        }catch(PDOException$e){            
            echo $e->getMessage();
            return false;
        }

    }

    /* ************************* RECARGOS *************************** */

    public function seleccionarConsultoriosDatosrecargos(){
        try {
            $this->bd->consultaSQL("SELECT contadorrecargos.contador, consultorios.idconsultorio, recibos.idrecibo, recibos.cantidad, recibos.estatus FROM contadorrecargos INNER JOIN consultorios ON contadorrecargos.idconsultorio = consultorios.idconsultorio INNER JOIN recibos ON consultorios.idconsultorio = recibos.idconsultorio WHERE recibos.estatus = 1");
            $resultados = $this->bd->obtenerConjuntoRegistros1();
            return $resultados;
        } catch (PDOException $e) {
            /* echo $e->getMessage(); */
            $resultados = [];
            return $resultados;
        }
    }

    public function registrarRecibosRecargos(array $datos){        
        try{
            $this->bd->iniciarTransaccion();
            $this->bd->consultaSQL("INSERT INTO recargos (idrecibo, idconcepto, fecharecargo, cantidad, estatus) VALUES (:idrecibo, :idconcepto, :fecharecargo, :cantidad, :estatus)");
            foreach($datos as $fila){
                foreach($fila as $column => $valor){
                    $this->bd->enlazarValor(":{$column}", $valor);
                    }
                $this->bd->ejecutar();
            }
            $this->bd->ejecutarTransaccion();
            return true;
        }catch(PDOException$e){
            $this->bd->deshacerTransaccion();
            echo $e->getMessage();
            return false;
        }
    }

    public function nuevaFechaRecargos($mes, $anio, $estado){ 
        $fecha1 = date("Y-m-d");
        $nuevafecha = date('Y-m-d', strtotime($fecha1. ' + 1 month'));
        $nuevomes =  date('F', strtotime($nuevafecha));
        $nuevoanio = date('Y', strtotime($nuevafecha));
        $estadoN =  "no";

        try{
            $this->bd->iniciarTransaccion();
            $this->bd->consultaSQL("UPDATE generacionrecargos SET estado = :estado WHERE mes = :mes AND anio = :anio");
            $this->bd->enlazarValor(':estado', $estado);
            $this->bd->enlazarValor(':mes', $mes);
            $this->bd->enlazarValor(':anio', $anio);
            if($this->bd->ejecutar() === false){
                $this->bd->deshacerTransaccion();
                $this->respuesta = false;
            }else{
                $this->bd->consultaSQL("INSERT INTO generacionrecargos (mes, anio, estado) VALUES (:nuevomes, :nuevoanio, :estadoN)");
                $this->bd->enlazarValor(':estadoN', $estadoN);
                $this->bd->enlazarValor(':nuevomes', $nuevomes);
                $this->bd->enlazarValor(':nuevoanio', $nuevoanio);
                $this->bd->ejecutar();
                $this->bd->ejecutarTransaccion();
            }  
            return $this->respuesta;         
        }catch(PDOException$e){            
            echo $e->getMessage();
            return false;
        }

    }

    public function actualizarRecibosNuevaCantidad(array $datos){
        try{
            $this->bd->iniciarTransaccion();
            $this->bd->consultaSQL("UPDATE recibos SET cantidad = :cantidad WHERE idrecibo = :idrecibo");
            foreach($datos as $fila){
                foreach($fila as $column => $valor){
                    $this->bd->enlazarValor(":{$column}", $valor);
                    }
                $this->bd->ejecutar();
            }
            $this->bd->ejecutarTransaccion();
            return true;
        }catch(PDOException$e){
            $this->bd->deshacerTransaccion();
            echo $e->getMessage();
            return false;
        }
    }

    public function actualizarContadorRecargos(array $datos){
        try{
            $this->bd->iniciarTransaccion();
            $this->bd->consultaSQL("UPDATE contadorrecargos SET contador = :contador WHERE idconsultorio = :idconsultorio");
            foreach($datos as $fila){
                foreach($fila as $column => $valor){
                    $this->bd->enlazarValor(":{$column}", $valor);
                    }
                $this->bd->ejecutar();
            }
            $this->bd->ejecutarTransaccion();
            return true;
        }catch(PDOException$e){
            $this->bd->deshacerTransaccion();
            echo $e->getMessage();
            return false;
        }
    } 

    /* ************************* ADEUDOS *************************** */

    public function consultar() : array {
        try {
            $this->bd->consultaSQL("SELECT propietarios.idconsultorio, propietarios.titulo, propietarios.nombre, propietarios.apellidop, propietarios.apellidom, consultorios.cvecons, recibos.idrecibo, recibos.fechaelaboracion, recibos.fechalimitepago, recibos.cverecibo, recibos.cantidad, recibos.comentarios, recibos.estatus, conceptos.descripcion FROM propietarios INNER JOIN consultorios ON propietarios.idconsultorio = consultorios.idconsultorio INNER JOIN recibos ON consultorios.idconsultorio = recibos.idconsultorio INNER JOIN conceptos ON recibos.idconcepto = conceptos.idconcepto WHERE recibos.estatus > 0");
            $resultados = $this->bd->obtenerConjuntoRegistros1();
            return $resultados;
        } catch (PDOException $e) {
            /* echo $e->getMessage(); */
            $resultados = [];
            return $resultados;
        }
    }

    public function consultarRecibo($dato) : array {
        try {
            $this->bd->consultaSQL("SELECT propietarios.idconsultorio, propietarios.titulo, propietarios.nombre, propietarios.apellidop, propietarios.apellidom, consultorios.cvecons, recibos.idrecibo, recibos.fechaelaboracion, recibos.fechalimitepago, recibos.cverecibo, recibos.cantidad, recibos.comentarios, recibos.estatus, conceptos.descripcion FROM propietarios INNER JOIN consultorios ON propietarios.idconsultorio = consultorios.idconsultorio INNER JOIN recibos ON consultorios.idconsultorio = recibos.idconsultorio INNER JOIN conceptos ON recibos.idconcepto = conceptos.idconcepto WHERE recibos.estatus > 0 AND propietarios.apellidop LIKE '" . $dato . "%'");
            $resultados = $this->bd->obtenerConjuntoRegistros1();
            return $resultados;
        } catch (PDOException $e) {
            /* echo $e->getMessage(); */
            $resultados = [];
            return $resultados;
        }
    }

    
}