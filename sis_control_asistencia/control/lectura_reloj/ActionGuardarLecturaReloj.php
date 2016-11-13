<?php
/*
**********************************************************
Nombre de archivo:	    ActionGuardarLecturaReloj.php
Prop�sito:				Permite insertar y modificar Lecturas Reloj
Tabla:					tca_lectura_reloj
Par�metros:				$hidden_id_lectura_reloj	--> id de la lectura
						$descripcion
						$txt_id_usuario_asignacion

Valores de Retorno:    	N�mero de registros
Fecha de Creaci�n:		24-05-2007
Versi�n:				
Autor:					Fernando Prudencio Cardona
**********************************************************
*/
session_start();
include_once("../LibModeloControlAsistencia.php");
///////////
include_once("../../lib/funciones.inc.php");
		$f = new funciones();
		///////////////
$Custom = new cls_CustomDBControlAsistencia();
$nombre_archivo = 'ActionGuardarLecturaReloj.php';

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
			$hidden_id_lectura_reloj = $_GET["hidden_id_lectura_reloj_$j"];
			$txt_codigo_empleado = $_GET["txt_codigo_empleado_$j"];
			$txt_fecha = $_GET["txt_fecha_$j"];
			$txt_hora = $_GET["txt_hora_$j"];
			$txt_tipo_movimiento = $_GET["txt_tipo_movimiento_$j"];
			$txt_observaciones = $_GET["txt_observaciones_$j"];
			$txt_turno = $_GET["txt_turno_$j"];
		
		}
		else
		{
			$hidden_id_lectura_reloj = $_POST["hidden_id_lectura_reloj_$j"];
			$txt_codigo_empleado = $_POST["txt_codigo_empleado_$j"];
			$txt_fecha = $_POST["txt_fecha_$j"];
			$txt_hora = $_POST["txt_hora_$j"];
			$txt_tipo_movimiento = $_POST["txt_tipo_movimiento_$j"];
			$txt_observaciones = $_POST["txt_observaciones_$j"];
			$txt_turno = $_POST["txt_turno_$j"];
			
		}

		if ($hidden_id_lectura_reloj == "undefined" || $hidden_id_lectura_reloj =="")
		{
			///////////////////Inserci�n
			//Validaci�n de datos (del lado del servidor)
		
					
			$res = $Custom->ValidarLecturaReloj("insert",$hidden_id_lectura_reloj,$txt_codigo_empleado,$txt_fecha,$txt_hora,$txt_tipo_movimiento,$txt_observaciones,$txt_turno);
			
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

			$res = $Custom ->CrearLecturaReloj($hidden_id_lectura_reloj,$txt_codigo_empleado,$txt_fecha,$txt_hora,$txt_tipo_movimiento,$txt_observaciones,$txt_turno);
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
			$res = $Custom->ValidarLecturaReloj("update",$hidden_id_lectura_reloj,$txt_codigo_empleado,$txt_fecha,$txt_hora,$txt_tipo_movimiento,$txt_observaciones,$txt_turno);
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
				
			$res = $Custom->ModificarLecturaReloj($hidden_id_lectura_reloj,$txt_codigo_empleado,$txt_fecha,$txt_hora,$txt_tipo_movimiento,$txt_observaciones,$txt_turno);
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
	if($sortcol == "") $sortcol = 'motivo';
	if($sortdir == "") $sortdir = 'asc';
	if($criterio_filtro == "") $criterio_filtro = '0=0';

	$res = $Custom->ContarListaLecturaReloj($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
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