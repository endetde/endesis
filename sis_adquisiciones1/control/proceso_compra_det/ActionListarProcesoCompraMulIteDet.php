<?php
/**
**********************************************************
Nombre de archivo:	    ActionListarProcesoCompraMulDet.php
Prop�sito:				Permite realizar el listado en tad_proceso_compra_det
Tabla:					t_tad_proceso_compra_det
Par�metros:				$cant
						$puntero
						$sortcol
						$sortdir
						$criterio_filtro

Valores de Retorno:    	Listado de Procesos y total de registros listados
Fecha de Creaci�n:		2008-05-20 17:42:45
Versi�n:				1.0.0
Autor:					Generado Automaticamente
**********************************************************
*/
session_start();
include_once('../LibModeloAdquisiciones.php');

$Custom = new cls_CustomDBAdquisiciones();
$nombre_archivo = 'ActionListarProcesoCompraMulIteDet .php';

if (!isset($_SESSION['autentificado']))
{
	$_SESSION['autentificado']='NO';
}
if($_SESSION['autentificado']=='SI')
{
	//Par�metros del filtro
	if($limit == '') $cant = 15;
	else $cant = $limit;

	if($start == '') $puntero = 0;
	else $puntero = $start;

	if($sort == '') $sortcol = 'id_proceso_compra_det';
	else $sortcol = $sort;

	if($dir == '') $sortdir = 'asc';
	else $sortdir = $dir;

	//Verifica si se har� o no la decodificaci�n(s�lo pregunta en caso del GET)
	//valores permitidos de $cod -> 'si', 'no'

	switch ($cod)
	{
		case 'si':
			$decodificar = true;
			break;
		case 'no':
			$decodificar = false;
			break;
		default:
			$decodificar = true;
			break;
	}

	//Verifica si se manda la cantidad de filtros
	if($CantFiltros=='') $CantFiltros = 0;

	//Se obtiene el criterio del filtro con formato sql para mandar a la BD
	$cond = new cls_criterio_filtro($decodificar);
	for($i=0;$i<$CantFiltros;$i++)
	{
		$cond->add_condicion_filtro($_POST["filterCol_$i"], $_POST["filterValue_$i"], $_POST["filterAvanzado_$i"]);
	}

	$cond->add_criterio_extra("PROCOMDET.id_proceso_compra",$m_id_proceso_compra);

	$criterio_filtro = $cond -> obtener_criterio_filtro();
	//Obtiene el criterio de orden de columnas
	$crit_sort = new cls_criterio_sort($sortcol,$sortdir,'ProcesoCompraMulIteDet');
	$sortcol = $crit_sort->get_criterio_sort();


	//Obtiene el total de los registros
	$res = $Custom -> ContarProcesoCompraMulIteDet($cant ,$puntero,$sortcol,$sortdir,$criterio_filtro,$hidden_ep_id_financiador,$hidden_ep_id_regional,$hidden_ep_id_programa,$hidden_ep_id_proyecto,$hidden_ep_id_actividad);

	if($res) $total_registros= $Custom->salida;

	//Obtiene el conjunto de datos de la consulta
	$res = $Custom->ListarProcesoCompraMulIteDet($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$hidden_ep_id_financiador,$hidden_ep_id_regional,$hidden_ep_id_programa,$hidden_ep_id_proyecto,$hidden_ep_id_actividad);

	if($res)
	{
		$xml = new cls_manejo_xml('ROOT');
		$xml->add_nodo('TotalCount',$total_registros);

		foreach ($Custom->salida as $f)
		{
			$xml->add_rama('ROWS');
			$xml->add_nodo('id_proceso_compra_det',$f['id_proceso_compra_det']);
			$xml->add_nodo('id_proceso_compra',$f['id_proceso_compra']);
			$xml->add_nodo('cantidad',$f['cantidad']);
			$xml->add_nodo('precio_referencial_total',$f['precio_referencial_total']);
			$xml->add_nodo('estado_reg',$f['estado_reg']);
			$xml->add_nodo('id_item',$f['id_item']);
			$xml->add_nodo('id_unidad_medida_base',$f['id_unidad_medida_base']);
			$xml->add_nodo('codigo_item',$f['codigo_item']);
			$xml->add_nodo('nombre_item',$f['nombre_item']);
			$xml->add_nodo('nombre_id3',$f['nombre_id3']);
			$xml->add_nodo('nombre_id2',$f['nombre_id2']);
			$xml->add_nodo('nombre_id1',$f['nombre_id1']);
			$xml->add_nodo('nombre_subg',$f['nombre_subg']);
			$xml->add_nodo('nombre_grupo',$f['nombre_grupo']);
			$xml->add_nodo('nombre_supg',$f['nombre_supg']);
			$xml->add_nodo('nombre_unid_base',$f['nombre_unid_base']);
			$xml->add_nodo('precio_total_moneda_seleccionada',$f['precio_total_moneda_seleccionada']);
			$xml->add_nodo('descripcion',$f['descripcion']);
			$xml->add_nodo('especificaciones_tecnicas',$f['especificaciones_tecnicas']);
			$xml->fin_rama();
		}
		$xml->mostrar_xml();
	}
	else
	{
		//Se produjo un error
		$resp = new cls_manejo_mensajes(true,'406');
		$resp->mensaje_error = $Custom->salida[1];
		$resp->origen = $Custom->salida[2];
		$resp->proc = $Custom->salida[3];
		$resp->nivel = $Custom->salida[4];
		$resp->query = $Custom->query;
		echo $resp->get_mensaje();
		exit;
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