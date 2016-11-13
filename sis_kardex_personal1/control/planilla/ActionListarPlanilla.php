<?php
/**
**********************************************************
Nombre de archivo:	    ActionListarPlanilla.php
Prop�sito:				Permite realizar el listado en tkp_planilla
Tabla:					tkp_tkp_planilla
Par�metros:				$cant
						$puntero
						$sortcol
						$sortdir
						$criterio_filtro

Valores de Retorno:    	Listado de Procesos y total de registros listados
Fecha de Creaci�n:		2010-08-23 11:07:47
Versi�n:				1.0.0
Autor:					Generado Automaticamente
**********************************************************
*/
session_start();
include_once('../LibModeloKardexPersonal.php');

$Custom = new cls_CustomDBKardexPersonal();
$nombre_archivo = 'ActionListarPlanilla .php';

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

	if($sort == '') $sortcol = 'id_planilla';
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
	//Obtiene el criterio de orden de columnas
	//$crit_sort = new cls_criterio_sort($sortcol,$sortdir,'Planilla');
	//$sortcol = $crit_sort->get_criterio_sort();
	
	//06/03/2014: para separar la informacion de las planillas de sueldos (planta) y consultores
	if($vista=='consultores'){
		$criterio_filtro=$criterio_filtro." AND (TIPPLA.tipo=''reposicion'' or TIPPLA.tipo=''aguinaldo_cons2'')";
	}else{
		$criterio_filtro=$criterio_filtro." AND TIPPLA.tipo!=''reposicion'' AND TIPPLA.tipo!=''aguinaldo_cons2'' ";
	}

	//07.2014
	if(isset($id_gestion)  && $id_gestion != null){
		$criterio_filtro=$criterio_filtro." AND PLANIL.id_gestion=$id_gestion";
	}
	
	//Obtiene el total de los registros
	$res = $Custom -> ContarPlanilla($cant ,$puntero,$sortcol,$sortdir,$criterio_filtro,$hidden_ep_id_financiador,$hidden_ep_id_regional,$hidden_ep_id_programa,$hidden_ep_id_proyecto,$hidden_ep_id_actividad);

	if($res) $total_registros= $Custom->salida;

	//Obtiene el conjunto de datos de la consulta
	$res = $Custom->ListarPlanilla($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$hidden_ep_id_financiador,$hidden_ep_id_regional,$hidden_ep_id_programa,$hidden_ep_id_proyecto,$hidden_ep_id_actividad);
	
	if($res)
	{
		$xml = new cls_manejo_xml('ROOT');
		$xml->add_nodo('TotalCount',$total_registros);

		foreach ($Custom->salida as $f)
		{
			$xml->add_rama('ROWS');
			$xml->add_nodo('id_planilla',$f["id_planilla"]);
			$xml->add_nodo('id_tipo_planilla',$f["id_tipo_planilla"]);
			$xml->add_nodo('desc_tipo_planilla',$f["desc_tipo_planilla"]);
			$xml->add_nodo('id_periodo',$f["id_periodo"]);
			$xml->add_nodo('desc_periodo',$f["desc_periodo"]);
			$xml->add_nodo('id_usuario',$f["id_usuario"]);
			$xml->add_nodo('usuario',$f["usuario"]);
			$xml->add_nodo('id_moneda',$f["id_moneda"]);
			$xml->add_nodo('desc_moneda',$f["desc_moneda"]);
			$xml->add_nodo('numero',$f["numero"]);
			$xml->add_nodo('estado',$f["estado"]);
			$xml->add_nodo('observaciones',$f["observaciones"]);
			$xml->add_nodo('fecha_reg',$f["fecha_reg"]);
			$xml->add_nodo('codigo_depto',$f["codigo_depto"]);
			$xml->add_nodo('fecha_planilla',$f["fecha_planilla"]);
			$xml->add_nodo('gestion',$f["gestion"]);
			$xml->add_nodo('id_gestion',$f["id_gestion"]);
			$xml->add_nodo('periodo_lite',$f["periodo_lite"]);
			$xml->add_nodo('fk_id_planilla',$f["fk_id_planilla"]);
			$xml->add_nodo('estado_anticipo',$f["estado_anticipo"]);
			$xml->add_nodo('recalcular',$f["recalcular"]);
			$xml->add_nodo('estado_obligacion',$f["estado_obligacion"]);
			$xml->add_nodo('resumen_periodo',$f["gestion"]." - ".$f["periodo_lite"]);
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