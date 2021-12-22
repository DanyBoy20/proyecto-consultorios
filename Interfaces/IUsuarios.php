<?php namespace Interfaces;
/**
 * @author Daniel Hernandez <dhernandez@dhwebdesignmx.com>
 * @see <a href="https://dhwebdesignmx.com">dh Web Design</a>
 */

interface IUsuarios{

    public function consultar();

    public function guardar();

    public function actualizarContraseña(); 

    public function ver();

    public function editar();
    

}