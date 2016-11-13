<?php
/**
**********************************************************
Nombre de archivo:	    ActionListarInventarioDet.php
Prop�sito:				Permite realizar el listado en tal_inventario_det
Tabla:					t_tal_inventario_det
Par�metros:				$cant
						$puntero
						$sortcol
						$sortdir
						$criterio_filtro

Valores de Retorno:    	Listado de Procesos y total de registros listados
Fecha de Creaci�n:		2007-10-31 16:33:35
Versi�n:				1.0.0
Autor:					Generado Automaticamente
**********************************************************
*/
session_start();
include_once('../scg_LibModeloAlmacenes.php');

$Custom = new cls_CustomDBAlmacenes();
$nombre_archivo = 'ActionListarInventarioDet_det.php';
if (!isset($_SESSION['autentificado']))
{	$_SESSION['autentificado']='NO';
}
if($_SESSION['autentificado']=='SI')
{//Par�metros del filtro
	if($limit == '') $cant = 15;
	else $cant = $limit;
	if($start == '') $puntero = 0;
	else $puntero = $start;
	if($sort == '') $sortcol = 'id_inventario_det';
	else $sortcol = $sort;
	if($dir == '') $sortdir = 'asc';
	else $sortdir = $dir;
	//Verifica si se har� o no la decodificaci�n(s�lo pregunta en caso del GET)
	//valores permitidos de $cod -> 'si', 'no'
		switch ($cod)
	{	case 'si':
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
	{	$cond->add_condicion_filtro($_POST["filterCol_$i"], $_POST["filterValue_$i"], $_POST["filterAvanzado_$i"]);
	}
	
	$cond->add_criterio_extra("INVDET.id_inventario",$m_id_inventario);
    $criterio_filtro = $cond -> obtener_criterio_filtro();
	//Obtiene el criterio de orden de columnas
	$crit_sort = new cls_criterio_sort($sortcol,$sortdir,'InventarioDet');
	$sortcol = $crit_sort->get_criterio_sort();
	$id_inventario=$m_id_inventario;
	
	$res = $Custom -> ContarInventarioDet($cant ,$puntero,$sortcol,$sortdir,$criterio_filtro,$hidden_ep_id_financiador,$hidden_ep_id_regional,$hidden_ep_id_programa,$hidden_ep_id_proyecto,$hidden_ep_id_actividad,$id_inventario);
	if($res) $total_registros= $Custom->salida;
	//Obtiene el conjunto de datos de la consulta
	$res = $Custom->ListarInventarioDet($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$hidden_ep_id_financiador,$hidden_ep_id_regional,$hidden_ep_id_programa,$hidden_ep_id_proyecto,$hidden_ep_id_actividad,$id_inventario);
		if($res)
	{	$xml = new cls_manejo_xml('ROOT');
		$xml->add_nodo('TotalCount',$total_registros);
		foreach ($Custom->salida as $f)
		{	$xml->add_rama('ROWS');
		    //$xml->add_nodo('id_inventario_det',$f["id_inventario_det"]);
			$xml->add_nodo('id_item',$f["id_item"]);
			$xml->add_nodo('desc_item',$f["desc_item"]);
			$xml->add_nodo('fecha_conteo',$f["fecha_conteo"]);
			$xml->add_nodo('id_inventario',$f["id_inventario"]);
			$xml->add_nodo('id_supergrupo',$f["id_supergrupo"]);
			$xml->add_nodo('desc_supergrupo',$f["desc_supergrupo"]);
			$xml->add_nodo('id_grupo',$f["id_grupo"]);
			$xml->add_nodo('desc_grupo',$f["desc_grupo"]);
			$xml->add_nodo('id_subgrupo',$f["id_subgrupo"]);
			$xml->add_nodo('desc_subgrupo',$f["desc_subgrupo"]);
			$xml->add_nodo('id_id1',$f["id_id1"]);
			$xml->add_nodo('desc_id1',$f["desc_id1"]);
			$xml->add_nodo('id_id2',$f["id_id2"]);
			$xml->add_nodo('desc_id2',$f["desc_id2"]);
			$xml->add_nodo('id_id3',$f["id_id3"]);
			$xml->add_nodo('desc_id3',$f["desc_id3"]);
			$xml->add_nodo('desc_unidad_medida_base',$f["desc_unidad_medida_base"]);
			$xml->add_nodo('nuevo',$f["nuevo"]);
			$xml->add_nodo('usado',$f["usado"]);
			$xml->add_nodo('total',$f["total"]);
			$xml->add_nodo('cantidad_contada_nuevo',$f["cantidad_contada_nuevo"]);
			$xml->add_nodo('cantidad_contada_usado',$f["cantidad_contada_usado"]);
			$xml->add_nodo('cantidad_contada_total',$f["cantidad_contada_total"]);
			$xml->fin_rama();
		}
		$xml->mostrar_xml();
	}
	else
	{	//Se produjo un error
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
{	$resp = new cls_manejo_mensajes(true, "401");
	$resp->mensaje_error = 'MENSAJE ERROR = Usuario no Autentificado';
	$resp->origen = "ORIGEN = $nombre_archivo";
	$resp->proc = "PROC = $nombre_archivo";
	$resp->nivel = 'NIVEL = 3';
	echo $resp->get_mensaje();
	exit;
}?>