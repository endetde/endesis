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


	function Header()
	{
		global $title;
		$data1=$this->LoadData();

		$imprimir_footer=1;
		$this->SetLeftMargin(15);
		$funciones = new funciones();
		$fecha=date("d-m-Y");
		//Logo
		$this->Image('../../../../lib/images/logo_reporte.jpg',150,2);
		//Arial bold 15
		$this->SetFont('Arial','B',16);
		$this->SetY(20);
		//Movernos a la derecha
		$this->Cell(185,13,'VALE DE INGRESO A ALMAC�N',0,0,'C');
		$this->Ln(5);
		$this->SetFont('Arial','B',12);
		$this->Cell(185,13,$data1[0][0],0,0,'C');
		$this->SetY(18);
		$this->SetX(168);
		$this->Cell(60,13,'C�digo: ' .$data1[0][1],0,0,'L');
		$this->Ln(5);
		$this->SetX(168);
		$this->Cell(60,13,'Fecha: '.$data1[0][10],0,0,'L');
		$this->Ln(5);
		$this->SetX(168);
		$this->Cell(60,13,'P�gina: '.$this->PageNo(),0,0,'L');
		$this->Ln(15);
	}

	//Pie de p�gina
	function Footer()
	{
		//Posici�n: a 1,5 cm del final
		$this->SetY(-50);
		//Arial italic 8
		$this->SetFont('Arial','',8);
		//ip
		$ip = captura_ip();

		$data1=$this->LoadData();
		//$this->Cell(25,6,' ','',0,'C',$fill);
		//$this->Cell(47,6,'Entregu� conforme','LTR',0,'C',$fill);
		//$this->Cell(47,6,'Recib� conforme','LTR',0,'C',$fill);
		/*$this->Cell(47,6,'','',1,'C',$fill);
		$this->Cell(47,6,'','',0,'C',$fill);
		$this->Cell(47,6,'','LTR',0,'C',$fill);
		$this->Cell(47,6,'','LTR',0,'C',$fill);
		$this->Cell(47,6,'','',1,'C',$fill);

		$this->Cell(47,6,'','',0,'C',$fill);
		$this->Cell(47,6,'....................................','LR',0,'C',$fill);
		$this->Cell(47,6,'....................................','LR',0,'C',$fill);
		$this->Cell(47,6,'','',0,'C',$fill);
		$this->Ln(3);*/

		//$this->SetX(0);
		$this->Cell(60,6,'','LRT',0,'C',$fill);
		$this->Cell(60,6,'','LRT',0,'C',$fill);
		$this->Cell(72,6,'','LRT',0,'C',$fill);
		$this->Ln(6);
		$this->Cell(60,6,'','LR',0,'C',$fill);
		$this->Cell(60,6,'','LR',0,'C',$fill);
		$this->Cell(72,6,'','LR',0,'C',$fill);
		$this->Ln(6);
		$this->Cell(60,6,$data1[0][8],'LRB',0,'C',$fill);
		$this->Cell(60,6,$data1[0][9],'LRB',0,'C',$fill);
		$this->Cell(72,6,'','LRB',0,'C',$fill);
		$this->Ln(6);

		$this->Cell(60,6,'Encargado de Almac�n','LRB',0,'C',$fill);
		$this->Cell(60,6,'Jefe de Almacenes','LRB',0,'C',$fill);
		$this->Cell(72,6,'','LRB',0,'C',$fill);
		$this->Ln(6);

		/*$this->Cell(47,6,'','',0,'',$fill);
		$this->Cell(47,6,'Aclaraci�n:','',0,'L',$fill);
		$this->Cell(47,6,'Aclaraci�n:','',0,'L',$fill);
		$this->Cell(47,6,'','',0,'',$fill);
		$this->Ln(3);

		$this->Cell(47,6,'','',0,'',$fill);
		$this->Cell(47,6,'CI:','',0,'L',$fill);
		$this->Cell(47,6,'CI:','',0,'L',$fill);
		$this->Cell(47,6,':','',0,'',$fill);
		$this->Ln(3);

		$this->Cell(47,6,'','',0,'',$fill);
		$this->Cell(47,6,'Fecha:','',0,'L',$fill);
		$this->Cell(47,6,'Fecha:','',0,'L',$fill);
		$this->Cell(47,6,'','',1,'',$fill);*/

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
		$cant=1000;
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
		$this->Cell(120,10,'Proveedor:   '.$data[0][5],0,0,'L');//,'LR',0,'C');
		$this->Ln(5);
		$this->Cell(120,10,'Concepto:   '.$data[0][6],0,0,'L');//,'LR',0,'C');
		$this->Ln(5);
		$this->Cell(120,10,'Enregado por:   '.$data[0][7],0,0,'L');//,'LR',0,'C');
		$this->Ln(5);
		$this->Cell(120,10,'Nro. Remisi�n:   '.$data[0][2],0,0,'L');//,'LR',0,'C');
		//$this->Ln(5);
		$this->SetX(130);
		$this->Cell(120,10,'Fecha Remisi�n:   '.$data[0][3],0,0,'L');//,'LR',0,'C');
		$this->Ln(5);
		$this->Cell(120,10,'Fecha de Ingreso Almac�n:   '.$data[0][4],0,0,'L');//,'LR',0,'C');
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
		$this->SetDrawColor(0,33,91);
		$this->SetLineWidth(.3);
		$this->SetFont('','',8);
		//Cabecera
		$w=array(6,30,13,10,11,84,20,18);
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
		for($i=0;$i<count($header);$i++)
		$this->Cell($w[$i],5,$header[$i],1,0,'C',1);
		$this->Ln();


		$cant=1000;
		$puntero=0;
		$sortcol='ITEM.id_supergrupo asc, ITEM.nombre asc';
		$sortdir='asc';
		$criterio_filtro=' INGDET.id_ingreso = '.$_SESSION["rep_ing_id_ingreso"];
		/*echo "query: ".$criterio_filtro;
		exit;*/
		//Leer las l�neas del fichero
		$Custom=new cls_CustomDBAlmacenes();
		$Custom->ListarIngresoDetalleReporte($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$hidden_ep_id_financiador,$hidden_ep_id_regional,$hidden_ep_id_programa,$hidden_ep_id_proyecto,$hidden_ep_id_actividad);

		$resp=$Custom->salida;

		$this->SetFont('','',6);
		//Se imprime los datos del reporte
		$cant_total=0;
		$tot=count($resp);

		foreach($resp as $row)
		{
			//Verifica si es el �ltimo registro para dibujar la l�nea inferior
			if($cont==$tot){
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
				}
				//Imprime los datos solo con l�neas de la izquierda y derecha
				$this->Cell($w[0],3.5,$cont,'LR',0,'C',$fill);
				$this->Cell($w[1],3.5,$row[0],'LR',0,'L',$fill);
				$this->Cell($w[2],3.5,$row[3],'LR',0,'R',$fill);
				$this->Cell($w[3],3.5,$row[5],'LR',0,'C',$fill);
				$this->Cell($w[4],3.5,$row[7],'LR',0,'C',$fill);
				$this->Cell($w[5],3.5,$row[8],'LR',0,'L',$fill);
				$this->Cell($w[6],3.5,$row[4],'LR',0,'R',$fill);
				$this->Cell($w[7],3.5,$row[9],'LR',1,'R',$fill);
			}
			//Actualiza los datos auxiliares
			$cant_total+=$row[3];
			$cont=$cont+1;
			$this->fil++;
		}

		//Imprime el total de las cantidades
		$this->Cell($w[0],3.5,'','LB',0,'C',$fill);
		$this->Cell($w[1],3.5,'Cantidad Total: ','B',0,'R',$fill);
		$this->Cell($w[2],3.5,$cant_total,'B',0,'R',$fill);
		$this->Cell(143,3.5,'','BR',1,'R',$fill);
		
		//Imprime las observaciones si es que hubieran
		$this->Cell(192,3.5,'Observaciones:','LR',1,'L',$fill);
		$this->Cell(192,3.5,$data[0][11],'LBR',1,'L',$fill);

		// Se imprime el detalle de cada UC solicitada
		/*foreach($data as $row)
		{
		$imprimir_footer=0;
		//Obtiene el detalle
		$cont=1;
		$cant=100;
		$puntero=0;
		$sortcol='OSUCDE.id_tipo_unidad_constructiva';
		$sortdir='asc';
		$criterio_filtro=' OSUCDE.id_salida = '.$_SESSION["rep_mat_id_salida"].' AND OSUCDE.id_tipo_unidad_constructiva = '.$row[6];
		$Det=new cls_CustomDBAlmacenes();
		$Det->PedidoMaterialesUCDet($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$detalle=$Det->salida;
		$this->AddPage();

		//Imprime el t�tulo del detalle
		$this->SetFont('Arial','B',12);
		$this->Cell(185,13,'SALIDA DE MATERIALES',0,0,'C');
		$this->Ln(6);
		$this->Cell(185,10,$data[0][0],0,0,'C');//,'LR',0,'C');
		$this->Ln(6);
		$this->SetFont('Arial','',10);

		$this->Cell(120,10,'Solicitante: '.$data[0][7],0,0,'L');//,'LR',0,'C');
		$this->Ln(4);
		$this->Cell(120,10,'Receptor autorizado: '.$data[0][1],0,0,'L');//,'LR',0,'C');
		$this->Cell(140,10,'Fecha: '.$data[0][2],0,0,'L');//,'LR',0,'C');
		$this->Ln(4);
		$this->Cell(120,10,'Unidad Constructiva:    '.$detalle[0][8],0,0,'L');//,'LR',0,'C');
		$this->Ln(4);
		$this->Cell(120,10,'Componente:    '.$detalle[0][1],0,0,'L');//,'LR',0,'C');
		$this->Ln(4);
		$this->Cell(120,10,'Cantidad:    '.round($detalle[0][2] * 100)/100,0,1,'L');//,'LR',0,'C'); round(valor_float * 100) / 100

		//Imprime los r�tulos del detalle
		$this->SetFont('Arial','',8);
		for($i=0;$i<count($header_det);$i++)
		$this->Cell($wdet[$i],7,$header_det[$i],1,0,'C',1);
		$this->Ln();

		$this->SetFont('Arial','',7);
		foreach($detalle as $row)
		{
		$this->Cell($wdet[0],4,$cont,'LTRB',0,'C',$fill);
		$this->Cell($wdet[1],4,$row[3],'LTRB',0,'L',$fill);
		$this->Cell($wdet[2],4,$row[4],'LTRB',0,'L',$fill);
		$this->Cell($wdet[3],4,$row[5],'LTRB',0,'L',$fill);
		$this->Cell($wdet[4],4,round($row[6]*100)/100,'LTRB',0,'R',$fill);
		$this->Cell($wdet[5],4,round($row[7]*100)/100,'LTRB',1,'R',$fill);
		$cont=$cont+1;
		}


		}*/


		/*if($tipo=="raiz"){
		for($i=0;$i<count($header);$i++)
		$this->Cell($w[$i],7,$header[$i],1,0,'C',1);
		$this->Ln();
		//Restauraci�n de colores y fuentes
		$this->SetFillColor(224,235,255);
		$this->SetTextColor(0);
		$this->SetFont('Arial','',8);
		//Datos
		$fill=0;
		//$CustomCantidad= new rcm_cls_CustomDBAlmacenes();

		foreach($data as $row)
		{
		if($row["tipo"]=="item"){

		$this->Cell($w[0],6,$row[3],'LTRB',0,'L',$fill);
		$this->Cell($w[1],6,$row[4],'LTRB',0,'L',$fill);
		$this->Cell($w[2],6,$fecha,'LTRB',0,'L',$fill);
		}
		else{

		$this->Cell($w[0],6,$row[1],'LTRB',0,'L',$fill);
		$this->Cell($w[1],6,$row[2],'LTRB',0,'L',$fill);
		$this->Cell($w[2],6,$fecha,'LTRB',0,'L',$fill);
		$rama[]=$row["id_tipo_unidad_constructiva"];
		$rama_nombre[]=$row["nombre"];
		$composicion=$row["id_composicion_tuc"];
		$filtro="TUCREEM.id_composicion_tuc=$composicion";
		$sort="TIPOUC.codigo";
		$dir="ASC";
		$CustomReemp=new cls_CustomDBAlmacenes();
		$CustomReemp->ListarTipoUnidadConsReemplazo(15,0,$sort,$dir,$filtro,$hidden_ep_id_financiador,$hidden_ep_id_regional,$hidden_ep_id_programa,$hidden_ep_id_proyecto,$hidden_ep_id_actividad);
		$nodes_reemp=$CustomReemp->salida;
		if(sizeof($nodes_reemp!=0)){

		foreach ($nodes_reemp as $reemp){
		$rama[]=$reemp["id_tipo_unidad_constructiva"];
		$rama_nombre[]=$reemp["desc_nombre"];
		$this->Ln();
		$this->Cell($w[0],6,$reemp["desc_tipo_unidad_constructiva"],'LTRB',0,'L',!$fill);
		$this->Cell($w[1],6,$reemp["desc_nombre"],'LTRB',0,'L',!$fill);
		$this->Cell($w[2],6,$fecha,'LTRB',0,'L',!$fill);
		$fill=!$fill;

		}

		}

		}
		$this->Ln();
		$fill=!$fill;



		}
		//////////////////////////////////////////////////
		//////////////////////////////////////////////////

		if(sizeof($rama)!=0){
		$header_item=array('C�digo','Material','Descripci�n','Cantidad');
		$i=0;
		foreach ($rama as $id){
		$datos=$this->LoadData($id,"rama");
		$_SESSION['nombre_cabecera']=$rama_nombre[$i];
		$this->AddPage();
		$_SESSION['nombre_pie']=$rama_nombre[$i];
		$this->FancyTable($header_item,$datos,"rama");
		$i=$i+1;

		}

		}

		}
		else{
		for($i=0;$i<count($header);$i++)
		$this->Cell($wi[$i],7,$header[$i],1,0,'C',1);
		$this->Ln();
		//Restauraci�n de colores y fuentes
		$this->SetFillColor(224,235,255);
		$this->SetTextColor(0);
		$this->SetFont('Arial','',8);
		//Datos
		$fill=0;
		foreach($data as $row)
		{
		$this->Cell($wi[0],6,$row[3],'LTRB',0,'L',$fill);
		$this->Cell($wi[1],6,$row[4],'LTRB',0,'L',$fill);
		$this->Cell($wi[2],6,$row[6],'LTRB',0,'L',$fill);
		$this->Cell($wi[3],6,$row[8],'LTRB',0,'R',$fill);
		//$this->Cell($wi[4],6,$row[8]*$row[11],'LTRB',0,'R',$fill);
		$this->Ln();
		$fill=!$fill;
		}
		}*/


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
$header=array('Nro.','C�digo','Cantidad','Unidad','Calidad','Descripci�n del Material','Peso Neto (kg)','Total Importe');
//$header=array('C�digo','Cantidad','Unidad','Nombre','Descripci�n','Peso Neto (kg)');
$header_det=array('Nro.','C�digo','Material','Descripci�n','Cant.x Comp.','Cant.Entregada');

//Carga de datos
$tipo=$tipo;
//$data=$pdf->LoadData();
//echo json_encode($tipo_torre);
$pdf->SetFont('Arial','',10);
$pdf->SetAutoPageBreak(1,53);
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