<?php namespace Interfaces;
/**
 * @author Daniel Hernandez <dhernandez@dhwebdesignmx.com>
 * @see <a href="https://dhwebdesignmx.com">dh Web Design</a>
 */

interface IDocumentos{

    public function consultar($dato);

    public function guardar();

    public function actualizarContraseña(); 

    public function ver($dato);

    public function editar();
    

}