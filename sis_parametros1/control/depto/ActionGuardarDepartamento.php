<?php
/**
**********************************************************
Nombre de archivo:	    ActionGuardarDepartamento.php
Prop�sito:				Permite insertar y modificar datos en la tabla tpm_depto
Tabla:					tpm_tpm_depto
Par�metros:				$id_depto
						$codigo_depto
						$nombre_depto
						$estado

Valores de Retorno:    	N�mero de registros guardados
Fecha de Creaci�n:		2009-01-23 10:58:13
Versi�n:				1.0.0
Autor:					Generado Automaticamente
**********************************************************
*/
session_start();
include_once("../LibModeloParametros.php");

$Custom = new cls_CustomDBParametros();
$nombre_archivo = "ActionGuardarDepartamento.php";

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
			$id_depto= $_GET["id_depto_$j"];
			$codigo_depto= $_GET["codigo_depto_$j"];
			$nombre_depto= $_GET["nombre_depto_$j"];
			$estado= $_GET["estado_$j"];
			$id_subsistema= $_GET["id_subsistema_$j"];
			//MODIFICACION 23/03/2011 aayaviri
			$id_lugar=$_GET["id_lugar_$j"];
			$id_tipo_proceso=$_GET["id_tipo_proceso_$j"];
			//MODIFICACION 03/10/2011 mflores
			$codificacion=$_GET["codificacion_$j"];
			//--------------
		}
		else
		{
			$id_depto=$_POST["id_depto_$j"];
			$codigo_depto=$_POST["codigo_depto_$j"];
			$nombre_depto=$_POST["nombre_depto_$j"];
			$estado=$_POST["estado_$j"];
			$id_subsistema=$_POST["id_subsistema_$j"];
			//MODIFICADO 23/03/2011 aayaviri
			$id_lugar=$_POST["id_lugar_$j"];
			$id_tipo_proceso=$_POST["id_tipo_proceso_$j"];
			//MODIFICACION 03/10/2011 mflores
			$codificacion=$_POST["codificacion_$j"];
			//----------------------
		}

		if ($id_depto == "undefined" || $id_depto == "")
		{
			////////////////////Inserci�n/////////////////////

			//Validaci�n de datos (del lado del servidor)
			$res = $Custom->ValidarDepartamento("insert",$id_depto,$codigo_depto,$nombre_depto,$estado);

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

			//MODIFICACION 03/10/2011 mflores
			//Validaci�n satisfactoria, se ejecuta la inserci�n en la tabla tpm_depto
			$res = $Custom -> InsertarDepartamento($id_depto,$codigo_depto,$nombre_depto,$estado,$id_subsistema,$id_lugar,$id_tipo_proceso,$codificacion);

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
			$res = $Custom->ValidarDepartamento("update",$id_depto,$codigo_depto,$nombre_depto,$estado);

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

			//MODIFICACION 03/10/2011 mflores
			$res = $Custom->ModificarDepartamento($id_depto,$codigo_depto,$nombre_depto,$estado,$id_subsistema,$id_lugar,$id_tipo_proceso,$codificacion);

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
	if($sortcol == "") $sortcol = "id_depto";
	if($sortdir == "") $sortdir = "asc";
	if($criterio_filtro == "") $criterio_filtro = "0=0";

	$res = $Custom->ContarDepartamento($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
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