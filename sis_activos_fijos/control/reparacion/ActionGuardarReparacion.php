<?php
/**
**********************************************************
Nombre de archivo:	    ActionGuardarReparacion.php
Prop�sito:				Permite insertar y modificar datos en la tabla tad_reparacion
Tabla:					tad_tad_Reparacion
Par�metros:				$id_Reparacion
						$nombre
						$descripcion
						$fecha_reg
						$id_tipo_activo

Valores de Retorno:    	N�mero de registros guardados
Fecha de Creaci�n:		26/07/2010
Versi�n:				1.0.0
Autor:					AVQ
**********************************************************
*/
session_start();
include_once("../LibModeloActivoFijo.php");

$Custom = new cls_CustomDBActivoFijo();
$nombre_archivo = "ActionGuardarReparacion.php";

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
			$hidden_id_reparacion = $_GET["id_reparacion_$j"];
			$txt_fecha_desde = $_GET["txt_fecha_desde_$j"];
			$txt_fecha_hasta = $_GET["txt_fecha_hasta_$j"];
			$txt_problema = $_GET["txt_problema_$j"];
			$txt_fecha_reg = $_GET["txt_fecha_reg_$j"];
			$txt_observaciones = $_GET["txt_observaciones_$j"];
			$txt_estado = $_GET["txt_estado_$j"];
			$hidden_id_activo_fijo = $_GET["id_activo_fijo_$j"];
			$hidden_id_persona = $_GET["hidden_id_persona_$j"];
			$hidden_id_institucion = $_GET["hidden_id_institucion_$j"];

		}
		else
		{
			$hidden_id_reparacion = $_POST["id_reparacion_$j"];
			$txt_fecha_desde = $_POST["txt_fecha_desde_$j"];
			$txt_fecha_hasta = $_POST["txt_fecha_hasta_$j"];
			$txt_problema = $_POST["txt_problema_$j"];
			$txt_fecha_reg = $_POST["txt_fecha_reg_$j"];
			$txt_observaciones = $_POST["txt_observaciones_$j"];
			$txt_estado = $_POST["txt_estado_$j"];
			$hidden_id_activo_fijo = $_POST["id_activo_fijo_$j"];
			$hidden_id_persona = $_POST["hidden_id_persona_$j"];
			$hidden_id_institucion = $_POST["hidden_id_institucion_$j"];

		}
	
/*echo "muestra el id_tipo Reparacion".$id_tipo_Reparacion;
exit;*/
	if ($hidden_id_reparacion == "undefined" || $hidden_id_reparacion == "")
		{
			////////////////////Inserci�n/////////////////////

			//Validaci�n de datos (del lado del servidor)
		
			$res = $Custom->ValidarReparacion("insert", $hidden_id_reparacion, $txt_fecha_desde, $txt_fecha_hasta, $txt_problema, $txt_fecha_reg, $txt_observaciones, $txt_estado, $hidden_id_activo_fijo, $hidden_id_persona, $hidden_id_institucion);
				
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

			//Validaci�n satisfactoria, se ejecuta la inserci�n en la tabla tad_Reparacion
			$res = $Custom -> InsertarReparacion($hidden_id_reparacion, $txt_fecha_desde, $txt_fecha_hasta, $txt_problema, $txt_fecha_reg, $txt_observaciones, $txt_estado, $hidden_id_activo_fijo, $hidden_id_persona, $hidden_id_institucion);

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
			$res = $Custom->ValidarReparacion("update", $hidden_id_reparacion, $txt_fecha_desde, $txt_fecha_hasta, $txt_problema, $txt_fecha_reg, $txt_observaciones, $txt_estado, $hidden_id_activo_fijo, $hidden_id_persona, $hidden_id_institucion);

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

			$res = $Custom->ModificarReparacion( $hidden_id_reparacion, $txt_fecha_desde, $txt_fecha_hasta, $txt_problema, $txt_fecha_reg, $txt_observaciones, $txt_estado, $hidden_id_activo_fijo, $hidden_id_persona, $hidden_id_institucion);

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
	if($sortcol == "") $sortcol = "id_reparacion";
	if($sortdir == "") $sortdir = "asc";
	if($criterio_filtro == "") $criterio_filtro = " rep.id_activo_fijo=$hidden_id_activo_fijo";

	$res = $Custom->ContarListaReparacion($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
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