<?php 
/**
 * @author Daniel Hernandez <dhernandez@dhwebdesignmx.com>
 * @see <a href="https://dhwebdesignmx.com">dh Web Design</a>
 */

use Modelos\ConsultoriosModelo;
require_once "../Modelos/ConsultoriosModelo.php";

class ApiFetchConsultorios{

    public $valorBuscado;
    public $nivel;
    public $numnivel;

    public function buscar(){
        $valor = $this->valorBuscado;
        $nivelb = $this->numnivel;
        $buscarconsultorio = new ConsultoriosModelo();
        $respuesta = $buscarconsultorio->buscarConsultoriolista($valor, $nivelb);
        $salidaDatos = array();
        foreach($respuesta as $item){
			$salidaDatos[] = array(
                "contador" => $item['contador'],
                "idconsultorio" => $item['idconsultorio'],
                "cvecons" => $item['cvecons'],
                "dimensiones" => $item['dimensiones'],
                "disponible" => $item['disponible'],
                "estado" => $item['estado'],
                "titulo" => $item['titulo'],
                "nombre" => $item['nombre'],
                "apellidop" => $item['apellidop'],
                "apellidom" => $item['apellidom']
			);
		}
		echo json_encode($salidaDatos);
		exit;        
    }

    public function listaConsultorios(){
        $buscanivel = $this->nivel;
        $listacpnsultorios = new ConsultoriosModelo();        
        $respuesta = $listacpnsultorios->consultar($buscanivel);
        foreach($respuesta as $item){
			$salidaDatos[] = array(
                "contador" => $item['contador'],
                "idconsultorio" => $item['idconsultorio'],
                "cvecons" => $item['cvecons'],
                "dimensiones" => $item['dimensiones'],
                "disponible" => $item['disponible'],
                "estado" => $item['estado'],
                "titulo" => $item['titulo'],
                "nombre" => $item['nombre'],
                "apellidop" => $item['apellidop'],
                "apellidom" => $item['apellidom']
			);
		}
		echo json_encode($salidaDatos);
		exit;
    }

}

if (isset($_GET["busqueda"]) && isset($_GET["niveln"])) {
    $valorBuscado = trim($_GET["busqueda"]);
    $numeronivel = trim($_GET["niveln"]);
    if ($valorBuscado != "") {
        $buscarconsultoriolista = new ApiFetchConsultorios();
        $buscarconsultoriolista->numnivel = $numeronivel;
        $buscarconsultoriolista->valorBuscado = $valorBuscado;
        $buscarconsultoriolista->buscar();
    } 
}

if (isset($_GET["todos"])) {
        $nivelBuscado = trim($_GET["todos"]);
        if ($nivelBuscado != "") {
            $listaconsultorios = new ApiFetchConsultorios();
            $listaconsultorios->nivel = $nivelBuscado;
            $listaconsultorios->listaConsultorios();
        }
}
