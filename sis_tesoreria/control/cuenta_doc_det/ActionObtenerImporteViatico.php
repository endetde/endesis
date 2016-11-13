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

include_once('../LibModeloTesoreria.php');

$Custom = new cls_CustomDBTesoreria();
$nombre_archivo = 'ActionVerificarRendicionVale.php';

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
	
	
	$res = $Custom -> ObtenerImporteViatico($id_categoria,$id_cobertura,$id_tipo_destino,$cantidad,$fecha,$_POST['fecha_ini'],$_POST['fecha_fin'],$id_cuenta_doc);
	
	if($res) $valor= $Custom->salida[0]['resultado'];
	

	$xml = new cls_manejo_xml('ROOT');
	$xml->add_nodo('TotalCount',1);
	$xml->add_rama('ROWS');
	$xml->add_nodo('respuesta', $valor);
	$xml->add_nodo('monto', $Custom->salida[0]['monto']);
	$xml->add_nodo('cantidad', $Custom->salida[0]['cantidad']);
	$xml->fin_rama();
	$xml->mostrar_xml();

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
