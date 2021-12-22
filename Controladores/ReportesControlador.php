<?php namespace Controladores;
/**
 * @author Daniel Hernandez <dhernandez@dhwebdesignmx.com>
 * @see <a href="https://dhwebdesignmx.com">dh Web Design</a>
 */

use Interfaces\IReportes;
use Modelos\ReportesModelo;
require_once "../Interfaces/IReportes.php";
require_once "../Modelos/ReportesModelo.php";

class ReportesControlador implements IReportes {

    public function verNiveles(){
        $listaniveles = new ReportesModelo();
        $reporteniveles = $listaniveles->seleccionarNiveles();
        return $reporteniveles;
    }

    public function verReporteGeneral(){
        $listageneral = new ReportesModelo();
        $reportegeneral = $listageneral->reporteGeneral();
        return $reportegeneral;
    }

    public function obtenerCuota(){
        $cuota = new ReportesModelo();
        $costocuota = $cuota->seleccionarCuota();
        return $costocuota;
    }

    public function obtenerTotales(){
        $resultados = new ReportesModelo();
        $restotales = $resultados->totales();
        return $restotales;
    }

    public function adeudos(){
        $resultados = new ReportesModelo();
        $resadeudos = $resultados->adeudos();
        return $resadeudos;        
    }

    public function adeudoPB(){ 
        $resultados = new ReportesModelo();
        $resadeudoPB = $resultados->adeudoPB();
        return $resadeudoPB;       
    }

    public function adeudoPN(){  
        $resultados = new ReportesModelo();
        $resadeudoPN = $resultados->adeudoPN();
        return $resadeudoPN;       
    }

    public function adeudoSN(){ 
        $resultados = new ReportesModelo();
        $resadeudoSN = $resultados->adeudoSN();
        return $resadeudoSN;        
    }

    public function adeudoTN(){   
        $resultados = new ReportesModelo();
        $resadeudoTN = $resultados->adeudoTN();
        return $resadeudoTN;      
    }

    public function pagosMes(){
        $resultados = new ReportesModelo();
        $pagosmes = $resultados->pagosMes();
        return $pagosmes;
    }

    public function pagosAnio(){
        $resultados = new ReportesModelo();
        $pagoanual = $resultados->pagosAnio();
        return $pagoanual;
    }

    public function pagosPorFecha($fecha1, $fecha2){
        $resultados = new ReportesModelo();
        $pagoporfecha = $resultados->pagosPorFecha($fecha1, $fecha2);
        return $pagoporfecha;
    }

}
