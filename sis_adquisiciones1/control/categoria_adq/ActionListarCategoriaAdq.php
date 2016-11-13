<?php
/**
**********************************************************
Nombre de archivo:	    ActionListarCategoriaAdq.php
Prop�sito:				Permite realizar el listado en tad_categoria_adq
Tabla:					t_tad_categoria_adq
Par�metros:				$cant
						$puntero
						$sortcol
						$sortdir
						$criterio_filtro

Valores de Retorno:    	Listado de Procesos y total de registros listados
Fecha de Creaci�n:		2008-05-14 16:23:16
Versi�n:				1.0.0
Autor:					Generado Automaticamente
**********************************************************
*/
session_start();
include_once('../LibModeloAdquisiciones.php');

$Custom = new cls_CustomDBAdquisiciones();
$nombre_archivo = 'ActionListarCategoriaAdq .php';

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

	if($sort == '') $sortcol = 'id_categoria_adq';
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
	$criterio_filtro = $cond -> obtener_criterio_filtro();
	if($m_id_categoria_adq>0){
	    $criterio_filtro=$criterio_filtro." AND CATADQ.id_categoria_adq=$m_id_categoria_adq";
	}
	//Obtiene el criterio de orden de columnas
	$crit_sort = new cls_criterio_sort($sortcol,$sortdir,'CategoriaAdq');
	$sortcol = $crit_sort->get_criterio_sort();
	

	//Obtiene el total de los registros
	$res = $Custom -> ContarCategoriaAdq($cant ,$puntero,$sortcol,$sortdir,$criterio_filtro,$hidden_ep_id_financiador,$hidden_ep_id_regional,$hidden_ep_id_programa,$hidden_ep_id_proyecto,$hidden_ep_id_actividad);

	if($res) $total_registros= $Custom->salida;

	//Obtiene el conjunto de datos de la consulta
	$res = $Custom->ListarCategoriaAdq($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$hidden_ep_id_financiador,$hidden_ep_id_regional,$hidden_ep_id_programa,$hidden_ep_id_proyecto,$hidden_ep_id_actividad);
	
	if($res)
	{
		$xml = new cls_manejo_xml('ROOT');
		$xml->add_nodo('TotalCount',$total_registros);
		if($oc == 'si'){
				$xml->add_rama('ROWS');
			$xml->add_nodo('id_categoria_adq','%');
			$xml->add_nodo('nombre','Todos');
			$xml->add_nodo('observaciones','Todos');
			$xml->add_nodo('descripcion','Todos');
			$xml->add_nodo('fecha_reg','Todos');
			$xml->add_nodo('precio_min','Todos');
			$xml->add_nodo('precio_max','Todos');
			$xml->add_nodo('id_moneda','%');
			$xml->add_nodo('desc_moneda','Todos');
            $xml->add_nodo('norma','Todos');
            $xml->add_nodo('simplificada','Todos');
            $xml->add_nodo('defecto','Todos');
            //8ago11
            $xml->add_nodo('doc_respaldo','Todos');
            $xml->fin_rama();
            
		}
		foreach ($Custom->salida as $f)
		{
			$xml->add_rama('ROWS');
			$xml->add_nodo('id_categoria_adq',$f["id_categoria_adq"]);
			$xml->add_nodo('nombre',$f["nombre"]);
			$xml->add_nodo('observaciones',$f["observaciones"]);
			$xml->add_nodo('descripcion',$f["descripcion"]);
			$xml->add_nodo('fecha_reg',$f["fecha_reg"]);
			$xml->add_nodo('precio_min',$f["precio_min"]);
			$xml->add_nodo('precio_max',$f["precio_max"]);
			$xml->add_nodo('id_moneda',$f["id_moneda"]);
			$xml->add_nodo('desc_moneda',$f["desc_moneda"]);
            $xml->add_nodo('norma',$f["norma"]);
            $xml->add_nodo('simplificada',$f["simplificada"]);
            $xml->add_nodo('defecto',$f["defecto"]);
            //8ago11
            $xml->add_nodo('doc_respaldo',$f["doc_respaldo"]);
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