<?php

namespace Servicios;

use Exception;

/**
 * @author Daniel Hernandez <dhernandez@dhwebdesignmx.com>
 * @see <a href="https://dhwebdesignmx.com">dh Web Design</a>
 */

class EmpleadosServicios {

    public $errores = [];
    public $claveacceso;
    public $claveacceso2;

    public function validarContrasenia(string $contrasenia1, string $contrasenia2): array {
        $this->claveacceso = $contrasenia1;
        $this->claveacceso2 = $contrasenia2;

        if (trim($this->claveacceso) == '') {
            $this->errores[] = '\nDebe ingresar una contraseña';
        }
        if (preg_match('/^(?=.{8,8}$)(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).*$/', $this->claveacceso) == 0) {
            $this->errores[] = '\nLa contraseña debe tener 8 caracteres, al menos una letra mayuscula, una minuscula, un simbolo y un numero';
        }
        if (trim($this->claveacceso2) == '') {
            $this->errores[] = '\nDebe ingresar una contraseña';
        }
        if (preg_match('/^(?=.{8,8}$)(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).*$/', $this->claveacceso2) == 0) {
            $this->errores[] = '\nLa contraseña debe tener 8 caracteres, al menos una letra mayuscula, una minuscula, un simbolo y un numero';
        }
        if ($this->claveacceso != $this->claveacceso2) {
            $this->errores[] = '\nLas contraseñas no coinciden';
        }
        return $this->errores;
    }

    static function crearContrasenia(int $longitud) : string {
        $minusculas = array('a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z');
        $mayusculas = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
        $simbolos = array('!','"','#','$','%','&','\'','(',')','*','+',',','-','.','/',':',';','<','=','>','?','@','[','\\',']','^','_','`','{','|','}');
        $numeros = array('0','1','2','3','4','5','6','7','8','9');
        $arregloCompleto = array($minusculas, $mayusculas, $simbolos, $numeros); 
        $contrasenia = $minusculas[array_rand($minusculas, 1)];
        $contrasenia = $contrasenia . $mayusculas[array_rand($mayusculas, 1)];
        $contrasenia = $contrasenia . $simbolos[array_rand($simbolos, 1)];
        $contrasenia = $contrasenia . $numeros[array_rand($numeros, 1)];   
        for($i = strlen($contrasenia); $i < max(8, $longitud); $i++){
            $temporal = $arregloCompleto[array_rand($arregloCompleto, 1)];
            $contrasenia = $contrasenia . $temporal[array_rand($temporal, 1)];
        }
        return str_shuffle($contrasenia);
    }

}
