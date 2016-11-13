<?php
/*
**********************************************************
Nombre de archivo:	    ActionActualizarLibros.php
Prop�sito:				Permite actualizar los datos desde los subsistemas 
Tabla:					
Par�metros:				
$txt_descripcion
$txt_flag_comprobante
$txt_tipo_comprobante

Valores de Retorno:    	N�mero de registros
Fecha de Creaci�n:		23/04/2012
Versi�n:				1.0.0
Autor:					
**********************************************************
*/
session_start();
include_once("../LibModeloContabilidad.php");

$Custom = new cls_CustomDBContabilidad();
$nombre_archivo = "ActionActualizarLibros.php";

if (!isset($_SESSION["autentificado"]))
{
	$_SESSION["autentificado"]="NO";
}
if($_SESSION["autentificado"]=="SI")
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
		$cont =  $_POST["cantidad_ids"];
		
		//Por Post siempre se decodifica
		$decodificar = true;
	}
	else
	{
		$resp = new cls_manejo_mensajes(true, "406");
		$resp->mensaje_error = "MENSAJE ERROR = No existen datos para almacenar.";
		$resp->origen = "ORIGEN = ";
		$resp->proc = "PROC = ";
		$resp->nivel = "NIVEL = 4";
		echo $resp->get_mensaje();
		exit;
	}
	$cont=1;
	//Envia al Custom la bandera que indica si se decodificar� o no
	$Custom->decodificar = $decodificar;

	//Realiza el bucle por todos los ids mandados
	for($j = 0;$j < $cont; $j++)
	{
		if ($get)
		{   $txt_tipo_actualizacion= $_GET["txt_tipo_actualizacion"];
			$txt_id_transaccion= $_GET["txt_id_transaccion"];
			$txt_subsistema= $_GET["txt_subsistema"];
			$txt_gestion= $_GET["txt_gestion"];
			$txt_periodo= $_GET["txt_ periodo"];			
						
								
		}
		else
		{
			$txt_tipo_actualizacion= $_POST["txt_tipo_actualizacion"];
			$txt_id_transaccion= $_POST["txt_id_transaccion"];
			$txt_subsistema= $_POST["txt_subsistema"];
			$txt_gestion= $_POST["txt_gestion"];
			$txt_periodo= $_POST["txt_periodo"];			
							

		}
		//echo $txt_id_transaccion.$txt_subsistema.$txt_gestion.$txt_periodo;exit;
		///////////////////////Actualizaci�n////////////////////
			
			//Validaci�n de datos (del lado del servidor)
			/*$res = $Custom->ValidarActualizacion("update",$id_actualizacion,$id_depto,$fecha,$descripcion,$fecha_reg,$id_usuario,$id_moneda,$id_comprobante);

			if(!$res)
			{
				//Error de validaci�n
				$resp = new cls_manejo_mensajes(true, "406");
				$resp->mensaje_error = $Custom->salida[1];
				$resp->origen = $Custom->salida[2];
				$resp->proc = $Custom->salida[3];
				$resp->nivel = $Custom->salida[4];
				echo $resp->get_mensaje();
				exit;
			}*/
	        if ($txt_tipo_actualizacion=='libro_venta'){
	        	
	        	$res = $Custom->ActualizarLibros($txt_id_transaccion,$txt_subsistema,$txt_gestion,$txt_periodo);
	        }else {
	        	$res = $Custom->ActualizarLibrosCompras($txt_id_transaccion,$txt_subsistema,$txt_gestion,$txt_periodo);
	        	
	        }
			
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

	}//END FOR

	//Guarda el mensaje de �xito de la operaci�n realizada
	if($cont > 1) $mensaje_exito = "Se guardaron todos los datos.";
	else $mensaje_exito = $Custom->salida[1];

	//Obtiene el total de los registros. Par�metros del filtro
	if($cant == "") $cant = 100;
	if($puntero == "") $puntero = 0;
	if($sortcol == "") $sortcol = "id_actualizacion";
	if($sortdir == "") $sortdir = "asc";
	if($criterio_filtro == "") $criterio_filtro = "0=0";

	//$res = $Custom->ContarActualizacion($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
	$total_registros=100;
	//if($total_registros>0) $total_registros = $Custom->salida;

	//Arma el xml para desplegar el mensaje
	$resp = new cls_manejo_mensajes(false);
	$resp->add_nodo("TotalCount", $total_registros);
	$resp->add_nodo("mensaje", $mensaje_exito);
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