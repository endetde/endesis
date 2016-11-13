<?php
/**
**********************************************************
Nombre de archivo:	    ActionGuardarCartaRegistro.php
Prop�sito:				Permite insertar y modificar datos en la tabla tts_carta
Tabla:					tts_tts_carta
Par�metros:				$id_carta
						$id_fina_regi_prog_proy_acti
						$id_unidad_organizacional
						$id_moneda
						$clase_carta
						$tipo_carta
						$estado_carta
						$id_cuenta_bancaria
						$id_institucion
						$id_proveedor
						$fecha_inicio
						$fecha_vence
						$obs_carta
						$importe_carta
						$importe_pagado
						$id_cheque
						$id_comprobante
						$fk_carta

Valores de Retorno:    	N�mero de registros guardados
Fecha de Creaci�n:		2008-11-18 20:39:05
Versi�n:				1.0.0
Autor:					Generado Automaticamente
**********************************************************
*/
session_start();
include_once("../LibModeloTesoreria.php");

$Custom = new cls_CustomDBTesoreria();
$nombre_archivo = "ActionGuardarCartaRegistro.php";

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
			$id_carta=$_GET["id_carta_$j"];
			$id_fina_regi_prog_proy_acti=$_GET["id_fina_regi_prog_proy_acti_$j"];
			$id_unidad_organizacional=$_GET["id_unidad_organizacional_$j"];
			$id_moneda=$_GET["id_moneda_$j"];
			$clase_carta=$_GET["clase_carta_$j"];
			$tipo_carta=$_GET["tipo_carta_$j"];
			$estado_carta=$_GET["estado_carta_$j"];
			$id_cuenta_bancaria=$_GET["id_cuenta_bancaria_$j"];
			$id_institucion=$_GET["id_institucion_$j"];
			$id_proveedor= $_GET["id_proveedor_$j"];
			$fecha_inicio= $_GET["fecha_inicio_$j"];
			$fecha_vence= $_GET["fecha_vence_$j"];
			$obs_carta= $_GET["obs_carta_$j"];
			$importe_carta= $_GET["importe_carta_$j"];
			$importe_pagado= $_GET["importe_pagado_$j"];
			$id_cheque= $_GET["id_cheque_$j"];
			$id_comprobante= $_GET["id_comprobante_$j"];
			$fk_carta= $_GET["fk_carta_$j"];
            $id_financiador= $_GET["txt_id_financiador_$j"];
			$id_regional	= $_GET["txt_id_regional_$j"];
			$id_programa	= $_GET["txt_id_programa_$j"];
			$id_proyecto	= $_GET["txt_id_proyecto_$j"];
			$id_actividad	= $_GET["txt_id_actividad_$j"];
		}
		else
		{
			$id_carta         =$_POST["id_carta_$j"];
			$id_fina_regi_prog_proy_acti=$_POST["id_fina_regi_prog_proy_acti_$j"];
			$id_unidad_organizacional=$_POST["id_unidad_organizacional_$j"];
			$id_moneda      =$_POST["id_moneda_$j"];
			$clase_carta     =$_POST["clase_carta_$j"];
			$tipo_carta     =$_POST["tipo_carta_$j"];
			$estado_carta   =$_POST["estado_carta_$j"];
			$id_cuenta_bancaria=$_POST["id_cuenta_bancaria_$j"];
			$id_institucion =$_POST["id_institucion_$j"];
			$id_proveedor   =$_POST["id_proveedor_$j"];
			$fecha_inicio   =$_POST["fecha_inicio_$j"];
			$fecha_vence    =$_POST["fecha_vence_$j"];
			$obs_carta      =$_POST["obs_carta_$j"];
			$importe_carta  =$_POST["importe_carta_$j"];
			$importe_pagado =$_POST["importe_pagado_$j"];
			$id_cheque      =$_POST["id_cheque_$j"];
			$id_comprobante =$_POST["id_comprobante_$j"];
			$fk_carta		=$_POST["fk_carta_$j"];
            $id_financiador = $_POST["txt_id_financiador_$j"];
			$id_regional	= $_POST["txt_id_regional_$j"];
			$id_programa	= $_POST["txt_id_programa_$j"];
			$id_proyecto	= $_POST["txt_id_proyecto_$j"];
			$id_actividad	= $_POST["txt_id_actividad_$j"];
		}

	
		if ($id_carta == "undefined" || $id_carta == "")
		{
			////////////////////Inserci�n/////////////////////

			//Validaci�n de datos (del lado del servidor)
			$res = $Custom->ValidarCartaRegistro("insert",$id_carta,$id_fina_regi_prog_proy_acti,$id_unidad_organizacional,$id_moneda,$clase_carta,$tipo_carta,$estado_carta,$id_cuenta_bancaria,$id_institucion,$id_proveedor,$fecha_inicio,$fecha_vence,$obs_carta,$importe_carta,$importe_pagado,$id_cheque,$id_comprobante,$fk_carta,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);

			if(!$res)
			{	//Error de validaci�n
				$resp = new cls_manejo_mensajes(true, "406");
				$resp->mensaje_error = $Custom->salida[1];
				$resp->origen = $Custom->salida[2];
				$resp->proc = $Custom->salida[3];
				$resp->nivel = $Custom->salida[4];
				echo $resp->get_mensaje();
				exit;
			}

			//Validaci�n satisfactoria, se ejecuta la inserci�n en la tabla tts_carta
			$res = $Custom -> InsertarCartaRegistro($id_carta,$id_fina_regi_prog_proy_acti,$id_unidad_organizacional,$id_moneda,$clase_carta,$tipo_carta,$estado_carta,$id_cuenta_bancaria,$id_institucion,$id_proveedor,$fecha_inicio,$fecha_vence,$obs_carta,$importe_carta,$importe_pagado,$id_cheque,$id_comprobante,$fk_carta,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);

			if(!$res)
			{	//Se produjo un error
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
			$res = $Custom->ValidarCartaRegistro("update",$id_carta,$id_fina_regi_prog_proy_acti,$id_unidad_organizacional,$id_moneda,$clase_carta,$tipo_carta,$estado_carta,$id_cuenta_bancaria,$id_institucion,$id_proveedor,$fecha_inicio,$fecha_vence,$obs_carta,$importe_carta,$importe_pagado,$id_cheque,$id_comprobante,$fk_carta,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);

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

			$res = $Custom->ModificarCartaRegistro($id_carta,$id_fina_regi_prog_proy_acti,$id_unidad_organizacional,$id_moneda,$clase_carta,$tipo_carta,$estado_carta,$id_cuenta_bancaria,$id_institucion,$id_proveedor,$fecha_inicio,$fecha_vence,$obs_carta,$importe_carta,$importe_pagado,$id_cheque,$id_comprobante,$fk_carta,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);

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
	if($sortcol == "") $sortcol = "id_carta";
	if($sortdir == "") $sortdir = "asc";
	if($criterio_filtro == "") $criterio_filtro = "0=0";

	$res = $Custom->ContarCartaRegistro($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
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