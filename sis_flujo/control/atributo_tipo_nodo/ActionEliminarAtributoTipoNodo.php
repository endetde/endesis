<?php
/**
**********************************************************
Nombre de archivo:	    ActionEliminarAtributoTipoNodo.php
Prop�sito:				Permite eliminar registros de la tabla tfl_tipo_nodo
Tabla:					tfl_atributo_tipo_nodo
Par�metros:				$id_atributo_tipo_nodo


Valores de Retorno:    	N�mero de registros
Fecha de Creaci�n:		2011-01-19 14:51:47
Versi�n:				1.0.0
Autor:					Ariel Ayaviri Omonte
**********************************************************
*/
session_start();

include_once("../LibModeloFlujo.php");

$Custom = new cls_CustomDBFlujo();
$nombre_archivo = "ActionEliminarAtributoTipoNodo.php";

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
	}
	else
	{
		$resp = new cls_manejo_mensajes(true, "406");
		$resp->mensaje_error = "MENSAJE ERROR = No existen datos para Eliminar.";
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
			$id_atributo_tipo_nodo= $_GET["id_atributo_tipo_nodo_$j"];
		}
		else
		{
			$id_atributo_tipo_nodo= $_POST["id_atributo_tipo_nodo_$j"];				
		}

		if ($id_atributo_tipo_nodo == "undefined" || $id_atributo_tipo_nodo == "")
		{
			$resp = new cls_manejo_mensajes(true, "406");
			$resp->mensaje_error = "MENSAJE ERROR = No existe el registro especificado para eliminar.";
			$resp->origen = "ORIGEN = $nombre_archivo";
			$resp->proc = "PROC = $nombre_archivo";
			$resp->nivel = "NIVEL = 4";
			echo $resp->get_mensaje();
			exit;
		}
		else
		{	//Eliminaci�n
			$res = $Custom-> EliminarAtributoTipoNodo($id_atributo_tipo_nodo);
			if(!$res)
			{
				$resp = new cls_manejo_mensajes(true, "406");
				$resp->mensaje_error = $Custom->salida[1] ;
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
	if($cont>1) $mensaje_exito = "Se eliminaron los registros especificados.";
	else $mensaje_exito = $Custom->salida[1];

	//Obtiene el total de los registros. Par�metros del filtro
	if($cant == "") $cant = 100;
	if($puntero == "") $puntero = 0;
	if($sortcol == "") $sortcol = "id_atributo_tipo_nodo";
	if($sortdir == "") $sortdir = "asc";
	if($criterio_filtro == "") 
	{//estos criterios de filtro son opcionales en este caso. se deben adaptar
		$criterio_filtro ="0=0";
		if(isset($maestro_id_tipo_nodo)){
		$criterio_filtro = "TIPNOD.id_tipo_nodo_inicio=$maestro_id_tipo_nodo";//cuenta solo los hijos del ide padre
		}
		if(isset($maestro_id_tipo_proceso))
		$criterio_filtro.="and TIPNOD.id_tipo_proceso = $maestro_id_tipo_proceso";
	}

	$res = $Custom->ContarAtributoTipoCircuito($cant,$puntero,$sortcol,$sortdir,$criterio_filtro);
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