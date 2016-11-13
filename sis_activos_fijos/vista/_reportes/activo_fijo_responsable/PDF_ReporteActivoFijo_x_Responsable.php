<?php 

session_start();


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

	function Header()
	{      
		
	
	 $fecha=date("d-m-Y");	
	 
	 
	 $this->Image('../../../../lib/images/logo_reporte.jpg',180,2,35,15);
	 $this->Ln(5);
	 $this->SetFont('Arial','B',5);
	 $this->SetX(15);
	 $this->Ln(1.5); 
	
	 
	 $this->SetFont('Arial','B',9);
	 $this->Cell(0,6,'DETALLE RESPONSABLE / CUSTODIO DE ACTIVOS FIJOS' ,0,1,'C');
	 
	 
	 $this->SetFont('Arial','B',5);

	 
	}
	//Pie de p�gina
	function Footer()
	{
	    //Posici�n: a 1,5 cm del final
	    $fecha=date("d-m-Y");
		$hora=date("H:i:s");
		
			$this->SetY(-7);
	   	    $this->SetFont('Arial','',6);
	   	    $this->Cell(70,3,'Usuario: '.$_SESSION["ss_nombre_usuario"],0,0,'L');
			$this->Cell(55,3,'P�gina '.$this->PageNo().' de {nb}',0,0,'C');
			$this->Cell(50,3,'',0,0,'L');
			$this->Cell(18,3,'Fecha: '.$fecha,0,0,'L');
			$this->ln(3);
			$this->Cell(70,3,'Sistema: ENDESIS - ACTIVOS FIJOS',0,0,'L');
			$this->Cell(50,3,'',0,0,'C');
			$this->Cell(55,3,'',0,0,'L');
			$this->Cell(18,3,'Hora: '.$hora,0,0,'L');	
		
	        
	}
}

	function mostrarCabecera(PDF $pdf){
		
		$pdf->SetFillColor(230 , 230, 230);    //Plomo claro
		
		$pdf->Cell(9,2,'N�','LTR',0,'C',true);
		$pdf->Cell(15,2,'CODIGO ACTIVO','LTR',0,'C',true);
		$pdf->Cell(30,2,'DENOMINACION','LTR',0,'C',true);
		$pdf->Cell(57,2,'DESCRIPCION','LTR',0,'C',true);
		$pdf->Cell(50,2,'UBICACION FISICA','LTR',0,'C',true);
		$pdf->Cell(40,2,'OBSERVACION','LTR',1,'C',true);
		
		$pdf->Cell(9,2,'','LBR',0,'C',true);
		$pdf->Cell(15,2,'FIJO','LBR',0,'C',true);
		$pdf->Cell(30,2,'','LBR',0,'C',true);
		$pdf->Cell(57,2,'','LBR',0,'C',true);
		$pdf->Cell(50,2,'','LBR',0,'C',true);
		$pdf->Cell(40,2,'','LBR',1,'C',true);
		
	}

	$detalle = $_SESSION['PDF_Detalle_Activos_Por_Responsable'] ;
	
	$responsable = $_SESSION['PDF_Responsables_Todos'];
	
	if($responsable == null)	
		$responsable = $_SESSION['PDF_Detalle_Activos_Por_Responsable'][0][3];
	
	$fecha=date("d-m-Y");
	
    $pdf=new PDF();	
	$pdf->AliasNbPages();
	$pdf->SetAutoPageBreak(true,7);
    $pdf->SetMargins(10,5,5);  
	
	$pdf->AddPage();	
	
	$pdf->SetFillColor(200 , 200, 200);    //Plomo Oscuro
	$pdf->SetFont('Arial','B',6);
	
	$pdf->Cell(0,3,'DATOS GENERALES',1,1,'C',true);
	$pdf->Ln(1);
	$pdf->Cell(40,3,'DEPARTAMENTO AF: ',0,0,'L');
	$pdf->SetFillColor(230 , 230, 230);    //Plomo claro
	$pdf->Cell(40,3,'Departamento de Activos Fijos Central: ',0,0,'L',true);
	$pdf->Cell(40,3,'',0,0,'C');
	$pdf->Cell(31,3,'RESPONSABLE: ',0,0,'C');
	$pdf->Cell(50,3,$responsable,0,1,'L',true);
	$pdf->Cell(40,3,'FECHA PROCESO:',0,0,'L');
	$pdf->Cell(40,3,$fecha,0,1,'L',true);
	$pdf->Ln(1);
	$pdf->SetFillColor(200 , 200, 200);    //Plomo Oscuro
	$pdf->Cell(0,3,'DETALLE',1,1,'C',true);
	$pdf->Ln(1);
		
	/*$pdf->Cell(24,3,'RESPONSABLE: ',1,0,'L');
	$pdf->Cell(87,3,$responsable,1,1,'L',true);
	mostrarCabecera($pdf); */
	
    $pdf->SetWidths(array(9,15,30,57,0,0,50,40));
	$pdf->SetFills(array(0,0,0,0,0,0,0,0));
 	$pdf->SetAligns(array('R','L','L','L','L','L','L','L'));
 	$pdf->SetVisibles(array(1,1,1,1,0,0,1,1));
  	$pdf->SetFontsSizes(array(6,6,6,6,6,6,6,6));
 	$pdf->SetFontsStyles(array('','','','','','','',''));
 	$pdf->SetSpaces(array(3,3,3,3,3,3,3,3));
 	$pdf->setDecimales(array(0,0,0,0,0,0,0,0));
    $pdf->SetFormatNumber(array(0,0,0,0,0,0,0,0));

	$cont = 0;
	$responsable_anterior = '';
	$responsable_actual = '';
	
	$custodio_anterior = '';	
	$custodio_actual = '';
	
	
	
 	 		for ($i=0;$i<count($detalle);$i++){	 
 	 			
 	 			$pdf->SetLineWidth(0.05);
 	 				
 	 			$cont += 1; 
 	 			array_unshift($detalle[$i],$cont);
 	 			
 	 			$responsable_actual = $detalle[$i][4];
 	 			$custodio_actual = $detalle[$i][5];
 	 			$pdf->SetFillColor(230 , 230, 230);    //Plomo claro
 	 			if($responsable_actual == $responsable_anterior){ 
 	 				
 	 				if($custodio_actual == $custodio_anterior){
 	 					
 	 					$pdf->MultiTabla($detalle[$i],0,3,3,6);
 	 					
 	 				}else if($custodio_actual != ''){
 	 					
	 	 				$custodio = $detalle[$i][5];
	 	 					
	 	 				$pdf->SetFont('Arial','B',5);
	 	 				$pdf->Ln(3);
	 	 				$pdf->Cell(24,3,'CUSTODIO: ',1,0,'L');
	 	 				$pdf->Cell(87,3,$custodio,1,1,'L',true);
	 	 				mostrarCabecera($pdf);
	 	 				$custodio_anterior = $custodio_actual;
	 	 				$pdf->MultiTabla($detalle[$i],0,3,3,6);
 	 				}else{
 	 					
 	 					$custodio_anterior = $custodio_actual;
 	 				}
 	 				
 	 				
 	 			}else{
 	 				
 	 				$responsable = $detalle[$i][4];
 	 				
 	 				if($responsable_actual != ''){
 	 				$pdf->SetFont('Arial','B',5);
 	 				$pdf->Ln(3);
 	 				$pdf->Cell(24,3,'RESPONSABLE: ',1,0,'L');
					$pdf->Cell(87,3,$responsable,1,1,'L',true);
					//mostrarCabecera($pdf);	
					$responsable_anterior = $responsable_actual;
					//$pdf->MultiTabla($detalle[$i],0,3,4,4,1);
 	 				}else{
 	 					$responsable_anterior = $responsable_actual;
 	 				}
					
					if($custodio_actual == $custodio_anterior){
					
						//$pdf->MultiTabla($detalle[$i],0,3,4,4,1);
					
					}else if($custodio_actual != ''){
					
						$custodio = $detalle[$i][5];
							
						$pdf->SetFont('Arial','B',5);
						$pdf->Ln(3);
						$pdf->Cell(24,3,'CUSTODIO: ',1,0,'L');
						$pdf->Cell(87,3,$custodio,1,1,'L',true);
						//mostrarCabecera($pdf);
						$custodio_anterior = $custodio_actual;
						//$pdf->MultiTabla($detalle[$i],0,3,4,4,1);
					}else{
						$custodio_anterior = $custodio_actual;
					}
					
					mostrarCabecera($pdf);
					//$pdf->MultiTabla($detalle[$i],0,3,4,4,1);
					$pdf->MultiTabla($detalle[$i],0,3,3,6);
					
 	 			} 	 			
 	 			
 	 			
 	 			/*if($custodio_actual == $custodio_anterior){ 	 			
	 	 			$pdf->MultiTabla($detalle[$i],0,3,4,4,1);
 	 			}else{
					
 	 				$custodio = $detalle[$i][5];
 	 				
 	 				$pdf->SetFont('Arial','B',5);
 	 				$pdf->Ln(5);
 	 				$pdf->Cell(34,3,'CUSTODIO: ',1,0,'L');
 	 				$pdf->Cell(40,3,$custodio,1,1,'L',true);
 	 				mostrarCabecera($pdf);
 	 				$custodio_anterior = $custodio_actual;
 	 				$pdf->MultiTabla($detalle[$i],0,3,4,4,1);
 	 			}	*/
	 	 		
 	 			$pdf->SetLineWidth(0.1);
 	 			                  
 	 		}

$pdf->AliasNbPages();
$pdf->Output();


?>