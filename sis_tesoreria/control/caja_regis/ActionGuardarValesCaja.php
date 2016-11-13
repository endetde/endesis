<?php
/**
**********************************************************
Nombre de archivo:	    ActionGuardarValesCaja.php
Prop�sito:				Permite insertar y modificar datos en la tabla tts_caja_regis
Tabla:					tts_tts_caja_regis
Par�metros:				$id_caja_regis
						$id_caja
						$id_cajero
						$id_empleado
						$importe_regis
						$fecha_regis

Valores de Retorno:    	N�mero de registros guardados
Fecha de Creaci�n:		2008-10-22 10:36:48
Versi�n:				1.0.0
Autor:					Generado Automaticamente
**********************************************************
*/
session_start();
include_once("../LibModeloTesoreria.php");
include_once("../../../sis_contabilidad/control/LibModeloContabilidad.php");

$Custom = new cls_CustomDBTesoreria();
$CustomSCI= new cls_CustomDBContabilidadIntegracion();

$nombre_archivo = "ActionGuardarValesCaja.php";

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
			$id_caja_regis= $_GET["id_caja_regis_$j"];
			$id_caja= $_GET["id_caja_$j"];
			$id_cajero= $_GET["id_cajero_$j"];
			$id_empleado= $_GET["id_empleado_$j"];
			$importe_regis= $_GET["importe_regis_$j"];
			$fecha_regis= $_GET["fecha_regis_$j"];
			$estado_regis= $_GET["estado_regis_$j"];
			$importe_entregado=$_GET["importe_entregado_$j"];
			$concepto_regis=$_GET["concepto_regis_$j"];
			$sw_contabilizar= $_GET["sw_contabilizar_$j"];
			$id_proveedor= $_GET["id_proveedor_$j"];
		}
		else
		{
			$id_caja_regis=$_POST["id_caja_regis_$j"];
			$id_caja=$_POST["id_caja_$j"];
			$id_cajero=$_POST["id_cajero_$j"];
			$id_empleado=$_POST["id_empleado_$j"];
			$importe_regis=$_POST["importe_regis_$j"];
			$fecha_regis=$_POST["fecha_regis_$j"];
			$estado_regis= $_POST["estado_regis_$j"];
			$importe_entregado=$_POST["importe_entregado_$j"];
			$concepto_regis=$_POST["concepto_regis_$j"];
			$sw_contabilizar= $_POST["sw_contabilizar_$j"];
			$id_proveedor= $_POST["id_proveedor_$j"];
		}
		
		if ($sw_contabilizar=='1')
		{ 		 
			$res = $CustomSCI->TTSIntegracionValesCaja($id_caja_regis,'1','1');
				if(!$res)
			{
				//Error de validaci�n
				$resp = new cls_manejo_mensajes(true, "406");
				$resp->mensaje_error = $CustomSCI->salida[1];
				$resp->origen = $CustomSCI->salida[2];
				$resp->proc = $CustomSCI->salida[3];
				$resp->nivel = $CustomSCI->salida[4];
				echo $resp->get_mensaje();
				exit;
			}
			break;
		}

		if ($id_caja_regis == "undefined" || $id_caja_regis == "")
		{
			////////////////////Inserci�n/////////////////////

			//Validaci�n de datos (del lado del servidor)
			$res = $Custom->ValidarValesCaja("insert",$id_caja_regis,$id_caja,$id_cajero,$id_empleado,$importe_regis,$fecha_regis);

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

			//Validaci�n satisfactoria, se ejecuta la inserci�n en la tabla tts_caja_regis
			$res = $Custom -> InsertarValesCaja($id_caja_regis,$id_caja,$id_cajero,$id_empleado,$importe_regis,$fecha_regis,$concepto_regis,$id_proveedor);

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
			$res = $Custom->ValidarValesCaja("update",$id_caja_regis,$id_caja,$id_cajero,$id_empleado,$importe_regis,$fecha_regis);

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

			$res = $Custom->ModificarValesCaja($id_caja_regis,$id_caja,$id_cajero,$id_empleado,$importe_regis,$fecha_regis,$estado_regis,$importe_entregado,$concepto_regis,$id_proveedor);

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
	if($sortcol == "") $sortcol = "id_caja_regis";
	if($sortdir == "") $sortdir = "asc";
	if($criterio_filtro == "") $criterio_filtro = "0=0";

	$res = $Custom->ContarValesCaja($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
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