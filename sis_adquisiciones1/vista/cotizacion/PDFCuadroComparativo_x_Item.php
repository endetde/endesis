<?php

session_start();

require('../../../lib/fpdf/fpdf.php');
define('FPDF_FONTPATH','font/');
class PDF extends FPDF
{   
	function PDF($orientation='P',$unit='mm',$format='Letter')
    {
    //Llama al constructor de la clase padre
    $this->FPDF($orientation,$unit,$format);
    //Iniciaci�n de variables
    }
 
function Header()
{
    $this->Image('../../../lib/images/logo_reporte.jpg',170,2,35,15);
    $this->Ln(5);
}
//Pie de p�gina
function Footer()
{
    //Posici�n: a 1,5 cm del final
    $fecha=date("d-m-Y");
	$hora=date("h:i:s");
	    $this->SetY(-10);
   	    $this->SetFont('Arial','',6);
   	   // $this->Cell(200,0.2,'',1,1);
		$this->Cell(70,3,'Usuario: '.$_SESSION["ss_nombre_usuario"],0,0,'L');
		$this->Cell(50,3,'P�gina '.$this->PageNo().' de {nb}',0,0,'C');
		$this->Cell(52,3,'',0,0,'L');
		$this->Cell(18,3,'Fecha: '.$fecha,0,0,'L');
		$this->ln(3);
		$this->Cell(70,3,'Sistema: ENDESIS -COMPRO',0,0,'L');
		$this->Cell(50,3,'',0,0,'C');
		$this->Cell(52,3,'',0,0,'L');
		$this->Cell(18,3,'Hora: '.$hora,0,0,'L');
		$this->ln(3);
		$this->Cell(70,3,sha1(gregoriantojd(date('m'),date('d'),date('Y')).$hora),0,1,'L');
   
}


}

	$pdf=new PDF();
	$pdf->AliasNbPages();
	
$pdf->SetAutoPageBreak(true,10);
$pdf-> AddFont('Arial','','arial.php');

$pdf->SetMargins(15,15,15);
$cua_com_cab=$_SESSION['PDF_cuacomcab'];
$num_solicitud='';

for($v=0;$v<count($cua_com_cab);$v++){
	$fecha_hoy=$cua_com_cab[$v][1];
	$nro_proceso=$cua_com_cab[$v][4];
	$cod_proceso=$cua_com_cab[$v][3];
	if($v==0){
	$num_solicitud=$num_solicitud.$cua_com_cab[$v][0];
	
	}else{
	$num_solicitud=$num_solicitud.','.$cua_com_cab[$v][0];	
	}
	
}
$v_items=$_SESSION['PDF_Items'];
 for ($i=0;$i<sizeof($v_items);$i++){
 $pdf->AddPage();
 //T�tulos de las columnas
 $pdf->setY(7);
$pdf->SetFont('Arial','B',6);
 $pdf->Cell(50,5,'ORIGINAL',0,1);
 $pdf->Ln(1.6);
 
 $pdf->SetFont('Arial','B',16);
$pdf->Cell(185,5,'CUADRO COMPARATIVO DE OFERTAS',0,1,'C');
$pdf->SetFont('Arial','B',8);
$pdf->Cell(185,4,'Expresado en '.$_SESSION['ss_moneda_principal'],0,1,'C');
$pdf->SetFont('Arial','',6);
$pdf->Cell(185,4,'Formato: Extendido',0,1,'C');
$pdf->Ln(2);
$pdf->SetFont('Arial','',6);
$pdf->Cell(50,4,'N� Proceso: '. $nro_proceso,0,0,'L');
$pdf->Cell(90,4,'Codigo Proceso: '. $cod_proceso,0,0,'L');
$pdf->Cell(50,4,'N� Solicitud: '. $num_solicitud,0,1,'L');
$pdf->SetFont('Arial','B',10);

$pdf->Cell(15,4,$_SESSION['PDF_titulo'],0,0);	
$pdf->SetFont('Arial','',8);
$pdf->MultiCell(175,4,$v_items[$i][1],0);	
$pdf->SetFont('Arial','B',10);
$pdf->Cell(30,5,'Cantidad: ',0,0);	
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(30,5,number_format($v_items[$i][3],0),0,'R');
$pdf->SetFont('Arial','B',10);
$pdf->Cell(30,5,'Precio Unitario: ',0,0);	
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(30,5,number_format($v_items[$i][2],2),0,'R');
$pdf->SetFont('Arial','B',10);
$pdf->Cell(30,5,'Precio Total: ',0,0);	
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(30,5,number_format($v_items[$i][4],2),0,'R');
$pdf->SetFont('Arial','B',10);
$pdf->SetTextColor(255,0,0);
/*echo "sali algo por favor".($v_items[$i][5]);
exit;*/

if($v_items[$i][5]!='no'){
	switch ($v_items [$i][5])
		{
			case "pendiente":$mostrar="Reformulaci�n Pendiente";
			break;
			case "si":$mostrar="Reformulaci�n Aprobada";
			break;
			case "verificado":$mostrar="Reformulaci�n Verificada";
			break;
		}
	$pdf->Cell(140,5,$mostrar,0,1);
}
$pdf->SetTextColor(0,0,0);
    $v_proveedores=$_SESSION['PDF_proveedores_'.$i];
	for($j=0;$j<sizeof($v_proveedores);$j++)
	{
		$v_ofertas=$_SESSION['PDF_proveedores_ofertas_'.$i.$j];
		$v_detalle_propuesta=$_SESSION['PDF_detalle_propuesta_'.$i.$j];
		$minimo=$v_proveedores[$j][3];
		/*echo $minimo;
		exit;*/
		$pdf->Ln(2);
		$pdf->SetX(30);
		$pdf->SetFont('Arial','B',10);
		$pdf->MultiCell(100,4,$v_proveedores[$j][2],0);
		
		$pdf->Ln(1);
		
		$pdf->SetX(30);
		//$pdf->Cell(100,5,'Oferta Cotizada seg�n el Item',0,1);
		$pdf->SetX(30);
		$pdf->SetFont('Arial','',6);
		
		$pdf->Cell(100,4,'Descripci�n',0,0,'C'); 
		$pdf->Cell(20,4,'Cantidad',0,0,'C'); 
		$pdf->Cell(15,4,'Unidad',0,0,'C'); 
		$pdf->Cell(20,4,'Precio Unitario',0,0,'C'); 
		$pdf->Cell(20,4,'Importe Total',0,1,'C'); 
 		$pdf->SetX(30);
		
		for($k=0;$k<sizeof($v_ofertas);$k++)
		{
		  	 $pdf->SetFont('Arial','',8);	
             $pdf->SetWidths(array(0,100,20,15,20,20));
             $pdf->SetAligns(array('L','L','R','L','R','R'));
             $pdf->SetVisibles(array(0,1,1,1,1,1,0));
             $pdf->SetFontsSizes(array(7,7,7,7,7,7));
             $pdf->SetDecimales(array(0,0,2,0,2,2));
             $pdf->SetSpaces(array(3,3,3,3,3,3));
             $pdf->SetX(30);
             $pdf->SetLineWidth(0.05);
             $x=$pdf->GetX();
	         $y=$pdf->GetY();
	       
	         if ($v_ofertas[$k][4]==$minimo){
	         	
	         	$pdf->SetFontsStyles(array('','','','','B','B'));
	         	$pdf->SetLineWidth(0.3);
	         }else{
	         	$pdf->SetFontsStyles(array('','','','','',''));
	         }
	         $pdf->MultiTabla($v_ofertas[$k],0,3,3,7);
	         
	       
             $x1=$pdf->GetX();
	         $y1=$pdf->GetY();
             $pdf->SetXY($x+180,$y);
             $pdf->Cell(2.5,2.5,'',1,1);
             $pdf->SetXY($x1,$y1);
             $pdf->SetLineWidth(0.2);
		}
		$pdf->SetX(30);
		if($v_proveedores[$j][4]!=''){
		$pdf->SetFont('Arial','B',8);
		$pdf->Cell(20,4,'Observaciones: ',0,0,'C'); 
		$pdf->SetFont('Arial','',8);
		$pdf->MultiCell(140,4,$v_proveedores[$j][4],0,'L'); 
		
		}
		if(sizeof($v_detalle_propuesta)!=0){
		$pdf->SetX(30);
		$pdf->SetFont('Arial','',7);
		$pdf->Cell(100,5,'Otras Ofertas: ',0,1);
		$pdf->SetFont('Arial','B',7);
		$pdf->SetX(30);
		$pdf->Cell(100,4,'Descripci�n','LTR',0,'C'); 
		$pdf->Cell(20,4,'Cantidad','LTR',0,'C'); 
		$pdf->Cell(15,4,'Unidad','LTR',0,'C'); 
		$pdf->Cell(20,4,'Precio U.','LTR',0,'C'); 
		$pdf->Cell(20,4,'Importe T.','LTR',1,'C'); 
 		$pdf->SetX(30);
	/*	$pdf->Cell(100,4,'','LBR',0,'C'); 
		$pdf->Cell(20,4,'Cotizada','LBR',0,'C'); 
		$pdf->Cell(20,4,'Unitario','LBR',0,'C'); 
		$pdf->Cell(20,4,'Total','LBR',1,'C'); 
		*/
		
		for($k1=0;$k1<sizeof($v_detalle_propuesta);$k1++)
		{
		  	 $pdf->SetFont('Arial','',8);	
             $pdf->SetWidths(array(100,20,15,20,20));
             $pdf->SetAligns(array('L','R','L','R','R'));
             $pdf->SetVisibles(array(1,1,1,1,1));
             $pdf->SetFontsSizes(array(7,7,7,7,7));
             $pdf->SetDecimales(array(0,2,0,2,2));
             $pdf->SetSpaces(array(3,3,3,3,3));;
             $pdf->SetX(30);
             $pdf->SetLineWidth(0.05);
             $x2=$pdf->GetX();
	         $y2=$pdf->GetY();
             $pdf->MultiTabla($v_detalle_propuesta[$k1],0,3,3,7);
             $x12=$pdf->GetX();
	         $y12=$pdf->GetY();
             $pdf->SetXY($x2+180,$y2);
             $pdf->Cell(2.5,2.5,'',1,1);
             $pdf->SetXY($x12,$y12);
             
             $pdf->SetLineWidth(0.2);
		}
		
	}
	$pdf->SetFont('Arial','B',16);
 }
 $pdf->SetX(15);
  $pdf->SetLineWidth(0.02);
 $pdf->SetFont('Arial','B',8);
 
 
 
 $pdf->Cell(30,5,'Empresa Adjudicada:',0,0);
 $pdf->Cell(160,4,'','B',1);
 $pdf->Cell(35,6,'Precio de Adjudicaci�n:',0,0);
 $pdf->Cell(155,4,'','B',1);
 
 $pdf->Cell(80,5,'Informe de recomendaci�n del Comit� de Evaluaci�n',0,1);
 // $pdf->SetX(30);
 $pdf->Cell(190,5,'','B',1);
  //$pdf->SetX(30);
 $pdf->Cell(190,5,'','B',1);
  //$pdf->SetX(30);
 $pdf->Cell(190,5,'','B',1);
 
}
//Obtenemos la lista de proveedores con sus respectivas garantias,lugar de entrega forma de pago
$v_detalle_proveedores=$_SESSION['PDF_Proveedores'];
$pdf->Ln(3);
  $pdf->SetLineWidth(0.2);
$pdf->Cell(30,4,'Proveedor','LTR',0,'C'); 
      
		$pdf->Cell(20,4,'Fecha Entrega','LTR',0,'C'); 
		$pdf->Cell(30,4,'Lugar Entrega','LTR',0,'C'); 
		$pdf->Cell(30,4,'Forma Pago','LTR',0,'C'); 
		$pdf->Cell(30,4,'Tiempo de Validez','LTR',0,'C'); 
		$pdf->Cell(30,4,'Garantia','LTR',0,'C'); 
 		$pdf->Cell(30,4,'Observaciones','LTR',1,'C'); 
for($l=0;$l<sizeof($v_detalle_proveedores);$l++)
		{
		  	 $pdf->SetFont('Arial','',8);	
             $pdf->SetWidths(array(30,20,30,30,30,30,30));
             $pdf->SetAligns(array('L','L','L','L','L','L','L'));
             $pdf->SetVisibles(array(1,1,1,1,1,1,1));
             $pdf->SetFontsSizes(array(7,7,7,7,7,7,7));
             $pdf->SetDecimales(array(0,0,0,0,0,0));
             $pdf->SetSpaces(array(3,3,3,3,3,3,3));;
             $pdf->SetLineWidth(0.05);
             $pdf->MultiTabla($v_detalle_proveedores[$l],0,3,3,7);
             $pdf->SetLineWidth(0.2);
		}
$pdf->SetFont('Arial','B',16);	
$pdf->Ln(10);	
$pdf->Cell(100,5,'______________________',0,0,'C'); 
$pdf->Cell(50,5,'______________________',0,1,'C'); 
$pdf->SetFont('Arial','B',10);
$y=$pdf->GetY();
$pdf->SetX(40);
$pdf->MultiCell(50,5,'Representante Unidad Solicitante  ',0,'C');
$pdf->SetXY(120,$y);
$pdf->MultiCell(50,5,'Representante Unidad de Bienes y Servicios  ',0,'C');
$pdf->Ln(10);


$pdf->Output();


?>