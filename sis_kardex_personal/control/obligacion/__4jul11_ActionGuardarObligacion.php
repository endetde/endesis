<?php
/**
**********************************************************
Nombre de archivo:	    ActionGuardarafp.php
Prop�sito:				Permite insertar y modificar datos en la tabla tkp_afp
Tabla:					tkp_afp
Par�metros:				$tkp_id_afp, nombre, fecha_reg, estado_reg
						

Valores de Retorno:    	N�mero de registros guardados
Fecha de Creaci�n:		2010-08-11
Versi�n:				1.0.0
Autor:					Mercedes Zambrana Meneses
**********************************************************
*/
session_start();
include_once("../LibModeloKardexPersonal.php");

$Custom = new cls_CustomDBKardexPersonal();
$nombre_archivo = "ActionGuardarObligacion.php";

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
	$vector_ids; //28feb11: Mzambrana
	//Realiza el bucle por todos los ids mandados
	for($j = 0;$j < $cont; $j++)
	{
		if ($get)
		{
		
			
			$id_obligacion=$_GET["id_obligacion_$j"];
			$id_tipo_obligacion=$_GET["id_tipo_obligacion_$j"];
			$id_planilla=$_GET["id_planilla_$j"];
			$id_comprobante=$_GET["id_comprobante_$j"];
			$id_comprobante=$_GET["id_obligacion_$j"];
			$monto=$_GET["id_obligacion_$j"];
			$estado_reg=$_GET["id_obligacion_$j"];
			$id_cuenta_bancaria=$_GET["id_cuenta_bancaria_$j"];
			$observaciones=$_GET["observaciones_$j"];
			$accion=$_GET["accion_obli_$j"];
			$tipo_pago=$_GET["tipo_pago_$j"];
			
			$mi_array=$_GET["mi_array_$j"];
			$cantidad_obligaciones=$_GET["cantidad_obligaciones_$j"];
			
			$id_cuenta=$_GET["id_cuenta_$j"];
			$id_auxiliar=$_GET["id_auxiliar_$j"];
			$fecha_pago=$_GET["fecha_pago_$j"];
		}
		else
		{
			
				
			$id_obligacion=$_POST["id_obligacion_$j"];
			$id_tipo_obligacion=$_POST["id_tipo_obligacion_$j"];
			$id_planilla=$_POST["id_planilla_$j"];
			$id_comprobante=$_POST["id_comprobante_$j"];
			$id_comprobante=$_POST["id_obligacion_$j"];
			$monto=$_POST["id_obligacion_$j"];
			$estado_reg=$_POST["id_obligacion_$j"];
			$id_cuenta_bancaria=$_POST["id_cuenta_bancaria_$j"];
			$observaciones=$_POST["observaciones_$j"];
			$accion=$_POST["accion_obli_$j"];
			$tipo_pago=$_POST["tipo_pago_$j"];
			
			$mi_array=$_POST["mi_array_$j"];
			$cantidad_obligaciones=$_POST["cantidad_obligaciones_$j"];
			
			
			$id_cuenta=$_POST["id_cuenta_$j"];
			$id_auxiliar=$_POST["id_auxiliar_$j"];
			$fecha_pago=$_POST["fecha_pago_$j"];
		}
	
	   
	   
	//}// end for -- 28feb11 
	  
	  
		if ($id_obligacion == "undefined" || $id_obligacion== "")
		{
			////////////////////Inserci�n/////////////////////
			
			//Validaci�n satisfactoria, se ejecuta la inserci�n en la tabla tsg_persona y tkp_relacion_familiar
			$res = $Custom -> InsertarObligacion($id_obligacion,$id_tipo_obligacion,$id_planilla,$id_comprobante,$monto,$estado_reg,$observaciones,$id_cuenta_bancaria,$tipo_pago);
			
				if(!$res){
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
			
		
	if($accion=='pago'){ //if($_SESSION["ss_id_usuario"]==120){ echo $fecha_pago; exit;} 
		$res = $Custom->PagarObligacion($id_obligacion,$id_tipo_obligacion,$id_planilla,$id_comprobante,$monto,$estado_reg,$observaciones,$id_cuenta_bancaria,$tipo_pago,$mi_array,$cantidad_obligaciones
		//, $fecha_pago
		);

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
	}else{
			$res = $Custom->ModificarObligacion($id_obligacion,$id_tipo_obligacion,$id_planilla,$id_comprobante,$monto,$estado_reg,$observaciones,$id_cuenta_bancaria,$tipo_pago,$id_cuenta,$id_auxiliar);

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
	}

	}//END FOR

	//Guarda el mensaje de �xito de la operaci�n realizada
	if($cont > 1) $mensaje_exito = "Se guardaron todos los datos.";
	else $mensaje_exito = $Custom->salida[1];

	//Obtiene el total de los registros. Par�metros del filtro
	if($cant == "") $cant = 100;
	if($puntero == "") $puntero = 0;
	if($sortcol == "") $sortcol = "id_obligacion";
	if($sortdir == "") $sortdir = "asc";
	if($criterio_filtro == "") $criterio_filtro = "0=0";

	$res = $Custom->ContarObligacion($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
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