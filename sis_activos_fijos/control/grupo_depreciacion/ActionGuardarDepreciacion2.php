<?php
/**
**********************************************************
Nombre de archivo:	    ActionGuardarDepreciacion2.php
Prop�sito:				Permite insertar y modificar datos en la tabla taf_grupo_depreciacion
Tabla:					taf_taf_grupo_depreciacion
Par�metros:				$id_grupo_depreciacion
						$ano_fin
						$mes_fin
						$id_depto
						$estado
						$id_usuario_reg
						$fecha_reg
						$id_usuario_reg2

Valores de Retorno:    	N�mero de registros guardados
Fecha de Creaci�n:		2010-07-20 14:54:38
Versi�n:				1.0.0
Autor:					Generado Automaticamente
**********************************************************
*/
session_start();
include_once("../LibModeloActivoFijo.php");

$Custom = new cls_CustomDBActivoFijo();
$nombre_archivo = "ActionGuardarDepreciacion2.php";

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
			$id_grupo_depreciacion= $_GET["id_grupo_depreciacion_$j"];
			$ano_fin= $_GET["ano_fin_$j"];
			$mes_fin= $_GET["mes_fin_$j"];
			$id_depto= $_GET["id_depto_$j"];
			$estado= $_GET["estado_$j"];
			$id_usuario_reg= $_GET["id_usuario_reg_$j"];
			$fecha_reg= $_GET["fecha_reg_$j"];
			$id_usuario_reg2= $_GET["id_usuario_reg2_$j"];
			$proyecto= $_GET["proyecto_$j"];

		}
		else
		{
			$id_grupo_depreciacion=$_POST["id_grupo_depreciacion_$j"];
			$ano_fin=$_POST["ano_fin_$j"];
			$mes_fin=$_POST["mes_fin_$j"];
			$id_depto=$_POST["id_depto_$j"];
			$estado=$_POST["estado_$j"];
			$id_usuario_reg=$_POST["id_usuario_reg_$j"];
			$fecha_reg=$_POST["fecha_reg_$j"];
			$id_usuario_reg2=$_POST["id_usuario_reg2_$j"];
			$proyecto= $_POST["proyecto_$j"];

		}

		if ($id_grupo_depreciacion == "undefined" || $id_grupo_depreciacion == "")
		{
			////////////////////Inserci�n/////////////////////

			//Validaci�n de datos (del lado del servidor)
			$res = $Custom->ValidarDepreciacion2("insert",$id_grupo_depreciacion,$ano_fin,$mes_fin,$id_depto,$estado,$id_usuario_reg,$fecha_reg,$id_usuario_reg2);

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

			//Validaci�n satisfactoria, se ejecuta la inserci�n en la tabla taf_grupo_depreciacion
			$res = $Custom -> InsertarDepreciacion2($id_grupo_depreciacion,$ano_fin,$mes_fin,$id_depto,$estado,$id_usuario_reg,$fecha_reg,$id_usuario_reg2,$proyecto);

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
		{	if($estado=='depreciado'){
				$time_fin=mktime(0,0,0,$mes_fin +1,0,$ano_fin);
				// Obtenemos la fecha
				//$dia_mes_ini = date("d",$time_ini);
				$dia_mes_fin = date("d",$time_fin);
			
				//$txt_fecha_ini = "$txt_mes_ini-$dia_mes_ini-$txt_gestion_ini";
				$fecha_fin = "$mes_fin-$dia_mes_fin-$ano_fin";
			
						
				//Obtiene el c�digo temporal con el cual generar� el detalle de la depreciaci�n
				$fecha = getdate();
				$codigo_temp = $_SESSION["ss_id_usuario"] .$fecha['hours'] .$fecha['minutes'] .$fecha['seconds'] .$fecha['mday'] .$fecha['mon'] .$fecha['year'];

			}
			
			
			///////////////////////Modificaci�n////////////////////
			
			//Validaci�n de datos (del lado del servidor)
			$res = $Custom->ValidarDepreciacion2("update",$id_grupo_depreciacion,$ano_fin,$mes_fin,$id_depto,$estado,$id_usuario_reg,$fecha_reg,$id_usuario_reg2);

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

			$res = $Custom->ModificarDepreciacion2($id_grupo_depreciacion,$ano_fin,$mes_fin,$id_depto,$estado,$id_usuario_reg,$fecha_reg,$id_usuario_reg2,$fecha_fin,$codigo_temp,$proyecto);

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
	if($sortcol == "") $sortcol = "id_grupo_depreciacion";
	if($sortdir == "") $sortdir = "asc";
	if($criterio_filtro == "") $criterio_filtro = "0=0";

	$res = $Custom->ContarDepreciacion2($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
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