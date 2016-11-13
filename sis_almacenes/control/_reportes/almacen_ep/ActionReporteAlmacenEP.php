<?php
/**
 * Nombre:	        ActionReporteAlmacenEP.php
 * Prop�sito:		recoge parametrsos de la vista y los pasa al api de agata pera la generacion de un reporte
 * Autor:		JoS� Abraham Mita Huanca	
 * Fecha creaci�n:	14-03-2008 
 *
 */
session_start();
include_once('../../LibModeloAlmacenes.php');
include_once('../../../../lib/lib_control/cls_manejo_reportes.php');

$Custom = new cls_CustomDBAlmacenes();

$nombre_archivo = 'ActionReporteAlmacenEP.php';

if (!isset($_SESSION['autentificado']))
{
	$_SESSION['autentificado']="NO";
}
if($_SESSION['autentificado']=="SI")
{
	$reporte = new cls_manejo_reportes();
	//$parametros = null;
	$parametros = array (
	'$id_financiador'=>$txt_id_financiador,
	'$id_regional'=>$txt_id_regional,
	'$id_programa'=>$txt_id_programa,
	'$id_proyecto'=>$txt_id_proyecto,
	'$id_actividad'=> $txt_id_actividad,
	'$id_almacen'=> $txt_id_almacen
	);
	//Valid values are: Pdf, Ps, Html, etc
	$reporte -> CreateReport('Pdf','../../../modelo/_reportes/ral_almacen_ep.agt',$parametros);
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