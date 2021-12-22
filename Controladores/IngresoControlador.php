<?php namespace Controladores;
/**
 * @author Daniel Hernandez <dhernandez@dhwebdesignmx.com>
 * @see <a href="https://dhwebdesignmx.com">dh Web Design</a>
 */

use Exception;
use Modelos\IngresoModelo;
class IngresoControlador{

    private $intentos;
    private $estadoCuenta;
    private $regexContrasenia = '/^(?=.{8,12}$)(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).+$/';

    public function inicioSesionControlador(){
        if(isset($_POST["usuario"]) && isset($_POST["contrasenia"])){
            if(trim(!empty($_POST["usuario"])) && trim(!empty($_POST["contrasenia"]))){
                if (filter_var($_POST["usuario"], FILTER_VALIDATE_EMAIL) === false) {
                    session_destroy();
                    echo "<script>alert('El correo no es valido.');</script>";
                }else if(strlen($_POST["usuario"]) < 10 || strlen($_POST["usuario"]) > 50) {
                    session_destroy();
                    echo "<script>alert('El correo debe ser mayor a 10 caracteres.');</script>";
                }else if(strlen($_POST["contrasenia"]) < 8 || strlen($_POST["contrasenia"]) > 12) {
                    session_destroy();
                    echo "<script>alert('La contraseña debe ser de 8 a 12 caracteres.');</script>";
                }else if(!preg_match($this->regexContrasenia, $_POST["contrasenia"])) {
                    session_destroy();
                    echo "<script>alert('La contraseña debe tener al menos\n * Una letra mayuscula,\n * Una letra minuscula,\n * Un numero \n * Un simbolo');</script>";
                }else{
                    try{    
                        $inicioSesion = new IngresoModelo();
                        $respuesta = $inicioSesion->inicioSesionModelo($_POST["usuario"]);
                        if($_POST["usuario"] == $respuesta["correo"]){
                            $this->intentos = $respuesta['intentos'];
                            if ($this->intentos <= 2) {                                   
                                if(password_verify( $_POST["contrasenia"], $respuesta['contrasenia'])){ 
                                    $this->intentos = 0;  
                                    $datosUsuario = array("usuario" => $_POST["usuario"], "intentos" => $this->intentos);
                                    $inicioSesion->intentosIngreso($datosUsuario);
                                    $_SESSION['validar'] = true;
                                    $_SESSION['identificador'] = $respuesta["idusuario"];
                                    $_SESSION['nombre'] = $respuesta["nombre"];
                                    $_SESSION['apellidop'] = $respuesta["apellidop"];
                                    $_SESSION['apellidom'] = $respuesta["apellidom"];
                                    $_SESSION['rol'] = $respuesta["descripcion"];
                                    $_SESSION['foto'] = $respuesta["foto"];
                                    $_SESSION['correo'] = $respuesta["correo"];
                                    $_SESSION['idrol'] = $respuesta["rol"];
                                    echo '<script>window.location.href = "inicio"</script>';  
                                }else{
                                    session_destroy();
                                    ++$this->intentos;
                                    $datosUsuario = array("usuario" => $_POST["usuario"], "intentos" => $this->intentos);
                                    $inicioSesion->intentosIngreso($datosUsuario);                                       
                                    echo "<script>alert('Los datos que ingreso son incorrectos.');</script>";    
                                }                                    
                            }else{
                                $this->estadoCuenta = 'Bloqueado';
                                session_destroy();
                                $datosUsuario = array("usuario" => $_POST["usuario"], "intentos" => $this->intentos, "condicion" => $this->estadoCuenta);
                                $inicioSesion->bloquearCuenta($datosUsuario);
                                echo "<script>alert('Supero el limite de intentos de acceso, su cuenta esta bloqueada, contacte al administrador.');</script>";
                            }
                        }else{
                            session_destroy();
                            echo "<script>alert('No hay una cuenta registrada con ese usuario');</script>";
                        }                  
                    }catch(Exception $e){
                        session_destroy();
                        /* echo $e->getMessage(); */
                        echo "<script>alert('Error en la validacion de datos, intente mas tarde.');</script>";
                    }
                }              
            }else{     
                session_destroy();
                echo "<script>alert('Debe llenar todos los campos.');</script>";       
            } 

        }
    }  

}

