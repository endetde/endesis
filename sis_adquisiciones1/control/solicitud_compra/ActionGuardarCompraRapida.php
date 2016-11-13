<?php
/**
**********************************************************
Nombre de archivo:	    ActionGuardarCompraRapida.php
Prop�sito:				Permite insertar y modificar datos en la tabla tad_solicitud_compra
Tabla:					tad_tad_solicitud_compra
Par�metros:				$id_solicitud_compra

Valores de Retorno:    	N�mero de registros guardados
Fecha de Creaci�n:		2008-07-01 17:05:11
Versi�n:				1.0.0
Autor:					Generado Automaticamente
**********************************************************
*/
session_start();
include_once("../LibModeloAdquisiciones.php");

$Custom = new cls_CustomDBAdquisiciones();
$nombre_archivo = "ActionGuardarCompraRapida.php";

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
			$id_solicitud_compra= $_GET["id_solicitud_compra_$j"];
			$codigo_proceso= $_GET["codigo_proceso_$j"];
			$observaciones_proceso= $_GET["observaciones_proceso_$j"];
			$simplificada= $_GET["simplificada_$j"];
			$id_comprador= $_GET["id_comprador_$j"];
			$tipo_recibo= $_GET["tipo_recibo_$j"];
			$pago_variable= $_GET["pago_variable_$j"];
			$fecha_reg= $_GET["fecha_reg_$j"];

		}
		else
		{
			$id_solicitud_compra=$_POST["id_solicitud_compra_$j"];
			$codigo_proceso= $_POST["codigo_proceso_$j"];
			$observaciones_proceso= $_POST["observaciones_proceso_$j"];
			$simplificada= $_POST["simplificada_$j"];
			$id_comprador= $_POST["id_comprador_$j"];
			$tipo_recibo= $_POST["tipo_recibo_$j"];
			$pago_variable = $_POST["pago_variable_$j"];
			$fecha_reg= $_POST["fecha_reg_$j"];
		}

		
	       if($simplificada=='NO'){
			$res = $Custom->ModificarCompraRapida($id_solicitud_compra,$codigo_proceso,$observaciones_proceso,$_SESSION['ss_id_empresa'],$pago_variable,$fecha_reg);
	       }
	       else{
	       	$res = $Custom->ModificarCompraRapidaSimplificada($id_solicitud_compra,$codigo_proceso,$observaciones_proceso,$_SESSION['ss_id_empresa'],$id_comprador,$tipo_recibo,$fecha_reg);
	     
	       }

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
		

	}//END FOR

	//Guarda el mensaje de �xito de la operaci�n realizada
	if($cont > 1) $mensaje_exito = "Se guardaron todos los datos.";
	else $mensaje_exito = $Custom->salida[1];

	//Obtiene el total de los registros. Par�metros del filtro
	if($cant == "") $cant = 100;
	if($puntero == "") $puntero = 0;
	if($sortcol == "") $sortcol = "id_solicitud_compra";
	if($sortdir == "") $sortdir = "asc";
	if($criterio_filtro == "") $criterio_filtro = "0=0";

	$id_empresa=$_SESSION["ss_id_empresa"];
	$res = $Custom->ContarCompraRapida($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad,$id_empresa);
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