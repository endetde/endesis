<?php
require('../../../../lib/fpdf/fpdf.php');
require('../../../../lib/funciones.inc.php');
include_once("../../../../lib/configuracion.log.php");
include_once("../../LibModeloPresupuesto.php");

class PDF extends FPDF
{
	//Cargar los datos
	//Cabecera de p�gina

	function Header(){
	global $title;
	$this->SetLeftMargin(15);
	$funciones = new funciones();
	//Logo
	$this->Image('../../../../lib/images/logo_reporte.jpg',165,5,36,12);
	//Arial bold 15
	$this->SetLineWidth(.1);
	$this->SetFont('Arial','B',10);
	//Movernos a la derecha
	$this->Cell(200,10,'DIRECCI�N GENERAL DE ASUNTOS ADMINISTRATIVOS',0,0,'C');
	$this->Ln(5);
	$this->Cell(200,10,'MEMORIAS DE C�LCULO',0,0,'C');
	$this->Ln(5);
	$this->Cell(200,10,'ANTEPROYECTO PRESUPUESTO GESTI�N '.$_SESSION['rep_mem_cal_gestion_pres'],0,0,'C');
	$this->Ln(5);
	$this->Cell(200,10,'COSTOS ESTIMADOS POR PARTIDA DE GASTO',0,0,'C');
	$this->Ln(5);
	$this->Cell(200,10,'PARTIDA '.$_SESSION['rep_mem_cal_codigo_partida'].' "'.$_SESSION['rep_mem_cal_nombre_partida'].'"',0,0,'C');
	$this->Ln(10);
	$this->SetFont('Arial','B',7);
	$this->Cell(22,4,'REGIONAL','LTR',0,'L');
	$this->Cell(78,4,$_SESSION['rep_mem_cal_regional'],'TR',0,'L');
	$this->Cell(25,4,'',0,0,'L');
	$this->Cell(45,4,'',0,0,'L');
	$this->Ln(4);
	$this->Cell(22,4,'ORG. FINANC.','LTR',0,'L');
	$this->Cell(78,4,$_SESSION['rep_mem_cal_financiador'],'TR',0,'L');
	$this->Cell(25,4,'',0,0,'L');
	$this->Cell(45,4,'',0,0,'L');
	$this->Ln(4);
	$this->Cell(22,4,'PROGRAMA','LTR',0,'L');
	$this->Cell(78,4,$_SESSION['rep_mem_cal_programa'],'TR',0,'L');
	$this->Cell(45,4,'',0,0,'L');
	$this->Cell(45,4,$_SESSION['rep_mem_cal_cod_formulario_gasto'],'LTRB',0,'C');
	$this->Ln(4);
	$this->Cell(22,4,'SUBPROGRAMA','LTR',0,'L');
	$this->Cell(78,4,$_SESSION['rep_mem_cal_proyecto'],'TR',0,'L');
	$this->Cell(25,4,'',0,0,'L');
	$this->Cell(45,4,'',0,0,'L');
	$this->Ln(4);
	$this->Cell(22,4,'ACTIVIDAD','LTR',0,'L');
	$this->Cell(78,4,$_SESSION['rep_mem_cal_actividad'],'TR',0,'L');
	$this->Cell(25,4,'',0,0,'L');
	$this->Cell(45,4,'',0,0,'L');
	$this->Ln(4);
	$this->Cell(22,4,'FUENTE','LTR',0,'L');
	$this->Cell(78,4,$_SESSION['rep_mem_cal_fuente'],'TR',0,'L');
	$this->Cell(45,4,'',0,0,'L');
	$this->Cell(45,4,'GESTI�N:     '.$_SESSION['rep_mem_cal_gestion_pres'],'LTR',0,'L');
	$this->Ln(4);     
	$this->Cell(22,4,'UNIDAD ORG.','LTRB',0,'L');
	$this->Cell(78,4,$_SESSION['rep_mem_cal_unidad_organizacional'],'TRB',0,'L');
	$this->Cell(45,4,'',0,0,'L');
	$this->Cell(45,4,'FECHA ELAB.: '.$_SESSION['rep_mem_cal_fecha_elaboracion'],'LRB',0,'L');
	$this->Ln(8);
	
	$this->SetFont('Arial','B',6);
	$this->Cell(10,4,'','LTR',0,'L');
	$this->Cell(60,4,'','TR',0,'L');
	$this->Cell(20,4,'','TR',0,'L');
	$this->Cell(20,4,'','TR',0,'L');
	$this->Cell(20,4,'','TR',0,'L');
	$this->Cell(60,4,'','TR',0,'L');
	$this->Ln(4);	
	$this->Cell(10,4,'Nro.','LR',0,'C');
	$this->Cell(60,4,'DESCRIPCI�N','R',0,'C');
	$this->Cell(20,4,'CANTIDAD','R',0,'C');
	$this->Cell(20,4,'COSTO UNITARIO','R',0,'C');
	$this->Cell(20,4,'COSTO TOTAL','R',0,'C');
	$this->Cell(60,4,'JUSTIFICACI�N','R',0,'C');	
	$this->Ln(4);
	$this->SetFont('Arial','B',4);
	$this->Cell(10,4,'','LR',0,'L');
	$this->Cell(60,4,'','R',0,'L');
	$this->Cell(20,4,'','R',0,'C');
	$this->Cell(20,4,'('.$_SESSION['rep_mem_cal_simbolo'].')','R',0,'C');
	$this->Cell(20,4,'('.$_SESSION['rep_mem_cal_simbolo'].')','R',0,'C');
	$this->Cell(60,4,'','R',0,'L');
	$this->Ln(4);
	$this->Cell(10,4,'','LTR',0,'L');
	$this->Cell(60,4,'','TR',0,'L');
	$this->Cell(20,4,'','TR',0,'L');
	$this->Cell(20,4,'','TR',0,'L');
	$this->Cell(20,4,'','TR',0,'L');
	$this->Cell(60,4,'','TR',0,'L');
	
	$this->Ln(3);
	}
	//Pie de p�gina
	function Footer(){
		//$this->SetY(-35);
		//Arial italic 8
		$this->SetFont('Arial','',7);
		//fecha
		$fecha=date("d-m-Y");
		//hora
		$hora=date("H:i:s");
		$this->ln(0);
		$this->Cell(190,5,'','LRT',0,'C');
		$this->ln(4);
		$this->Cell(133,4,'','L',0,'C');
		$this->Cell(57,4,'FIRMA Y SELLO','R',0,'C');
		$this->ln(4);
		$this->Cell(133,3,'','LTR',0,'L');
		$this->Cell(57,3,'','LTR',0,'C');
		$this->ln(3);
		$this->Cell(20,5,'Elaborado Por: ','L',0,'L');
		$this->Cell(111,5,'','B',0,'L');
		$this->Cell(2,5,'','R',0,'L');
		$this->Cell(2,5,'','L',0,'L');
		$this->Cell(53,5,'','B',0,'L');
		$this->Cell(2,5,'','R',0,'L');
		$this->ln(5);
		$this->Cell(20,5,'Aprobado Por: ','L',0,'L');
		$this->Cell(111,5,'','B',0,'L');
		$this->Cell(2,5,'','R',0,'L');
		$this->Cell(2,5,'','L',0,'L');
		$this->Cell(53,5,'','B',0,'L');
		$this->Cell(2,5,'','R',0,'L');
		$this->ln(5);
		$this->Cell(133,3,'','LBR',0,'L');
		$this->Cell(57,3,'','LBR',0,'C');
		$this->ln(5);
		$this->SetFont('Arial','',6);
		$this->Cell(70,3,'Usuario: '.$_SESSION["ss_nombre_usuario"],0,0,'L');
		$this->Cell(50,3,'P�gina '.$this->PageNo().' de {nb}',0,0,'C');
		$this->Cell(52,3,'',0,0,'L');
		$this->Cell(18,3,'Fecha: '.$fecha,0,0,'L');
		$this->ln(3);
		$this->Cell(70,3,'Sistema: ENDESIS - PRESTO',0,0,'L');
		$this->Cell(50,3,'',0,0,'C');
		$this->Cell(52,3,'',0,0,'L');
		$this->Cell(18,3,'Hora: '.$hora,0,0,'L');		
	}
	function LoadData($id_partida_presupuesto,$id_presupuesto,$tipo_memoria,$id_partida,$id_moneda){
		$cant=1000;
	    $puntero=0;
	    $sortcol='CINGAS.desc_ingas_item_serv';
	    $sortdir='asc';
	    $criterio_filtro='PARPRE.id_partida_presupuesto='.$id_partida_presupuesto.' AND PRESUP.id_presupuesto='.$id_presupuesto.' AND MEMCAL.tipo_detalle='.$tipo_memoria.' AND MONEDA.id_moneda='.$id_moneda;
	    //Leer las l�neas del fichero
	    $Custom = new cls_CustomDBPresupuesto();
		$Custom->ListarRepGralMemoriaInversion($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);		
	    $data=$Custom->salida;
	    return $data;
	}
	//Tabla coloreada
	function FancyTable($data,$id_partida_presupuesto,$id_presupuesto,$tipo_memoria,$id_partida,$id_moneda){
		//Colores, ancho de l�nea y fuente en negrita	
		$this->SetLineWidth(.1);
		//obtener el total de registros
		$criterio_filtro='PARPRE.id_partida_presupuesto='.$id_partida_presupuesto.' AND MEMCAL.tipo_detalle='.$tipo_memoria.' AND MONEDA.id_moneda='.$id_moneda;
		$criterio_suma='PARPRE.id_partida_presupuesto='.$id_partida_presupuesto.' AND PRESUP.id_presupuesto='.$id_presupuesto.' AND MEMCAL.tipo_detalle='.$tipo_memoria.' AND MONEDA.id_moneda='.$id_moneda;
	    //Leer las l�neas del fichero
	    $CustomC= new cls_CustomDBPresupuesto();
		$CustomC->ContarRepGralMemoriaInversion(15,0,'','',$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);		
	    $cantidad=$CustomC->salida;
	    $CustomS= new cls_CustomDBPresupuesto();
		$CustomS->SumaCostoMemoriaInversion(15,0,'','',$criterio_suma,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);		
		$suma_total=$CustomS->salida;
	  	//Cabecera
		$w=array(10,60,20);
			//Restauraci�n de colores y fuentes
			/*$this->SetFillColor(224,235,255);
			$this->SetTextColor(0);*/
			$this->SetFont('Arial','',7);
			$numero_paginas=ceil($cantidad/36);
			if($numero_paginas==0){
				$numero_paginas=1;
			}
			$cantidad_estimada=$numero_paginas*36;
			$restante=$cantidad_estimada-$cantidad;
			//Datos			    
				$numero=1;
		       foreach($data as $row){       
					$this->Cell($w[0],4,$numero.'.-','LR',0,'C');
					$this->Cell($w[1],4,$row[0],'R',0,'L');
					$this->Cell($w[2],4,number_format($row[1],2,'.',','),'R',0,'R');
					$this->Cell($w[2],4,number_format($row[2],2,'.',','),'R',0,'R');
					$this->Cell($w[2],4,number_format($row[3],2,'.',','),'R',0,'R');
					$this->Cell($w[1],4,$row[4],'R',0,'L');
					$this->Ln(4);
					$numero=$numero+1;
			    }
			   for($i=1;$i<=$restante;$i++){
			     	$this->Cell($w[0],4,'','LR',0,'L');
					$this->Cell($w[1],4,'','R',0,'L');
					$this->Cell($w[2],4,'','R',0,'C');
					$this->Cell($w[2],4,'','R',0,'C');
					$this->Cell($w[2],4,'','R',0,'C');
					$this->Cell($w[1],4,'','R',0,'C');
					$this->Ln(4);
					$numero=$numero+1;
			   }
			   $this->Cell($w[0],4,'','LT',0,'L');
			   $this->Cell($w[1],4,'TOTAL PRESUPUESTO ANUAL ','T',0,'L');
			   $this->Cell($w[2],4,'','T',0,'L');
			   $this->Cell($w[2],4,'','TR',0,'L');
			   $this->Cell(20,4,number_format($suma_total, 2, '.', ','),'LTRB',0,'R'); 	
			   $this->Cell(60,4,'','TR',0,'L');					   
			   $this->Ln(4);
			   //$this->Cell(190,4,'','LR',0,'L');   			
		}
}
$pdf=new PDF('P','mm','Letter');
$pdf->AliasNbPages();
//Carga de datos
$data=$pdf->LoadData($id_partida_presupuesto,$id_presupuesto,$tipo_memoria,$id_partida,$id_moneda);
$pdf->SetFont('Arial','',14);
$pdf->SetAutoPageBreak(1,35);
$pdf->SetTopMargin(13);
$pdf->SetRightMargin(10);
$pdf->SetLeftMargin(15);
$pdf->AddPage();
$pdf->FancyTable($data,$id_partida_presupuesto,$id_presupuesto,$tipo_memoria,$id_partida,$id_moneda);
$pdf->Output();
?>