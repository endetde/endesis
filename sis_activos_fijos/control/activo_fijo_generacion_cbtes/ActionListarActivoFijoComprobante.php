<?php
/**
Nombre de archivo:		ActionListarActivoFijoComprobante.php  
Prop�sito:				Permite desplegar el contenido de la tabla actif.taf_activo_fijo_comprobante
Tabla:					actif.taf_activo_fijo_comprobante
Par�metros:				$cant
						$puntero
						$sortcol
						$sortdir
						$criterio_filtro
						$id_grupo_proceso

Valores de Retorno:    	Listado de actif.taf_activo_fijo_comprobante y total de registros listados
Fecha de Creaci�n:		01/02/2013
Versi�n:				1.1.1
Autor:					Elmer Velasquez	
**********************************************************
*/
session_start();

include_once("../LibModeloActivoFijo.php");

$Custom = new cls_CustomDBActivoFijo();
$nombre_archivo = 'ActionListarActivoFijoComprobante.php';

if (!isset($_SESSION['autentificado']))
{
	$_SESSION['autentificado']="NO";
}
if($_SESSION['autentificado']=="SI")
{
	//Par�metros del filtro
	if($limit == "") $cant = 15;
	else $cant = $limit;

	if($start == "") $puntero = 0;
	else $puntero = $start;

	if($sort == "") $sortcol = 'tac.id_activo_fijo_comprobante';
	else $sortcol = $sort;

	if($dir == "") $sortdir = 'asc';
	else $sortdir = $dir;
	
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
	
	//Verifica si se manda la cantidad de filtros
	if($CantFiltros=="") $CantFiltros = 0;

	//Se obtiene el criterio del filtro con formato sql para mandar a la BD
	$cond = new cls_criterio_filtro($decodificar);
	for($i=0;$i<$CantFiltros;$i++)
	{
		$cond->add_condicion_filtro($_POST["filterCol_$i"], $_POST["filterValue_$i"], $_POST["filterAvanzado_$i"]);
	}
	$cond->add_criterio_extra("tac.id_grupo_proceso",$id_grupo_proceso);
	$criterio_filtro = $cond->obtener_criterio_filtro();
	//echo $criterio_filtro;exit;
	//Obtiene el total de los registros
	$res = $Custom->CountActivoFijoComprobante($cant,$puntero,$sortcol,$sortdir,$criterio_filtro);
	if($res) $total_registros= $Custom->salida;
	
	
	if($control_asociacion=='si')
	{
		$xml = new cls_manejo_xml('ROOT');
		$xml->add_nodo('TotalCount',$total_registros);
		$xml->mostrar_xml();
		
	}
	else{
	
	//Obtiene el conjunto de datos de la consulta
		$res = $Custom->ListarActivoFijoComprobante($cant,$puntero,$sortcol,$sortdir,$criterio_filtro);
		
		if($res)
		{
			$xml = new cls_manejo_xml('ROOT');
			$xml->add_nodo('TotalCount',$total_registros);
		
			foreach ($Custom->salida as $f)
			{
				$xml->add_rama('ROWS');
				$xml->add_nodo('id_activo_fijo_comprobante', $f["id_activo_fijo_comprobante"]);
				$xml->add_nodo('id_grupo_proceso', $f["id_grupo_proceso"]);
				$xml->add_nodo('id_comprobante', $f["id_comprobante"]);
				$xml->add_nodo('id_depto_contable', $f["id_depto_contable"]);
				$xml->add_nodo('nro_cuenta', $f["nro_cuenta"]);
				$xml->add_nodo('nombre_cuenta', $f["nombre_cuenta"]);
				$xml->add_nodo('monto', $f["monto"]);
				$xml->add_nodo('depreciacion_acumulada', $f["depreciacion_acumulada"]);
				$xml->add_nodo('estado', $f["estado"]);
				$xml->add_nodo('tipo_comprobante', $f["tipo_comprobante"]);
				$xml->add_nodo('monto_actual', $f["monto_actual"]);
				$xml->add_nodo('id_tipo_activo_cuenta', $f["id_tipo_activo_cuenta"]);
				$xml->add_nodo('id_contra_cuenta', $f["id_contra_cuenta"]);
				$xml->add_nodo('depto_contable', $f["depto_contable"]);
			
				$xml->fin_rama();
			}
			$xml->mostrar_xml();
		}
		else
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
else
{
	$resp = new cls_manejo_mensajes(true, "401");
	$resp->mensaje_error = 'MENSAJE ERROR = Usuario no Autentificado';
	$resp->origen = "ORIGEN = $nombre_archivo";
	$resp->proc = "PROC = $nombre_archivo";
	$resp->nivel = 'NIVEL = 3';
	echo $resp->get_mensaje();
	exit;

}?>