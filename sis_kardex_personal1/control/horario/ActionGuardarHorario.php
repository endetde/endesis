<?php
/**
**********************************************************
Nombre de archivo:	    ActionGuardarHorario.php
Prop�sito:				Permite insertar y modificar datos en la tabla tkp_horario
Tabla:					tkp_tkp_horario
Par�metros:				$hidden_id_horario
						$txt_id_tipo_horario
						$txt_id_vacacion

Valores de Retorno:    	N�mero de registros guardados
Fecha de Creaci�n:		2010-08-10 09:06:57
Versi�n:				1.0.0
Autor:					Fernando Prudencio Cardona
**********************************************************
*/
session_start();
include_once("../LibModeloKardexPersonal.php");

$Custom = new cls_CustomDBKardexPersonal();
$nombre_archivo = "ActionGuardarHorario.php";

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
			$hidden_id_horario= $_GET["hidden_id_horario_$j"];
			$hidden_id_tipo_horario= $_GET["hidden_id_tipo_horario_$j"];
			$hidden_id_vacacion= $_GET["hidden_id_vacacion_$j"];
			$txt_fecha_inicio= $_GET["txt_fecha_inicio_$j"];
			$txt_fecha_fin= $_GET["txt_fecha_fin_$j"];
			$txt_numero_periodo= $_GET["txt_numero_periodo_$j"];
			$txt_horas_por_dia= $_GET["txt_horas_por_dia_$j"];
			$txt_hora_ini_p1= $_GET["txt_hora_ini_p1_$j"];
			$txt_hora_fin_p1= $_GET["txt_hora_fin_p1_$j"];
            $txt_hora_ini_p2= $_GET["txt_hora_ini_p2_$j"];
			$txt_hora_fin_p2= $_GET["txt_hora_fin_p2_$j"];
			$txt_tipo_periodo= $_GET["txt_tipo_periodo_$j"];
			$txt_observaciones= $_GET["txt_observaciones_$j"];
			$txt_repite_anualmente= $_GET["txt_repite_anualmente_$j"];
			$txt_estado_reg= $_GET["txt_estado_reg_$j"];
		}
		else
		{
			$hidden_id_horario= $_POST["hidden_id_horario_$j"];
			$hidden_id_tipo_horario= $_POST["hidden_id_tipo_horario_$j"];
			$hidden_id_vacacion= $_POST["hidden_id_vacacion_$j"];
			$txt_fecha_inicio= $_POST["txt_fecha_inicio_$j"];
			$txt_fecha_fin= $_POST["txt_fecha_fin_$j"];
			$txt_numero_periodo= $_POST["txt_numero_periodo_$j"];
			$txt_horas_por_dia= $_POST["txt_horas_por_dia_$j"];
			$txt_hora_ini_p1= $_POST["txt_hora_ini_p1_$j"];
			$txt_hora_fin_p1= $_POST["txt_hora_fin_p1_$j"];
            $txt_hora_ini_p2= $_POST["txt_hora_ini_p2_$j"];
			$txt_hora_fin_p2= $_POST["txt_hora_fin_p2_$j"];
			$txt_tipo_periodo= $_POST["txt_tipo_periodo_$j"];
			$txt_observaciones= $_POST["txt_observaciones_$j"];
			$txt_repite_anualmente= $_POST["txt_repite_anualmente_$j"];
            $txt_estado_reg= $_POST["txt_estado_reg_$j"];

		}

		if ($hidden_id_horario == "undefined" || $hidden_id_horario == "")
		{
			////////////////////Inserci�n/////////////////////

			//Validaci�n de datos (del lado del servidor)
			$res = $Custom->ValidarHorario("insert",$hidden_id_horario,$hidden_id_tipo_horario,$hidden_id_vacacion,$txt_fecha_inicio,$txt_fecha_fin,$txt_numero_periodo,$txt_horas_por_dia,$txt_hora_ini_p1,$txt_hora_fin_p1,$txt_hora_ini_p2,$txt_hora_fin_p2,$txt_tipo_periodo,$txt_observaciones,$txt_repite_anualmente);

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

			//Validaci�n satisfactoria, se ejecuta la inserci�n en la tabla tkp_empleado
			$res = $Custom -> InsertarHorario($hidden_id_horario,$hidden_id_tipo_horario,$hidden_id_vacacion,$txt_fecha_inicio,$txt_fecha_fin,$txt_numero_periodo,$txt_horas_por_dia,$txt_hora_ini_p1,$txt_hora_fin_p1,$txt_hora_ini_p2,$txt_hora_fin_p2,$txt_tipo_periodo,$txt_observaciones,$txt_repite_anualmente,$txt_estado_reg);

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
			$res = $Custom->ValidarHorario("update",$hidden_id_horario,$hidden_id_tipo_horario,$hidden_id_vacacion,$txt_fecha_inicio,$txt_fecha_fin,$txt_numero_periodo,$txt_horas_por_dia,$txt_hora_ini_p1,$txt_hora_fin_p1,$txt_hora_ini_p2,$txt_hora_fin_p2,$txt_tipo_periodo,$txt_observaciones,$txt_repite_anualmente);

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

			$res = $Custom->ModificarHorario($hidden_id_horario,$hidden_id_tipo_horario,$hidden_id_vacacion,$txt_fecha_inicio,$txt_fecha_fin,$txt_numero_periodo,$txt_horas_por_dia,$txt_hora_ini_p1,$txt_hora_fin_p1,$txt_hora_ini_p2,$txt_hora_fin_p2,$txt_tipo_periodo,$txt_observaciones,$txt_repite_anualmente,$txt_estado_reg);

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
	if($sortcol == "") $sortcol = "TIPHOR.nombre";
	if($sortdir == "") $sortdir = "asc";
	if($criterio_filtro == "") $criterio_filtro = "0=0";

	$res = $Custom->ContarListaHorario($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
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