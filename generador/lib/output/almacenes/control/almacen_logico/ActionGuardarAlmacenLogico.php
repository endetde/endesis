<?php
/**
**********************************************************
Nombre de archivo:	    ActionGuardarAlmacenLogico.php
Prop�sito:				Permite insertar y modificar datos en la tabla tal_almacen_logico
Tabla:					tal_tal_almacen_logico
Par�metros:				$hidden_id_almacen_logico
						$txt_codigo
						$txt_bloqueado
						$txt_nombre
						$txt_descripcion
						$txt_estado_registro
						$txt_fecha_reg
						$txt_obsevaciones
						$txt_id_almacen_ep
						$txt_id_tipo_almacen
	
Valores de Retorno:    	N�mero de registros guardados
Fecha de Creaci�n:		2007-10-12 16:30:43
Versi�n:				1.0.0
Autor:					Generado Automaticamente
**********************************************************
*/
session_start();
include_once("../LibModeloAlmacenes.php");

$Custom = new cls_CustomDBAlmacenes();
$nombre_archivo = "ActionGuardarAlmacenLogico.php";

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
			$hidden_id_almacen_logico						= $_GET["hidden_id_almacen_logico_$j"];
			$txt_codigo						= $_GET["txt_codigo_$j"];
			$txt_bloqueado						= $_GET["txt_bloqueado_$j"];
			$txt_nombre						= $_GET["txt_nombre_$j"];
			$txt_descripcion						= $_GET["txt_descripcion_$j"];
			$txt_estado_registro						= $_GET["txt_estado_registro_$j"];
			$txt_fecha_reg						= $_GET["txt_fecha_reg_$j"];
			$txt_obsevaciones						= $_GET["txt_obsevaciones_$j"];
			$txt_id_almacen_ep						= $_GET["txt_id_almacen_ep_$j"];
			$txt_id_tipo_almacen						= $_GET["txt_id_tipo_almacen_$j"];
							
		}
		else
		{
			$hidden_id_almacen_logico						= $_POST["hidden_id_almacen_logico_$j"];
			$txt_codigo						= $_POST["txt_codigo_$j"];
			$txt_bloqueado						= $_POST["txt_bloqueado_$j"];
			$txt_nombre						= $_POST["txt_nombre_$j"];
			$txt_descripcion						= $_POST["txt_descripcion_$j"];
			$txt_estado_registro						= $_POST["txt_estado_registro_$j"];
			$txt_fecha_reg						= $_POST["txt_fecha_reg_$j"];
			$txt_obsevaciones						= $_POST["txt_obsevaciones_$j"];
			$txt_id_almacen_ep						= $_POST["txt_id_almacen_ep_$j"];
			$txt_id_tipo_almacen						= $_POST["txt_id_tipo_almacen_$j"];
			
		}

		if ($hidden_id_almacen_logico == "undefined" || $hidden_id_almacen_logico == "")
		{
			////////////////////Inserci�n/////////////////////

			//Validaci�n de datos (del lado del servidor)
			$res = $Custom->ValidarAlmacenLogico("insert",$hidden_id_almacen_logico, $txt_codigo, $txt_bloqueado, $txt_nombre, $txt_descripcion, $txt_estado_registro, $txt_fecha_reg, $txt_obsevaciones, $txt_id_almacen_ep, $txt_id_tipo_almacen);
			
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

			//Validaci�n satisfactoria, se ejecuta la inserci�n en la tabla tal_almacen_logico
			$res = $Custom -> InsertarAlmacenLogico($hidden_id_almacen_logico, $txt_codigo, $txt_bloqueado, $txt_nombre, $txt_descripcion, $txt_estado_registro, $txt_fecha_reg, $txt_obsevaciones, $txt_id_almacen_ep, $txt_id_tipo_almacen);

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
			$res = $Custom->ValidarAlmacenLogico("update",$hidden_id_almacen_logico, $txt_codigo, $txt_bloqueado, $txt_nombre, $txt_descripcion, $txt_estado_registro, $txt_fecha_reg, $txt_obsevaciones, $txt_id_almacen_ep, $txt_id_tipo_almacen);

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

			$res = $Custom->ModificarAlmacenLogico($hidden_id_almacen_logico, $txt_codigo, $txt_bloqueado, $txt_nombre, $txt_descripcion, $txt_estado_registro, $txt_fecha_reg, $txt_obsevaciones, $txt_id_almacen_ep, $txt_id_tipo_almacen);

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
	if($sortcol == "") $sortcol = "id_almacen_logico";
	if($sortdir == "") $sortdir = "asc";
	if($criterio_filtro == "") $criterio_filtro = "0=0";

	$res = $Custom->ContarAlmacenLogico($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
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