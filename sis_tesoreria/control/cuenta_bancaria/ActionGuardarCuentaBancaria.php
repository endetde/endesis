<?php
/**
**********************************************************
Nombre de archivo:	    ActionGuardarCuentaBancaria.php
Prop�sito:				Permite insertar y modificar datos en la tabla tts_cuenta_bancaria
Tabla:					tts_tts_cuenta_bancaria
Par�metros:				$id_cuenta_bancaria
						$id_institucion
						$nro_cuenta_banco
						$nro_cheque
						$estado_cuenta

Valores de Retorno:    	N�mero de registros guardados
Fecha de Creaci�n:		2008-10-16 11:07:13
Versi�n:				1.0.0
Autor:					Generado Automaticamente
**********************************************************
*/
session_start();
include_once("../LibModeloTesoreria.php");

$Custom = new cls_CustomDBTesoreria();
$nombre_archivo = "ActionGuardarCuentaBancaria.php";

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
			$id_cuenta_bancaria= $_GET["id_cuenta_bancaria_$j"];
			$id_institucion= $_GET["id_institucion_$j"];
			$id_cuenta= $_GET["id_cuenta_$j"];
			$id_auxiliar= $_GET["id_auxiliar_$j"];
			$nro_cheque= $_GET["nro_cheque_$j"];
			$estado_cuenta= $_GET["estado_cuenta_$j"];
			$nro_cuenta_banco= $_GET["nro_cuenta_banco_$j"];
			$id_parametro= $_GET["id_parametro_$j"];
		}
		else
		{
			$id_cuenta_bancaria=$_POST["id_cuenta_bancaria_$j"];
			$id_institucion=$_POST["id_institucion_$j"];
			$id_cuenta=$_POST["id_cuenta_$j"];
			$id_auxiliar=$_POST["id_auxiliar_$j"];
			$nro_cheque=$_POST["nro_cheque_$j"];
			$estado_cuenta=$_POST["estado_cuenta_$j"];
			$nro_cuenta_banco=$_POST["nro_cuenta_banco_$j"];
			$id_parametro= $_POST["id_parametro_$j"];

		}

		if ($id_cuenta_bancaria == "undefined" || $id_cuenta_bancaria == "")
		{
			////////////////////Inserci�n/////////////////////

			//Validaci�n de datos (del lado del servidor)
			$res = $Custom->ValidarCuentaBancaria("insert",$id_cuenta_bancaria,$id_institucion,$id_cuenta,$id_auxiliar,$nro_cheque,$estado_cuenta,$nro_cuenta_banco,$id_parametro);

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

			//Validaci�n satisfactoria, se ejecuta la inserci�n en la tabla tts_cuenta_bancaria
			$res = $Custom -> InsertarCuentaBancaria($id_cuenta_bancaria,$id_institucion,$id_cuenta,$id_auxiliar,$nro_cheque,$estado_cuenta,$nro_cuenta_banco,$id_parametro);

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
			$res = $Custom->ValidarCuentaBancaria("update",$id_cuenta_bancaria,$id_institucion,$id_cuenta,$id_auxiliar,$nro_cheque,$estado_cuenta,$nro_cuenta_banco,$id_parametro);

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

			$res = $Custom->ModificarCuentaBancaria($id_cuenta_bancaria,$id_institucion,$id_cuenta,$id_auxiliar,$nro_cheque,$estado_cuenta,$nro_cuenta_banco,$id_parametro);

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
	if($sortcol == "") $sortcol = "id_cuenta_bancaria";
	if($sortdir == "") $sortdir = "asc";
	if($criterio_filtro == "") $criterio_filtro = "0=0";

	$res = $Custom->ContarCuentaBancaria($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
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