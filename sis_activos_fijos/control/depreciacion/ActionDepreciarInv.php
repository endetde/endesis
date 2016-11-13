<?php
/**
 * Nombre del archivo:	ActionDepreciar.php
 * Prop�sito:			Ejecuta la depreciaci�n de los activos fijos
 * Tabla:				taf_depreciacion
 * Par�metros:			$fecha_ini, $fecha_fin, $id_financiador, $id_regional, $id_programa, $id_regional, $id_actividad
 * 						$id_tipo_activo, $id_sub_tipo_activo, $id_activo_fijo
 * 						
 * Valores de Retorno:	
 * Autor:				Rodrigo Chumacero Moscoso
 * Fecha creaci�n:		03-07-2007
 */ 
session_start();
include_once("../LibModeloActivoFijo.php");

$Custom = new cls_CustomDBActivoFijo();
$nombre_archivo = 'ActionDepreciarInv.php';

if (!isset($_SESSION['autentificado']))
{
	$_SESSION['autentificado']="NO";
}
if($_SESSION['autentificado']=="SI")
{
	//Verifica si los datos vienen por POST o GET
	if (sizeof($_GET) > 0)
	{
		$get=true;
	}
	elseif(sizeof($_POST) > 0)
	{
		$get = false;
	}
	else
	{
		$resp = new cls_manejo_mensajes(true, "406");
		$resp->mensaje_error = "MENSAJE ERROR = No existen par�metros para ejecutar la depreciaci�n.";
		$resp->origen = "ORIGEN = $nombre_archivo";
		$resp->proc = "PROC = $nombre_archivo";
		$resp->nivel = 'NIVEL = 4';
		$resp->get_mensaje();
		exit;
	}

	//Envia al Custom la bandera que indica si se decodificar� o no
	$Custom->decodificar = $decodificar;

	if ($get)
	{
		$txt_mes_ini = $_GET["txt_mes_ini"];
		$txt_mes_fin = $_GET["txt_mes_fin"];
		$txt_gestion_ini = $_GET["txt_gestion_ini"];
		$txt_gestion_fin = $_GET["txt_gestion_fin"];
		$txt_id_financiador = $_GET["txt_id_financiador"];
		$txt_id_regional = $_GET["txt_id_regional"];
		$txt_id_programa = $_GET["txt_id_programa"];
		$txt_id_proyecto = $_GET["txt_id_proyecto"];
		$txt_id_actividad = $_GET["txt_id_actividad"];
		$txt_id_tipo_activo = $_GET["maestro_id_tipo_activo"];
		$txt_id_sub_tipo_activo = $_GET["maestro_id_sub_tipo_activo"];
		$txt_id_activo_fijo = $_GET["txt_id_activo_fijo"];
	}
	else
	{
		//$txt_mes_ini = $_POST["txt_mes_ini"];
		$txt_mes_fin = $_POST["txt_mes_fin"];
		//$txt_gestion_ini = $_POST["txt_gestion_ini"];
		$txt_gestion_fin = $_POST["txt_gestion_fin"];
		$txt_id_financiador = $_POST["txt_id_financiador"];
		$txt_id_regional = $_POST["txt_id_regional"];
		$txt_id_programa = $_POST["txt_id_programa"];
		$txt_id_proyecto = $_POST["txt_id_proyecto"];
		$txt_id_actividad = $_POST["txt_id_actividad"];
		$txt_id_tipo_activo = $_POST["maestro_id_tipo_activo"];
		$txt_id_sub_tipo_activo = $_POST["maestro_id_sub_tipo_activo"];
		$txt_id_activo_fijo = $_POST["txt_id_activo_fijo"];
	}

	//Valida que la fecha fin sea mayor a la de inicio
	/*if($txt_gestion_fin < $txt_gestion_ini)
	{
	$resp = new cls_manejo_mensajes(true, "406");
	$resp->mensaje_error = "La Gesti�n de Finalizaci�n debe ser mayor o igual a la Gesti�n de Inicio";
	$resp->origen = $nombre_archivo;
	$resp->proc = $nombre_archivo;
	$resp->nivel = $nombre_archivo;
	$resp->get_mensaje();
	exit;
	}*/

	//Verifica que el mes de finalizaci�n no sea menor al de inicio
	/*if($txt_gestion_fin == $txt_gestion_ini)
	{
	if($txt_mes_fin < $txt_mes_ini)
	{
	$resp = new cls_manejo_mensajes(true, "406");
	$resp->mensaje_error = "La fecha de finalizaci�n debe ser mayor o igual a la de inicio";
	$resp->origen = $nombre_archivo;
	$resp->proc = $nombre_archivo;
	$resp->nivel = $nombre_archivo;
	$resp->get_mensaje();
	exit;
	}
	}*/

	//formatea fecha, obtenemos el �ltimo d�a del mes_fin  en la gestion_fin
	//$time_ini=mktime(0,0,0,$txt_mes_ini +1,0,$txt_gestion_ini);
	$time_fin=mktime(0,0,0,$txt_mes_fin +1,0,$txt_gestion_fin);
	// Obtenemos la fecha
	//$dia_mes_ini = date("d",$time_ini);
	$dia_mes_fin = date("d",$time_fin);

	//$txt_fecha_ini = "$txt_mes_ini-$dia_mes_ini-$txt_gestion_ini";
	$txt_fecha_fin = "$txt_mes_fin-$dia_mes_fin-$txt_gestion_fin";

	//Se verifica que ninguno de los par�metros est�n vac�os
	$sw = true;

	//Obtiene el c�digo temporal con el cual generar� el detalle de la depreciaci�n
	$fecha = getdate();
	$codigo_temp = $_SESSION["ss_id_usuario"] .$fecha['hours'] .$fecha['minutes'] .$fecha['seconds'] .$fecha['mday'] .$fecha['mon'] .$fecha['year'];
/*echo ('ccccccc'.$codigo_temp);
exit;*/

	//if($txt_fecha_ini == "" && $txt_fecha_ini == "undefined") $sw = $sw && false;
	if($txt_fecha_fin == "" && $txt_fecha_fin == "undefined") $sw = $sw && false;
	if($txt_id_financiador == "" && $txt_id_financiador == "undefined") $sw = $sw && false;
	if($txt_id_regional == "" && $txt_id_regional == "undefined") $sw = $sw && false;
	if($txt_id_programa == "" && $txt_id_programa == "undefined") $sw = $sw && false;
	if($txt_id_proyecto == "" && $txt_id_proyecto == "undefined") $sw = $sw && false;
	if($txt_id_actividad == "" && $txt_id_actividad == "undefined") $sw = $sw && false;
	if($txt_id_tipo_activo == "" && $txt_id_tipo_activo == "undefined") $sw = $sw && false;
	if($txt_id_sub_tipo_activo == "" && $txt_id_sub_tipo_activo == "undefined") $sw = $sw && false;
	if($txt_id_activo_fijo == "" && $txt_id_activo_fijo == "undefined") $sw = $sw && false;

	if($sw)
	{/**********************************************/

		//Se ejecuta la depreciaci�n
		$res = $Custom->DepreciarInv($txt_fecha_fin, $txt_id_financiador, $txt_id_regional, $txt_id_programa, $txt_id_proyecto, $txt_id_actividad, $txt_id_tipo_activo, $txt_id_sub_tipo_activo, $txt_id_activo_fijo, $codigo_temp);
		if(!$res)
		{
			//Error al ejecutar depreciaci�n
			$resp = new cls_manejo_mensajes(true, "406");
			$resp->mensaje_error = $Custom->salida[1];
			$resp->origen = $Custom->salida[2];
			$resp->proc = $Custom->salida[3];
			$resp->nivel = $Custom->salida[4];
			$resp->get_mensaje();
			exit;
		}
		else
		{
			//Arma el xml para desplegar el mensaje
			$resp = new cls_manejo_mensajes(false,"202");
			$resp->add_nodo('TotalCount',0);
			$resp->add_nodo('mensaje', $Custom->salida[1]);
			$resp->add_nodo('tiempo_resp', '200');
			$resp->add_nodo('codigo_temp',$codigo_temp);
			$resp->get_mensaje();
			exit;
		}

	}
	else
	{
		//Si uno de los par�metros est� vac�o no ejecuta la depreciaci�n
		$resp = new cls_manejo_mensajes(true, "401");
		$resp->mensaje_error = 'MENSAJE ERROR = Par�metros insuficientes';
		$resp->origen = "ORIGEN = $nombre_archivo";
		$resp->proc = "PROC = $nombre_archivo";
		$resp->nivel = 'NIVEL = 1';
		$resp->get_mensaje();
		exit;
	}

}
else
{
	$resp = new cls_manejo_mensajes(true, "401");
	$resp->mensaje_error = 'MENSAJE ERROR = Usuario no Autentificado';
	$resp->origen = "ORIGEN = $nombre_archivo";
	$resp->proc = "PROC = $nombre_archivo";
	$resp->nivel = 'NIVEL = 1';
	$resp->get_mensaje();
	exit;
}
?>