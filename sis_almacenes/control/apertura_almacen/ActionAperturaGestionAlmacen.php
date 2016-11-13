<?php
/*
**********************************************************
Nombre de archivo:	    ActionGuardarGrupo.php
Prop�sito:				Permite insertar y modificar
Tabla:					tal_grupo
Par�metros:				$hidden_id_grupo
Valores de Retorno:    	N�mero de registros
Fecha de Creaci�n:		28-09-2007
Versi�n:				1.0.0
Autor:					Susana Castro Guaman
**********************************************************
*/
session_start();
include_once("../fpc_LibModeloAlmacenes.php");

$Custom = new cls_CustomDBAlmacenes();
$nombre_archivo = 'ActionAperturaGestionAlmacen.php';

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
		$cont=1;

		//Verifica si se har� o no la decodificaci�n(s�lo pregunta en caso del GET)
		//valores permitidos de $cod -> "si", "no"
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
		$cont =  $_POST['cantidad_ids'];

		//Por Post siempre se decodifica
		$decodificar = true;
	}
	else
	{
		$resp = new cls_manejo_mensajes(true, "406");
		$resp->mensaje_error = "MENSAJE ERROR = No existen datos para almacenar.";
		$resp->origen = "ORIGEN = $nombre_archivo";
		$resp->proc = "PROC = $nombre_archivo";
		$resp->nivel = 'NIVEL = 4';
		echo $resp->get_mensaje();
		exit;
	}

	//Envia al Custom la bandera que indica si se decodificar� o no
	$Custom->decodificar = $decodificar;

	//Realiza el bucle por todos los ids mandados

			$id_financiador = $txt_id_financiador;
			$id_regional = $txt_id_regional;
			$id_programa = $txt_id_programa;
			$id_proyecto = $txt_id_proyecto;
			$id_actividad = $txt_id_actividad;
			$fecha_apertura = $txt_fecha_apertura;
			$id_almacen = $txt_id_almacen;
		
		///////////////////////Modificaci�n////////////////////

			//Validaci�n de datos (del lado del servidor)
			$res = $Custom->AperturaAlmacenGestion($id_almacen,$fecha_apertura);
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
		

	//Guarda el mensaje de �xito de la operaci�n realizada
	exit;
}
else
{
	$resp = new cls_manejo_mensajes(true, "401");
	$resp->mensaje_error = 'MENSAJE ERROR = Usuario no Autentificado';
	$resp->origen = "ORIGEN = $nombre_archivo";
	$resp->proc = "PROC = $nombre_archivo";
	$resp->nivel = 'NIVEL = 1';
	echo $resp->get_mensaje();
	exit;
}
?>