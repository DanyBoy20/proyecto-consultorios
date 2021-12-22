<?php
require_once('../Librerias/TCPDF/tcpdf.php');
include '../Controladores/Documentos.php';
class PDF extends TCPDF {
    public function Header(){
        $archivoImagen = K_PATH_IMAGES.'LOGO-PROYECTO.png';
        $this->Image($archivoImagen, 15, 10, 23, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        $this->Ln(23);
        $this->SetFont('helvetica', 'B', 1);
        $this->SetFillColor(3, 84, 167);
        $this->Cell(180, 1, '', 0, 0, 'C', 1);
    }
    public function Footer(){
        $this->SetY(-15);
        $this->SetFont('helvetica', 'B', 7);
        $this->SetFillColor(22, 58, 187);
        $this->SetTextColor(255, 255, 255);
        $this->Cell(90, 5, '      Edificio de consultorios | CEM Vista Hermosa', 0, 0, 'L', 1);
        $this->Cell(90, 5, 'Pagina '.$this->getAliasNumPage().' / '.$this->getAliasNbPages(), 0, 0, 'R', 1);
    }
}
if(isset($_POST['id'])){
    $contador = 1;
    setlocale(LC_TIME,"es_MX");
    $fecha1 = date('Y-m-d');
    $mes = date('F', strtotime($fecha1));
    $anio = date('Y', strtotime($fecha1));
    $dia = date('j', strtotime($fecha1));
    $mesbuscado;
    $arreglomeses = ['January' => 'Enero', 'February' => 'Febrero', 'March' => 'Marzo', 'April' => 'Abril', 'May' => 'Mayo', 'June' => 'Junio', 'July' => 'Julio', 'August' => 'Agosto', 'September' => 'Septiembre', 'October' => 'Octubre', 'November' => 'Noviembre', 'December' => 'Diciembre'];
    $mensajerecargos = "Se generaron recargos por morosidad";
    $mensajerecargos2 = "Los recargos son acumulables, y a partir del tercer mes será del 10%";
    $comentariosfinales = "El presente documento no es un comprobante legal y/o prueba de pago realizado. Representa la información de pago de la cuota mensual y los recargos aplicados (si existen) por morosidad. Los datos mostrados son los almacenados en base de datos a la fecha indicada en la cabecera del documento. Cualquier duda o comentario sobre la información aquí presentada, contacte con el administrador del inmueble.";
    foreach ($arreglomeses as $mesobtenido => $valormes) {
        if($mes == $mesobtenido){
            $mesbuscado = $valormes;
        }
    }
    $modulo = new Controladores\Documentos();
    $respuesta = (array)$modulo->ver($_POST['id']);
    foreach ($respuesta as $recibo) {
        $titulo = $recibo['titulo'];
        $nombre = $recibo['nombre'];
        $apellidop = $recibo['apellidop'];
        $apellidom = $recibo['apellidom'];
        $cvecons = $recibo['cvecons'];
        $fechaelaboracion = strtoupper($recibo['fechaelaboracion']);
        $fechalimitepago = $recibo['fechalimitepago'];
        $cverecibo = $recibo['cverecibo'];
        $mensualidad = $recibo['mensualidad'];
        $cantidad = $recibo['cantidad'];
        $comentarios = $recibo['comentarios'];
        $estatus = $recibo['estatus'];
        $descripcion = $recibo['descripcion'];
    }
    $recargos = (array)$modulo->consultar($_POST['id']);    
    $pdf = new PDF('p', 'mm', 'A4', true, 'UTF-8', false);
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Ing. Daniel Hernandez');
    $pdf->SetTitle('CEM Vista Hermosa');
    $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 001', PDF_HEADER_STRING, array(0,64,255), array(0,64,128));
    $pdf->setFooterData(array(0,64,0), array(0,64,128));
    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
    $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
    $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
    if (@file_exists(dirname(__FILE__).'/lang/spa.php')) {
        require_once(dirname(__FILE__).'/lang/spa.php');
        $pdf->setLanguageArray($l);
    }
    $pdf->setFontSubsetting(true);
    $pdf->SetFont('dejavusans', '', 14, '', true);
    $pdf->AddPage();
    $pdf->Ln(-14);
    $pdf->SetFont('helvetica', 'B', 8);
    $pdf->Cell(0,3, 'No. recibo:', 0, 1, 'R');
    $pdf->SetTextColor(199, 0, 0);
    $pdf->Cell(0,3, $cverecibo, 0, 1, 'R');
    $pdf->Ln(3);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->SetFont('helvetica', 'B', 8);
    $pdf->Cell(0,3, 'Fecha del recibo:', 0, 1, 'R');
    $pdf->Cell(0,3, $fechaelaboracion, 0, 1, 'R');
    $pdf->Ln(5);
    $pdf->SetFont('helvetica', '', 10);
    $pdf->MultiCell(95, 5, 'Cuernavaca, Morelos. ' . $dia . ' de ' . $mesbuscado . ' del ' . $anio , 0, 'L', 0, 0, '', '', true);
    $pdf->Ln(8);
    $pdf->SetFont('helvetica', 'B', 15);
    $pdf->Cell(0, 3, 'RECIBO DE PAGO | ' . strtoupper($descripcion), 0, 1, 'C');
    $pdf->Ln(2);
    $pdf->SetFont('helvetica', '', 9);
    if(!empty($recargos)){
        $pdf->Cell(0, 3, $mensajerecargos, 0, 1, 'C');
    }else{
        $pdf->Cell(0, 3, 'Fecha limite de pago para no generar recargos: ' . $fechalimitepago, 0, 1, 'C');
    }
    $pdf->Ln(12);
    $pdf->SetFont('helvetica', 'B', 12);
    $pdf->MultiCell(95, 5, 'Propietario:', 0, 'L', 0, 0, '', '', true);
    $pdf->MultiCell(80, 5, 'Consultorio:', 0, 'L', 0, 0, '', '', true);
    $pdf->Ln(5);
    $pdf->SetFont('helvetica', '', 10);
    $pdf->MultiCell(95, 5, $titulo . ' ' . $nombre . ' ' . $apellidop . ' ' . $apellidom, 0, 'L', 0, 0, '', '', true);
    $pdf->MultiCell(80, 5, $cvecons, 0, 'L', 0, 0, '', '', true);
    $pdf->Ln(15);
    $pdf->SetFillColor(22, 58, 187);
    $pdf->SetTextColor(255, 255, 255);
    $pdf->Cell(45, 5, 'Item', 1, 0, 'C', 1);
    $pdf->Cell(45, 5, 'Concepto', 1, 0, 'C', 1);
    $pdf->Cell(45, 5, 'Costo', 1, 0, 'C', 1);
    $pdf->Cell(45, 5, 'Importe', 1, 0, 'C', 1);
    $pdf->Ln(5);
    $pdf->SetFillColor(255, 255, 255);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->Cell(45, 5, $contador, 1, 0, 'C', 1);
    $pdf->Cell(45, 5, "Cuota mensual", 1, 0, 'C', 1);
    $pdf->Cell(45, 5, '$' . number_format($mensualidad, 2, ".", ","), 1, 0, 'C', 1);
    $pdf->Cell(45, 5, '$' . number_format($mensualidad, 2, ".", ","), 1, 0, 'C', 1);
    foreach ($recargos as $recargos) {
        $contador++;
        $descripcion = $recargos['descripcion'];
        $costo = $recargos['costo'] * 100;  
        $fecharecargo = $recargos['fecharecargo'];
        $recargo = $recargos['cantidad'];
        $pdf->Ln(5);
        $pdf->SetFillColor(255, 255, 255);
        $pdf->Cell(45, 5, $contador, 1, 0, 'C', 1);
        $pdf->Cell(45, 5, $descripcion, 1, 0, 'C', 1);
        $pdf->Cell(45, 5, $costo . "%", 1, 0, 'C', 1);
        $pdf->Cell(45, 5, '$' . number_format($recargo, 2, ".", ","), 1, 0, 'C', 1);
    }
    $pdf->Ln(5);
    $pdf->SetFillColor(255, 255, 255);
    $pdf->Cell(45, 5, "", 0, 0, 'C', 1);
    $pdf->Cell(45, 5, "", 0, 0, 'C', 1);
    $pdf->SetFillColor(22, 58, 187);
    $pdf->SetTextColor(255, 255, 255);
    $pdf->Cell(45, 5, "Total   ", 1, 0, 'R', 1);
    $pdf->SetFillColor(255, 255, 255);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->Cell(45, 5, '$' . number_format($cantidad, 2, ".", ","), 1, 0, 'C', 1);
    $pdf->Ln(15);
    $pdf->SetFont('helvetica', 'B', 12);
    $pdf->Cell(0, 3, 'Comentarios:', 0, 1, 'L');
    $pdf->Ln(2);
    $pdf->SetFont('helvetica', '', 10);
    if(!empty($recargos)){
        $pdf->Cell(0, 3, $mensajerecargos2, 0, 1, 'L');
    }else{
        $pdf->Cell(0, 3, $comentarios, 0, 1, 'L');
    }
    $pdf->Ln(13);
    $pdf->SetFont('helvetica', '', 9);
    $pdf->MultiCell(177, 5, $comentariosfinales, 0, 'L', 0, 0, '', '', true);
    $pdf->Ln(40);
    $pdf->SetFont('helvetica', 'B', 15);
    $pdf->Cell(0, 3, '_____________________', 0, 1, 'C');
    $pdf->Ln(1);
    $pdf->SetFont('helvetica', 'B', 10);
    $pdf->Cell(0, 3, 'CEM Vista Hermosa', 0, 1, 'C');
    ob_end_clean();
    $pdf->Output('RECIBO_' . $cverecibo . '.pdf', 'I');
}