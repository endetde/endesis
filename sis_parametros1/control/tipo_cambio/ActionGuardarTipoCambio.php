<?php
/**
**********************************************************
Nombre de archivo:	    ActionGuardarTipoCambio.php
Prop�sito:				Permite insertar y modificar datos en la tabla tpm_tipo_cambio
Tabla:					tpm_tpm_tipo_cambio
Par�metros:				$hidden_id_tipo_cambio
						$txt_fecha
						$txt_hora
						$txt_oficial
						$txt_compra
						$txt_venta
						$txt_observaciones
						$txt_estado
						$txt_id_moneda

Valores de Retorno:    	N�mero de registros guardados
Fecha de Creaci�n:		2007-11-06 20:48:42
Versi�n:				1.0.0
Autor:					Generado Automaticamente
**********************************************************
*/
session_start();
include_once("../LibModeloParametros.php");

$Custom = new cls_CustomDBParametros();
$nombre_archivo = "ActionGuardarTipoCambio.php";

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
			$hidden_id_tipo_cambio= $_GET["hidden_id_tipo_cambio_$j"];
			$txt_fecha= $_GET["txt_fecha_$j"];
			$txt_hora= $_GET["txt_hora_$j"];
			$txt_oficial= $_GET["txt_oficial_$j"];
			$txt_compra= $_GET["txt_compra_$j"];
			$txt_venta= $_GET["txt_venta_$j"];
			$txt_observaciones= $_GET["txt_observaciones_$j"];
			$txt_estado= $_GET["txt_estado_$j"];
			$txt_id_moneda= $_GET["txt_id_moneda_$j"];

		}
		else
		{
			$hidden_id_tipo_cambio=$_POST["hidden_id_tipo_cambio_$j"];
			$txt_fecha=$_POST["txt_fecha_$j"];
			$txt_hora=$_POST["txt_hora_$j"];
			$txt_oficial=$_POST["txt_oficial_$j"];
			$txt_compra=$_POST["txt_compra_$j"];
			$txt_venta=$_POST["txt_venta_$j"];
			$txt_observaciones=$_POST["txt_observaciones_$j"];
			$txt_estado=$_POST["txt_estado_$j"];
			$txt_id_moneda=$_POST["txt_id_moneda_$j"];

		}

		if ($hidden_id_tipo_cambio == "undefined" || $hidden_id_tipo_cambio == "")
		{
			////////////////////Inserci�n/////////////////////

			//Validaci�n de datos (del lado del servidor)
			$res = $Custom->ValidarTipoCambio("insert",$hidden_id_tipo_cambio, $txt_fecha,$txt_hora,$txt_oficial,$txt_compra,$txt_venta,$txt_observaciones,$txt_estado,$txt_id_moneda);

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

			//Validaci�n satisfactoria, se ejecuta la inserci�n en la tabla tpm_tipo_cambio
			$res = $Custom -> InsertarTipoCambio($hidden_id_tipo_cambio, $txt_fecha, $txt_hora, $txt_oficial, $txt_compra, $txt_venta, $txt_observaciones, $txt_estado, $txt_id_moneda);

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
			$res = $Custom->ValidarTipoCambio("update",$hidden_id_tipo_cambio, $txt_fecha, $txt_hora, $txt_oficial, $txt_compra, $txt_venta, $txt_observaciones, $txt_estado, $txt_id_moneda);

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

			$res = $Custom->ModificarTipoCambio($hidden_id_tipo_cambio, $txt_fecha, $txt_hora, $txt_oficial, $txt_compra, $txt_venta, $txt_observaciones, $txt_estado, $txt_id_moneda);

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
	if($sortcol == "") $sortcol = "id_tipo_cambio";
	if($sortdir == "") $sortdir = "asc";
	if($criterio_filtro == "") $criterio_filtro = "MONEDA.id_moneda=''$m_id_moneda''";

	$res = $Custom->ContarTipoCambio($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
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