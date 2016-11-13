<?php
/**
**********************************************************
Nombre de archivo:	    ActionGuardarRegistroDocumento.php
Prop�sito:				Permite insertar y modificar datos en la tabla tct_documento
Tabla:					tct_tct_documento
Par�metros:				$id_documento
						$id_transaccion
						$tipo_documento
						$nro_documento
						$fecha_documento
						$razon_social
						$nro_nit
						$nro_autorizacion
						$codigo_control
						$poliza_dui
						$formulario
						$tipo_retencion

Valores de Retorno:    	N�mero de registros guardados
Fecha de Creaci�n:		2008-09-16 17:57:13
Versi�n:				1.0.0
Autor:					Generado Automaticamente
**********************************************************
*/
session_start();
include_once("../LibModeloContabilidad.php");

$Custom = new cls_CustomDBContabilidad();
$nombre_archivo = "ActionGuardarDocumento.php";

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


	//Envia al Custom la bandera que indica si se decodificar� o no
	$Custom->decodificar = $decodificar;

	//Realiza el bucle por todos los ids mandados

	$id_documento;
	$tipo_documento;
	$id_moneda;
	$importe_avance;
	$nro_documento;
	$fecha_documento;
	$razon_social;
	$nro_nit;
	$nro_autorizacion;
	$codigo_control;
	$nombre_tabla;
	$nombre_campo;
	$id_tabla;
	$importe_ice;
	$importe_exento;
	$id_plan_pago;

	
	if($tipo_documento==8||$tipo_documento==9||$tipo_documento==10){
		$nro_nit="";
		$nro_autorizacion="";
		$codigo_control="";
	}
//	echo $tipo_documento;
//	exit;
	
	////////////////////Inserci�n/////////////////////

	if ($id_documento == "undefined" || $id_documento == ""){
		
		//Validaci�n
		$res = $Custom->ValidarDocumento($id_documento,$tipo_documento,$id_moneda,$importe_avance,$nro_documento,$fecha_documento,$razon_social,$nro_nit,$nro_autorizacion,$codigo_control,$nombre_tabla,$nombre_campo,$id_tabla,$importe_ice,$importe_exento);
		if(!$res)
		{
			//Se produjo un error
			$resp = new cls_manejo_mensajes(true, "406");
			$resp->mensaje_error = $Custom->salida[1] . " (iteraci�n $cont)";
			$resp->origen = $Custom->salida[2];
			$resp->proc = $Custom->salida[3];
			$resp->nivel = $Custom->salida[4];
			$resp->query = $Custom->query;
			echo $resp->get_mensaje();
			exit;
		}
		
		//Inserci�n
		$res = $Custom -> InsertarDocumento($id_documento,$tipo_documento,$id_moneda,$importe_avance,$nro_documento,$fecha_documento,$razon_social,$nro_nit,$nro_autorizacion,$codigo_control,$nombre_tabla,$nombre_campo,$id_tabla,$importe_ice,$importe_exento,$id_plan_pago);
		if(!$res)
		{
			//Se produjo un error
			$resp = new cls_manejo_mensajes(true, "406");
			$resp->mensaje_error = $Custom->salida[1] . " (iteraci�n $cont)";
			$resp->origen = $Custom->salida[2];
			$resp->proc = $Custom->salida[3];
			$resp->nivel = $Custom->salida[4];
			$resp->query = $Custom->query;
			echo $resp->get_mensaje();
			exit;
		}
		$mensaje_exito = "Documento registrado.";
	}
	else{
		
		//Validaci�n
		$res = $Custom->ValidarDocumento($id_documento,$tipo_documento,$id_moneda,$importe_avance,$nro_documento,$fecha_documento,$razon_social,$nro_nit,$nro_autorizacion,$codigo_control,$nombre_tabla,$nombre_campo,$id_tabla,$importe_ice,$importe_exento);
		if(!$res)
		{
			//Se produjo un error
			$resp = new cls_manejo_mensajes(true, "406");
			$resp->mensaje_error = $Custom->salida[1] . " (iteraci�n $cont)";
			$resp->origen = $Custom->salida[2];
			$resp->proc = $Custom->salida[3];
			$resp->nivel = $Custom->salida[4];
			$resp->query = $Custom->query;
			echo $resp->get_mensaje();
			exit;
		}
		
		//Modificaci�n
		$res = $Custom -> ModificarDocumento($id_documento,$tipo_documento,$id_moneda,$importe_avance,$nro_documento,$fecha_documento,$razon_social,$nro_nit,$nro_autorizacion,$codigo_control,$nombre_tabla,$nombre_campo,$id_tabla,$importe_ice,$importe_exento,$id_plan_pago);
		if(!$res)
		{
			//Se produjo un error
			$resp = new cls_manejo_mensajes(true, "406");
			$resp->mensaje_error = $Custom->salida[1] . " (iteraci�n $cont)";
			$resp->origen = $Custom->salida[2];
			$resp->proc = $Custom->salida[3];
			$resp->nivel = $Custom->salida[4];
			$resp->query = $Custom->query;
			echo $resp->get_mensaje();
			exit;
		}
		$mensaje_exito = "Documento modificado con �xito.";

	}

	//Guarda el mensaje de �xito de la operaci�n realizada
	
	//Arma el xml para desplegar el mensaje
	$resp = new cls_manejo_mensajes(false);
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