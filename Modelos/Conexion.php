<?php namespace Modelos;
/**
 * @author Daniel Hernandez <dhernandez@dhwebdesignmx.com>
 * @see <a href="https://dhwebdesignmx.com">dh Web Design</a>
 */

/* include (__DIR__ .'../../../../conn/config.inc.cm.php'); */

/* local */
include ("Configuracion.php");

use \PDO, \PDOException;

class Conexion{

    private $host = DB_HOST;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $dbname = DB_NAME;
    private $dbcharset = DB_CHARSET;

    private $conexion;
    private $error;
    private $sentencia;
    private $dbconectado = false;

    protected function __construct(){
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname . ';charset=' . $this->dbcharset;
        $opciones = array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );
        try {
            $this->conexion = new PDO($dsn, $this->user, $this->pass, $opciones);
            $this->dbconectado = true;
        } catch (PDOException $e) {
            $this->error = $e->getMessage();
        }        
    }

    protected function obtenerError(){
        return $this->error;
    }

    protected function estaConectado(){
        return $this->dbconectado;
    }

    protected function consultaSQL($query){
        $this->sentencia = $this->conexion->prepare($query);
    }

    protected function ejecutar(){
        return $this->sentencia->execute();
    }

    protected function iniciarTransaccion(){
        return $this->conexion->beginTransaction();
    }

    protected function ejecutarTransaccion(){
        return $this->conexion->commit();
    }

    protected function deshacerTransaccion(){
        return $this->conexion->rollback();
    }

    protected function idInsertado(){
        return $this->conexion->lastInsertId();
    }

    protected function obtenerConjuntoRegistros(){
        $this->ejecutar();
        return $this->sentencia->fetchAll(PDO::FETCH_OBJ);
        /* return $this->sentencia->fetchAll(); */
    }

    protected function obtenerConjuntoRegistros1(){
        $this->ejecutar();
        /* return $this->sentencia->fetchAll(PDO::FETCH_OBJ); */
        return $this->sentencia->fetchAll();
    }

    protected function cantidadRegistros(){
        return $this->sentencia->rowCount();
    }

    protected function obtenerRegistro(){
        $this->ejecutar();
        /* return $this->sentencia->fetch(PDO::FETCH_OBJ); */
        return $this->sentencia->fetch();
    }

    protected function obtenerRegistro1(){
        $this->ejecutar();
        /* return $this->sentencia->fetch(PDO::FETCH_OBJ); */
        return $this->sentencia->fetch(PDO::FETCH_OBJ);
    }

    protected function enlazarValor($param, $valor, $tipo = null){
        if(is_null($tipo)){
            switch (true){
                case is_int($valor):
                    $tipo = PDO::PARAM_INT;
                break;
                case is_bool($valor):
                    $tipo = PDO::PARAM_BOOL;
                break;
                case is_null($valor):
                    $tipo = PDO::PARAM_NULL;
                break;
                default:
                    $tipo = PDO::PARAM_STR;
            }
        }
        $this->sentencia->bindValue($param, $valor, $tipo);
    }

}