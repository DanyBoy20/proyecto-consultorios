<?php namespace Modelos;
/**
 * @author Daniel Hernandez <dhernandez@dhwebdesignmx.com>
 */

class EnlacesModelos{

    public function enlacesModelo(string $enlaces) : string{
        $paginas = array(
            "adeudos", "acceso-restringido", "demodoc", "expediente-consultorio", "editar-datos-propietario", "inicio", "pagina-no-encontrada", "perfil", "planta-baja", "primer-nivel", "recibo", "registrar", "registro-pagos", "reporte-pago-por-fecha", "reporte-por-fecha", "salir", "segundo-nivel", "solicitud-demostracion", "tercer-nivel"
        ); 
        if(in_array($enlaces, $paginas, TRUE)){
            $modulos = "Vistas/modulos/" . $enlaces . ".php";
        }else{
            $modulos = "Vistas/modulos/index.php";
        }               
        return $modulos;
    }

}
