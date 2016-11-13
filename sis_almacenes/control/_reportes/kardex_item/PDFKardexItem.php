<?php
require('../../../../lib/fpdf/fpdf.php');
require('../../../../lib/funciones.inc.php');
include_once("../../../../lib/configuracion.log.php");
include_once("../../LibModeloAlmacenes.php");

class PDF extends FPDF
{
	//Cargar los datos
	//Cabecera de p�gina
	var $saldo_ing;//Para los saldos de los ingresos
	var $saldo_sal;//Para los saldos de las salidas
	var $saldo_inicial;//Saldo inicial f�sico
	var $saldo_mon_inicial;//Saldo inicial monetario

	var $sep_decim='.';
	var $sep_mil=',';

	function Header()
	{
		global $title;
		$imprimir_footer=1;
		$this->SetLeftMargin(15);
		$funciones = new funciones();
		//Logo
		//$this->Image('../../../../lib/images/logo_reporte.jpg',140,2);
		$this->Image('../../../../lib/images/logo_reporte.jpg',165,8,36,13);

		$this->SetX(175);
		$this->Cell(60,13,'P�gina: '.$this->PageNo().' de {nb}',0,1,'L');

		// establecemos el idioma de la p�gina
		setlocale (LC_TIME,"spanish", "es_ES@euro", "es_ES", "es");
		//creamos la cadena con los especificadores necesarios
		$formato = "%d de %B de %Y";
		//$formato = "%A, %d de %B de %Y";

		$this->SetFont('Arial','B',12);
		//Movernos a la derecha
		$this->Cell(185,4,'KARDEX F�SICO-VALORADO',0,1,'C');
		$this->Cell(185,4,utf8_decode($_SESSION['kard_item_desc_almacen']),0,1,'C');

		$fechad=$_SESSION["kard_item_fecha_desde"];

		$mes = substr($fechad, 0, 2);
		$dia = substr($fechad, 3, 2);
		$anio = substr($fechad, -4);
		$fechad=$dia.'-'.$mes.'-'.$anio;
		//Mostramos la fecha, ahora s� en el idioma deseado.

		$fechad=strftime($formato, strtotime($fechad));


		$fechah=$_SESSION["kard_item_fecha_hasta"];

		$mes = substr($fechah, 0, 2);
		$dia = substr($fechah, 3, 2);
		$anio = substr($fechah, -4);
		$fechah=$dia.'-'.$mes.'-'.$anio;

		//Mostramos la fecha, ahora s� en el idioma deseado.
		$fechah=strftime($formato, strtotime($fechah));


		$this->SetFont('Arial','B',8);
		$this->Cell(185,6,'Del '.$fechad.'  Al '.$fechah,0,0,'C');
		$this->Ln(10);
	}
	//Pie de p�gina
	function Footer()
	{
		//Posici�n: a 1,5 cm del final

		$this->SetY(-15);
		//Arial italic 8
		$this->SetFont('Arial','',6);
		//ip
		$ip = captura_ip();
		//N�mero de p�gina
		$fecha=date("d-m-Y");
		//hora
		$hora=date("H:i:s");
		$this->Cell(60,10,'Usuario: '.$_SESSION["ss_nombre_usuario"] ,0,0,'L');
		//$this->Cell(100,10,'P�gina '.$this->PageNo().' de {nb}',0,0,'C');
		$this->Cell(100,10,'',0,0,'C');
		$this->Cell(100,10,'Fecha: '.$fecha ,0,0,'L');
		$this->ln(3);
		$this->Cell(60,10,'',0,0,'L');
		$this->Cell(100,10,'',0,0,'C');
		//$this->Cell(100,10,'Hora: '.$hora ,0,0,'L');
		//fecha
	}
	/*function LoadData()
	{
	$cant=100000;
	$puntero=0;
	$sortcol='INGRES.fecha_finalizado_cancelado';
	$sortdir='asc';
	$criterio_filtro=' OSUCDE.id_salida = '.$_SESSION["rep_mat_id_salida"];
	//Leer las l�neas del fichero
	$Custom=new cls_CustomDBAlmacenes();
	$Custom->PedidoMaterialesUC($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$hidden_ep_id_financiador,$hidden_ep_id_regional,$hidden_ep_id_programa,$hidden_ep_id_proyecto,$hidden_ep_id_actividad);

	$resp=$Custom->salida;

	return $resp;
	}*/

	/*function Maestro($data,$titulo_copia,$header,$header_det)
	{
	$this->imprimir_footer=1;
	$this->SetFont('Arial','B',12);
	//Movernos a la derecha

	$this->Cell(185,13,'KARDEX',0,1,'C');
	$this->Cell(185,13,'DEL '.$_SESSION["kard_item_fecha_desde"].'  AL '.$_SESSION["kard_item_fecha_hasta"],0,0,'C');
	$this->Ln(10);

	/*if(sizeof($data>0))
	{
	$this->SetFont('Arial','',10);
	$this->Cell(120,10,'Item: '.$data[0]['nombre_item'],0,0,'L');//,'LR',0,'C');
	$this->Cell(140,10,'Descripci�n: '.$data[0]['descripcion_item'],0,0,'L');
	$this->Ln(4);
	$this->FancyTable($data,$header,$header_det);
	}

	}*/

	function ObtenerSaldos($ing,$sal,$saldo_item)
	{
		//**********SALDO F�SICO
		$saldo=$saldo_item[0]['saldo'];

		//echo "saldo: ".$saldo;
		//exit;
		$saldo_mon=0;
		//Suma las salidas para obtener el saldo inicial
		/*foreach ($sal as $row)
		{
		$saldo+=$row['cantidad'];
		$saldo_mon+=$row['costo'];
		}
		//echo "saldo: ".$saldo;
		//exit;   828
		//Resta los ingresos para obtener el saldo inicial
		foreach ($ing as $row)
		{
		$saldo-=$row['cantidad'];
		$saldo_mon-=$row['costo'];
		}*/
		$this->saldo_inicial=$saldo=='' ? 0:$saldo;
		$this->saldo_mon_inicial=$saldo_mon=='' ? 0:$saldo_mon;

		//Calcula los saldos de los ingresos
		foreach ($ing as $row)
		{
			$this->saldo_ing[0][]=$saldo+$row['cantidad'];
			$this->saldo_ing[1][]=$saldo_mon+$row['costo'];
			$saldo+=$row['cantidad'];
			$saldo_mon+=$row['costo'];
		}

		//Calcula los saldos de las salidas
		foreach ($sal as $row)
		{
			$this->saldo_sal[0][]=$saldo-$row['cantidad'];
			$this->saldo_sal[1][]=$saldo_mon-$row['costo'];
			$saldo-=$row['cantidad'];
			$saldo_mon-=$row['costo'];
		}

	}

	//Tabla coloreada
	function FancyTable($data,$header,$header_det)
	{
		//Obtiene los datos del kardex del item de ingreso
		$cant=100000;
		$puntero=0;
		$sortcol='INGRES.fecha_finalizado_cancelado,INGRES.correlativo_ing';
		$sortdir='asc';
		$criterio_filtro=' INGDET.id_item = '.$_SESSION["kard_item_id_item"]." AND INGRES.fecha_finalizado_cancelado BETWEEN ''".$_SESSION["kard_item_fecha_desde"]."'' AND ''".$_SESSION["kard_item_fecha_hasta"]."''";

		//Leer las l�neas del fichero
		$Custom=new cls_CustomDBAlmacenes();
		$Custom->ListarKardexItemIngreso($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$hidden_ep_id_financiador,$hidden_ep_id_regional,$hidden_ep_id_programa,$hidden_ep_id_proyecto,$hidden_ep_id_actividad);
		$resp_ing=$Custom->salida;

		///Obtiene el saldo anterior del item
		$criterio_filtro=' INGDET.id_item = '.$_SESSION["kard_item_id_item"]." AND INGRES.fecha_finalizado_cancelado < ''".$_SESSION["kard_item_fecha_desde"]."''";

		//Leer las l�neas del fichero
		$Custom=new cls_CustomDBAlmacenes();
		$Custom->ListarKardexItemSaldo($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$hidden_ep_id_financiador,$hidden_ep_id_regional,$hidden_ep_id_programa,$hidden_ep_id_proyecto,$hidden_ep_id_actividad);
		$saldo_item=$Custom->salida;

		/*echo"<pre>";
		print_r($resp_ing);
		echo"</pre>";*/
		/////

		//Obtiene los datos del kardex del item de ingreso
		$sortcol='SALIDA.fecha_borrador';
		$sortdir='asc';
		$criterio_filtro=' SALDET.id_item = '.$_SESSION["kard_item_id_item"]." AND SALIDA.fecha_borrador BETWEEN ''".$_SESSION["kard_item_fecha_desde"]."'' AND ''".$_SESSION["kard_item_fecha_hasta"]."''";
		//Leer las l�neas del fichero
		$Custom->ListarKardexItemSalida($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$hidden_ep_id_financiador,$hidden_ep_id_regional,$hidden_ep_id_programa,$hidden_ep_id_proyecto,$hidden_ep_id_actividad);
		$resp_sal=$Custom->salida;


		/*$this->SetFont('Arial','B',12);
		//Movernos a la derecha
		$this->Cell(185,4,'KARDEX F�SICO-VALORADO',0,1,'C');

		$fechad=$_SESSION["kard_item_fecha_desde"];

		$mes = substr($fechad, 0, 2);
		$dia = substr($fechad, 3, 2);
		$anio = substr($fechad, -4);
		$fechad=$dia.'-'.$mes.'-'.$anio;
		//Mostramos la fecha, ahora s� en el idioma deseado.

		$fechad=strftime($formato, strtotime($fechad));


		$fechah=$_SESSION["kard_item_fecha_hasta"];

		$mes = substr($fechah, 0, 2);
		$dia = substr($fechah, 3, 2);
		$anio = substr($fechah, -4);
		$fechah=$dia.'-'.$mes.'-'.$anio;

		//Mostramos la fecha, ahora s� en el idioma deseado.
		$fechah=strftime($formato, strtotime($fechah));


		$this->SetFont('Arial','B',8);
		$this->Cell(185,6,'Del '.$fechad.'  Al '.$fechah,0,0,'C');
		$this->Ln(10);*/

		//Contador hoja
		$prim_hoja=1;

		$this->SetFont('Arial','',8);
		$this->SetFillColor(255,255,255);
		$this->SetTextColor(0);
		$this->SetDrawColor(190,190,190);
		$this->SetLineWidth(.1);
		$this->SetFont('','',10);



		/*
		if(count($resp_sal)==0){

		//Imprime el t�tulo secundario del kardex
		/*$this->Cell(185,4,'ITEM:  ' .$resp_sal[0]['nombre'],0,1,'L');
		$this->Cell(185,4,'DESCRIPCI�N:  ' .$resp_sal[0]['descripcion_item'],0,1,'L');

		$this->Cell(185,4,'ITEM:  ' .$resp_ing[0]['nombre'],0,1,'L');
		$this->Cell(185,4,'DESCRIPCI�N:  ' .$resp_ing[0]['descripcion_item'],0,1,'L');
		$this->Ln(5);
		}

		if(count($resp_ing)==0){

		//Imprime el t�tulo secundario del kardex
		$this->Cell(185,4,'ITEM:  ' .$resp_sal[0]['nombre'],0,1,'L');
		$this->Cell(185,4,'DESCRIPCI�N:  ' .$resp_sal[0]['descripcion_item'],0,1,'L');

		/*$this->Cell(185,4,'ITEM:  ' .$resp_ing[0]['nombre'],0,1,'L');
		$this->Cell(185,4,'DESCRIPCI�N:  ' .$resp_ing[0]['descripcion_item'],0,1,'L');
		$this->Ln(5);
		}*/

		//if((count($resp_ing)!=0)&&count($resp_sal!=0)){

		//Imprime el t�tulo secundario del kardex
		//$this->Cell(185,4,'ITEM:  ' .$resp_sal[0]['nombre'],0,1,'L');
		//$this->Cell(185,4,'DESCRIPCI�N:  ' .$resp_sal[0]['descripcion_item'],0,1,'L');

		/*$this->Cell(185,4,'ITEM:  ' .$resp_ing[0]['nombre'],0,1,'L');
		$this->Cell(185,4,'DESCRIPCI�N:  ' .$resp_ing[0]['descripcion_item'],0,1,'L');*/
		//$this->Ln(5);
		// }

		if (count($resp_ing)!=0){
			//Imprime el t�tulo secundario del kardex
			$this->Cell(185,4,'ITEM:  ' .$resp_ing[0]['nombre'],0,1,'L');
			$this->Cell(185,4,'DESCRIPCI�N:  ' .$resp_ing[0]['descripcion_item'],0,1,'L');

			/*$this->Cell(185,4,'ITEM:  ' .$resp_ing[0]['nombre'],0,1,'L');
			$this->Cell(185,4,'DESCRIPCI�N:  ' .$resp_ing[0]['descripcion_item'],0,1,'L');*/
			$this->Ln(5);

		}else{


			//Imprime el t�tulo secundario del kardex
			$this->Cell(185,4,'ITEM:  ' .$resp_sal[0]['nombre'],0,1,'L');
			$this->Cell(185,4,'DESCRIPCI�N:  ' .$resp_sal[0]['descripcion_item'],0,1,'L');

			/*$this->Cell(185,4,'ITEM:  ' .$resp_ing[0]['nombre'],0,1,'L');
			$this->Cell(185,4,'DESCRIPCI�N:  ' .$resp_ing[0]['descripcion_item'],0,1,'L');*/
			$this->Ln(5);


		}



		//Cabecera
		$w=array(12,10,50,15,15,15,15,15,15,15);
		$fecha=date("d-m-Y");
		$sortcol= $fecha;
		$this->SetFont('Arial','',6);
		//Imprime los r�tulos de las columnas

		$this->Cell(72,3,'',0,0,'C',1);
		$this->Cell(45,3,'F�SICO','LTR',0,'C',1);
		$this->Cell(15,3,'','L',0,'C',1);
		$this->Cell(45,3,'VALORADO','LTR',1,'C',1);
		for($i=0;$i<count($header);$i++)
		$this->Cell($w[$i],5,$header[$i],1,0,'C',1);
		$this->Ln();

		//Obtiene los saldos
		$this->ObtenerSaldos($resp_ing,$resp_sal,$saldo_item);

		// Se imprime los datos de ingresos
		$this->SetFont('Arial','',6);
		$cont=0;
		
		$rr=0;
		$cont=0;
		//-------------------------
		foreach ($resp_ing as $row){
			$xx[$rr]['fecha_orden']=$row['fecha_orden'];
			$xx[$rr]['fecha']=$row['fecha'];
			$xx[$rr]['correl']=$row['correl_ing'];
			$xx[$rr]['glosa']=$row['glosa'];
			$xx[$rr]['ingreso']=$row['cantidad'];
			$xx[$rr]['salida']=0;
			$xx[$rr]['cant_saldo']=$this->saldo_ing[0][$rr];
			$xx[$rr]['costo_unit']=$row['costo_unitario'];
			$xx[$rr]['costo_debe']=$row['costo'];
			$xx[$rr]['costo_haber']=0;
			$xx[$rr]['saldo']=$this->saldo_ing[1][$rr];
			$rr++;
		}
		$cont=0;
		foreach ($resp_sal as $row){
			$xx[$rr]['fecha_orden']=$row['fecha_orden'];
			$xx[$rr]['fecha']=$row['fecha'];
			$xx[$rr]['correl']=$row['correl_sal'];
			$xx[$rr]['glosa']=$row['glosa'];
			$xx[$rr]['ingreso']=0;
			$xx[$rr]['salida']=$row['cantidad'];
			$xx[$rr]['cant_saldo']=$this->saldo_sal[0][$cont];
			$xx[$rr]['costo_unit']=$row['costo_unitario'];
			$xx[$rr]['costo_debe']=0;
			$xx[$rr]['costo_haber']=$row['costo'];
			$xx[$rr]['saldo']=$this->saldo_sal[1][$cont];
			$rr++;
			$cont++;
		}
		sort($xx);
		
		/*echo "<pre>";
		print_r($xx);
		echo "</pre>";
		exit;*/
		$cont=0;
		//Calcula los saldos a partir del saldo inicial
		$saldo_fis=$saldo_item[0]['saldo'];
		$saldo_mon=0;
		foreach ($xx as $row) {
			//echo "cadena=".substr($xx[$cont]['correl'],0,1);
			if(substr($xx[$cont]['correl'],0,1)=='I'){
				$saldo_fis+=$xx[$cont]['ingreso'];
				$saldo_mon+=$xx[$cont]['costo_debe'];
				$xx[$cont]['cant_saldo']=$saldo_fis;
				$xx[$cont]['saldo']=$saldo_mon;
			}
			else{
				$saldo_fis-=$xx[$cont]['salida'];
				$saldo_mon-=$xx[$cont]['costo_haber'];
				$xx[$cont]['cant_saldo']=$saldo_fis;
				$xx[$cont]['saldo']=$saldo_mon;
			}
			$cont++;
		}
		
		
		$cont=0;
		foreach($xx as $row)
		{
			if($cont==0)
			{
				//Imprime el saldo inicial
				$this->Cell($w[0],4,'','LTB',0,'C',$fill);
				$this->Cell($w[1],4,'','',0,'C',$fill);
				$this->Cell($w[2],4,'Saldo Anterior','TB',0,'L',$fill);
				$this->Cell($w[3],4,'','LTRB',0,'R',$fill);
				$this->Cell($w[4],4,'','LTRB',0,'C',$fill);
				//$this->Cell($w[4],4,$row['saldo_actual'],'LTRB',0,'R',$fill);
				$this->Cell($w[5],4,number_format($this->saldo_inicial,2,$this->sep_decim,$this->sep_mil),'TRB',0,'R',$fill);
				$this->Cell($w[6],4,'','LTRB',0,'R',$fill);
				$this->Cell($w[7],4,'','LTRB',0,'R',$fill);
				$this->Cell($w[8],4,'','LTRB',0,'R',$fill);
				$this->Cell($w[9],4,number_format($this->saldo_mon_inicial,2,$this->sep_decim,$this->sep_mil),'LTRB',1,'R',$fill);
			}

			$this->Cell($w[0],4,$row['fecha'],'LTRB',0,'C',$fill);
			$this->Cell($w[1],4,$row['correl'],'LTRB',0,'C',$fill);
			$this->Cell($w[2],4,$row['glosa'],'LTRB',0,'L',$fill);
			$this->Cell($w[3],4,$row['ingreso'],'LTRB',0,'R',$fill);
			$this->Cell($w[4],4,$row['salida'],'LTRB',0,'C',$fill);
			//$this->Cell($w[4],4,$row['saldo_actual'],'LTRB',0,'R',$fill);
			$this->Cell($w[5],4,number_format($row['cant_saldo'],2,$this->sep_decim,$this->sep_mil),'LTRB',0,'R',$fill);
			$this->Cell($w[6],4,number_format($row['costo_unit'],2,$this->sep_decim,$this->sep_mil),'LTRB',0,'R',$fill);
			$this->Cell($w[7],4,number_format($row['costo_debe'],2,$this->sep_decim,$this->sep_mil),'LTRB',0,'R',$fill);
			$this->Cell($w[8],4,number_format($row['costo_haber'],2,$this->sep_decim,$this->sep_mil),'LTRB',0,'R',$fill);
			$this->Cell($w[9],4,number_format($row['saldo'],2,$this->sep_decim,$this->sep_mil),'LTRB',1,'R',$fill);

			$cont++;
		}
		
		
		
		
		//-------------------------
		/*
		
		foreach($resp_ing as $row)
		{
			if($cont==0)
			{
				//Imprime el saldo inicial
				$this->Cell($w[0],4,'','LTB',0,'C',$fill);
				$this->Cell($w[1],4,'','',0,'C',$fill);
				$this->Cell($w[2],4,'Saldo Anterior','TB',0,'L',$fill);
				$this->Cell($w[3],4,'','LTRB',0,'R',$fill);
				$this->Cell($w[4],4,'','LTRB',0,'C',$fill);
				//$this->Cell($w[4],4,$row['saldo_actual'],'LTRB',0,'R',$fill);
				$this->Cell($w[5],4,number_format($this->saldo_inicial,2,$this->sep_decim,$this->sep_mil),'TRB',0,'R',$fill);
				$this->Cell($w[6],4,'','LTRB',0,'R',$fill);
				$this->Cell($w[7],4,'','LTRB',0,'R',$fill);
				$this->Cell($w[8],4,'','LTRB',0,'R',$fill);
				$this->Cell($w[9],4,number_format($this->saldo_mon_inicial,2,$this->sep_decim,$this->sep_mil),'LTRB',1,'R',$fill);
			}

			$this->Cell($w[0],4,$row['fecha'],'LTRB',0,'C',$fill);
			$this->Cell($w[1],4,$row['correl_ing'],'LTRB',0,'C',$fill);
			$this->Cell($w[2],4,$row['glosa'],'LTRB',0,'L',$fill);
			$this->Cell($w[3],4,$row['cantidad'],'LTRB',0,'R',$fill);
			$this->Cell($w[4],4,'','LTRB',0,'C',$fill);
			//$this->Cell($w[4],4,$row['saldo_actual'],'LTRB',0,'R',$fill);
			$this->Cell($w[5],4,number_format($this->saldo_ing[0][$cont],2,$this->sep_decim,$this->sep_mil),'LTRB',0,'R',$fill);
			$this->Cell($w[6],4,number_format($row['costo_unitario'],2,$this->sep_decim,$this->sep_mil),'LTRB',0,'R',$fill);
			$this->Cell($w[7],4,number_format($row['costo'],2,$this->sep_decim,$this->sep_mil),'LTRB',0,'R',$fill);
			$this->Cell($w[8],4,'','LTRB',0,'R',$fill);
			$this->Cell($w[9],4,number_format($this->saldo_ing[1][$cont],2,$this->sep_decim,$this->sep_mil),'LTRB',1,'R',$fill);

			$cont++;
		}

		// Se imprime los datos de ingresos
		$this->SetFont('Arial','',6);
		$cont=0;
		foreach($resp_sal as $row)
		{
			/*if($cont==0)
			{
			//Imprime el saldo inicial
			$this->Cell($w[0],4,'','LTB',0,'C',$fill);
			$this->Cell($w[1],4,'','',0,'C',$fill);
			$this->Cell($w[2],4,'Saldo Anterior','TB',0,'L',$fill);
			$this->Cell($w[3],4,'','LTRB',0,'R',$fill);
			$this->Cell($w[4],4,'','LTRB',0,'C',$fill);
			//$this->Cell($w[4],4,$row['saldo_actual'],'LTRB',0,'R',$fill);
			$this->Cell($w[5],4,$this->saldo_ing[1][$cont],'TRB',0,'R',$fill);
			$this->Cell($w[6],4,'','LTRB',0,'R',$fill);
			$this->Cell($w[7],4,'','LTRB',0,'R',$fill);
			$this->Cell($w[8],4,'','LTRB',0,'R',$fill);
			$this->Cell($w[9],4,$this->saldo_mon_inicial,'LTRB',1,'R',$fill);
			}
			*/
/*
			$this->Cell($w[0],4,$row['fecha'],'LTRB',0,'C',$fill);
			$this->Cell($w[1],4,$row['correl_sal'],'LTRB',0,'C',$fill);
			$this->Cell($w[2],4,'            '.$row['glosa'],'LTRB',0,'L',$fill);
			$this->Cell($w[3],4,'','LTRB',0,'R',$fill);
			$this->Cell($w[4],4,$row['cantidad'],'LTRB',0,'R',$fill);
			//$this->Cell($w[4],4,$row['saldo_actual'],'LTRB',0,'R',$fill);
			$this->Cell($w[5],4,number_format($this->saldo_sal[0][$cont],2,$this->sep_decim,$this->sep_mil),'LTRB',0,'R',$fill);
			$this->Cell($w[6],4,number_format($row['costo_unitario'],2,$this->sep_decim,$this->sep_mil),'LTRB',0,'R',$fill);
			$this->Cell($w[7],4,'','LTRB',0,'R',$fill);
			$this->Cell($w[8],4,number_format($row['costo'],2,$this->sep_decim,$this->sep_mil),'LTRB',0,'R',$fill);
			$this->Cell($w[9],4,number_format($this->saldo_sal[1][$cont],2,$this->sep_decim,$this->sep_mil),'LTRB',1,'R',$fill);
			$cont++;
		}*/
	}
}

$pdf=new PDF('P','mm','Letter');
$pdf->AliasNbPages();
//T�tulos de las columnas
$header=array('Nro.','Unidad Constructiva','Componente','Cantidad');
$header_det=array('FECHA','N�MERO','DESCRIPCI�N','ENTRADA','SALIDA','SALDO','P.U.Bs.','DEBE','HABER','SALDO');

//Carga de datos
$tipo=$tipo;
//$data=$pdf->LoadData();
//echo json_encode($tipo_torre);
$pdf->SetFont('Arial','',10);
$pdf->SetAutoPageBreak(1,35);
$pdf->SetTopMargin(15);
$pdf->SetRightMargin(15);
$pdf->SetLeftMargin(15);
$pdf->AddPage();
//$pdf->Maestro($data,'Original',$header,$header_det);
$pdf->FancyTable('',$header_det,'');
$pdf->Output();
?>