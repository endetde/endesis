<?php
/*
**********************************************************
Nombre de archivo:	    ActionSaveParamGenerales.php
Prop�sito:				Permite insertar y modificar Parametros Generales
Tabla:					tsg_parametro_general
Par�metros:				$hidden_id_parametros_generales	--> id del parametro general
						$descripcion
						$txt_id_usuario_asignacion

Valores de Retorno:    	N�mero de registros
Fecha de Creaci�n:		24-05-2007
Versi�n:				
Autor:					Anacleto Rojas Veizaga
**********************************************************
*/
session_start();
include_once("../LibModeloSeguridad.php");

$Custom = new cls_CustomDBSeguridad();
$nombre_archivo = 'ActionSaveParamGenerales.php';

if (!isset($_SESSION['autentificado']))
{
	$_SESSION['autentificado']="NO";
}
if($_SESSION['autentificado']=="SI")
{
	//Verifica si los datos vienen por post o get
	if (sizeof($_GET) >0)
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
	elseif(sizeof($_POST) >0)
	{
		$get=false;
		$cont =  $_POST['cantidad_ids'];
		
		//Por Post siempre se decodifica
		$decodificar = true;
	}
	else
	{
		$resp = new cls_manejo_mensajes(true, "406");
		$resp->mensaje_error = "MENSAJE ERROR = No existen datos para almacenar";
		$resp->origen = "ORIGEN= $nombre_archivo";
		$resp->proc = "PROC =$nombre_archivo";
		$resp->nivel = 'NIVEL = 4';
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
			$hidden_id_parametro_general = $_GET["hidden_id_parametro_general_$j"];
			$txt_nombre_atributo = $_GET["txt_nombre_atributo_$j"];
			$txt_valor_atributo = $_GET["txt_valor_atributo_$j"];
			$txt_descripcion = $_GET["txt_descripcion_$j"];
			
		}
		else
		{
			$hidden_id_parametro_general = $_POST["hidden_id_parametro_general_$j"];
			$txt_nombre_atributo = $_POST["txt_nombre_atributo_$j"];
			$txt_valor_atributo = $_POST["txt_valor_atributo_$j"];
			$txt_descripcion = $_POST["txt_descripcion_$j"];
		
		}

	
		if ($hidden_id_parametro_general == "undefined" || $hidden_id_parametro_general =="")
		{
			///////////////////Inserci�n
			//Validaci�n de datos (del lado del servidor)
		
					
			$res = $Custom->ValidarParametroGeneral("insert",$hidden_id_parametro_general,$txt_nombre_atributo,$txt_valor_atributo,$txt_descripcion);
			
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

			$res = $Custom ->CrearParametroGeneral($hidden_id_parametro_general,$txt_nombre_atributo,$txt_valor_atributo,$txt_descripcion);
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
		else
		{	//Modificaci�n
			//Validaci�n de datos (del lado del servidor)
			$res = $Custom->ValidarParametroGeneral("update",$hidden_id_parametro_general,$txt_nombre_atributo,$txt_valor_atributo,$txt_descripcion);
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
				
			$res = $Custom->ModificarParametroGeneral($hidden_id_parametro_general,$txt_nombre_atributo,$txt_valor_atributo,$txt_descripcion);
			if(!$res)
			{
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

	/***************no entra aqui cuando es $_GET*************/
	///Guarda el mensaje de �xito de la operaci�n realizada
	if($cont > 1) $mensaje_exito = 'Se guardaron todos los datos.';
	else $mensaje_exito = $Custom->salida[1];
	
	//Obtiene el total de los registros. Par�metros del filtro
	if($cant == "") $cant = 100;
	if($puntero == "") $puntero = 0;
	if($sortcol == "") $sortcol = 'descripcion';
	if($sortdir == "") $sortdir = 'asc';
	if($criterio_filtro == "") $criterio_filtro = '0=0';

	$res = $Custom->ContarListaParametroGeneral($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
	if($res) $total_registros = $Custom->salida;

	//Arma el xml para desplegar el mensaje
	$resp = new cls_manejo_mensajes(false);
	$resp->add_nodo('TotalCount', $total_registros);
	$resp->add_nodo('mensaje', $mensaje_exito);
	$resp->add_nodo('tiempo_resp', '200');
	echo $resp->get_mensaje();
	exit;
}
else
{
	$resp = new cls_manejo_mensajes(true, "401");
	$resp->mensaje_error = 'MENSAJE ERROR = Usuario no Autentificado';
	$resp->origen = "ORIGEN = $nombre_archivo";
	$resp->proc = "PROC = $nombre_archivo";
	$resp->nivel = 'NIVEL = 1';
	echo $resp->get_mensaje();
	exit;
}
?>