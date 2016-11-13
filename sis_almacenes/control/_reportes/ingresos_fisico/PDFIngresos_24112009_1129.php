<?php
require('../../../../lib/fpdf/fpdf.php');
require('../../../../lib/funciones.inc.php');
include_once("../../../../lib/configuracion.log.php");
include_once("../../rcm_LibModeloAlmacenes.php");

class PDF extends FPDF
{
	//Cargar los datos
	//Cabecera de p�gina
	var $fil=10;//contador de las filas para controlar el corte de p�ginas (saltos de p�ginas)
	var $inicio_pag=false;//para definir si se requiere l�nea superior en los datos impresos
	
	var $sep_decim='.';
	var $sep_mil=',';


	function Header()
	{
		global $title;
		$data1=$this->LoadData();

				
		$imprimir_footer=1;
		$this->SetLeftMargin(15);
		$funciones = new funciones();
		$fecha=date("d-m-Y");
		//Logo
		$this->Image('../../../../lib/images/logo_reporte.jpg',173,2,36,13);
		//Arial bold 15
		$this->SetFont('Arial','B',16);
		$this->SetY(20);
		//Movernos a la derecha
		$this->Cell(185,13,'FORM. DE INGRESO DE MATERIALES',0,0,'C');
		//$this->Cell(185,13,'FORM. DE DEVOLUCI�N DE MATERIALES',0,0,'C');
		$this->Ln(5);
		$this->SetFont('Arial','B',12);
		$this->Cell(185,13,$data1[0]['nombre_almacen'],0,0,'C');
		$this->SetY(18);
		$this->SetX(168);
		$this->Cell(60,13,'Nro.: ' .$data1[0][1],0,0,'L');
		$this->Ln(5);
		$this->SetX(168);
		//$this->Cell(60,13,'Fecha: '.$data1[0]['fecha_reg'],0,0,'L');
		$this->Cell(60,13,'Fecha: '.$data1[0]['fecha_finalizado_cancelado'],0,0,'L');
		$this->Ln(5);
		$this->SetX(168);
		$this->Cell(60,13,'P�gina: '.$this->PageNo(),0,0,'L');
		$this->Ln(10);
		
		
		
	}

	//Pie de p�gina
	function Footer()
	{
		//Posici�n: a 1,5 cm del final
		$this->SetY(-40);
		//Arial italic 8
		$this->SetFont('Arial','',8);
		//ip
		$ip = captura_ip();

		$data1=$this->LoadData();
		

		//$this->SetX(0);
		$this->Cell(64,6,'','LRT',0,'C',$fill);
		$this->Cell(64,6,'','LRT',0,'C',$fill);
		$this->Cell(64,6,'','LRT',0,'C',$fill);
		$this->Ln(6);
		$this->Cell(64,6,'','LR',0,'C',$fill);
		$this->Cell(64,6,'','LR',0,'C',$fill);
		$this->Cell(64,6,'','LR',0,'C',$fill);
		$this->Ln(6);
		$this->Cell(64,6,$data1[0]['almacenero'],'LRB',0,'C',$fill);
		//$this->Cell(64,6,$data1[0]['jefe_almacen'],'LRB',0,'C',$fill);
		$this->Cell(64,6,'','LRB',0,'C',$fill);
		$this->Cell(64,6,$data1[0]['jefe_almacen'],'LRB',0,'C',$fill);
		//$this->Cell(64,6,'WILDO PAREDES','LRB',0,'C',$fill);
		$this->Ln(6);
		
		$this->Cell(64,5,'C.I.:  '.$data1[0]['doc_almacenero'],'LR',0,'C',$fill);
		$this->Cell(64,5,'','LR',0,'C',$fill);
		$this->Cell(64,5,'C.I.:  '.$data1[0]['doc_jefe_almacen'],'LR',0,'C',$fill);
		//$this->Cell(64,5,'C.I.:              ','LR',0,'C',$fill);
		$this->Ln(5);
		

		$this->Cell(64,6,'Encargado de Almac�n','LRB',0,'C',$fill);
		//$this->Cell(64,6,'Jefe de Almacenes','LRB',0,'C',$fill);
		$this->Cell(64,6,'','LRB',0,'C',$fill);
		$this->Cell(64,6,'Jefe de Almacenes','LRB',0,'C',$fill);
		//$this->Cell(64,6,'Contratista','LRB',0,'C',$fill);
		$this->Ln(6);

		
		//$this->SetFont('Arial','',6);

		//N�mero de p�gina
		/*$fecha=date("d-m-Y");
		//hora
		$hora=date("H:i:s");
		$this->Cell(60,10,'Usuario: '.$_SESSION["ss_nombre_usuario"] ,0,0,'L');
		$this->Cell(100,10,'P�gina '.$this->PageNo().' de {nb}',0,0,'C');
		$this->Cell(100,10,'Fecha: '.$fecha ,0,0,'L');
		$this->ln(3);
		$this->Cell(60,10,'',0,0,'L');
		$this->Cell(100,10,'',0,0,'C');
		$this->Cell(100,10,'Hora: '.$hora ,0,0,'L');*/
		//fecha
	}
	function LoadData()
	{
		$cant=100000;
		$puntero=0;
		$sortcol='TIPOUC.nombre';
		$sortdir='asc';
		$criterio_filtro=' INGRES.id_ingreso = '.$_SESSION["rep_ing_id_ingreso"];
		/*echo "query: ".$criterio_filtro;
		exit;*/
		//Leer las l�neas del fichero
		$Custom=new cls_CustomDBAlmacenes();
		$Custom->NotaIngreso($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$hidden_ep_id_financiador,$hidden_ep_id_regional,$hidden_ep_id_programa,$hidden_ep_id_proyecto,$hidden_ep_id_actividad);

		$resp=$Custom->salida;

		return $resp;
	}

	function Maestro($data)
	{
		$this->AddPage();
		$this->SetFont('Arial','',10);
		$this->Cell(120,10,'Origen Ingreso:   '.$data[0]['origen'],0,0,'L');//,'LR',0,'C');
		//$this->Cell(120,10,'Contratista:   '.$data[0][5],0,0,'L');//,'LR',0,'C');
		$this->Ln(5);
		$this->Cell(120,10,'Concepto:   '.$data[0]['descripcion'],0,0,'L');//,'LR',0,'C');
		$this->Ln(5);
		$this->Cell(120,10,'Entregado por:   '.$data[0]['responsable'],0,0,'L');//,'LR',0,'C');
		$this->Ln(5);
		$this->Cell(120,10,'Nro. Remisi�n:   '.$data[0]['num_factura'],0,0,'L');//,'LR',0,'C');
		//$this->Ln(5);
		$this->SetX(130);
		$this->Cell(120,10,'Fecha Remisi�n:   '.$data[0]['fecha_factura'],0,0,'L');//,'LR',0,'C');
		$this->Ln(5);
		$this->Cell(120,10,'Fecha de Ingreso Almac�n:   '.$data[0]['fecha_finalizado_cancelado'],0,0,'L');//,'LR',0,'C');
		$this->Ln(10);
	}

	//Tabla coloreada
	function FancyTable($data,$header,$header_det)
	{
		//Contador
		$cont=1;
               
		$this->SetFont('Arial','',7);
		$this->SetFillColor(255,255,255);
		$this->SetTextColor(0);
		$this->SetDrawColor(190,190,190);
		$this->SetLineWidth(.2);
		$this->SetFont('','',8);
		//Cabecera
		//$w=array(6,30,13,10,11,84,20,18);
		$w=array(6,32,13,10,11,98,22);
		//$w=array(25,20,20,40,60,30);
		//('C�digo','Cantidad','Unidad','Calidad','Descripci�n del Material','Peso Neto (kg)');
		$wi=array(35,60,60,30);
		$wdet=array(6,20,45,80,20,20);
		$rama=array();
		$rama_nombre=array();
		$fecha=date("d-m-Y");

		//print ('<pre>');
		//print_r($header);
		//print ('</pre>');
		//$this->SetY(30);

		//Imprime los r�tulos de las columnasis
		$this->SetFont('Arial','B',7);
		for($i=0;$i<count($header);$i++)
		$this->Cell($w[$i],5,$header[$i],1,0,'C',1);
		$this->Ln();


		$cant=100000;
		$puntero=0;
		//$sortcol='ITEM.id_supergrupo asc, ITEM.nombre asc';
		$sortcol='ITEM.nombre desc';
		$sortdir='asc';
		$criterio_filtro=' INGDET.id_ingreso = '.$_SESSION["rep_ing_id_ingreso"];
		/*echo "query: ".$criterio_filtro;
		exit;*/
		//Leer las l�neas del fichero
		$Custom=new cls_CustomDBAlmacenes();
		$Custom->ListarIngresoDetalleReporte($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$hidden_ep_id_financiador,$hidden_ep_id_regional,$hidden_ep_id_programa,$hidden_ep_id_proyecto,$hidden_ep_id_actividad);

		$resp=$Custom->salida;

		$this->SetFont('Arial','',6);
		//Se imprime los datos del reporte
		$cant_total=0;
		$peso_total=0;
		$tot=count($resp);

		foreach($resp as $row)
		{
			//Verifica si es el �ltimo registro para dibujar la l�nea inferior
			/*if($cont==$tot){
				//Por ser �ltimo registro, se pone como 51 la variable fil para que dibuje la l�nea inferior
				$this->fil=51;
			}

			//Verifica si es la �ltima l�nea de la p�gina
			if($this->fil>50){
				//Imprime la l�nea inferior
				$this->Cell($w[0],3.5,$cont,'LBR',0,'C',$fill);//LTRB
				$this->Cell($w[1],3.5,$row[0],'LBR',0,'L',$fill);
				$this->Cell($w[2],3.5,$row[3],'LBR',0,'R',$fill);
				$this->Cell($w[3],3.5,$row[5],'LBR',0,'C',$fill);
				$this->Cell($w[4],3.5,$row[7],'LBR',0,'C',$fill);
				$this->Cell($w[5],3.5,$row[8],'LBR',0,'L',$fill);
				$this->Cell($w[6],3.5,$row[4],'LBR',0,'R',$fill);
				$this->Cell($w[7],3.5,$row[9],'LBR',1,'R',$fill);
				//Inicializa el contador de filas
				$this->fil=1;
				//Notifica que es una p�gina nueva
				$this->inicio_pag=true;
			}
			else {
				if($this->inicio_pag){
					//Por ser inicio de p�gina imprime los r�tulos de las columnas
					$this->SetFont('','',8);
					for($i=0;$i<count($header);$i++)
					$this->Cell($w[$i],5,$header[$i],1,0,'C',1);
					$this->Ln();
					$this->inicio_pag=false;
					$this->SetFont('','',6);
				}*/
				//Imprime los datos solo con l�neas de la izquierda y derecha
				$this->Cell($w[0],3.5,$cont,'LTBR',0,'C',$fill);
				$this->Cell($w[1],3.5,$row['nombre'],'LTBR',0,'L',$fill);
				//$this->Cell($w[2],3.5,$row[3],'LTBR',0,'R',$fill);
				$this->Cell($w[2],3.5,number_format($row['cantidad'],2,$this->sep_decim,$this->sep_mil),'LTBR',0,'R',$fill);
				$this->Cell($w[3],3.5,$row['unidad_med'],'LTBR',0,'C',$fill);
				$this->Cell($w[4],3.5,$row['calidad'],'LTBR',0,'C',$fill);
				$this->Cell($w[5],3.5,$row['nueva_desc'],'LTBR',0,'L',$fill);
				//$this->Cell($w[6],3.5,$row[4],'LTBR',1,'R',$fill);
				$this->Cell($w[6],3.5,number_format($row['peso_neto'],5,$this->sep_decim,$this->sep_mil),'LTBR',1,'R',$fill);
				//$this->Cell($w[7],3.5,$row[9],'LTBR',1,'R',$fill);
			//}
			//Actualiza los datos auxiliares
			$cant_total+=$row['cantidad'];
			$peso_total+=$row['peso_neto'];
			$cont=$cont+1;
			$this->fill++;
		}

		//Imprime el total de las cantidades
		$this->SetFont('Arial','B',7);
		$this->Cell($w[0],3.5,'','LB',0,'C',$fill);
		$this->Cell($w[1],3.5,'TOTALES ','B',0,'L',$fill);
		$this->Cell($w[2],3.5,number_format($cant_total,2,$this->sep_decim,$this->sep_mil),'B',0,'R',$fill);
		$this->Cell($w[3],3.5,'','B',0,'R',$fill);
		$this->Cell($w[4],3.5,'','B',0,'R',$fill);
		$this->Cell($w[5],3.5,'','B',0,'R',$fill);
		$this->Cell($w[6],3.5,number_format($peso_total,5,$this->sep_decim,$this->sep_mil),'BR',1,'R',$fill);
		
		
		//Imprime las observaciones si es que hubieran
		$this->SetFont('Arial','',6);
		$this->Cell(192,3.5,'Observaciones:','LR',1,'L',$fill);
		$this->MultiCell(192,3.5,$data[0]['observaciones'],'LBR',1,'L',$fill);

		// Se imprime el detalle de cada UC solicitada
		


	}

	/*function AcceptPageBreak()
	{
	if($this->col>41)
	{

	}
	}*/

}

$pdf=new PDF('P','mm','Letter');
$pdf->AliasNbPages();
//T�tulos de las columnas
$header=array('Nro.','C�digo','Cantidad','Unidad','Calidad','Descripci�n del Material','Peso Neto (kg)');//,'Total Importe');
//$header=array('C�digo','Cantidad','Unidad','Nombre','Descripci�n','Peso Neto (kg)');
$header_det=array('Nro.','C�digo','Material','Descripci�n','Cant.x Comp.','Cant.Entregada');

//Carga de datos
$tipo=$tipo;
//$data=$pdf->LoadData();
//echo json_encode($tipo_torre);
$pdf->SetFont('Arial','',10);
$pdf->SetAutoPageBreak(1,48);
$pdf->SetTopMargin(15);
$pdf->SetRightMargin(15);
$pdf->SetLeftMargin(15);
$data=$pdf->LoadData();

//$pdf->AddPage();
$pdf->Maestro($data);
$pdf->FancyTable($data,$header,$header_det);
//$pdf->AddPage();
//$pdf->Maestro($data,'Copia Almac�n');
//$pdf->FancyTable($data,$header,$header_det);
//$pdf->AddPage();
//$pdf->Maestro($data,'Copia Interesado');
//$pdf->FancyTable($data,$header,$header_det);
//$pdf->AddPage();
//$pdf->Maestro($data,'Copia Supervisor');
//$pdf->FancyTable($data,$header,$header_det);
$pdf->Output();
?>