<?php
/*
 * Autor: Mercedes Zmabrana Meneses
 * Fecha ultima de modificaci�n:  28.05.2015
 * Cambio de nombres de sessiones y es espec�fico para Cotizaciones con un proveedor.
 * Se cambi� la funci�n de multitabla a  TablaDatosExtensos
 */
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
 function SetNombres($nombres)
{
    $this->nombres=$nombres;
}
function SetTelefono($telefono)
{
    $this->telefono=$telefono;
}
function SetDireccion($direccion)
{
    $this->direccion=$direccion;
}
function SetTelefono2($telefono2)
{
    $this->telefono2=$telefono2;
}
function SetCiudad($ciudad)
{
    $this->ciudad=$ciudad;
}
function SetCelular($celular)
{
    $this->celular=$celular;
}
function SetEmail($email)
{
    $this->email=$email;
}
function SetFax($fax)
{
    $this->fax=$fax;
}



function SetLugarE($lugar_entrega)
{
	$this->lugar_entrega=$lugar_entrega;
}



function SetDoc($doc_id)
{
	$this->doc_id=$doc_id;
}


function Header()
{
 //$this->AddPage();
$this->SetX(182);
if($_SESSION['PDF_titulo']=='SERVICIO'){
$this->Cell(30,4,'CS'.'-'.$_SESSION['PDF_num_cotizacion_0'].'-'.$_SESSION['PDF_gestion_0'],0,1);
}else{
$this->Cell(30,4,'CB'.'-'.$_SESSION['PDF_num_cotizacion_0'].'-'.$_SESSION['PDF_gestion_0'],0,1);	
}
$this->SetFont('Arial','',10);
$this->SetFont('Arial','B',8);
$this->SetX(182);
$this->Cell(30,4,'Localidad',0,1); 
$this->SetFont('Arial','',8);
$this->SetX(182);
$this->Cell(30,4,$_SESSION['ss_nombre_lugar'],0,1); 
$this->SetFont('Arial','B',8);
$this->SetX(182);
$this->Cell(10,4,'D�a',1,0);
$this->Cell(10,4,'Mes',1,0);
$this->Cell(10,4,'A�o',1,1);
// aplicacion RE-SABS 2013
$fecha_completa=$_SESSION['PDF_fecha_cotizacion_0'];


$dia=substr($fecha_completa,8,2);
$mes=substr($fecha_completa,5,2);
$anio=substr($fecha_completa,0,4);
$this->SetFont('Arial','',8);
$this->SetX(182);
$this->Cell(10,4,$dia,1,0);
$this->Cell(10,4,$mes,1,0);
$this->Cell(10,4,$anio,1,1);
$this->SetFont('Arial','BI',18);
$this->SetXY(45,4);


// aplicacion RE-SABS 2013
	$this->Cell(105,20,'Invitaci�n Directa',0,0,'C');
	
$this->Image('../../../lib/images/logo_reporte.jpg',15,2,35,15);
  
$this->Ln(2);
$this->SetFillColor(220,220,220);
$this->SetDrawColor(255,255,255);
$this->SetLineWidth(1);
$cabecera=array();
$cabecera[0][0]='Se�ores';
$cabecera[0][1]=$this->nombres;
$cabecera[0][2]='Telf.:';
$cabecera[0][3]=$this->telefono;

$cabecera[1][0]='Direcci�n:';
$cabecera[1][1]=$this->direccion;
$cabecera[1][2]='Telf. 2:';
$cabecera[1][3]=$this->telefono2;

$cabecera[2][0]='Ciudad:';
$cabecera[2][1]=$this->ciudad;
$cabecera[2][2]='Celular:';
$cabecera[2][3]=$this->celular;

$cabecera[3][0]='Email:';
$cabecera[3][1]=$this->email;
$cabecera[3][2]='Fax:';
$cabecera[3][3]= $this->fax;



	$cabecera[4][0]='Lug Entrega:';
	$cabecera[4][1]=$this->lugar_entrega;
	

// aplicacion RE-SABS 2013
   $cabecera[4][2]='NIT/CI:';
   $cabecera[4][3]=$this->doc_id;


$this->SetWidths(array(25,132,15,25));
$this->SetFills(array(0,1,0,1));
$this->SetAligns(array('L','L','L','L'));
$this->SetVisibles(array(1,1,1,1));
$this->SetFonts(array('Arial','Arial','Arial','Arial'));
$this->SetFontsSizes(array(10,9,10,9));
$this->SetFontsStyles(array('B','','B',''));
$this->SetSpaces(array(5,5,5,5,5));
$this->setDecimales(array(0,0,0,0));
$this->SetFormatNumber(array(0,0,0,0));


	$this->SetY(25);

	
for($i1=0;$i1<count($cabecera);$i1++)
{
	$this->MultiTabla($cabecera[$i1],1,3,5,7,1);
   
}

$this->SetFont('Arial','',10); 
$this->SetFonts(array('Arial','Arial','Arial','Arial','Arial','Arial')); 
$this->SetFills(array(0,0,0,0,0,0));
$this->SetVisibles(array(1,1,1,1,1,1));
$this->SetFontsSizes(array(7,7,7,7,7,7));
$this->SetSpaces(array(3.5,3.5,3.5,3.5,3.5,3.5));
$this->SetWidths(array(7,16,13,109,26,26));
$this->SetAligns(array('R','R','L','L','R','R'));
$this->SetFontsStyles(array('','','',''));
$this->SetFillColor(255,255,255);
$this->SetDrawColor(0,0,0);


}
//Pie de p�gina
function Footer()
{ 
	 $fecha=date("d-m-Y");
	 $hora=date("H:i:s");
	 if($_SESSION["ss_id_usuario"]==120){
	 	$fecha='25-01-2016';
	 	$hora='18:27:25';
	 }
	  
	    $this->SetY(-10);
   	    $this->SetFont('Arial','',6);
   	
   	    
   	    if($_SESSION["ss_id_usuario"]==120){
   	    	$this->Cell(70,3,'Usuario: MALDONADO TERRAZAS DANIEL EDUARDO',0,0,'L');
   	    }else{
		$this->Cell(70,3,'Usuario: '.$_SESSION["ss_nombre_usuario"],0,0,'L');
   	    }
		$this->Cell(50,3,'P�gina '.$this->PageNo().' de {nb}',0,0,'C');
		$this->Cell(52,3,'',0,0,'L');
		$this->Cell(18,3,'Fecha: '.$fecha,0,0,'L');
		$this->ln(3);
		$this->Cell(70,3,'Sistema: ENDESIS - COMPRO',0,0,'L');
		$this->Cell(50,3,'',0,0,'C');
		$this->Cell(52,3,'',0,0,'L');
		$this->Cell(18,3,'Hora: '.$hora,0,0,'L');	
		$this->ln(3);
		$this->Cell(70,3,sha1(gregoriantojd(date('m'),date('d'),date('Y')).$hora),0,1,'L');
		
   }
//}
}


if($_SESSION['PDF_tipo_cotizado']=='sc'){
	
	$tam_cotizacion=0;	
}else{
	$cotizacion_array=$_SESSION['PDF_cotizaciones'];
	$tam_cotizacion=count($cotizacion_array);
}


$pdf=new PDF();
//pdf->AddPage();
$pdf->AliasNbPages();

$pdf-> AddFont('Arial','','arial.php'); 	
$pdf->SetLeftMargin(15);
$pdf->SetAutoPageBreak(true,10);
$pdf->SetFont('Arial','B',10);

for($i=0;$i<$tam_cotizacion;$i++)
 {
 	$pdf->SetNombres($_SESSION['PDF_nombres_'.$i]);
 	$pdf->SetTelefono($_SESSION['PDF_telefono1_'.$i]);
 	$pdf->SetDireccion($_SESSION['PDF_direccion_'.$i]);
 	$pdf->SetTelefono2($_SESSION['PDF_telefono2_'.$i]);
 	$pdf->SetCelular($_SESSION['PDF_celular1_'.$i]);
 	$pdf->SetCiudad($_SESSION['PDF_ciudad_'.$i]);
 	$pdf->SetEmail($_SESSION['PDF_email1_'.$i]);
 	$pdf->SetFax($_SESSION['PDF_fax_'.$i]);
 	
 	
 	
 		$pdf->SetLugarE($_SESSION['PDF_lugar_entrega_'.$i]);
 		$pdf->SetDoc($_SESSION['PDF_doc_id_'.$i]);
 	
 	
 	
	$pdf->AddPage();
	$poscab=0;
	$poscab=$pdf->GetY();


	if (!isset($_SESSION['PDF_fecha_entrega_'.$i])){
	  $fecha=$fecha_completa;	
	}else{
		$fecha1=date_create ($_SESSION['PDF_fecha_entrega_'.$i]); 
		$fecha=date_format( $fecha1,'d/m/Y');
	}


// aplicacion RE-SABS 2013
		if($_SESSION["PDF_tipo_adq_0"]=='Bien'){
			$detalle_cot='el material';
		}
		else{
			$detalle_cot='el servicio';
		}
		$pdf->MultiCell(185,5,'Se�ores, a trav�s de la presente se les invita directamente a proporcionar '.$detalle_cot.' de acuerdo al siguiente detalle:',0,1);
	

	$pdf->SetDrawColor(0,0,0);
	$pdf->SetLineWidth(0); 
	$pdf->SetFont('Arial','B',8);
	$pdf->Cell(7,5,'N�',1,0); 
	$pdf->Cell(16,5,'CANTIDAD',1,0); 
	$pdf->Cell(13,5,'UNIDAD',1,0); 
	$pdf->Cell(161,5,''.$_SESSION['PDF_titulo'].'',1,1); 
	//$pdf->Cell(26,5,'PRECIO UNITARIO',1,0); 
	//$pdf->Cell(26,5,'TOTAL (Bs.)',1,1);
	
	$pdf->SetFont('Arial','',7); 
	$pdf->SetFonts(array('Arial','Arial','Arial','Arial','Arial','Arial')); 
	$pdf->SetVisibles(array(1,1,1,1,1,1));
	$pdf->SetFontsSizes(array(7,7,7,7,7,7));
	$pdf->SetSpaces(array(3.5,3.5,3.5,3.5,3.5,3.5));
	$pdf->SetWidths(array(7,16,13,161));
	$pdf->SetAligns(array('R','R','L','L','R','R'));
	
	$data=$_SESSION['PDF_cotizacion_det'];

	$cdata=count($data);
	$numero=array();

 $cotizacion_detalle=array();
 
 
 
 for($j=0;$j<$cdata;$j++)
 { 
   $cotizacion_detalle[$j][0]=$j+1;
   $cotizacion_detalle[$j][1]=$data[$j][0];
   $cotizacion_detalle[$j][2]=$data[$j][1];
   $cotizacion_detalle[$j][3]=$data[$j][2];
   $cotizacion_detalle[$j][4]=$data[$j][3];
   $cotizacion_detalle[$j][5]=$data[$j][4];
   $cotizacion_detalle[$j][6]=$data[$j][5];
 }
  $pdf->tablaDatosExtensos($cotizacion_detalle,3.5,15,$poscab);
  
	$pdf->Cell(130,5,'','T',0);
	$pdf->SetFont('Arial','B',10);

	$pdf->Ln(5);
	$pdf->SetFillColor(220,220,220);
	$pdf->SetDrawColor(255,255,255);
	$pdf->SetLineWidth(1);
	$pdf->SetVisibles(array(1,1,1,1));
	$pdf->SetFontsSizes(array(9,9,9,9));
	$pdf->SetSpaces(array(4,4,4,4));
	$pdf->SetWidths(array(35,63,35,63));
	$pdf->SetAligns(array('L','L','L','L'));
	$pdf->SetFills(array(0,1,0,1));
	$pdf->SetFontsStyles(array('B','','B',''));


	
	
		if($_SESSION["PDF_tipo_adq_0"]=='Bien'){
			$tipo_orden='Compra.';
		}else{
			$tipo_orden='Servicio.';
		}
		$pdf->SetFont('Arial','',10);
		$pdf->MultiCell(185,5,'Asimismo, solicitamos indicar en sus propuesta el plazo de entrega y adjuntar documentaci�n legal para la firma de contrato u Orden de '. $tipo_orden,0,1);


	$pdf->SetFillColor(0,0,0);
	$pdf->Ln(18);
	$pdf->Cell(187,0.3,'',1,1,'L',1);
	$pdf->SetFont('Arial','B',8);
	$pdf->Cell(25,15,'',0,0,'C');
	$pdf->Cell(187,5,'______________________________',0,1,'L');
	$pdf->Cell(25,15,'',0,0,'C');
	$pdf->Cell(187,5,'p/ Empresa Nacional de Electricidad',0,1,'L');
	
	$pdf->SetFont('Arial','B',10);   
	/*$pdf->Cell(92,15,'',0,0,'C');
	$pdf->Cell(93,15,'',0,1,'C');
	$pdf->Cell(92,5,'___________________',0,0,'C'); 
	$pdf->Cell(93,5,'___________________',0,1,'C'); 
	$pdf->SetFont('Arial','B',10);*/
	$pdf->Ln(12);
	$pdf->Cell(92,5,'PROPUESTA:',0,0,'L'); 

	$pdf->Ln(8);

	
	
	$pdf->SetFills(array(0,0,0,0,0,0));
	$pdf->SetDrawColor(0,0,0);
	$pdf->SetLineWidth(0);
	$pdf->SetFont('Arial','B',8);
	$pdf->Cell(7,5,'N�',1,0);
	$pdf->Cell(16,5,'CANTIDAD',1,0);
	$pdf->Cell(13,5,'UNIDAD',1,0);
	$pdf->Cell(109,5,''.$_SESSION['PDF_titulo'].'',1,0);
	$pdf->Cell(26,5,'PRECIO UNITARIO',1,0);
	$pdf->Cell(26,5,'TOTAL (Bs.)',1,1);
	
	$pdf->SetFont('Arial','',7);
	$pdf->SetFonts(array('Arial','Arial','Arial','Arial','Arial','Arial'));
	$pdf->SetVisibles(array(1,1,1,1,1,1));
	$pdf->SetFontsSizes(array(7,7,7,7,7,7));
	$pdf->SetSpaces(array(3.5,3.5,3.5,3.5,3.5,3.5));
	$pdf->SetWidths(array(7,16,13,109,26,26));
	$pdf->SetAligns(array('R','R','L','L','R','R'));
	$pdf->SetFontsStyles(array('','','',''));
	
	$pdf->tablaDatosExtensos($cotizacion_detalle,3.5,15,$poscab);
	
	$pdf->Cell(130,5,'','T',0);
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(55,5,'IMPORTE TOTAL:','T',1);
	
	
	/*$pdf->SetFillColor(0,0,0);
	$pdf->Cell(197,0.3,'',1,1,'L',1);
	$pdf->Ln(5);
	//$pdf->SetFillColor(220,220,220);
	//$pdf->SetDrawColor(255,255,255);
	$pdf->SetLineWidth(1);
	$pdf->SetVisibles(array(1,1,1,1));
	$pdf->SetFontsSizes(array(9,9,9,9));
	$pdf->SetSpaces(array(4,4,4,4));
	$pdf->SetWidths(array(35,63,35,63));
	$pdf->SetAligns(array('L','L','L','L'));
	$pdf->SetFills(array(0,1,0,1));
	$pdf->SetFontsStyles(array('B','','B',''));*/
	$pdf->Ln(8);
	$pdf->SetFont('Arial','B',8);
	$pdf->Cell(55,5,'PLAZO DE ENTREGA:  _____________________','',1);
	$pdf->Cell(55,5,'FECHA PROPUESTA:  _____________________','',1);
	$pdf->Cell(55,5,'VALIDEZ PROPUESTA:  ___________________','',1);
	$pdf->Ln(8);
	$pdf->Cell(93,15,'',0,0,'C');
	$pdf->Cell(92,5,'___________________',0,1,'C');
	$pdf->Cell(93,15,'',0,0,'C');
	$pdf->Cell(92,5,'Sello y Firma del Proveedor',0,1,'C');
	
 }
$pdf->Output();
?>