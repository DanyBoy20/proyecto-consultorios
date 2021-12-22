<?php namespace Interfaces;
/**
 * @author Daniel Hernandez <dhernandez@dhwebdesignmx.com>
 * @see <a href="https://dhwebdesignmx.com">dh Web Design</a>
 */

interface IReportes{

    public function verNiveles();
        
    public function verReporteGeneral();

    public function obtenerCuota();

    public function obtenerTotales();

    public function adeudos();

    public function adeudoPB();

    public function adeudoPN();

    public function adeudoSN();

    public function adeudoTN();

    public function pagosMes();

    public function pagosAnio();

    public function pagosPorFecha(string $fecha1, string $fecha2);
    
}