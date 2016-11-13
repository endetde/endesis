<?php
/**
 * Nombre del archivo:	ActionVerificarDetalleProceso.php
 * Prop�sito:			devuelve tru o false dependiendo de si la solicitud tiene detalles en algun proceso
 * Par�metros:			$id_solicitud
 * Valores de Retorno:	true o false
 * Autor:				Jaime Rivera Rojas
 * Fecha creaci�n:		28-06-2008
 */
session_start();

include_once('../LibModeloFlujo.php');

$Custom = new cls_CustomDBFlujo();
$nombre_archivo = 'ActionResponsable.php';

if (!isset($_SESSION['autentificado']))
{
	$_SESSION['autentificado']="NO";
}
if($_SESSION['autentificado']=="SI")
{
	if (sizeof($_GET) > 0)
	{
		$get=true;
		$cont=1;
		
		
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
	
	
	$res = $Custom -> MarcarResponsable($id_correspondencia);

	

	//Arma el xml para desplegar el mensaje
	$resp = new cls_manejo_mensajes(false);
	$resp->add_nodo("TotalCount","1");
	$resp->add_nodo("mensaje",$mensaje_exito = $Custom->salida[1]);
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
