<?php
/**
**********************************************************
Nombre de archivo:	    ActionGuardarDatosValIng.php
Prop�sito:				Permite insertar y modificar datos en la tabla tal_ingreso
Tabla:					tal_tal_ingreso
Par�metros:				$hidden_id_ingreso
						$txt_correlativo_ord_ing
						$txt_correlativo_ing
						$txt_codigo
						$txt_descripcion
						$txt_observaciones
						$txt_costo_total
						$txt_contabilizar
						$txt_contabilizado
						$txt_estado_ingreso
						$txt_estado_registro
						$txt_cod_inf_tec
						$txt_resumen_inf_tec
						$txt_fecha_borrador
						$txt_fecha_pendiente
						$txt_fecha_aprobado_rechazado
						$txt_fecha_ing_fisico
						$txt_fecha_ing_valorado
						$txt_fecha_finalizado_cancelado
						$txt_fecha_reg
						$txt_id_responsable_almacen
						$txt_id_proveedor
						$txt_id_contratista
						$txt_id_empleado
						$txt_id_almacen_logico
						$txt_id_firma_autorizada
						$txt_id_institucion
						$txt_id_motivo_ingreso

Valores de Retorno:    	N�mero de registros guardados
Fecha de Creaci�n:		2007-10-18 20:49:02
Versi�n:				1.0.0
Autor:					Generado Automaticamente
**********************************************************
*/
session_start();
include_once("../rcm_LibModeloAlmacenes.php");

$Custom = new cls_CustomDBAlmacenes();
$nombre_archivo = "ActionGuardarDatosValIng.php";

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
			$hidden_id_ingreso= $_GET["hidden_id_ingreso_$j"];
			$txt_importacion= $_GET["txt_importacion_$j"];
			$txt_flete= $_GET["txt_flete_$j"];
			$txt_seguro= $_GET["txt_seguro_$j"];
			$txt_gastos_alm= $_GET["txt_gastos_alm_$j"];
			$txt_gastos_aduana= $_GET["txt_gastos_aduana_$j"];
			$txt_iva= $_GET["txt_iva_$j"];
			$txt_rep_form= $_GET["txt_rep_form_$j"];
			$txt_peso_neto= $_GET["txt_peso_neto_$j"];
			$txt_id_moneda_import= $_GET["txt_id_moneda_import_$j"];
			$txt_id_moneda_nacionaliz= $_GET["txt_id_moneda_nacionaliz_$j"];
			$txt_dui= $_GET["txt_dui_$j"];
		}
		else
		{
			$hidden_id_ingreso= $_POST["hidden_id_ingreso_$j"];
			$txt_importacion= $_POST["txt_importacion_$j"];
			$txt_flete= $_POST["txt_flete_$j"];
			$txt_seguro= $_POST["txt_seguro_$j"];
			$txt_gastos_alm= $_POST["txt_gastos_alm_$j"];
			$txt_gastos_aduana= $_POST["txt_gastos_aduana_$j"];
			$txt_iva= $_POST["txt_iva_$j"];
			$txt_rep_form= $_POST["txt_rep_form_$j"];
			$txt_peso_neto= $_POST["txt_peso_neto_$j"];
			$txt_id_moneda_import= $_POST["txt_id_moneda_import_$j"];
			$txt_id_moneda_nacionaliz= $_POST["txt_id_moneda_nacionaliz_$j"];
			$txt_dui= $_POST["txt_dui_$j"];
		}

		if ($hidden_id_ingreso == "undefined" || $hidden_id_ingreso == "")
		{
			////////////////////Inserci�n/////////////////////

			//Validaci�n de datos (del lado del servidor)
			/*$res = $Custom->ValidarIngreso("insert",$hidden_id_ingreso, $txt_correlativo_ord_ing,$txt_correlativo_ing,$txt_descripcion,$txt_costo_total,$txt_contabilizar,$txt_contabilizado,$txt_estado_ingreso,$txt_estado_registro,$txt_cod_inf_tec,$txt_resumen_inf_tec,$txt_fecha_borrador,$txt_fecha_pendiente,$txt_fecha_aprobado_rechazado,$txt_fecha_ing_fisico,$txt_fecha_ing_valorado,$txt_fecha_finalizado_cancelado,$txt_fecha_reg,$txt_id_responsable_almacen,$txt_id_proveedor,$txt_id_contratista,$txt_id_empleado,$txt_id_almacen_logico,$txt_id_firma_autorizada,$txt_id_institucion,$txt_id_motivo_ingreso_cuenta);

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
			}*/

			//Validaci�n satisfactoria, se ejecuta la inserci�n en la tabla tal_ingreso
			$res = $Custom -> InsertarValoracionIngreso($hidden_id_ingreso,$txt_importacion,$txt_flete,$txt_seguro,$txt_gastos_alm,$txt_gastos_aduana,$txt_iva,$txt_rep_form,$txt_peso_neto,$txt_id_moneda_import,$txt_id_moneda_nacionaliz,$txt_dui);

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
			/*$res = $Custom->ValidarIngreso("update",$hidden_id_ingreso, $txt_correlativo_ord_ing, $txt_correlativo_ing, $txt_descripcion, $txt_costo_total, $txt_contabilizar, $txt_contabilizado, $txt_estado_ingreso, $txt_estado_registro, $txt_cod_inf_tec, $txt_resumen_inf_tec, $txt_fecha_borrador, $txt_fecha_pendiente, $txt_fecha_aprobado_rechazado, $txt_fecha_ing_fisico, $txt_fecha_ing_valorado, $txt_fecha_finalizado_cancelado, $txt_fecha_reg, $txt_id_responsable_almacen, $txt_id_proveedor, $txt_id_contratista, $txt_id_empleado, $txt_id_almacen_logico, $txt_id_firma_autorizada, $txt_id_institucion, $txt_id_motivo_ingreso_cuenta);

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
			}*/

			$res = $Custom -> InsertarValoracionIngreso($hidden_id_ingreso,$txt_importacion,$txt_flete,$txt_seguro,$txt_gastos_alm,$txt_gastos_aduana,$txt_iva,$txt_rep_form,$txt_peso_neto,$txt_id_moneda_import,$txt_id_moneda_nacionaliz,$txt_dui);

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

	}//END FOR

	//Guarda el mensaje de �xito de la operaci�n realizada
	if($cont > 1) $mensaje_exito = "Se guardaron todos los datos.";
	else $mensaje_exito = $Custom->salida[1];

	//Obtiene el total de los registros. Par�metros del filtro
	if($cant == "") $cant = 100;
	if($puntero == "") $puntero = 0;
	if($sortcol == "") $sortcol = "id_ingreso";
	if($sortdir == "") $sortdir = "asc";
	if($criterio_filtro == "") $criterio_filtro = "0=0";

	$res = $Custom->ContarIngresoProy($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
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