<?php namespace Controladores;
/**
 * @author Daniel Hernandez <dhernandez@dhwebdesignmx.com>
 * @see <a href="https://dhwebdesignmx.com">dh Web Design</a>
 */

use Interfaces\IUsuarios;
use Modelos\EmpleadosModelo;
use Servicios\EmpleadosServicios;

class EmpleadosControlador implements IUsuarios {

    private $errores = [];
    private $variablesIndefinidas = [];
    private $claveacceso;
    private $contraseniaActualizada; 
    
    public function actualizarContraseña(){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (!isset($_POST['contrasenia']) || !isset($_POST['repetircontrasenia'])) {
                echo '<script type="text/javascript">alert("No se recibio ningun dato, intente nuevamente");</script>';
            }else{
                $servicioempleados = new EmpleadosServicios();
                $this->errores = $servicioempleados->validarContrasenia($_POST['contrasenia'], $_POST['repetircontrasenia']);
                if(!empty($this->errores)){
                    $camposInvalidos = implode(",", $this->errores);
                    echo '<script type="text/javascript">alert("Hay errores en los campos del formulario: '.$camposInvalidos.'");</script>'; 
                }else{
                    $correo = $_SESSION['correo'];
                    $this->claveacceso = $_POST['contrasenia'];
                    $this->contraseniaActualizada = password_hash($this->claveacceso, PASSWORD_DEFAULT);
                    $datosUsuario = array(
                        "correo" => $correo,
                        "contraseniaActualizada" => $this->contraseniaActualizada,           
                    );
                    $resultado = new EmpleadosModelo();                    
                    $resultado->actualizarContrasenia($datosUsuario);
                    if(!$resultado){
                        echo '<script type="text/javascript">alert("No fue posible actualizar su contraseña, intente mas tarde");</script>';
                        echo '<script>window.location.href = "inicio"</script>';
                    }else{
                        echo '<script type="text/javascript">alert("Contraseña actualizada, debera usarla en su proximo inicio de sesion");</script>';
                        echo '<script>window.location.href = "inicio"</script>';
                    }
                }  
            }   
        }
    }

    public function ver(){}

    public function editar(){}

    public function consultar(){}

    public function guardar(){}


}
