<?php
require('../../../../lib/fpdf/fpdf.php');
require('../../../../lib/funciones.inc.php');
include_once("../../../../lib/configuracion.log.php");
//include_once("../../rcm_LibModeloAlmacenes.php");
include_once("../../LibModeloActivoFijo.php");
define('FPDF_FONTPATH','font/');

class PDF extends FPDF
{    //Cargar los datos
	//Cabecera de p�gina

	function Header()
	{	global $title;
	$this->SetLeftMargin(15);
	$funciones = new funciones();
	//Logo
	$this->Image('../../../../lib/images/logo_reporte.jpg',230,2,36,13);
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

	function LoadData($id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad,$id_empleado)
	{   
    $cant=20;
	$puntero=0;
	if($id_empleado=='%'){
		$criterio_filtro=" AND empl.id_empleado LIKE ''$id_empleado''";
	}//fin empleado %	
	else{
	   $criterio_filtro=" AND empl.id_empleado=".$id_empleado;			
	 }//fin else
	//Leer las l�neas del fichero
	$Custom=new cls_CustomDBActivoFijo();
	$Custom->ListarActivoFijoEstadoEPEmpleado($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
	$var1=$Custom->salida;
	return $var1;
	    /*echo $id_empleado;
	    exit;*/
		
	}

	//Tabla coloreada
	function FancyTable($header,$data,$id_empleado)
	{ 
		$this->SetDrawColor(190,190,190);
		$this->SetLineWidth(.1);
		
		$this->SetFont('Arial','B',12);
		//Movernos a la derecha
		$this->Cell(250,6,'ESTADO DE ACTIVOS FIJOS',0,0,'C');
		$this->Ln(3);
		$this->Cell(250,10,'Por Estructura Program�tica y Funcionario',0,0,'C');
		$this->Ln(10);
	    $num=count($data);
	    $pag=0;
	  foreach ($data as $row){
	  	$pag=$pag+1;
     	$this->SetFont('Arial','B',7);
		$this->Cell(20,4,'Financiador :',0,0,'L');
		$this->Cell(55,4,$row[1],0,0,'L');
		$this->Ln(3);
		$this->Cell(20,4,'Regional :',0,0,'L');
		$this->Cell(55,4,$row[3],0,0,'L');
		$this->Ln(3);
		$this->Cell(20,4,'Programa :',0,0,'L');
		$this->Cell(55,4,$row[5],0,0,'L');
		$this->Ln(3);
		$this->Cell(20,4,'Sub Programa :',0,0,'L');
		$this->Cell(55,4,$row[7],0,0,'L');
		$this->Ln(3);
		$this->Cell(20,4,'Actividad :',0,0,'L');
		$this->Cell(55,4,$row[9],0,0,'L');
		$this->Ln(3);
		$this->Cell(20,4,'Funcionario :',0,0,'L');
		$this->Cell(55,4,$row[11],0,0,'L');
		$this->Ln(3);
		$this->Cell(20,4,'Unidad Org. :',0,0,'L');
		$this->Cell(55,4,$row[13],0,0,'L');
		$this->Ln(6);

		/*$this->Cell(10,5,'Nun',0,0,'L');
		$this->Cell(10,5,'TIPO',0,0,'L');*/
		$criterio_filtro="";       
		//$criterio_filtro=" AND empl.id_empleado=".$id_empleado;		
		if($id_empleado=='%'){
			$criterio_filtro=" AND empl.id_empleado LIKE ''$id_empleado''";
		}//fin empleado %	
		else{
			$criterio_filtro=" AND empl.id_empleado=".$id_empleado;			
		  }//fin else
		
		 $cant=20;
	     $puntero=0;
	     //Leer las l�neas del fichero
	     $Custom=new cls_CustomDBActivoFijo();
	     $Custom->ListarActivoFijoEstadoEmpleado($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$row[0],$row[2],$row[4],$row[6],$row[8]);
	     $res=$Custom->salida;
	     $this->SetFont('','B',6);
         $data1=array();
         $cont=1;
                 foreach($res as $d){
                     	 $aux=array();
                     	 array_push($aux,$cont);
        	     
        	           for($i=0;$i<12;$i++){
        	             array_push($aux,$d[$i]);
        	                 }
        	              $cont++;
        	              array_push($data1,$aux);
        	               }
                            $res=$data1;
                            
       	                    $this->SetWidths(array(10,15,20,20,25,15,20,20,20,20,15));
		                    $this->SetAligns( array('C','C','C','C','C','C','C','C','C','C','C'));// para centrear los titulos del header
        	                
		                     $y=$this->GetY();
		                     $this->susana($header);
		                     $y2=$this->GetY();
        	                        		                    
		                     $this->SetFont('','',5);//tama�o de la letra del detalle
		                     $this->SetAligns( array('C','L','L','L','L','R','R','R','R','R','R'));// para convertir el centrado lado izquierdo
		                     
		                     foreach ($res as $d)
		                        {  	$y=$this->GetY();
		                           $this->susana($d);
			                        $y2=$this->GetY();
			                     }
		                    $rama_nombre=array();
		                    if($pag<$num){
		                    $this->AddPage();	
		                    }
		                    
		}//fin foreach
			
	}//Fin funcion fancy table
}//Fin Clase PDF
$pdf=new PDF('L','mm','Letter');
$pdf->AliasNbPages();
//T�tulos de las columnas
$header=array('NRO','C�DIGO','TIPO','SUB TIPO','DENOMINACI�N','FECHA ALTA','ORDEN COMPRA','VALOR COMPRA','DEP. ACUM.','VALOR ACTUAL','VIDA UTIL');//toodo lo que quiero mostrar en mis columnas
 /*echo $id_empleado;
	exit;*/
$data=$pdf->LoadData($id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad,$id_empleado);

$pdf->SetFont('Arial','',18);
$pdf->SetAutoPageBreak(1,35);
$pdf->SetTopMargin(15);
$pdf->SetRightMargin(10);
$pdf->SetLeftMargin(10);
$pdf->AddPage();
$pdf->FancyTable($header,$data,$id_empleado);
$pdf->Output();
?>