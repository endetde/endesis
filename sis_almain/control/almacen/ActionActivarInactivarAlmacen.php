<?php
ob_start('limpiar');
function limpiar($buffer) {
	return trim($buffer);
}
?>
<?php

/**
 * **********************************************************
 * Nombre de archivo: ActionActivarInactivarAlmacen.php
 * Prop�sito:				Permite activar o inactivar registros de la tabla tal_almacen
 * Tabla:					tal_almacen
 * Par�metros:				$id_almacen	--> id de almacen
 * $txt_id_usuario_asignacion
 *
 * Valores de Retorno: N�mero de registros
 * Fecha de Creaci�n:		25-07-2013
 * Versi�n:				1.0.0
 * Autor:					Ruddy Lujan Bravo
 * *********************************************************
 */
session_start();

include_once ("../LibModeloAlma.php");

$Custom = new cls_CustomDBAlma();
$nombre_archivo = 'ActionActivarInactivarAlmacen.php';

if (! isset($_SESSION['autentificado'])) {
	$_SESSION['autentificado'] = "NO";
}

if ($_SESSION['autentificado'] == "SI") {
	$get = true;
	if (sizeof($_GET) > 0) {
		$get = true;
	} elseif (sizeof($_POST) > 0) {
		$get = false;
	} else {
		$resp = new cls_manejo_mensajes(true, "406");
		$resp->mensaje_error = "MENSAJE ERROR = No existen datos para cambiar.";
		$resp->origen = "ORIGEN = $nombre_archivo";
		$resp->proc = "PROC = $nombre_archivo";
		$resp->nivel = "NIVEL = 4";
		echo $resp->get_mensaje();
		exit();
	}
	
	if ($get) {
		$id_almacen = $_GET["id_almacen"];
	} else {
		$id_almacen = $_POST["id_almacen"];
	}
	
	if ($id_almacen == "undefined" || $id_almacen == "") {
		$resp = new cls_manejo_mensajes(true, "406");
		$resp->mensaje_error = "MENSAJE ERROR = No existe el almacen  especificado para cambiar.";
		$resp->origen = "ORIGEN = $nombre_archivo";
		$resp->proc = "PROC = $nombre_archivo";
		$resp->nivel = "NIVEL = 4";
		echo $resp->get_mensaje();
		exit();
	} else {
		$res = $Custom->ActivarInactivarAlmacen($id_almacen);
		if (! $res) {
			$resp = new cls_manejo_mensajes(true, "406");
			$resp->mensaje_error = $Custom->salida[1];
			$resp->origen = $Custom->salida[2];
			$resp->proc = $Custom->salida[3];
			$resp->nivel = $Custom->salida[4];
			$resp->query = $Custom->query;
			echo $resp->get_mensaje();
			exit();
		}
	}
	
	// Guarda el mensaje de �xito de la operaci�n realizada
	if ($cont > 1)
		$mensaje_exito = 'Se cambiaron los registros especificados.';
	else
		$mensaje_exito = $Custom->salida[1];
		
		// Obtiene el total de los registros. Par�metros del filtro
	if ($cant == "")
		$cant = 100;
	if ($puntero == "")
		$puntero = 0;
	if ($sortcol == "")
		$sortcol = 'id_almacen';
	if ($sortdir == "")
		$sortdir = 'asc';
	if ($criterio_filtro == "")
		$criterio_filtro = '0=0';
	
	$res = $Custom->ContarAlmacen($cant, $puntero, $sortcol, $sortdir, $criterio_filtro, $id_financiador, $id_regional, $id_programa, $id_proyecto, $id_actividad);
	if ($res)
		$total_registros = $Custom->salida;
		
		// Arma el xml para desplegar el mensaje
	$resp = new cls_manejo_mensajes(false);
	$resp->add_nodo('TotalCount', $total_registros);
	$resp->add_nodo('mensaje', $mensaje_exito);
	$resp->add_nodo('tiempo_resp', '200');
	echo $resp->get_mensaje();
	exit();
} else {
	$resp = new cls_manejo_mensajes(true, "401");
	$resp->mensaje_error = "MENSAJE ERROR = Usuario no Autentificado";
	$resp->origen = "ORIGEN = $nombre_archivo";
	$resp->proc = "PROC = $nombre_archivo";
	$resp->nivel = "NIVEL = 1";
	echo $resp->get_mensaje();
	exit();
}
?>
<?php ob_end_flush();?>