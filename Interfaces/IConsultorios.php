<?php namespace Interfaces;
/**
 * @author Daniel Hernandez <dhernandez@dhwebdesignmx.com>
 * @see <a href="https://dhwebdesignmx.com">dh Web Design</a>
 */

interface IConsultorios{

    public function consultarPB();

    public function consultar1N();

    public function consultar2N();

    public function consultar3N();

    public function guardar();

    public function actualizarContraseña(); 

    public function ver();

    public function editar();
    

}