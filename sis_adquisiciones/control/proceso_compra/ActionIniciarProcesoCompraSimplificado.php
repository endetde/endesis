<?php
/**
**********************************************************
Nombre de archivo:	    ActionIniiarProcesoCompraRegular.php
Prop�sito:				Para pasar al esta de proceso_compra "en_proceso", en estado se inicia el proceso
Tabla:					tad_tad_proceso_compra
Par�metros:				$id_proceso_compra
						

Valores de Retorno:    	N�mero de registros guardados
Fecha de Creaci�n:		2008-05-13 18:03:05
Versi�n:				1.0.0
Autor:					Rensi Arteaga Copari
**********************************************************
*/
session_start();
include_once("../LibModeloAdquisiciones.php");

$Custom = new cls_CustomDBAdquisiciones();
$nombre_archivo = "ActionGuardarProcesoCompra.php";

if (!isset($_SESSION["autentificado"]))
{
	$_SESSION["autentificado"]="NO";
}
if($_SESSION["autentificado"]=="SI")
{

		if ($id_proceso_compra != "undefined" && $id_proceso_compra != "")
		{
			////////////////////Inserci�n/////////////////////
			
			//Validaci�n satisfactoria, se ejecuta  el incio de proceso
			$res = $Custom -> IniciarProcesoCompraSim($id_proceso_compra,"Transcurso Simplificado",$id_comprador,$tipo_recibo);

			if(!$res)
			{
				//Se produjo un error
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