<?php
/**
**********************************************************
Nombre de archivo:	    ActionGuardarEmisionFactura.php
Prop�sito:				Permite insertar y modificar datos en la tabla tts_factura_recibo
Tabla:					tts_tts_factura_recibo
Par�metros:				$id_factura_recibo
						$id_fina_regi_prog_proy_acti
						$id_unidad_organizacional
						$id_cajero
						$id_concepto_ingas
						$id_moneda
						$nro_factura
						$importe_factura
						$nro_deposito
						$fecha_deposito
						$razon_social
						$nro_nit

Valores de Retorno:    	N�mero de registros guardados
Fecha de Creaci�n:		2008-10-29 17:35:04
Versi�n:				1.0.0
Autor:					Generado Automaticamente
**********************************************************
*/
session_start();
include_once("../LibModeloTesoreria.php");

$Custom = new cls_CustomDBTesoreria();
$nombre_archivo = "ActionGuardarEmisionFactura.php";

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
			$id_factura_recibo= $_GET["id_factura_recibo_$j"];
			$id_fina_regi_prog_proy_acti= $_GET["id_fina_regi_prog_proy_acti_$j"];
			$id_unidad_organizacional= $_GET["id_unidad_organizacional_$j"];
			$id_cajero= $_GET["id_cajero_$j"];
			$id_concepto_ingas= $_GET["id_concepto_ingas_$j"];
			$id_moneda= $_GET["id_moneda_$j"];
			
			$importe_factura= $_GET["importe_factura_$j"];
			$nro_deposito= $_GET["nro_deposito_$j"];
			$fecha_deposito= $_GET["fecha_deposito_$j"];
			$razon_social= $_GET["razon_social_$j"];
			$nro_nit= $_GET["nro_nit_$j"];
$id_financiador= $_GET["txt_id_financiador_$j"];
				$id_regional	= $_GET["txt_id_regional_$j"];
				$id_programa	= $_GET["txt_id_programa_$j"];
				$id_proyecto	= $_GET["txt_id_proyecto_$j"];
				$id_actividad	= $_GET["txt_id_actividad_$j"];
		}
		else
		{
			$id_factura_recibo=$_POST["id_factura_recibo_$j"];
			$id_fina_regi_prog_proy_acti=$_POST["id_fina_regi_prog_proy_acti_$j"];
			$id_unidad_organizacional=$_POST["id_unidad_organizacional_$j"];
			$id_cajero=$_POST["id_cajero_$j"];
			$id_concepto_ingas=$_POST["id_concepto_ingas_$j"];
			$id_moneda=$_POST["id_moneda_$j"];
			
			$importe_factura=$_POST["importe_factura_$j"];
			$nro_deposito=$_POST["nro_deposito_$j"];
			$fecha_deposito=$_POST["fecha_deposito_$j"];
			$razon_social=$_POST["razon_social_$j"];
			$nro_nit=$_POST["nro_nit_$j"];
$id_financiador= $_POST["txt_id_financiador_$j"];
				$id_regional	= $_POST["txt_id_regional_$j"];
				$id_programa	= $_POST["txt_id_programa_$j"];
				$id_proyecto	= $_POST["txt_id_proyecto_$j"];
				$id_actividad	= $_POST["txt_id_actividad_$j"];
		}

		if ($id_factura_recibo == "undefined" || $id_factura_recibo == "")
		{
			////////////////////Inserci�n/////////////////////

			//Validaci�n de datos (del lado del servidor)
			$res = $Custom->ValidarEmisionFactura("insert",$id_factura_recibo,$id_fina_regi_prog_proy_acti,$id_unidad_organizacional,$id_cajero,$id_concepto_ingas,$id_moneda,$importe_factura,$nro_deposito,$fecha_deposito,$razon_social,$nro_nit,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);

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
			}

			//Validaci�n satisfactoria, se ejecuta la inserci�n en la tabla tts_factura_recibo
			$res = $Custom -> InsertarEmisionFactura($id_factura_recibo,$id_fina_regi_prog_proy_acti,$id_unidad_organizacional,$id_cajero,$id_concepto_ingas,$id_moneda,$importe_factura,$nro_deposito,$fecha_deposito,$razon_social,$nro_nit,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);

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
			$res = $Custom->ValidarEmisionFactura("update",$id_factura_recibo,$id_fina_regi_prog_proy_acti,$id_unidad_organizacional,$id_cajero,$id_concepto_ingas,$id_moneda,$importe_factura,$nro_deposito,$fecha_deposito,$razon_social,$nro_nit,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);

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
			}

			$res = $Custom->ModificarEmisionFactura($id_factura_recibo,$id_fina_regi_prog_proy_acti,$id_unidad_organizacional,$id_cajero,$id_concepto_ingas,$id_moneda,$importe_factura,$nro_deposito,$fecha_deposito,$razon_social,$nro_nit,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);

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
	if($sortcol == "") $sortcol = "id_factura_recibo";
	if($sortdir == "") $sortdir = "asc";
	if($criterio_filtro == "") $criterio_filtro = "0=0";

	$res = $Custom->ContarEmisionFactura($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
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