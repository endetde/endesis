<?php
/**
**********************************************************
Nombre de archivo:	    ActionGuardarDevengadoDetalle.php
Prop�sito:				Permite insertar y modificar datos en la tabla tts_devengado_detalle
Tabla:					tts_tts_devengado_detalle
Par�metros:				$id_devengado_detalle
						$id_devengado
						$id_fina_regi_prog_proy_acti
						$id_unidad_organizacional
						$porcentaje_devengado
						$importe_devengado

Valores de Retorno:    	N�mero de registros guardados
Fecha de Creaci�n:		2008-10-21 15:43:29
Versi�n:				1.0.0
Autor:					Generado Automaticamente
**********************************************************
*/
session_start();
include_once("../LibModeloTesoreria.php");

$Custom = new cls_CustomDBTesoreria();
$nombre_archivo = "ActionGuardarDevengadoDcto.php";

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
	for($j = 0;$j < $cont; $j++)
	{
		if ($get)
		{
			$id_devengado_dcto= $_GET["id_devengado_dcto_$j"];
			$id_devengado= $_GET["id_devengado_$j"];
			$tipo_documento= $_GET["tipo_documento_$j"];
			$importe_doc= $_GET["importe_doc_$j"];
			$id_moneda= $_GET["id_moneda_$j"];
			$nro_documento= $_GET["nro_documento_$j"];
			$fecha_documento= $_GET["fecha_documento_$j"];
			$razon_social	= $_GET["razon_social_$j"];
			$nro_nit	= $_GET["nro_nit_$j"];
			$nro_autorizacion	= $_GET["nro_autorizacion_$j"];
			$codigo_control	= $_GET["codigo_control_$j"];
			$poliza_dui	= $_GET["poliza_dui_$j"];
			$formulario	= $_GET["formulario_$j"];
			$tipo_rentecion	= $_GET["tipo_rentecion_$j"];
			$estado_documento	= $_GET["estado_documento_$j"];
		}
		else
		{
			$id_devengado_dcto= $_POST["id_devengado_dcto_$j"];
			$id_devengado= $_POST["id_devengado_$j"];
			$tipo_documento= $_POST["tipo_documento_$j"];
			$importe_doc= $_POST["importe_doc_$j"];
			$id_moneda= $_POST["id_moneda_$j"];
			$nro_documento= $_POST["nro_documento_$j"];
			$fecha_documento= $_POST["fecha_documento_$j"];
			$razon_social	= $_POST["razon_social_$j"];
			$nro_nit	= $_POST["nro_nit_$j"];
			$nro_autorizacion	= $_POST["nro_autorizacion_$j"];
			$codigo_control	= $_POST["codigo_control_$j"];
			$poliza_dui	= $_POST["poliza_dui_$j"];
			$formulario	= $_POST["formulario_$j"];
			$tipo_rentecion	= $_POST["tipo_rentecion_$j"];
			$estado_documento	= $_POST["estado_documento_$j"];
		}
		
		
		if ($id_devengado_dcto == "undefined" || $id_devengado_dcto == "")
		{
			////////////////////Inserci�n/////////////////////

			//Validaci�n de datos (del lado del servidor)
			/*$res = $Custom->ValidarDevengadoDetalle("insert",$id_devengado_detalle, $id_devengado,$id_fina_regi_prog_proy_acti,$id_unidad_organizacional,$porcentaje_devengado,$importe_devengado,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad,$porc_monto);

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

			//Validaci�n satisfactoria, se ejecuta la inserci�n en la tabla tts_devengado_detalle
			$res = $Custom -> InsertarDevengadoDcto($id_devengado_dcto,$id_devengado,$tipo_documento,$importe_doc,$id_moneda,$nro_documento,$fecha_documento,$razon_social,$nro_nit,$nro_autorizacion,$codigo_control,$poliza_dui,$formulario,$tipo_retencion,$estado_documento);

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
		}
		else
		{	///////////////////////Modificaci�n////////////////////

			//Validaci�n de datos (del lado del servidor)
			/*$res = $Custom->ValidarDevengadoDetalle("update",$id_devengado_detalle, $id_devengado,$id_fina_regi_prog_proy_acti,$id_unidad_organizacional,$porcentaje_devengado,$importe_devengado,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad,$porc_monto);

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

			$res = $Custom->ModificarDevengadoDcto($id_devengado_dcto,$id_devengado,$tipo_documento,$importe_doc,$id_moneda,$nro_documento,$fecha_documento,$razon_social,$nro_nit,$nro_autorizacion,$codigo_control,$poliza_dui,$formulario,$tipo_retencion,$estado_documento);

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

	}//END FOR

	//Guarda el mensaje de �xito de la operaci�n realizada
	if($cont > 1) $mensaje_exito = "Se guardaron todos los datos.";
	else $mensaje_exito = $Custom->salida[1];

	//Obtiene el total de los registros. Par�metros del filtro
	if($cant == "") $cant = 100;
	if($puntero == "") $puntero = 0;
	if($sortcol == "") $sortcol = "id_devengado_detalle";
	if($sortdir == "") $sortdir = "asc";
	if($criterio_filtro == "") $criterio_filtro = "DEVENG.id_devengado=''$m_id_devengado''";

	$res = $Custom->ContarDevengadoDcto($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
	if($res) $total_registros = $Custom->salida;

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