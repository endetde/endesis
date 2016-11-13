<?php
/**
**********************************************************
Nombre de archivo:	    ActionGuardarServicioAdicional.php
Prop�sito:				Permite insertar y modificar datos en la tabla tst_linea
Tabla:					tst_tst_linea
Par�metros:				$hidden_id_linea
						$txt_empresa
						$txt_puerto_linea
						$txt_numero_telefono
						$txt_id_tipo_llamada

Valores de Retorno:    	N�mero de registros guardados
Fecha de Creaci�n:		2008-01-18 19:44:10
Versi�n:				1.0.0
Autor:					Generado Automaticamente
**********************************************************
*/
session_start();
include_once("../LibModeloSistemaTelefonico.php");

$Custom = new cls_CustomDBSistemaTelefonico();
$nombre_archivo = "ActionGuardarServicioAdicional.php";

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
			$id_servicio_adicional= $_GET["id_servicio_adicional_$j"];
			$id_asignacion_equipo = $_GET["id_asignacion_equipo_$j"];
			$fecha_ini= $_GET["fecha_ini_$j"];
			$estado_reg= $_GET["estado_reg_$j"];
			$importe_servicio= $_GET["importe_servicio_$j"];
			$detalle= $_GET["detalle_$j"];
			$id_correspondencia= $_GET["id_correspondencia_$j"];
			$fecha_fin= $_GET["fecha_fin_$j"];

		}
		else
		{
			$id_servicio_adicional= $_POST["id_servicio_adicional_$j"];
			$id_asignacion_equipo = $_POST["id_asignacion_equipo_$j"];
			$fecha_ini= $_POST["fecha_ini_$j"];
			$estado_reg= $_POST["estado_reg_$j"];
			$importe_servicio= $_POST["importe_servicio_$j"];
			$detalle= $_POST["detalle_$j"];
			$id_correspondencia= $_POST["id_correspondencia_$j"];
			$fecha_fin= $_POST["fecha_fin_$j"];
		}

		if ($id_servicio_adicional == "undefined" || $id_servicio_adicional == "")
		{
			////////////////////Inserci�n/////////////////////

			//Validaci�n de datos (del lado del servidor)
			$res = $Custom->ValidarServicioAdicional("insert",$id_servicio_adicional,$id_asignacion_equipo,$fecha_ini,$estado_reg,$importe_servicio,$detalle,$id_correspondencia,$fecha_fin);

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

			//Validaci�n satisfactoria, se ejecuta la inserci�n en la tabla tst_linea
			$res = $Custom -> InsertarServicioAdicional($id_servicio_adicional,$id_asignacion_equipo,$fecha_ini,$estado_reg,$importe_servicio,$detalle,$id_correspondencia,$fecha_fin);

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
			$res = $Custom->ValidarServicioAdicional("update",$id_servicio_adicional,$id_asignacion_equipo,$fecha_ini,$estado_reg,$importe_servicio,$detalle,$id_correspondencia,$fecha_fin);

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

			$res = $Custom->ModificarServicioAdicional($id_servicio_adicional,$id_asignacion_equipo,$fecha_ini,$estado_reg,$importe_servicio,$detalle,$id_correspondencia,$fecha_fin);

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
	if($sortcol == "") $sortcol = "id_linea";
	if($sortdir == "") $sortdir = "asc";
	if($criterio_filtro == "") $criterio_filtro = "SERVAD.id_asignacion_equipo=''$id_asignacion_equipo''";

	$res = $Custom->ContarServicioAdicional($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
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