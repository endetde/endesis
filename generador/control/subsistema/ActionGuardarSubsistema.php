<?php
/**
**********************************************************
Nombre de archivo:	    ActionGuardarSubsistema.php
Prop�sito:				Permite insertar y modificar datos en la tabla tsg_subsistema
Tabla:					tsg_tsg_subsistema
Par�metros:				$hidden_id_subsistema
						$txt_nombre_corto
						$txt_nombre_largo
						$txt_descripcion
						$txt_version_desarrollo
						$txt_desarrolladores
						$txt_fecha_reg
						$txt_hora_reg
						$txt_fecha_ultima_modificacion
						$txt_hora_ultima_modificacion
						$txt_observaciones
	
Valores de Retorno:    	N�mero de registros guardados
Fecha de Creaci�n:		2007-10-10 11:02:01
Versi�n:				1.0.0
Autor:					Generado Automaticamente
**********************************************************
*/
session_start();
include_once("../LibModeloSeguridad.php");

$Custom = new cls_CustomDBSeguridad();
$nombre_archivo = "ActionGuardarSubsistema.php";

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
			$hidden_id_subsistema						= $_GET["hidden_id_subsistema_$j"];
			$txt_nombre_corto						= $_GET["txt_nombre_corto_$j"];
			$txt_nombre_largo						= $_GET["txt_nombre_largo_$j"];
			$txt_descripcion						= $_GET["txt_descripcion_$j"];
			$txt_version_desarrollo						= $_GET["txt_version_desarrollo_$j"];
			$txt_desarrolladores						= $_GET["txt_desarrolladores_$j"];
			$txt_fecha_reg						= $_GET["txt_fecha_reg_$j"];
			$txt_hora_reg						= $_GET["txt_hora_reg_$j"];
			$txt_fecha_ultima_modificacion						= $_GET["txt_fecha_ultima_modificacion_$j"];
			$txt_hora_ultima_modificacion						= $_GET["txt_hora_ultima_modificacion_$j"];
			$txt_observaciones						= $_GET["txt_observaciones_$j"];
							
		}
		else
		{
			$hidden_id_subsistema						= $_POST["hidden_id_subsistema_$j"];
			$txt_nombre_corto						= $_POST["txt_nombre_corto_$j"];
			$txt_nombre_largo						= $_POST["txt_nombre_largo_$j"];
			$txt_descripcion						= $_POST["txt_descripcion_$j"];
			$txt_version_desarrollo						= $_POST["txt_version_desarrollo_$j"];
			$txt_desarrolladores						= $_POST["txt_desarrolladores_$j"];
			$txt_fecha_reg						= $_POST["txt_fecha_reg_$j"];
			$txt_hora_reg						= $_POST["txt_hora_reg_$j"];
			$txt_fecha_ultima_modificacion						= $_POST["txt_fecha_ultima_modificacion_$j"];
			$txt_hora_ultima_modificacion						= $_POST["txt_hora_ultima_modificacion_$j"];
			$txt_observaciones						= $_POST["txt_observaciones_$j"];
			
		}

		if ($hidden_id_subsistema == "undefined" || $hidden_id_subsistema == "")
		{
			////////////////////Inserci�n/////////////////////

			//Validaci�n de datos (del lado del servidor)
			$res = $Custom->ValidarSubsistema("insert",$hidden_id_subsistema, $txt_nombre_corto, $txt_nombre_largo, $txt_descripcion, $txt_version_desarrollo, $txt_desarrolladores, $txt_fecha_reg, $txt_hora_reg, $txt_fecha_ultima_modificacion, $txt_hora_ultima_modificacion, $txt_observaciones);
			
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

			//Validaci�n satisfactoria, se ejecuta la inserci�n en la tabla tsg_subsistema
			$res = $Custom -> InsertarSubsistema($hidden_id_subsistema, $txt_nombre_corto, $txt_nombre_largo, $txt_descripcion, $txt_version_desarrollo, $txt_desarrolladores, $txt_fecha_reg, $txt_hora_reg, $txt_fecha_ultima_modificacion, $txt_hora_ultima_modificacion, $txt_observaciones);

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
			$res = $Custom->ValidarSubsistema("update",$hidden_id_subsistema, $txt_nombre_corto, $txt_nombre_largo, $txt_descripcion, $txt_version_desarrollo, $txt_desarrolladores, $txt_fecha_reg, $txt_hora_reg, $txt_fecha_ultima_modificacion, $txt_hora_ultima_modificacion, $txt_observaciones);

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

			$res = $Custom->ModificarSubsistema($hidden_id_subsistema, $txt_nombre_corto, $txt_nombre_largo, $txt_descripcion, $txt_version_desarrollo, $txt_desarrolladores, $txt_fecha_reg, $txt_hora_reg, $txt_fecha_ultima_modificacion, $txt_hora_ultima_modificacion, $txt_observaciones);

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
	if($sortcol == "") $sortcol = "id_subsistema";
	if($sortdir == "") $sortdir = "asc";
	if($criterio_filtro == "") $criterio_filtro = "0=0";

	$res = $Custom->ContarSubsistema($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
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