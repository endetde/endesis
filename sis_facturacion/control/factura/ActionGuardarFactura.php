<?php
/*
**********************************************************
Nombre de archivo:	    ActionGuardarFactura.php
Prop�sito:				Permite insertar y modificar a factura
Tabla:					tfv_factura
Fecha de Creaci�n:		2014.05
Versi�n:				1.0.0
Autor:					MTSL
**********************************************************
*/
session_start();
include_once("../LibModeloFactur.php");

$Custom = new cls_CustomDBFactur();
$nombre_archivo = 'ActionGuardarFactura.php';

if (!isset($_SESSION['autentificado']))
{
	$_SESSION['autentificado']="NO";
}
if($_SESSION['autentificado']=="SI")
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
		$cont =  $_POST['cantidad_ids'];
		
		//Por Post siempre se decodifica
		$decodificar = true;
	}
	else
	{
		$resp = new cls_manejo_mensajes(true, "406");
		$resp->mensaje_error = "MENSAJE ERROR = No existen datos para almacenar.";
		$resp->origen = "ORIGEN = $nombre_archivo";
		$resp->proc = "PROC = $nombre_archivo";
		$resp->nivel = 'NIVEL = 4';
		echo $resp->get_mensaje();
		exit;
	}
	
	//Envia al Custom la bandera que indica si se decodificar� o no
	$Custom->decodificar = $decodificar;

	//Realiza el bucle por todos los ids mandados
	for($j = 0;$j < $cont; $j++)
	{
		if ($get){
			$id_factura = $_GET["id_factura_$j"];
			$id_gestion = $_GET["id_gestion_$j"];
			$id_cliente = $_GET["id_cliente_$j"];
			$id_dosifica = $_GET["id_dosifica_$j"];
			$id_moneda = $_GET["id_moneda_$j"];
			$id_depto = $_GET["id_depto_$j"];
			$fac_tcambio = $_GET["fac_tcambio_$j"];
			$fac_fecha = $_GET["fac_fecha_$j"];
			$fac_concepto = $_GET["fac_concepto_$j"];
			$fac_formula = $_GET["fac_formula_$j"];	
		}
		else{
			$id_factura = $_POST["id_factura_$j"];
			$id_gestion = $_POST["id_gestion_$j"];
			$id_cliente = $_POST["id_cliente_$j"];
			$id_dosifica = $_POST["id_dosifica_$j"];
			$id_moneda = $_POST["id_moneda_$j"];
			$id_depto = $_POST["id_depto_$j"];
			$fac_tcambio = $_POST["fac_tcambio_$j"];
			$fac_fecha = $_POST["fac_fecha_$j"];
			$fac_concepto = $_POST["fac_concepto_$j"];
			$fac_formula = $_POST["fac_formula_$j"];
		}

		if ($id_factura == "undefined" || $id_factura == "")
		{
			////////////////////Inserci�n/////////////////////
			//Validaci�n de datos (del lado del servidor)
			$res = $Custom->ValidarFactura("insert", $id_factura, $id_gestion, $id_cliente, $id_dosifica, $id_moneda, $id_depto, $fac_tcambio, $fac_fecha, $fac_concepto, $fac_formula);
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

			//Validaci�n satisfactoria, se ejecuta la inserci�n del cambio de lectura
			$res = $Custom -> InsertarFactura($id_factura, $id_gestion, $id_cliente, $id_dosifica, $id_moneda, $id_depto, $fac_tcambio, $fac_fecha, $fac_concepto, $fac_formula);
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
			//echo $txt_clave_activa;
			
			$res = $Custom->ValidarFactura("update", $id_factura, $id_gestion, $id_cliente, $id_dosifica, $id_moneda, $id_depto, $fac_tcambio, $fac_fecha, $fac_concepto, $fac_formula);
			if(!$res)
			{
				//Error de validaci�n
				$resp = new cls_manejo_mensajes(true, "406");
				$resp->mensaje_error = $Custom->salida[1];
				$resp->origen = $Custom->salida[2];
				$resp->proc = $Custom->salida[3];
				$resp->nivel =$Custom->salida[4];
				echo $resp->get_mensaje();
				exit;
			}

			$res = $Custom->ModificarFactura($id_factura, $id_gestion, $id_cliente, $id_dosifica, $id_moneda, $id_depto, $fac_tcambio, $fac_fecha, $fac_concepto, $fac_formula);
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
	if($cont > 1) $mensaje_exito = 'Se guardaron todos los datos.';
	else $mensaje_exito = $Custom->salida[1];

	//Obtiene el total de los registros. Par�metros del filtro
	if($cant == "") $cant = 100;
	if($puntero == "") $puntero = 0;
	if($sortcol == "") $sortcol = 'dos.id_factura';
	if($sortdir == "") $sortdir = 'asc';
	if($criterio_filtro == "") $criterio_filtro = '0=0';

	$res = $Custom->ContarFactura($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
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