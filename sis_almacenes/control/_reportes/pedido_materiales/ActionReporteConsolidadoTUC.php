<?php
/**
 * Nombre:	        ActionReporteFaltanteTUC.php
 * Prop�sito:		recoge parametrsos de la vista y los pasa al api de agata pera la generacion de un reporte
 * Autor:			
 * Fecha creaci�n:	
 *
 */
session_start();
include_once('../../rac_LibModeloAlmacenes.php');
include_once('../../../../lib/lib_reportes/ReportePDF.php');
include_once('../../../reportes/RConsolidadoTUC.php');
$Custom = new cls_CustomDBAlmacenes();
$nombre_archivo = 'ActionReporteConsolidadoTUC.php';
if (!isset($_SESSION['autentificado']))
{
	$_SESSION['autentificado']="NO";
}
if($_SESSION['autentificado']=="SI")
{
	$nombreArchivo = 'ConsolidadoUC.pdf';
	
	$Custom=new cls_CustomDBAlmacenes();
	$Custom->ConsolidadoTUC($hidden_id_salida);	
	$resp=$Custom->salida;
	/*
	print ("<pre>");
	print_r($resp);
	var_dump($resp);
	print ("</pre>");
	exit;*/
	
	
	$parametros = array (
	 						'tamano'=> 'LETTER',
	 						'orientacion'=> 'P',
	 						'titulo'=> 'Compisici�n Unidad Constructiva',
	 						'nombre_archivo'=> $nombreArchivo,
	 						'tipoReporte' => 'pdf',
	 						'codSistema'  => 'ALMIN',
	 						'desc_almacen' => $desc_almacen,
	 						'desc_almacen_logico' => $desc_almacen_logico
	 						
						);	
    
	$reporte = new RConsolidadoTUC($parametros);
	$reporte->datosHeader($resp,$parametros );
	$reporte->generarReporte();
	$reporte->output();
	
	
	
	
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