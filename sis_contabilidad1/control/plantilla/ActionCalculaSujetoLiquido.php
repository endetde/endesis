<?php
/**
**********************************************************
Nombre de archivo:	    ActionEliminarPlantilla.php
Prop�sito:				Permite eliminar registros de la tabla tct_plantilla
Tabla:					tct_tct_plantilla
Par�metros:				$id_plantilla


Valores de Retorno:    	N�mero de registros
Fecha de Creaci�n:		2008-10-16 12:20:40
Versi�n:				1.0.0
Autor:					Generado Automaticamente
**********************************************************
*/
session_start();
include_once("../LibModeloContabilidad.php");

$Custom = new cls_CustomDBContabilidad();

$nombre_archivo = "ActionCalculaSujetoLiquido.php";

if (!isset($_SESSION["autentificado"]))
{
	$_SESSION["autentificado"]="NO";
}


if($_SESSION["autentificado"]=="SI")
{
	

	$res = $Custom-> CalculaSujetoLiquido($importe,$tipo_documento,$sw_sujeto_liquido);
	
	$importe=round($res,4);
	
    echo "{\"importe\":\"$importe\"}";
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