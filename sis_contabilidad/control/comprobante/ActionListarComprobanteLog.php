<?php
/**
**********************************************************
Nombre de archivo:	    ActionListarComprobanteLog.php
Prop�sito:				Permite realizar el listado en tct_comprobante
Tabla:					tct_tct_comprobante
Par�metros:				$cant
						$puntero
						$sortcol
						$sortdir
						$criterio_filtro

Valores de Retorno:    	Listado de Procesos y total de registros listados
Fecha de Creaci�n:		2008-09-16 17:55:38
Versi�n:				1.0.0
Autor:					RCM
**********************************************************
*/
session_start();
include_once('../LibModeloContabilidad.php');

$Custom = new cls_CustomDBContabilidad();

$nombre_archivo = 'ActionListarComprobanteLog.php';

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

	if($sort == '') $sortcol = 'id_comprobante';
	else $sortcol = $sort;

	if($dir == '') $sortdir = 'desc';
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
	//if($m_id_comprobante!=''){
	$cond->add_criterio_extra("COMPRO.id_comprobante",$id_comprobante);
	/*}else{
	$cond->add_criterio_extra("COMPRO.id_usuario",$_SESSION["ss_id_usuario"]);}
	*/
	$criterio_filtro = $cond -> obtener_criterio_filtro();
	
	/*echo 'id:'.$id_comprobante;
	exit;*/
	
	//Obtiene el criterio de orden de columnas
	$crit_sort = new cls_criterio_sort($sortcol,$sortdir,'Comprobante');
	$sortcol = $crit_sort->get_criterio_sort();
	

	//Obtiene el total de los registros
	$res = $Custom -> ContarComprobanteLog($cant ,$puntero,$sortcol,$sortdir,$criterio_filtro,$hidden_ep_id_financiador,$hidden_ep_id_regional,$hidden_ep_id_programa,$hidden_ep_id_proyecto,$hidden_ep_id_actividad);

	if($res) $total_registros= $Custom->salida;

	//Obtiene el conjunto de datos de la consulta
	$res = $Custom->ListarComprobanteLog($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$hidden_ep_id_financiador,$hidden_ep_id_regional,$hidden_ep_id_programa,$hidden_ep_id_proyecto,$hidden_ep_id_actividad);

	if($res)
	{
		$xml = new cls_manejo_xml('ROOT');
		$xml->add_nodo('TotalCount',$total_registros);

		foreach ($Custom->salida as $f)
		{
			$xml->add_rama('ROWS');
			$xml->add_nodo('id_comprobante_log',$f["id_comprobante_log"]);
			$xml->add_nodo('id_comprobante',$f["id_comprobante"]);
			$xml->add_nodo('id_parametro',$f["id_parametro"]);
			$xml->add_nodo('desc_parametro',$f["desc_parametro"]);
			$xml->add_nodo('nro_cbte',$f["nro_cbte"]);
			$xml->add_nodo('momento_cbte',$f["momento_cbte"]);
			$xml->add_nodo('fecha_cbte',$f["fecha_cbte"]);
			$xml->add_nodo('concepto_cbte',$f["concepto_cbte"]);
			$xml->add_nodo('glosa_cbte',$f["glosa_cbte"]);
			$xml->add_nodo('acreedor',$f["acreedor"]);
			$xml->add_nodo('aprobacion',$f["aprobacion"]);
			$xml->add_nodo('conformidad',$f["conformidad"]);
			$xml->add_nodo('pedido',$f["pedido"]);
			$xml->add_nodo('id_periodo_subsis',$f["id_periodo_subsis"]);
			$xml->add_nodo('desc_periodo',$f["periodo_sub"]);
			$xml->add_nodo('id_moneda_reg',$f["id_moneda_reg"]);
			$xml->add_nodo('desc_moneda',$f["desc_moneda"]);
			$xml->add_nodo('id_usuario',$f["id_usuario"]);
			$xml->add_nodo('desc_usuario',$f["desc_usuario"]);
			$xml->add_nodo('id_subsistema',$f["id_subsistema"]);
			$xml->add_nodo('desc_subsistema',$f["desc_subsistema"]);
			$xml->add_nodo('id_cbte_clase',$f["id_cbte_clase"]);
			$xml->add_nodo('desc_clase',$f["desc_clases"]);
			$xml->add_nodo('id_moneda',$f["id_moneda"]);
			$xml->add_nodo('desc_moneda',$f["desc_moneda"]);
			$xml->add_nodo('id_gestion',$f["id_gestion"]);
			$xml->add_nodo('nombre_depto',$f["nombre_depto"]);
			$xml->add_nodo('id_depto',$f["id_depto"]);
			$xml->add_nodo('titulo_cbte',$f["titulo_cbte"]);
			$xml->add_nodo('fecha_inicio',$f["fecha_inicio"]);
			$xml->add_nodo('fecha_final',$f["fecha_final"]);
			$xml->add_nodo('id_moneda_cbte',$f["id_moneda_cbte"]);
			$xml->add_nodo('tipo_cambio',$f["tipo_cambio"]);
			$xml->add_nodo('nombre_moneda_cbte',$f["nombre_moneda_cbte"]);
			$xml->add_nodo('prioridad_moneda_cbte',$f["prioridad_moneda_cbte"]);
			$xml->add_nodo('estado_cbte',$f["estado_cbte"]);
 
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