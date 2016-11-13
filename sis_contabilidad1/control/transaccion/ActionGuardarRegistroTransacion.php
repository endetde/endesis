<?php
/**
**********************************************************
Nombre de archivo:	    ActionGuardarRegistroTransacion.php
Prop�sito:				Permite insertar y modificar datos en la tabla tct_transaccion
Tabla:					tct_tct_transaccion
Par�metros:				$id_transaccion
						$id_comprobante
						$id_fuente_financiamiento
						$id_fina_regi_prog_proy_acti
						$id_unidad_organizacional
						$id_cuenta
						$id_partida
						$id_auxiliar
						$id_orden_trabajo
						$id_oec
						$concepto_tran

Valores de Retorno:    	N�mero de registros guardados
Fecha de Creaci�n:		2008-09-16 17:57:09
Versi�n:				1.0.0
Autor:					Generado Automaticamente
**********************************************************
*/
session_start();
include_once("../LibModeloContabilidad.php");

$Custom = new cls_CustomDBContabilidad();
$nombre_archivo = "ActionGuardarRegistroTransacion.php";

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
		{	$id_transaccion =  $_GET["id_transaccion_$j"];
			$concepto_tran =   $_GET["concepto_tran_$j"];
			$fecha_trans =   $_GET["fecha_trans_$j"];
			$id_auxiliar =   $_GET["id_auxiliar_$j"];
			$id_comprobante =   $_GET["id_comprobante_$j"];
			$m_id_comprobante= $_POST["m_id_combrobante"];
			$id_cuenta =   $_GET["id_cuenta_$j"];
			$id_fuente_financiamiento =   $_GET["id_fuente_financiamiento_$j"];
			$id_moneda =   $_GET["id_moneda_$j"];
			$id_oec =   $_GET["id_oec_$j"];
			$id_orden_trabajo =   $_GET["id_orden_trabajo_$j"];
			$id_partida =   $_GET["id_partida_$j"];
			$id_plantilla =   $_GET["id_plantilla_$j"];
			
			$id_unidad_organizacional =   $_GET["id_unidad_organizacional_$j"];
			$importe_debe =   $_GET["importe_debe_$j"];
			$importe_haber =   $_GET["importe_haber_$j"];
			$tipo_Cambio =   $_GET["tipo_Cambio_$j"];
			$tipo_cambio_origen =   $_GET["tipo_cambio_origen_$j"];
			$id_fina_regi_prog_proy_acti =   $_GET["id_fina_regi_prog_proy_acti_$j"];
			$importe_ejecucion =   $_GET["importe_ejecucion_$j"];
			
			


		}
		else
		{	$id_transaccion =  $_POST["id_transaccion_$j"];
			$concepto_tran =  $_POST["concepto_tran_$j"];
			$fecha_trans =  $_POST["fecha_trans_$j"];
			$id_auxiliar =  $_POST["id_auxiliar_$j"];
			$id_comprobante =  $_POST["id_comprobante_$j"];
			
			$m_id_comprobante= $_POST["m_id_combrobante"];
			$id_cuenta =  $_POST["id_cuenta_$j"];
			$id_fuente_financiamiento =  $_POST["id_fuente_financiamiento_$j"];
			$id_moneda =  $_POST["id_moneda_$j"];
			$id_oec =  $_POST["id_oec_$j"];
			$id_orden_trabajo =  $_POST["id_orden_trabajo_$j"];
			$id_partida =  $_POST["id_partida_$j"];
			$id_plantilla =  $_POST["id_plantilla_$j"];
			
			$id_unidad_organizacional =  $_POST["id_unidad_organizacional_$j"];
			$importe_debe =  $_POST["importe_debe_$j"];
			$importe_haber =  $_POST["importe_haber_$j"];
			$tipo_Cambio =  $_POST["tipo_Cambio_$j"];
			$tipo_cambio_origen =  $_POST["tipo_cambio_origen_$j"];
			$id_fina_regi_prog_proy_acti =   $_POST["id_fina_regi_prog_proy_acti_$j"];
			$importe_ejecucion =   $_POST["importe_ejecucion_$j"];


		}
		//echo ($id_comprobante." es id comprobante ".$m_id_comprobante); exit() ;
		if($id_transaccion==0)$id_transaccion="undefined";
		if($id_comprobante==0)$id_comprobante=$m_id_comprobante;
		if ($id_transaccion == "undefined" || $id_transaccion == "")
		{
			////////////////////Inserci�n/////////////////////

		
			//Validaci�n de datos (del lado del servidor)
			$res = $Custom->ValidarRegistroTransacion("insert",$id_transaccion , $id_auxiliar , $id_comprobante , $id_cuenta , 
			$id_fuente_financiamiento , $id_moneda , $id_oec , $id_orden_trabajo , $id_partida , $id_plantilla  , $id_unidad_organizacional , 
			$importe_debe , $importe_haber , $tipo_Cambio , $tipo_cambio_origen , 
			$id_fina_regi_prog_proy_acti , $concepto_tran , $fecha_trans );

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

			//Validaci�n satisfactoria, se ejecuta la inserci�n en la tabla tct_transaccion
			$res = $Custom -> InsertarRegistroTransacion($id_transaccion , $id_auxiliar , $id_comprobante , $id_cuenta , 
			$id_fuente_financiamiento , $id_moneda , $id_oec , $id_orden_trabajo , $id_partida , $id_plantilla  , $id_unidad_organizacional , 
			$importe_debe , $importe_haber , $tipo_Cambio , $tipo_cambio_origen , 
			$id_fina_regi_prog_proy_acti , $concepto_tran , $fecha_trans ,$importe_ejecucion);

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
			$res = $Custom->ValidarRegistroTransacion("update",$id_transaccion , $id_auxiliar , $id_comprobante , $id_cuenta , 
			$id_fuente_financiamiento , $id_moneda , $id_oec , $id_orden_trabajo , $id_partida , $id_plantilla  , $id_unidad_organizacional , 
			$importe_debe , $importe_haber , $tipo_Cambio , $tipo_cambio_origen , 
			$id_fina_regi_prog_proy_acti , $concepto_tran , $fecha_trans );

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

			$res = $Custom->ModificarRegistroTransacion($id_transaccion , $id_auxiliar , $id_comprobante , $id_cuenta , 
			$id_fuente_financiamiento , $id_moneda , $id_oec , $id_orden_trabajo , $id_partida , $id_plantilla  , $id_unidad_organizacional , 
			$importe_debe , $importe_haber , $tipo_Cambio , $tipo_cambio_origen , 
			$id_fina_regi_prog_proy_acti , $concepto_tran , $fecha_trans,$importe_ejecucion);

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
	if($sortcol == "") $sortcol = "id_transaccion";
	if($sortdir == "") $sortdir = "asc";
	if($criterio_filtro == "") $criterio_filtro = "0=0";

	$res = $Custom->ContarRegistroTransacion($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad,$id_comprobante_0,$id_moneda_0);
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