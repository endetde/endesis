<?php
/**
**********************************************************
Nombre de archivo:	    ActionEstadoModificacion.php
Prop�sito:				Permite eliminar registros de la tabla tts_cuenta_doc
Tabla:					tts_tts_cuenta_doc
Par�metros:				$id_depto


Valores de Retorno:    	N�mero de registros
Fecha de Creaci�n:		2009-10-27 10:40:41
Versi�n:				1.0.0
Autor:					Generado Automaticamente
**********************************************************
*/
session_start();
include_once("../LibModeloPresupuesto.php");

$Custom = new cls_CustomDBPresupuesto();

$nombre_archivo = "ActionEstadoPresupuesto.php";

$id_gestion = $_POST['id_gestion'];
$id_moneda = $_POST['id_moneda'];

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
		$resp->mensaje_error = "MENSAJE ERROR = No existen datos para cambiar estado.";
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
			$id_presupuesto = $_GET["id_presupuesto"];
			$accion = $_GET["accion"];
			
		}
		else
		{
			$id_presupuesto = $_POST["id_presupuesto"];
			$accion = $_POST["accion"];			
		}

		if ($id_presupuesto == "undefined" || $id_presupuesto == "")
		{
			$resp = new cls_manejo_mensajes(true, "406");
			$resp->mensaje_error = "MENSAJE ERROR = No existe el registro especificado para cambiar estado.";
			$resp->origen = "ORIGEN = $nombre_archivo";
			$resp->proc = "PROC = $nombre_archivo";
			$resp->nivel = "NIVEL = 4";
			echo $resp->get_mensaje();
			exit;
		}
		else
		{	
			
			$res = $Custom-> CambiarEstadoPresupuesto($id_presupuesto,$accion);
			
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
	}//end for

	//Guarda el mensaje de �xito de la operaci�n realizada
	if($cont>1) $mensaje_exito = "Se cambio el estado de los registros especificados.";
	else $mensaje_exito = $Custom->salida[1];

	//Obtiene el total de los registros. Par�metros del filtro
	if($cant == "") $cant = 100;
	if($puntero == "") $puntero = 0;
	if($sortcol == "") $sortcol = "id_presupuesto";
	if($sortdir == "") $sortdir = "asc";
	if($criterio_filtro == "") 
	{
		if($fk_id_cuenta_doc!='0')
			$criterio_filtro = "PRESUP.id_presupuesto=$id_presupuesto";
		else 
			$criterio_filtro = "0=0";
	}

	$res = $Custom -> ContarPresupuestoVigenteSuma($cant ,$puntero,$sortcol,$sortdir,$criterio_filtro,$hidden_ep_id_financiador,$hidden_ep_id_regional,$hidden_ep_id_programa,$hidden_ep_id_proyecto,$hidden_ep_id_actividad,$id_gestion);
	
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