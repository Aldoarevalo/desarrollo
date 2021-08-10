<?php
//session_start();
$codigo=$_REQUEST["codigo"];    
//if ($username>=1) {
include_once './tcpdf/tcpdf.php';
include("conexion.php");
// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF {

    // Page footer
    public function Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
        $this->Cell(0,0, 'Pag. '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, 
                false, 'R', 0, '', 0, false, 'T', 'M');
    }
}

$titulo="Informe de Presupuesto";

// create new PDF document // CODIFICACION POR DEFECTO ES UTF-8
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Emanuel Godoy');
$pdf->SetTitle("$titulo");
$pdf->SetSubject('App Ventas');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');
$pdf->setPrintHeader(false);
// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

//set margins POR DEFECTO
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
//$pdf->SetMargins(8,10, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

//set auto page breaks SALTO AUTOMATICO Y MARGEN INFERIOR
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);


// ---------------------------------------------------------

// TIPO DE LETRA
$pdf->SetFont('times', 'B', 18);

// AGREGAR PAGINA
$pdf->AddPage('P','LEGAL');
$pdf->Cell(0,0,"AppVentas",0,1,'C');
$pdf->Ln();
$pdf->Cell(0,0,"Presupuesto N°: ".$codigo,0,1,'C');
//$pdf->Cell(0,0,"$titulo",0,1,'C');
//SALTO DE LINEA
$pdf->Ln();
//COLOR DE TABLA
        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetTextColor(0);
        $pdf->SetDrawColor(0, 0, 0);
        $pdf->SetLineWidth(0.2);
        
        $pdf->SetFont('', 'B',12);
        // Header
        
        $pdf->SetFillColor(180, 180, 180);
        $pdf->Cell(90,5,'DATOS DE LA EMPRESA', 1, 0, 'L', 1);
        $pdf->Cell(0,5,'DATOS DEL CLIENTE', 1, 0, 'L', 1);
        
        
    $pdf->Ln();
    $pdf->SetFont('', '');
        $pdf->SetFillColor(255, 255, 255);
        

       //     $pdf->Cell(50,5,'dsdfsd/n assadas', 1, 0, 'C', 1);
       //     $pdf->Cell(0,5,'asa', 1, 0, 'L', 1);
        //    $pdf->Ln();

        $pedira = "SELECT * FROM presupuesto,cliente,empleado where 
            presupuesto.cli_codigo=cliente.cli_codigo and
            presupuesto.emp_usuario=empleado.emp_codigo and 
            pre_codigo=$codigo";
        $pe = mysql_query($pedira, $conexion);
        while ($row = mysql_fetch_array($pe)) {
                $clinombre=$row["cli_nombre"];
                $cliapellido=$row["cli_apellido"];
                $cliruc=$row["cli_ruc"];
                $prefecha=$row["pre_fecha"];
                $empnombre=$row["emp_nombre"];
                $empapellido=$row["emp_apellido"];
        }

        /*
if (!empty(isset($_REQUEST['vdesde'])) && !empty(isset($_REQUEST['vhasta']))) {
    if ($_REQUEST['opcion']=='1') {
        $marcas = consultas::get_datos("select * from cargo "
                . "where car_cod between ".$_REQUEST['vdesde']
                ." and ".$_REQUEST['vhasta']." order by car_cod");        
    }else{
        $marcas = consultas::get_datos("select * from cargo "
                . "where car_descri between '".$_REQUEST['vdesde']
                ."' and '".$_REQUEST['vhasta']."' order by car_descri");         
    }
} else {
    $marcas = consultas::get_datos("select * from cargo order by car_cod");
}


foreach ($marcas as $marca) {
            $pdf->Cell(50,5,$marca['car_cod'], 1, 0, 'C', 1);
            $pdf->Cell(0,5,$marca['car_descri'], 1, 0, 'C', 1);
            $pdf->Ln();
        }
        
*/

$prefe=strftime("%d de %B de %Y",strtotime($prefecha));

// Multicell test
$pdf->MultiCell(90, 5, 'Informática EL BIT'."\n".'Soluciones Empresariales'."\n".'Avenida Eusebio Ayala 2344'."\n".'Teléfono: 021 304 567'."\n".'Email: contacto@elbit.com', 1, 'L', 1, 0, '', '', true);
$pdf->MultiCell(0, 5, 'Nombre: '.$clinombre."\n".'Apellido: '.$cliapellido."\n".'RUC: '.$cliruc."\n".'Teléfono: '."\n".'Email: ', 1, 'L', 1, 0, '', '', true);
$pdf->Ln(4);

// set color for background
$pdf->SetFillColor(220, 255, 220);



   $pdf->Ln();
    $pdf->SetFont('', '');
        $pdf->SetFillColor(255, 255, 255);
        

            $pdf->Cell(90,5,'Fecha Presupuesto: '.$prefe, 1, 0, 'L', 1);
            $pdf->Cell(0,5,'Validez: 8 días', 1, 0, 'L', 1);
            $pdf->Ln();
            $pdf->Ln();


        $pdf->SetFillColor(180, 180, 180);
        $pdf->Cell(90,5,'PRODUCTO', 1, 0, 'L', 1);
        $pdf->Cell(30,5,'UNIDADES', 1, 0, 'C', 1);
        $pdf->Cell(30,5,'PRECIO', 1, 0, 'R', 1);
        $pdf->Cell(0,5,'TOTAL', 1, 0, 'R', 1);
          $pdf->Ln();

       $pedira2 = "SELECT * FROM presupuesto_detalle,producto where 
            presupuesto_detalle.pro_codigo=producto.pro_codigo 
            and pre_codigo=$codigo";
             
        $pe2 = mysql_query($pedira2, $conexion);
        while ($row = mysql_fetch_array($pe2)) {
                $prodescripcion=$row["pro_descripcion"];
                $precio=$row["pdet_precio"];
                $cantidad=$row["pdet_cantidad"];
                $subtotal=$row["pdet_subtotal"];

        $pdf->SetFillColor(255, 255, 255);
        $pdf->Cell(90,5,$prodescripcion, 1, 0, 'L', 1);
        $pdf->Cell(30,5,$cantidad, 1, 0, 'C', 1);
        $pdf->Cell(30,5,$precio, 1, 0, 'R', 1);
        $pdf->Cell(0,5,$subtotal, 1, 0, 'R', 1);
        $pdf->Ln();
        }


        $pedira3 = "SELECT sum(pdet_subtotal) as total FROM presupuesto_detalle WHERE pre_codigo =$codigo";
        $pe3 = mysql_query($pedira3, $conexion);
        while ($row = mysql_fetch_array($pe3)) {
                $total=$row["total"];
        }



          $pdf->Ln();
        $pdf->SetFillColor(180, 180, 180);
        $pdf->Cell(90,5,'TOTAL', 1, 0, 'L', 1);
        $pdf->Cell(0,5,$total, 1, 0, 'R', 1);
          $pdf->Ln();
          $pdf->Ln();

        $pdf->SetFillColor(255, 255, 255);
                $pdf->SetFont('', 'I',10);
// Multicell test
$pdf->MultiCell(90, 5, 'Firma de la persona que confecciona el presupuesto'."\n".''."\n".''."\n".''."\n".$empnombre." ".$empapellido, 1, 'C', 1, 0, '', '', true);
$pdf->MultiCell(0, 5, 'Firma de aceptación del cliente'."\n".'  '."\n".' '."\n".' '."\n".$clinombre." ".$cliapellido, 1, 'C', 1, 0, '', '', true);
$pdf->Ln(4);


setlocale(LC_ALL,"es_ES.UTF-8");
date_default_timezone_set('America/Asuncion');
$fee = date("d-m-Y");
$fee=strftime("%A, %d de %B de %Y",strtotime($fee));

  $pdf->Ln();
$pdf->Cell(0,0,"Informe Generado por AppVentas, el $fee",0,1,'R');
//SALIDA AL NAVEGADOR
$pdf->Output('reporte_presupuesto_nro_'.$codigo.'.pdf', 'I');


//} else echo "Acceda...";
?>
