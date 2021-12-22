<?php namespace Modelos;
/**
 * @author Daniel Hernandez <dhernandez@dhwebdesignmx.com>
 * @see <a href="https://dhwebdesignmx.com">dh Web Design</a>
 */

use \PDOException;

class IngresoModelo extends Conexion{

    private $bd;
    private $estadoempleado = "activo";

    function __construct(){
        $this->bd = new Conexion;        
    }

    public function inicioSesionModelo(string $datosSesion) : array {  
        $error = array("correo" => "noexiste123456@correonoexiste.com", "intentos" => 3);
        try {
            $this->bd->consultaSQL("SELECT idusuario, nombre, apellidop, apellidom, correo, contrasenia, usuarios.idrol as rol, intentos, foto, descripcion
            FROM usuarios INNER JOIN rolesusuario ON usuarios.idrol = rolesusuario.idrol
            WHERE correo = :usuario AND condicion = :condicion");
            $this->bd->enlazarValor(':usuario', $datosSesion);
            $this->bd->enlazarValor(':condicion', $this->estadoempleado);
            $resultados = $this->bd->obtenerRegistro();
            $arreglo = $resultados ? $resultados : $error;            
            return $arreglo; 
        } catch(PDOException $e){
            echo $e->getMessage();
            return $error;
        }
    }

    public function intentosIngreso(array $datosUsuario){
        $this->bd->consultaSQL("UPDATE usuarios SET intentos = :intentos WHERE correo = :usuario");
        $this->bd->enlazarValor('intentos', $datosUsuario['intentos']);
        $this->bd->enlazarValor(':usuario', $datosUsuario['usuario']);
        $this->bd->ejecutar();
    }

    public function bloquearCuenta(array $datosUsuario){
        $this->bd->consultaSQL("UPDATE usuarios SET condicion = :condicion, intentos = :intentos WHERE correo = :usuario");
        $this->bd->enlazarValor('condicion', $datosUsuario['condicion']);
        $this->bd->enlazarValor('intentos', $datosUsuario['intentos']);
        $this->bd->enlazarValor(':usuario', $datosUsuario['usuario']);
        $this->bd->ejecutar();
    }

}