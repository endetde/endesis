<?php
/**
**********************************************************
Nombre de archivo:	    ActionGuardarCbtesPartidasExcel.php
Prop�sito:				Permite insertar y modificar datos en la tabla tts_extracto_bancario
Tabla:					tts_extracto_bancario
Par�metros:				$id_extracto_bancario
						

Valores de Retorno:    	N�mero de registros guardados
Fecha de Creaci�n:		01/11/2015
Versi�n:				1.0.0
Autor:					avq
**********************************************************
*/
session_start();
include_once("../LibModeloPresupuesto.php");

require_once 'Excel/reader.php';    

$Custom = new cls_CustomDBPresupuesto();
//$CustomTesoro = new cls_CustomDBTesoro();
$nombre_archivo = "ActionGuardarCbtesReversionesExcel.php";

if (!isset($_SESSION["autentificado"]))
{
	$_SESSION["autentificado"]="NO";
}
if($_SESSION["autentificado"]=="SI")
{
	//Verifica si los datos vienen por POST o GET
if (sizeof($_GET) > 0)
	{
		$get=true;
		$cont=1;
		
		//Verifica si se har� o no la decodificaci�n(s�lo pregunta en caso del GET)
		//valores permitidos de $cod -> "si", "no"
		switch ($cod)
		{
			case "si":
				$decodificar = true;
				break;
			case "no":
				$decodificar = false;
				break;
			default:
				$decodificar = true;
				break;
		}
	}
	elseif(sizeof($_POST) > 0)
	{ 
		$get = false;
		$cont =  $_POST["cantidad_ids"];
		
		//Por Post siempre se decodifica
		$decodificar = true;
	}
	else
	{
		$resp = new cls_manejo_mensajes(true, "406");
		$resp->mensaje_error = "MENSAJE ERROR = No existen datos para almacenar.";
		$resp->origen = "ORIGEN = ";
		$resp->proc = "PROC = ";
		$resp->nivel = "NIVEL = 4";
		echo $resp->get_mensaje();
		exit;
	}
	 
	//Envia al Custom la bandera que indica si se decodificar� o no
	$Custom->decodificar = $decodificar;


	//Realiza el bucle por todos los ids recuperados
	/***************************Excel Reader*********************/
	
	
	$data = new Spreadsheet_Excel_Reader();
	
	$data->setOutputEncoding('CP1251');
	
	error_reporting(E_ALL ^ E_NOTICE);
	
	
	$id_siet_declara= $_POST["id_siet_declara"];
	$periodo_lite= $_POST["periodo_lite"];
	$gestion= $_POST["gestion"];
	$tipo_declara= $_POST["tipo_declara"];
	$tipo= $_POST["tipo"];
	
	/*echo $id_siet_declara;
	echo $periodo_lite;
	echo $gestion;
	exit;*/
	
	//$nro_cuenta_banco=substr($nro_cuenta_banco,-4);
	//if (!file_exists('archivos/'.$periodo_lite.'CUT'.$gestion.'.xls'))
 
if ($tipo_declara=='gasto'){
	
		$nombre_archivo='CbtesReversion'.$periodo_lite.$gestion.'.xls';
	}else 
	{
	
		$nombre_archivo='CbtesReversion'.$periodo_lite.$gestion.'Rec.xls';
	}
   
	if (!file_exists('archivos/'.$nombre_archivo))
	{
		
		$resp = new cls_manejo_mensajes(true, "406");
		$resp->error = "Archivo no encontrado";
		$resp->mensaje_error ='Archivo no encontrado para el periodo'.$periodo_lite.'y la gestion'.$gestion;
		$resp->origen = "File";
		$resp->proc = "Migraci�n";
		$resp->nivel = "0";
		$resp->query = "0";
		echo $resp->get_mensaje();
		exit;
		
	}
	//$data->read('archivos/'.$periodo_lite.'CUT'.$gestion.'.xls');
	
	$data->read('archivos/'.$nombre_archivo);	
		for ($h=0;$h<count($data->sheets);$h++){
			
			for ($i = 1; $i <= $data->sheets[$h]['numRows']; $i++) {
				for ($j = 1; $j <= $data->sheets[$h]['numCols']; $j++) {
					$id_siet_cbte=$data->sheets[$h]['cells'][$i][1];
					
					
				
				}
				
				$res = $Custom ->InsertarSietCbteReversionExcel($id_siet_cbte);
				if(!$res)
				{
					//Se produjo un error
					$resp = new cls_manejo_mensajes(true, "406");
					$resp->error = 'true' . "Error en el formato del archivo corrija el archivo Excel.";
					$resp->mensaje ='Error en el formato del archivo corrija el archivo Excel.';
					$resp->origen = $Custom->salida[2];
					$resp->proc = $Custom->salida[3];
					$resp->nivel = $Custom->salida[4];
					$resp->query = $Custom->query;
					//echo $resp->get_mensaje();
					//exit;
				}
			}
		
	  }
 	//Guarda el mensaje de �xito de la operaci�n realizada
	if($cont > 1) $mensaje_exito = "Se guardaron todos los datos.";
	else $mensaje_exito = $Custom->salida[1];

	//Obtiene el total de los registros. Par�metros del filtro
	if($cant == "") $cant = 100;
	if($puntero == "") $puntero = 0;
	if($sortcol == "") $sortcol = "id_siet_declara";
	if($sortdir == "") $sortdir = "asc";
	if($criterio_filtro == "") $criterio_filtro = "0=0";

	$res = $Custom->ContarSietDeclara($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		if($res) $total_registros = $Custom->salida;
   //  $mensaje_exito='Existe un error Consulte con el ADMINISTRADOR DEL SISTEMA';
	//Arma el xml para desplegar el mensaje
	$resp = new cls_manejo_mensajes(false);
	$resp->add_nodo("TotalCount", $total_registros);
	$resp->add_nodo("mensaje", $mensaje_exito);
	$resp->add_nodo("tiempo_resp", "200");
	echo $resp->get_mensaje();
	exit;
}
else
{
	$resp = new cls_manejo_mensajes(true, "401");
	$resp->mensaje_error = "MENSAJE ERROR = Usuario no Autentificado";
	$resp->origen = "ORIGEN = $nombre_archivo";
	$resp->proc = "PROC = $nombre_archivo";
	$resp->nivel = "NIVEL = 1";
	echo $resp->get_mensaje();
	exit;
}
?>