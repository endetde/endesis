<?php

session_start();
/**
 * Autor: Ana Maria VQ
 * Fecha de creacion: 08/03/2010
 * Descripci�n: Reporte de Prestaci�n de Servicios
 * **/

require('../../../../lib/fpdf/fpdf.php');
define('FPDF_FONTPATH','font/');
 
class PDF extends FPDF
{   
	function PDF($orientation='L',$unit='mm',$format='Letter')
    {
    //Llama al constructor de la clase padre
    $this->FPDF($orientation,$unit,$format);
    $this-> AddFont('Arial','','arial.php');
 
    //Iniciaci�n de variables
    }



function Header()
{       
   $this->Image('../../../../lib/images/logo_reporte.jpg',230,2,35,15);
  
    $this->Ln(5);
    $this->SetFont('Arial','B',16);
 	$this->Cell(0,6,'PRESTACI�N DE SERVICIOS VIGENTES',0,1,'C');
 	$this->SetFont('Arial','',10);
	$this->Cell(0,6,''.utf8_decode($_SESSION['PDF_desc_depto']),0,1,'C');
	$this->SetFont('Arial','B',10);
 	$this->SetX(15);
 	$this->Ln(1.5);


	$this->Ln(2);

 $this->Ln(1);
 $this->SetFont('Arial','B',7);
 $this->SetLineWidth(0.2);
 
 $this->SetWidths(array(12,45,15,45,25,15,25,18,15,15,22,20));
 $this->SetFills(array(0,0,0,0,0,0,0));
 $this->SetAligns(array('L','L','L','L','L','C','L','L','L','L','R','L'));
 $this->SetVisibles(array(1,1,1,1,1,1,1,1,1,1,1,1));
 $this->SetFontsSizes(array(6,6,6,6,6,6,6,6,6,6,6,6,6,6,6));
 $this->SetFontsStyles(array('','','','','','','','','','','','','','','',''));
 $this->SetDecimales(array(0,0,0,0,0,2,0,0,0,1,1,1,2,0));
 $this->SetSpaces(array(3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3));
 $this->SetFormatNumber(array(0,0,0,0,0,0,0,0,0,0,1,0));
 
 
 $this->Cell(12,3,'N�','TRL',0,'C');  
 $this->Cell(45,3,'NOMBRE ','TRL',0,'C');  
 $this->Cell(15,3,'CI','TRL',0,'C');  
 $this->Cell(45,3,'SERVICIO','TRL',0,'C');  
 
 $this->Cell(25,3,'UNIDAD','TRL',0,'C'); 
 $this->Cell(15,3,'N�','TRL',0,'C');  
 $this->Cell(25,3,'ORDEN','TRL',0,'C');  
 $this->Cell(18,3,'TIEMPO','TRL',0,'C');  
 $this->Cell(15,3,'FECHA','TRL',0,'C');  
 $this->Cell(15,3,'FECHA','TRL',0,'C');  
  $this->Cell(22,3,'REMUNERACION','TRL',0,'C'); 
  $this->Cell(20,3,'ESTADO','TRL',1,'C'); 
 
 
 $this->Cell(12,3,'SOL','BRL',0,'C');  
 $this->Cell(45,3,'','BRL',0,'C');  
 $this->Cell(15,3,'','BRL',0,'C');  
 $this->Cell(45,3,'','BRL',0,'C');  
 $this->Cell(25,3,'ORGANIZACIONAL','BRL',0,'C'); 
 $this->Cell(15,3,'CONTRATO','BRL',0,'C');  
 $this->Cell(25,3,'SERVICIO','BRL',0,'C');  
 $this->Cell(18,3,'ENTREGA','BRL',0,'C');  
 $this->Cell(15,3,'INICIO','BRL',0,'C');  
 $this->Cell(15,3,'FIN','BRL',0,'C'); 
  $this->Cell(22,3,'','BRL',0,'C');   
 $this->Cell(20,3,'VIGENTE','BRL',1,'C');  
 
 $this->Ln(0.3);
}
//Pie de p�gina
function Footer()
{
    //Posici�n: a 1,5 cm del final
    $fecha=date("d-m-Y");
	$hora=date("H:i:s");
	    $this->SetY(-7);
   	    $this->SetFont('Arial','',6);
   	    $this->Cell(100,3,'Usuario: '.$_SESSION["ss_nombre_usuario"],0,0,'L');
		$this->Cell(70,3,'P�gina '.$this->PageNo().' de {nb}',0,0,'C');
		$this->Cell(62,3,'',0,0,'L');
		$this->Cell(18,3,'Fecha: '.$fecha,0,0,'L');
		$this->ln(3);
		$this->Cell(100,3,'Sistema: ENDESIS -COMPRO',0,0,'L');
		$this->Cell(70,3,'',0,0,'C');
		$this->Cell(62,3,'',0,0,'L');
		$this->Cell(18,3,'Hora: '.$hora,0,0,'L');	
        
      }


}

	$pdf=new PDF();
	$pdf->AliasNbPages();
	$pdf->SetAutoPageBreak(true,7);
    $pdf->SetMargins(5,5,5);
    $pdf->AddPage();



  $pdf->SetWidths(array(12,45,15,45,25,15,25,18,15,15,22,20));
 $pdf->SetFills(array(0,0,0,0,0,0,0));
 $pdf->SetAligns(array('L','L','L','L','L','C','L','L','L','L','R','L'));
 $pdf->SetVisibles(array(1,1,1,1,1,1,1,1,1,1,1,1));
 $pdf->SetFontsSizes(array(6,6,6,6,6,6,6,6,6,6,6,6,6,6,6));
 $pdf->SetFontsStyles(array('','','','','','','','','','','','','','','',''));
 $pdf->SetDecimales(array(0,0,0,0,0,2,0,0,0,1,1,1,2,0));
 $pdf->SetSpaces(array(3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3));
 $pdf->SetFormatNumber(array(0,0,0,0,0,0,0,0,0,0,1,0));
 
$v_setdetalle=$_SESSION['PDF_prestacion_servicios'];

 for ($i=0;$i<sizeof($v_setdetalle);$i++){
 	$pdf->SetLineWidth(0.05);
 	
 	   $pdf->MultiTabla($v_setdetalle[$i],0,3,3,6,1);
 	  
   }
 

$pdf->SetFont('Arial','',10); 	   
$y=$pdf->GetY();
$posy1=$y;

	
$altura=$pdf->h;
$margen_inf=$pdf->lMargin;
$tope_inf=$altura-$margen_inf;

if(($tope_inf-$y)<$margen_inf){
	$pdf->SetXY(0,($altura-$y-25));
}else{
	$pdf->SetXY(0,$y);
}
//
$pdf->MultiCell(0,4,"\n\n\n\n____________________________"."\n"."Responsable de Planilla",'','C',0); 

	  
	  
$pdf->Output();


?>