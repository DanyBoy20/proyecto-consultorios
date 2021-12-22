<?php
require_once('../Librerias/TCPDF/tcpdf.php');
include '../Controladores/ReportesControlador.php';
class PDF extends TCPDF {
    public function Header(){
        $archivoImagen = K_PATH_IMAGES.'LOGO-PROYECTO.png';
        $this->Image($archivoImagen, 15, 10, 18, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        $this->Ln(15);
        $this->SetFillColor(3, 84, 167);
        $this->SetFont('helvetica', 'B', 8);
        $this->Cell(0,3, 'Hoja de reportes', 0, 1, 'R');
        $this->SetFont('helvetica', 'B', 1);
        $this->Cell(268, 1, '', 0, 0, 'C', 1);
    }
    public function Footer(){
        $this->SetY(-15);
        $this->SetFont('helvetica', 'B', 7);
        $this->SetFillColor(22, 58, 187);
        $this->SetTextColor(255, 255, 255);
        $this->Cell(134, 5, '      Edificio de consultorios | CEM Vista Hermosa', 0, 0, 'L', 1);
        $this->Cell(134, 5, 'Pagina '.$this->getAliasNumPage().' / '.$this->getAliasNbPages(), 0, 0, 'R', 1);
    }
}
    $nombrearchivo = "PAGOS_MES";
    $contador = 1;
    setlocale(LC_TIME,"es_MX");
    $fecha1 = date('Y-m-d');
    $mes = date('F', strtotime($fecha1));
    $anio = date('Y', strtotime($fecha1));
    $dia = date('j', strtotime($fecha1));
    $mesbuscado;
    $arreglomeses = ['January' => 'Enero', 'February' => 'Febrero', 'March' => 'Marzo', 'April' => 'Abril', 'May' => 'Mayo', 'June' => 'Junio', 'July' => 'Julio', 'August' => 'Agosto', 'September' => 'Septiembre', 'October' => 'Octubre', 'November' => 'Noviembre', 'December' => 'Diciembre'];  
    $modulo = new Controladores\ReportesControlador();
    $pagomes = (array)$modulo->pagosAnio();
    $campocantidad = 'cantidad';
    $campocargo = 'costorecargo';
    $sumaimporte = array_sum(array_column($pagomes,$campocantidad));
    $sumacargo = array_sum(array_column($pagomes,$campocargo));
    $pdf = new PDF('L', 'mm', 'A4', true, 'UTF-8', false);    
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
    $pdf->Ln(5);
    $pdf->SetFont('helvetica', '', 9);
    $pdf->MultiCell(95, 5, 'Cuernavaca, Morelos. ' . $dia . ' de ' . $mesbuscado . ' del ' . $anio , 0, 'L', 0, 0, '', '', true);
    $pdf->Ln(10);
    $pdf->SetFont('helvetica', 'B', 13);
    $pdf->SetFillColor(87, 214, 161);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->Cell(0, 3, 'REPORTE | PAGOS - ANUAL', 0, 1, 'C');
    $pdf->Ln(10);
    $pdf->SetFont('helvetica', 'B', 9);
    $pdf->SetFillColor(82, 138, 226);
    $pdf->SetTextColor(255, 255, 255);
    $pdf->Cell(23, 5, 'Fecha pago', 1, 0, 'C', 1);
    $pdf->Cell(27, 5, 'No. pago', 1, 0, 'C', 1);
    $pdf->Cell(22, 5, 'No. recibo', 1, 0, 'C', 1);
    $pdf->Cell(25, 5, 'No consultorio', 1, 0, 'C', 1);
    $pdf->Cell(44, 5, 'Concepto', 1, 0, 'C', 1);
    $pdf->Cell(20, 5, 'Recargo', 1, 0, 'C', 1);
    $pdf->Cell(30, 5, 'Importe', 1, 0, 'C', 1);
    $pdf->Cell(77, 5, 'Comentarios', 1, 0, 'C', 1);
    $i;
    for($i = 0; $i < count($pagomes); $i++){
        ($i%2 == 0) ? $pdf->SetFillColor(161, 208, 246) : $pdf->SetFillColor(255, 255, 255) ;
        $pdf->Ln(6);
        $pdf->SetFont('helvetica', 'B', 8);
        $pdf->SetTextColor(0, 0, 0);
        $cargo = $pagomes[$i]['costo']*100;
        if($pagomes[$i]['descripcion'] == NULL){
            $concepto = "Cuota mensual";
        }else{
            $concepto = "Cuora mensual y recargos " . $cargo . "%";
        }
        $pdf->Cell(23, 5, $pagomes[$i]['fechapago'], 0, 0, 'C', 1);
        $pdf->Cell(27, 5, $pagomes[$i]['cvepago'], 0, 0, 'C', 1);
        $pdf->Cell(22, 5, $pagomes[$i]['cverecibo'], 0, 0, 'L', 1);
        $pdf->Cell(25, 5, $pagomes[$i]['cvecons'], 0, 0, 'C', 1);
        $pdf->Cell(44, 5, $concepto, 0, 0, 'C', 1);
        $pdf->Cell(20, 5, 'MX$ ' . number_format($pagomes[$i]['costorecargo'], 2, ".", ","), 0, 0, 'C', 1);
        $pdf->Cell(30, 5, 'MX$ ' . number_format($pagomes[$i]['cantidad'], 2, ".", ","), 0, 0, 'C', 1);
        $pdf->Cell(77, 5, $pagomes[$i]['comentarios'], 0, 0, 'L', 1);
        if($i == 18){
            $pdf->AddPage();
            $pdf->Ln(15);
            $pdf->SetFont('helvetica', 'B', 9);
            $pdf->SetFillColor(82, 138, 226);
            $pdf->SetTextColor(255, 255, 255);
            $pdf->Cell(23, 5, 'Fecha pago', 1, 0, 'C', 1);
            $pdf->Cell(27, 5, 'No. pago', 1, 0, 'C', 1);
            $pdf->Cell(22, 5, 'No. recibo', 1, 0, 'C', 1);
            $pdf->Cell(25, 5, 'No consultorio', 1, 0, 'C', 1);
            $pdf->Cell(44, 5, 'Concepto', 1, 0, 'C', 1);
            $pdf->Cell(20, 5, 'Recargo', 1, 0, 'C', 1);
            $pdf->Cell(30, 5, 'Importe', 1, 0, 'C', 1);
            $pdf->Cell(77, 5, 'Comentarios', 1, 0, 'C', 1);
        }        
    }
    $pdf->Ln(7);
    $pdf->SetFont('helvetica', 'B', 9);
    $pdf->SetFillColor(255, 255, 255);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->Cell(23, 5, '', 0, 0, 'C', 1);
    $pdf->Cell(27, 5, '', 0, 0, 'C', 1);
    $pdf->Cell(22, 5, '', 0, 0, 'C', 1);
    $pdf->Cell(25, 5, '', 0, 0, 'C', 1);
    $pdf->SetFillColor(82, 138, 226);
    $pdf->SetTextColor(255, 255, 255);
    $pdf->Cell(44, 5, 'Total   ', 0, 0, 'R', 1);
    $pdf->SetFillColor(255, 255, 255);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->Cell(20, 5, 'MX$ ' . number_format($sumacargo, 2, ".", ","), 0, 0, 'C', 1);
    $pdf->Cell(30, 5, 'MX$ ' . number_format($sumaimporte, 2, ".", ","), 0, 0, 'C', 1);
    $pdf->Cell(77, 5, '', 0, 0, 'C', 1);    
    $pdf->Ln(30);
    $pdf->SetFont('helvetica', 'B', 15);
    $pdf->Cell(0, 3, '_____________________', 0, 1, 'C');
    $pdf->Ln(1);
    $pdf->SetFont('helvetica', 'B', 10);
    $pdf->Cell(0, 3, 'CEM Vista Hermosa', 0, 1, 'C');
    ob_end_clean();
    $pdf->Output('REPORTE_' . $nombrearchivo . '.pdf', 'I');
