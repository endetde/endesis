<?php
/**
**********************************************************
Nombre de archivo:	    ActionGuardarEmpleadoAfp.php
Prop�sito:				Permite insertar y modificar datos en la tabla tkp_empleado_afp
Tabla:					tkp_tkp_empleado_afp
Par�metros:				$id_empleado_afp
						$id_empleado
						$id_afp
						$nro_afp
						$fecha_reg, estado_reg

Valores de Retorno:    	N�mero de registros guardados
Fecha de Creaci�n:		12-08-2010
Versi�n:				1.0.0
Autor:					Mercedes Zambrana Meneses
**********************************************************
*/
session_start();
include_once("../LibModeloKardexPersonal.php");

$Custom = new cls_CustomDBKardexPersonal();
$nombre_archivo = "ActionGuardarEmpleadoAfp.php";

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
			$id_empleado_afp= $_GET["id_empleado_afp_$j"];
			$id_empleado= $_GET["id_empleado_$j"];
			$id_afp=$_GET["id_afp_$j"];
			$nro_afp=$_GET["nro_afp_$j"];
			$txt_fecha_reg= $_GET["txt_fecha_reg_$j"];
			$estado_reg= $_GET["estado_reg_$j"];
			$jubilado= $_GET["jubilado_$j"];
			$fecha_asignacion= $_GET["fecha_asignacion_$j"];
			$fecha_finalizacion= $_GET["fecha_finalizacion_$j"];
		}
		else
		{
			$id_empleado_afp= $_POST["id_empleado_afp_$j"];
			$id_empleado= $_POST["id_empleado_$j"];
			$id_afp=$_POST["id_afp_$j"];
			$nro_afp=$_POST["nro_afp_$j"];
			$txt_fecha_reg= $_POST["txt_fecha_reg_$j"];
			$estado_reg= $_POST["estado_reg_$j"];
			$jubilado= $_POST["jubilado_$j"];
			
			$fecha_asignacion= $_POST["fecha_asignacion_$j"];
			$fecha_finalizacion= $_POST["fecha_finalizacion_$j"];
		}

		if ($id_empleado_afp == "undefined" || $id_empleado_afp== "")
		{
			////////////////////Inserci�n/////////////////////

			//Validaci�n de datos (del lado del servidor)
			$res = $Custom->ValidarEmpleadoAfp("insert",$id_empleado_afp, $id_empleado,$id_afp,$nro_afp,$fecha_reg,$estado_reg);

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

			//Validaci�n satisfactoria, se ejecuta la inserci�n en la tabla tkp_empleado_tpm_frppa
			$res = $Custom -> InsertarEmpleadoAfp($id_empleado_afp, $id_empleado,$id_afp,$nro_afp,$fecha_reg,$estado_reg,$jubilado,$fecha_asignacion,$fecha_finalizacion);

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
			$res = $Custom->ValidarEmpleadoAfp("update",$id_empleado_afp, $id_empleado,$id_afp,$nro_afp,$fecha_reg,$estado_reg);

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

			$res = $Custom->ModificarEmpleadoAfp($id_empleado_afp, $id_empleado,$id_afp,$nro_afp,$fecha_reg,$estado_reg,$jubilado,$fecha_asignacion,$fecha_finalizacion);

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
	if($sortcol == "") $sortcol = "id_empleado_afp";
	if($sortdir == "") $sortdir = "asc";
	if($criterio_filtro == "") $criterio_filtro = "EMPLEA.id_empleado=''$m_id_empleado''";

	$res = $Custom->ContarEmpleadoAfp($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
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