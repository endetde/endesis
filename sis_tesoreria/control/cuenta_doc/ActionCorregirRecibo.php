<?php
/**
**********************************************************
Nombre de archivo:	    ActionCorregirRecibo.php
Prop�sito:				Permite corregir registros de la tabla tts_cuenta_doc
Tabla:					tts_tts_cuenta_doc
Valores de Retorno:    	N�mero de registros
Fecha de Creaci�n:		10
Versi�n:				1.0.0
Autor:					avq
**********************************************************
*/
session_start();
include_once("../LibModeloTesoreria.php");

$Custom = new cls_CustomDBTesoreria();

$nombre_archivo = "ActionCorregirRecibo.php";

if (!isset($_SESSION["autentificado"]))
{
	$_SESSION["autentificado"]="NO";
}


if($_SESSION["autentificado"]=="SI")
{
	if (sizeof($_GET) >0)
	{
		$get=true;
		$cont=1;
	}
	elseif(sizeof($_POST) >0)
	{
		$get=false;
		$cont =  $_POST["cantidad_ids"];
		$cont=1;
	}
	else
	{
		$resp = new cls_manejo_mensajes(true, "406");
		$resp->mensaje_error = "MENSAJE ERROR = No existen datos para Cambiar Estado.";
		$resp->origen = "ORIGEN = $nombre_archivo";
		$resp->proc = "PROC = $nombre_archivo";
		$resp->nivel = "NIVEL = 4";
		echo $resp->get_mensaje();
		exit;
	}

	
	for($j = 0;$j < $cont; $j++)
	{
		if ($get)
		{ 
				
			$id_cuenta_doc = $_GET["id_cuenta_doc_".$j];
			$id_caja = $_GET["id_caja"];
			
		}
		else
		{
			$id_cuenta_doc = $_POST["id_cuenta_doc_".$j];
			$id_caja = $_POST["id_caja"];
		}		

		if ($id_cuenta_doc == "undefined" || $id_cuenta_doc == "")
		{
			$resp = new cls_manejo_mensajes(true, "406");
			$resp->mensaje_error = "MENSAJE ERROR = No existe el registro especificado para Cambiar Estado.";
			$resp->origen = "ORIGEN = $nombre_archivo";
			$resp->proc = "PROC = $nombre_archivo";
			$resp->nivel = "NIVEL = 4";
			echo $resp->get_mensaje();
			exit;
		}
		else
		{	
			
			$res = $Custom->CorregirRecibo($id_cuenta_doc);
			if(!$res)
			{
				
				$resp = new cls_manejo_mensajes(true, "406");
				$resp->mensaje_error = $Custom->salida[1];
				$resp->origen = $Custom->salida[2];
				$resp->proc = $Custom->salida[3];
				$resp->nivel = $Custom->salida[4];
				$resp->query = $Custom->query;
				echo $resp->get_mensaje();
				exit;
			}
		}
	}
				//end for

	//Guarda el mensaje de �xito de la operaci�n realizada
	if($cont>1) $mensaje_exito = "Se realiz� la correci�n del recibo espec�ficada";
	else $mensaje_exito = $Custom->salida[1];

	//Obtiene el total de los registros. Par�metros del filtro
	if($cant == "") $cant = 15;
	if($puntero == "") $puntero = 0;
	if($sortcol == "") $sortcol = "vredoc.id_caja";
	if($sortdir == "") $sortdir = "desc";
	if($criterio_filtro == "") 
	{
		//if($fk_id_cuenta_doc!='0')
			$criterio_filtro = " vredoc.id_caja=".$id_caja;
		/*else 
			$criterio_filtro = "0=0";*/
	}
	$res = $Custom->ContarDetalleRendicionDocumento($cant ,$puntero,$sortcol,$sortdir,$criterio_filtro,$hidden_ep_id_financiador,$hidden_ep_id_regional,$hidden_ep_id_programa,$hidden_ep_id_proyecto,$hidden_ep_id_actividad);
	if($res) $total_registros = $Custom->salida;

	//Arma el xml para desplegar el mensaje
	$resp = new cls_manejo_mensajes(false);
	$resp->add_nodo("TotalCount", $total_registros);
	$resp->add_nodo("mensaje",$mensaje_exito);
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