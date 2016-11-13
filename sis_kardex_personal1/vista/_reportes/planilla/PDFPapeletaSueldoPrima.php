<?php
session_start();
/**Autor: Ana Mar�a Villegas Quispe
 * Fecha Mod: 06/05/2013
 * Desc:   Reporte de papeleta de Pago de Primas
 
 */

require('../../../../lib/fpdf/fpdf.php');
define('FPDF_FONTPATH','font/');

class PDF extends FPDF
{   
	function PDF($orientation='P',$unit='mm',$format='Letter')
    {
    //Llama al constructor de la clase padre
    $this->FPDF($orientation,$unit,$format);
     $this-> AddFont('Arial','','arial.php');
    //Iniciaci�n de variables
    }
 function SetPrograma($nombre_programa)
{
    $this->nombre_programa=$nombre_programa;
}   
 //Cabecera
function Header()
{


}
//Pie de p�gina
function Footer()
{
 $fecha=date("d-m-Y");
	$hora=date("h:i:s");
	    $this->SetY(-3);
   	    $this->SetFont('Arial','',5);
   	  
   }

}

$pdf=new PDF();



$detalle=$_SESSION['PDF_lista_papeleta_prima'];
$firma=$_SESSION['PDF_firma'];
$tam_det=count($detalle);



$pdf->AliasNbPages();
$pdf->SetAutoPageBreak(true,3);
$pdf->SetMargins(5,5,5);
$pdf->SetFont('Arial','B',5);
$indice=0;

for($j=0;$j<$tam_det;$j++){
	
	if (($j % 2)==0){
$pdf->AddPage();
	} else {
		$pdf->Ln(48);
	}    
	$cabecera=$_SESSION["PDF_cab_rep_planilla"];	
	for ($i=$indice;$i<($indice+1);$i++){
		
		$inicio_boleta=$pdf->GetY();
		$codigo_empleado=$detalle[$i]['codigo_empleado'];
		$nombre_empleado=$detalle[$i]['nombre_completo'];
		$nombre_cargo=$detalle[$i]['nombre_cargo'];
		$nivel=$detalle[$i]['nivel'];
		$saldo_rc_iva=$detalle[$i]['saldo_rc_iva'];
		$tot_dias=$detalle[$i]['tot_dias'];
		
		switch ($detalle[$i]['codigo']){
		
			 case 'PRIMA':  $pa_taguin=$detalle[$i]['valor'];
								$liq_pag_literal=$detalle[$i]['liq_pag_literal'];	
			   break;
			
		}
	}
	$indice=$indice+1;
	
	

$pdf->SetFont('Arial','B',14);
$y=$inicio_boleta;
$ges_prima=$cabecera[0]['gestion'];
$ges_prima=$ges_prima-1;
	
	$pdf->Cell(40,20,'','',1);
	$pdf->SetY($y);
	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(0,5,' PAPELETA DE PAGO DE PRIMAS','',1,'C');
	$pdf->Cell(0,5,'CORRESPONDIENTE AL A�O :'.$ges_prima,'',1,'C');
	$pdf->Cell(0,5,'(Expresado en bolivianos)','',1,'C');
	$pdf->SetFont('Arial','',10);
	
	
	$x=$pdf->GetX();
	
			$pdf->SetFont('Arial','B',9);
	$pdf->SetXY(167,$y);
	$pdf->Cell(45,4,'No Patronal:511-2067','',1,'C'); 
	$pdf->SetX(170);
	$pdf->Cell(42,6,'N.I.T. 1023187029','',1,'C'); 
	$pdf->Cell(207,12,'','',1,'C');		
	$pdf->SetFont('Arial','B',11);

	
	$pdf->Cell(2,5,'','',0);
	$pdf->Cell(13,5,'C�digo','RT',0,'C');
	$pdf->Cell(82,5,'Nombres y Apellidos','RT',0,'C');
	$pdf->Cell(98,5,'Cargo','RT',0,'C');
	//$pdf->Cell(10,5,'Niv','T',0,'C');
	$pdf->Cell(2,5,'','',1,'C');
	//datos
	
	$pdf->SetFont('Arial','',9);
	$pdf->Cell(2,5,'','',0);
	$pdf->Cell(13,5,$codigo_empleado,'RB',0,'C');
	$pdf->Cell(82,5,$nombre_empleado,'RB',0,'C');
	$pdf->Cell(98,5,$nombre_cargo,'RB',0,'C');
	//$pdf->Cell(10,5,$nivel,'B',0,'C');
	$pdf->Cell(2,5,'','',1,'C');
	//// Imagenn.
		//$pdf->Image('../../../../lib/images/navidad.jpg',35,45,30,35);
		
		//$pdf->Image('../../../../lib/images/navidad.jpg',35,195,30,35);
	//$pdf->Image('../../../../lib/images/fondo_ende.jpg',20,20,150,67);
	//Fin de la imagen
	
	
	
	
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(2,10,'','',0);
	$pdf->Cell(70,10,'','',0,'L');
	$pdf->Cell(20,10,'','',0,'R');
	$pdf->Cell(5,10,'','',0);
	$pdf->Cell(5,10,'','',0);
	//$pdf->Cell(50,10,'Dias Trabajados:','',0,'L');
	/*$pdf->Cell(50,10,'PRIMA:','',0,'L');
	$pdf->Cell(15,10,''.$tot_dias,'',0,'R');*/
	$pdf->Cell(50,10,'','',0,'L');
	$pdf->Cell(15,10,'','',0,'R');
	
	$pdf->Cell(25,10,'','',0,'R');
	$pdf->Cell(10,10,'','',0,'R');
	$pdf->Cell(5,10,'','',1,'C');
	
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(2,10,'','',0);
	$pdf->Cell(70,10,'','',0,'L');
	$pdf->Cell(20,10,'','',0,'R');
	$pdf->Cell(5,10,'','',0);
	$pdf->Cell(5,10,'','',0);
	$pdf->Cell(50,10,'TOTAL PRIMA:','',0,'L');
	$pdf->Cell(15,10,'','',0,'R');
	$pdf->Cell(25,10,''.$pa_taguin,'',0,'R');
	$pdf->Cell(10,10,'','',0,'R');
	$pdf->Cell(5,10,'','',1,'C');
	
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(2,10,'','',0);
	$pdf->Cell(70,10,'','',0,'L');     
	$pdf->Cell(20,10,'','',0,'R');
	$pdf->Cell(5,10,'','',0);
	$pdf->Cell(5,10,'','',0);
	$pdf->Cell(50,10,'Son: '.$liq_pag_literal,'',0,'L');
	$pdf->Cell(15,10,'','',0,'R');
	$pdf->Cell(25,10,'','',0,'R');
	$pdf->Cell(10,10,'','',0,'R');
	$pdf->Cell(5,10,'','',1,'C');
	
	
	$pdf->Ln(25);
	$pdf->SetFont('Arial','',5);
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(20,5,'',0,0,'C');
	if($firma==1){
		$pdf->Cell(60,5,'',0,0,'C');
		
	}else{
	  $pdf->Cell(60,5,'RECIBI CONFORME','T',0,'C');
	}
	$pdf->Cell(20,5,'',0,1,'C');
	$pdf->SetXY(8,($pdf->GetY()-3));
	$pdf->SetFont('Arial','',5);
	$pdf->Cell(5,2,'',0,1,'C');
	
	
	$pdf->Ln(10);
	$pdf->SetFont('Arial','',5);
	$pdf->Cell(2,5,'','',0);
	$pdf->Cell(100,2,''.sha1($nombre_empleado.$suelmes.$cabecera[0]['periodo'].$cabecera[0]['gestion']),0,0,'L');
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(20,5,'',0,0,'C');
	$pdf->Cell(60,5,'',0,0,'C');
	$pdf->Cell(20,5,'',0,1,'C');
	$pdf->SetXY(8,($pdf->GetY()-3));
	$pdf->SetFont('Arial','',5);
	$pdf->Cell(5,2,'Endesis',0,1,'C');
	
	
}
$pdf->Output();


?>