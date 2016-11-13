<?php
require('../../../../lib/fpdf/fpdf.php');
require('../../../../lib/funciones.inc.php');
include_once("../../../../lib/configuracion.log.php");
//include_once("../../rcm_LibModeloAlmacenes.php");
include_once("../../LibModeloControlAsistencia.php");
define('FPDF_FONTPATH','font/');

class PDF extends FPDF
{    //Cargar los datos
	//Cabecera de p�gina

	function Header()
	{	global $title;
	$this->SetLeftMargin(15);
	$funciones = new funciones();
	//Logo
	$this->Image('../../../../lib/images/logo_reporte.jpg',160,4,36,13);
	$this->Ln(8);
		$this->SetLineWidth(.1);

		$this->SetFont('Arial','B',12);
		$this->Cell(200,10,'RESUMEN MENSUAL DE DESCUENTOS',0,0,'C');
		$this->Ln(7);
		$this->SetFont('Arial','B',10);
		$this->Cell(75,8,'Descuentos Correspondientes al Mes de :',0,0,'L');
		$this->SetFont('Arial','',10);
		$this->Cell(30,8,$_SESSION['mes_resumen_descuento_mes'],0,0,'L');
		$this->Ln(7);
		$this->SetFont('Arial','B',10);
		$this->Cell(20,8,'Desde:',0,0,'L');
		$this->SetFont('Arial','',10);
		$this->Cell(30,8,cambiarFormatoFecha($_SESSION['fecha_desde_resumen_descuento_mes'],1),0,0,'L');
		$this->SetFont('Arial','B',10);
		$this->Cell(20,8,'Hasta:',0,0,'L');
		$this->SetFont('Arial','',10);
		$this->Cell(50,8,cambiarFormatoFecha($_SESSION['fecha_hasta_resumen_descuento_mes'],1),0,0,'L');
		$this->Ln(8);
		$this->SetDrawColor(103,113,157);
		$this->SetFillColor(253,184,19);
		$this->SetFont('Arial','B',8);		
		$this->Cell(80,8,'Funcionario',1,0,'C',1);
		$this->Cell(25,8,'Haber Mensual',1,0,'C',1);
		$this->Cell(30,8,'Tiempo No Trabajado',1,0,'C',1);
		$this->Cell(20,8,'Descuento',1,0,'C',1);
		$this->Cell(35,8,'Cantidad Memorandum',1,0,'C',1);
		$this->Ln(8);
	}

	function Footer()
	{	//Posici�n: a 1,5 cm del final
		$this->SetY(-15);
		//Arial italic 8
		$this->SetFont('Arial','I',6);
		//N�mero de p�gina
		$fecha=date("d-m-Y");
		//hora
		$hora=date("H:i:s");
		$this->Cell(80,10,'Usuario: '.$_SESSION["ss_nombre_usuario"] ,0,0,'L');
		$this->Cell(80,10,'P�gina '.$this->PageNo().' de {nb}',0,0,'L');
		$this->Cell(60,10,'Fecha: '.$fecha ,0,0,'L');
		$this->ln(3);
		$this->Cell(80,10,'',0,0,'L');
		$this->Cell(80,10,'',0,0,'L');
		$this->Cell(60,10,'Hora: '.$hora ,0,0,'L');
		
	}

  	/////////////////////////////////////////////////////////////////////////////
  	function LoadData($id_empleado,$fecha_ini,$fecha_fin,$tipo_contrato)
	{     $cant=10000;
		  $puntero=0;
	      $sortcol='EMPLEA.nombre_completo,c.sueldo';
	      $sortdir='asc';
		  $criterio_filtro="0=0";			
		 
		
           	//Leer las l�neas del fichero
	
	$Custom=new cls_CustomDBControlAsistencia();
	$Custom->ResumenMensualDescuento($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad,$id_empleado,$fecha_ini,$fecha_fin,$tipo_contrato);
	
	//print_r ($Custom->salida); exit;
	
	$var1=$Custom->salida;
	return $var1;
	}

	//Tabla coloreada
	function FancyTable($data)
	{  
				
		
		
	    $this->SetLineWidth(.1);//grosor de la linea
		//Cabecera
	  	$this->SetFont('Arial','B',8);
		$w=array(80,25,30,20, 35);
			//Datos					
			$this->SetFont('Arial','',8);
			$i=1;	
			$this->SetDrawColor(103,113,157);
		    $this->SetFillColor(221,221,221);            	        
	        foreach($data as $row){
	        	$relleno=0;
	        	    if($i%2==0){
	        	    	$relleno=1;
	        	    }

	        	   
	        	    $this->Cell($w[0],5,$row[0],1,0,'L',$relleno);//desc_detalle
					$this->Cell($w[1],5,$row[1],1,0,'R',$relleno);//desc_ret_incor
					$this->Cell($w[2],5,$row[2],1,0,'C',$relleno);//desc_ret_incor
					$this->Cell($w[3],5,$row[3],1,0,'R',$relleno);//desc_ret_incor
				
					if($row[4]>0){
						$this->Cell($w[4],5,$row[4],1,0,'R',$relleno);//desc_ret_incor
					
					}else{
						$this->Cell($w[4],5,'',1,0,'R',$relleno);//desc_ret_incor
					}
					//$this->Cell($w[4],5,$row[4],1,0,'R',$relleno);//desc_ret_incor
					$this->Ln(5);
					$i=$i+1;
			}
					      
	}

}
function cambiarFormatoFecha($fecha,$band){ 
    if($band==0){
    list($mes,$dia,$anio)=explode("-",$fecha); 
    return $dia."/".$mes."/".$anio;	
    }
	 else{
	 	list($mes,$dia,$anio)=explode("/",$fecha); 
    return $dia."/".$mes."/".$anio;
	 }
}
$pdf=new PDF('P','mm','Letter');
$pdf->AliasNbPages();
//T�tulos de las columnas
		$fecha_ini=$fecha_ini;
		$fecha_fin=$fecha_fin;
		$id_empleado=$id_empleado;
		$tipo_contrato=$tipo_contrato;
$data=$pdf->LoadData($id_empleado,$fecha_ini,$fecha_fin,$tipo_contrato);
  	/*echo($fecha_inicio);
	exit();*/
$pdf->SetFont('Arial','',12);
$pdf->SetAutoPageBreak(1,35);
$pdf->SetTopMargin(15);
$pdf->SetRightMargin(10);
$pdf->SetLeftMargin(5);
$pdf->AddPage();
$pdf->FancyTable($data);
$pdf->Output();
?>