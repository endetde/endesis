<?php
ob_start('limpiar');
function limpiar($buffer) {
	return trim($buffer);
}
?> 
<?php

/**
 * **********************************************************
 * Nombre de archivo: ActionGuardarTramoUnidadConstructiva.php
 * Prop�sito:				Permite insertar y modificar datos en la tal_tramo_unidad_constructiva
 * Tabla:					tal_tramo_unidad_constructiva
 * Valores de Retorno: N�mero de registros guardados
 * Fecha de Creaci�n:		24-12-2014
 * Versi�n:					1.0.0
 * Autor:					UNKNOW
 * *********************************************************
 */
session_start();
include_once ("../LibModeloAlma.php");

$Custom = new cls_CustomDBAlma();
$nombre_archivo = "ActionGuardarTramoUnidadConstructiva.php";
if (! isset($_SESSION["autentificado"])) {
	$_SESSION["autentificado"] = "NO";
}
if ($_SESSION["autentificado"] == "SI") 
{
	// Verifica si los datos vienen por POST o GET
	if (sizeof($_GET) > 0) {
		$get = true;
		$cont = 1;
		
		// Verifica si se har� o no la decodificaci�n(s�lo pregunta en caso del GET)
		// valores permitidos de $cod -> "si", "no"
		switch ($cod) {
			case "si" :
				$decodificar = true;
				break;
			case "no" :
				$decodificar = false;
				break;
			default :
				$decodificar = true;
				break;
		}
	} elseif (sizeof($_POST) > 0) {
		$get = false;
		$cont = $_POST["cantidad_ids"];
		
		// Por Post siempre se decodifica
		$decodificar = true;
	} else {
		$resp = new cls_manejo_mensajes(true, "406");
		$resp->mensaje_error = "MENSAJE ERROR = No existen datos para almacenar.";
		$resp->origen = "ORIGEN = ";
		$resp->proc = "PROC = ";
		$resp->nivel = "NIVEL = 4";
		echo $resp->get_mensaje();
		exit();
	}
	
	// Envia al Custom la bandera que indica si se decodificar� o no
	$Custom->decodificar = $decodificar;
	// Realiza el bucle por todos los ids mandados
	for($j = 0; $j < $cont; $j ++) 
	{
		if ($get) {
			$id_tramo_uc = $_GET["hidden_id_tramo_unidad_constructiva_$j"];
			$id_tramo = $_GET["m_id_tramo"];
			$id_uc= $_GET["txt_id_unidad_constructiva_$j"];	
			$estado = $_GET["txt_estado_$j"];
			
		} else 
		{
			$id_tramo_uc = $_POST["hidden_id_tramo_unidad_constructiva_$j"];
			$id_tramo = $_POST["m_id_tramo"];
			$id_uc = $_POST["txt_id_unidad_constructiva_$j"];
			$estado = $_POST["txt_estado_$j"];
		}
		
		if ($id_tramo_uc == "undefined" || $id_tramo_uc == "") 
		{
			// //////////////////Inserci�n/////////////////////
			
			// Validaci�n de datos (del lado del servidor)
			$res = $Custom->ValidarTramoUC("insert",$id_tramo_uc,$id_tramo, $id_uc,$estado);
			
			if (! $res) {
				// Error de validaci�n
				$resp = new cls_manejo_mensajes(true, "406");
				$resp->mensaje_error = $Custom->salida[1];
				$resp->origen = $Custom->salida[2];
				$resp->proc = $Custom->salida[3];
				$resp->nivel = $Custom->salida[4];
				echo $resp->get_mensaje();
				exit();
			}
			// Validaci�n satisfactoria, se ejecuta la inserci�n en la tabla tal_almacen
			$res = $Custom->InsertarTramoUC($id_tramo_uc, $id_tramo, $id_uc, $estado);
			if (! $res) {
				// Se produjo un error
				$resp = new cls_manejo_mensajes(true, "406");
				$resp->mensaje_error = $Custom->salida[1] . " (iteraci�n $cont)";
				$resp->origen = $Custom->salida[2];
				$resp->proc = $Custom->salida[3];
				$resp->nivel = $Custom->salida[4];
				$resp->query = $Custom->query;
				echo $resp->get_mensaje();
				exit();
			}
		} 
		else 
		{ // /////////////////////Modificaci�n////////////////////
		         // Validaci�n de datos (del lado del servidor)
			$res = $Custom->ValidarTramoUC("update",$id_tramo_uc, $id_tramo, $id_uc, $estado);
			
			if (! $res) {

				$resp = new cls_manejo_mensajes(true, "406");
				$resp->mensaje_error = $Custom->salida[1];
				$resp->origen = $Custom->salida[2];
				$resp->proc = $Custom->salida[3];
				$resp->nivel = $Custom->salida[4];
				echo $resp->get_mensaje();
				exit();
			}
			
			$res = $Custom->ModificarTramoUC($id_tramo_uc, $id_tramo, $id_uc, $estado);
			
			if (! $res) {
				// Se produjo un error
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
	} // END FOR
	  
	// Guarda el mensaje de �xito de la operaci�n realizada
	if ($cont > 1)
		$mensaje_exito = "Se guardaron todos los datos.";
	else
		$mensaje_exito = $Custom->salida[1];
		
		// Obtiene el total de los registros. Par�metros del filtro
	if ($cant == "")
		$cant = 100;
	if ($puntero == "")
		$puntero = 0;
	if ($sortcol == "")
		$sortcol = "id_tramo_unidad_constructiva";
	if ($sortdir == "")
		$sortdir = "asc";
	if ($criterio_filtro == "")
		$criterio_filtro =$criterio_filtro." 0=0 AND tuc.id_tramo like (".$id_tramo.")";

	$res = $Custom->ContarTramoUnidadConstructiva($cant, $puntero, $sortcol, $sortdir, $criterio_filtro, $id_financiador, $id_regional, $id_programa, $id_proyecto, $id_actividad);
	if ($res)
		$total_registros = $Custom->salida;
		
		// Arma el xml para desplegar el mensaje
	$resp = new cls_manejo_mensajes(false);
	$resp->add_nodo("TotalCount", $total_registros);
	$resp->add_nodo("mensaje", $mensaje_exito);
	$resp->add_nodo("tiempo_resp", "200");
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