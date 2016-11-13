<?php
require('../../../../lib/fpdf/fpdf.php');
require('../../../../lib/funciones.inc.php');
include_once("../../../../lib/configuracion.log.php");
include_once('../../LibModeloContabilidad.php');
define('FPDF_FONTPATH','font/');
class PDF extends FPDF
{   function Header()
	{	
	global $title;
	$this->SetLeftMargin(15);
	$funciones = new funciones();
	//Logo
	$this->Image('../../../../lib/images/logo_reporte.jpg',230,5,36,13);
	$this->SetFont('','B',8);
	$this->Cell(250,4,'NIT 154262027',0,0,'R');
	$this->SetFont('','B',12);
	$this->Ln(4);
	$this->Cell(250,4,'LIBRO DE VENTAS',0,0,'C');
	$this->Ln(4);
	$this->SetFont('','B',8);
	$this->Cell(250,6,'DE  '.$_SESSION['rep_sci_fecha_inicio'].' AL  '.$_SESSION['rep_sci_fecha_fin'] ,0,0,'C');
	$this->Ln(4);
	$this->Cell(250,6,'Expresado en '.$_SESSION['txt_desc_moneda'] ,0,0,'C');	
	$this->Ln(10);
	$this->SetDrawColor(190,190,190);
	$this->SetLineWidth(.1);
	$this->SetFont('','B',6);
	$this->Cell(10,4,'NUM.','LRT',0,'C');
	
	$this->Cell(17,4,'NIT - CI','LRT',0,'C');
	$this->Cell(45,4,'','LRT',0,'C');
	$this->Cell(17,4,'N�MERO','LRT',0,'C');
	$this->Cell(23,4,'N�MERO','LRT',0,'C');
	$this->Cell(20,4,'FECHA DE ','LRT',0,'C');
	
	$this->Cell(17,4,'IMPORTE','LRT',0,'C');
	$this->Cell(17,4,'IMPORTE','LRT',0,'C');
	$this->Cell(17,4,'IMPORTE','LRT',0,'C');
	$this->Cell(17,4,'TOTAL','LRT',0,'C');
	$this->Cell(17,4,'DEBITO ','LRT',0,'C');
	$this->Cell(19,4,'FACTURA VALIDA','LRT',0,'C');
	$this->Cell(17,4,'C�DIGO DE','LRT',0,'C');
	$this->ln(3);
	$this->Cell(10,4,'','LR',0,'C');
	
	$this->Cell(17,4,'CLIENTE','R',0,'C');
	$this->Cell(45,4,'RAZ�N SOCIAL CLIENTE','R',0,'C');
	$this->Cell(17,4,'DE FACTURA','R',0,'C');
	$this->Cell(23,4,'DE TRAMITE','R',0,'C');
	$this->Cell(20,4,'FACTURA','R',0,'C');
	
	$this->Cell(17,4,'TOTAL','R',0,'C');
	$this->Cell(17,4,'I.C.E.','R',0,'C');
	$this->Cell(17,4,'EXCENTO','R',0,'C');
	$this->Cell(17,4,'SUJETO D.F.','R',0,'C');
	$this->Cell(17,4,'FISCAL I.V.A.','R',0,'C');
	$this->Cell(19,4,'O ANULADA','R',0,'C');
	$this->Cell(17,4,'DE CONTROL','R',0,'C');
	$this->Ln(4);
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
		$this->Cell(120,10,'Usuario: '.$_SESSION["ss_nombre_usuario"] ,0,0,'L');
		$this->Cell(110,10,'P�gina '.$this->PageNo().' de {nb}',0,0,'L');
		$this->Cell(100,10,'Fecha: '.$fecha ,0,0,'L');
		$this->ln(3);
		$this->Cell(100,10,'',0,0,'L');
		$this->Cell(130,10,'',0,0,'L');
		$this->Cell(200,10,'Hora: '.$hora ,0,0,'L');
	}
	/////////////////////////////////////////////////////////////////////////////
	function LoadData($id_moneda,$fecha_inicio,$fecha_fin,$sw_debito_credito,$id_depto)
	{   
	$cant=10000000;
	$puntero=0;
	$sortcol='DOC.fecha_documento';
	$sortdir='asc';
	$criterio_filtro="MON.id_moneda=''$id_moneda''";
	$criterio_filtro=$criterio_filtro." and COM.fecha_cbte >= ''$fecha_inicio''";
	$criterio_filtro=$criterio_filtro." and COM.fecha_cbte <= ''$fecha_fin''";

	//Leer las l�neas del fichero
	$Custom=new cls_CustomDBContabilidad();
	
	$Custom->ActionListarDocumentoIva($cant,$puntero,'DOC.nro_documento',$sortdir,'0=0',$hidden_ep_id_financiador,$hidden_ep_id_regional,$hidden_ep_id_programa,$hidden_ep_id_proyecto,$hidden_ep_id_actividad,$fecha_inicio,$fecha_fin,$id_moneda,$sw_debito_credito,$id_depto);
	$var1=$Custom->salida;
	return $var1;
	}
	
	function FancyTable($header,$data,$id_moneda,$fecha_inicio,$fecha_fin,$sw_debito_credito,$id_depto)
	{	
	$cant=10000000;
	$puntero=0;
	$sortcol='DOC.fecha_documento';
	$sortdir='asc';
	$criterio_filtro="MON.id_moneda=''$id_moneda''";
	
	$criterio_filtro=$criterio_filtro." and COM.fecha_cbte >= ''$fecha_inicio''";
	$criterio_filtro=$criterio_filtro." and COM.fecha_cbte <= ''$fecha_fin''";

	//Leer las l�neas del fichero
	$Custom=new cls_CustomDBContabilidad();
	$Custom->ActionListarDocumentoIvaSuma($cant,$puntero,'total_factura',$sortdir,'0=0',$hidden_ep_id_financiador,$hidden_ep_id_regional,$hidden_ep_id_programa,$hidden_ep_id_proyecto,$hidden_ep_id_actividad,$fecha_inicio,$fecha_fin,$id_moneda,$sw_debito_credito,$id_depto);
	/*echo $Custom->query;
	exit;    */    
	$var1=$Custom->salida;
		
		$this->SetDrawColor(190,190,190);
		$this->SetLineWidth(.1);
		$this->SetFont('Arial','B',12);
		/*$this->Cell(250,10,'LIBRO DE COMPRAS',0,0,'C');
		$this->Ln(15);*/
		
         $this->SetFont('','B',6);
         $data1=array();
         $cont=1;
         $num=count($data);
	     $pag=0;
        
		 
         foreach($data as $d){
         	             $pag=$pag+1;
                     	 $aux=array();
                     	 array_push($aux,$cont);
        	     
        	           //for($i=0;$i<14;$i++){
        	            array_push($aux,$d[2]);
        	           	array_push($aux,$d[6]);
        	           	array_push($aux,$d[3]);
        	           	array_push($aux,'');
        	           	array_push($aux,$d[1]);
        	           	array_push($aux,$d[7]);
        	           	array_push($aux,$d[8]);
        	           	array_push($aux,$d[9]);
        	           	array_push($aux,$d[10]);
        	           	array_push($aux,$d[12]);
        	           	array_push($aux,'');
        	           	array_push($aux,$d[5]);
        	                 //}
        	                 
        	                 
        	              $cont++;
        	              array_push($data1,$aux);
        	               }
        	               $data=$data1;
                           $this->SetWidths(array(10,17,45,17,23,20,17,17,17,17,17,19,17,17));
		                    $this->SetAligns( array('C','C','C','C','C','C','C','C','C','C','C','C','C'));// para centrear los titulos del header
        	                $this->SetVisibles(array(1,1,1,1,1,1,1,1,1,1,1,1,1,1));//para ver si son visibles o no 1: visible 0:no visible
        	                $this->SetFontsSizes(array(6,6,6,6,6,6,6,6,6,6,6,6,6,6));//tama�o del tipo de letra
                            $this->SetFonts(array('Arial','Arial','Arial','Arial','Arial','Arial','Arial','Arial','Arial','Arial','Arial','Arial','Arial','Arial'));
                            $this->SetSpaces(array(4,4,4,4,4,4,4,4,4,4,4,4,4,4,4));
                            $this->SetFontsStyles(array('B','B','B','B','B','B','B','B','B','B','B','B','B','B'));
		                    
		                    /* $y=$this->GetY();
		                     $this->MultiTabla($header,0,3,4,6);
		                     $y2=$this->GetY();*/
		                     	                        		                    
		                     $this->SetFont('','',5);//tama�o de la letra del detalle
		                     $this->SetAligns( array('C','R','L','R','R','C','R','R','R','R','R','C','C','C'));// para convertir el centrado lado izquierdo
		                     $this->SetVisibles(array(1,1,1,1,1,1,1,1,1,1,1,1,1,1));
		                     $this->SetFontsSizes(array(6,6,6,6,6,6,6,6,6,6,6,6,6,6));//tama�o del tipo de letra
		                     $this->SetFonts(array('Arial','Arial','Arial','Arial','Arial','Arial','Arial','Arial','Arial','Arial','Arial','Arial','Arial','Arial'));
                             $this->SetSpaces(array(4,4,4,4,4,4,4,4,4,4,4,4,4,4));
                             $this->SetFormatNumber(array(0,0,0,0,0,0,0,1,1,1,1,0,0,0));
                             $this->SetDecimales(array(0,0,0,0,0,0,2,2,2,2,2,0,0,0));
                             $this->SetFontsStyles(array('','','','','','','','','','','','','',''));
                            
                             foreach ($data as $d)
		                        {  	$y=$this->GetY();
		                            $this->MultiTabla($d,0,3,4,6,1);
		                            $y2=$this->GetY();
		                            
		                         }
		                     
		foreach ($var1 as $d)
	    {	$this->SetFont('','B',7);
	    	$this->Cell(66,10,'',0,0,'R');
	     
            $this->Cell(20,10,'',0,0,'R');
            $this->Cell(45,10,'TOTAL:',0,0,'R');
            $this->Cell(17,10,$d[0],0,0,'R');
            $this->Cell(17,10,$d[1],0,0,'R');
            $this->Cell(17,10,$d[2],0,0,'R');
            $this->Cell(17,10,$d[3],0,0,'R');
            $this->Cell(17,10,$d[5],0,0,'R');
    	}
	}
}
$pdf=new PDF('L','mm','Letter');
$pdf->AliasNbPages();
//T�tulos  de las columnas
//              1          2           3              4              5                    6                  7                8                         9              10             11                12                  13                     14
$header=array('NUM','COMPROBAN','FECHA FACTURA','N�MERO DE NIT','N�MERO DE FACTURA','N�MERO FORMULARIO','C�DIGO DE CONTROL','NOMBRE O RAZ�N SOCIAL','TOTAL FACTURA','TOTAL I.C.E.','IMPORTE EXCENTO','IMPORTE NETO','CREDITO FISCAL I.V.A.','DEBITO FISCAL I.V.A.');//toodo lo que quiero mostrar en mis columnas

$data=$pdf->LoadData($id_moneda,$fecha_inicio,$fecha_fin,$sw_debito_credito,$id_depto);

$pdf->SetFont('Arial','',12);
$pdf->SetAutoPageBreak(1,35);
$pdf->SetTopMargin(15);
$pdf->SetRightMargin(10);
$pdf->SetLeftMargin(10);
$pdf->AddPage();
$pdf->FancyTable($header,$data,$id_moneda,$fecha_inicio,$fecha_fin,$sw_debito_credito,$id_depto);
$pdf->Output();
?>