<?php
/**
**********************************************************
Nombre de archivo:	    ActionListarafp.php
Prop�sito:				Permite realizar el listado en tkp_afp
Tabla:					tkp_afp
Par�metros:				$cant
						$puntero
						$sortcol
						$sortdir
						$criterio_filtro

Valores de Retorno:    	Listado de Procesos y total de registros listados
Fecha de Creaci�n:		2010-08-11 17:24:33
Versi�n:				1.0.0
Autor:					Mercedes Zambrana Meneses
**********************************************************
*/
session_start();
include_once('../LibModeloKardexPersonal.php');

$Custom = new cls_CustomDBKardexPersonal();
$nombre_archivo = 'ActionListarObligacion.php';

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

	if($sort == '') $sortcol = 'nombre';
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
	
	$cond->add_criterio_extra("id_planilla",$id_planilla);
	
	$criterio_filtro = $cond -> obtener_criterio_filtro();
	
	//echo $criterio_filtro;
	//exit;
	
	//$criterio_filtro=$criterio_filtro. " AND ob.estado_reg=''borrador''";
	
	//Obtiene el criterio de orden de columnas
	$crit_sort = new cls_criterio_sort($sortcol,$sortdir,'Obligacion');
	$sortcol = $crit_sort->get_criterio_sort();
	

	//Obtiene el total de los registros
	$res = $Custom -> ContarObligacion($cant ,$puntero,$sortcol,$sortdir,$criterio_filtro,$hidden_ep_id_financiador,$hidden_ep_id_regional,$hidden_ep_id_programa,$hidden_ep_id_proyecto,$hidden_ep_id_actividad);

	if($res) $total_registros= $Custom->salida;

	//Obtiene el conjunto de datos de la consulta
	$res = $Custom->ListarObligacion($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$hidden_ep_id_financiador,$hidden_ep_id_regional,$hidden_ep_id_programa,$hidden_ep_id_proyecto,$hidden_ep_id_actividad);
		if($res)
	{
		$xml = new cls_manejo_xml('ROOT');
		$xml->add_nodo('TotalCount',$total_registros);

	//$xml->add_nodo('foto_persona',$f["foto_persona"]);
		foreach ($Custom->salida as $f)
		{
			$xml->add_rama('ROWS');
			$xml->add_nodo('id_obligacion',$f["id_obligacion"]);
			$xml->add_nodo('id_tipo_obligacion',$f["id_tipo_obligacion"]);
			$xml->add_nodo('codigo',$f["codigo"]);
			$xml->add_nodo('nombre',$f["nombre"]);
			$xml->add_nodo('id_planilla',$f["id_planilla"]);
			$xml->add_nodo('id_comprobante',$f["id_comprobante"]);
			$xml->add_nodo('monto',$f["monto"]);
			$xml->add_nodo('fecha_reg',$f["fecha_reg"]);
			$xml->add_nodo('estado_reg',$f["estado_reg"]);
			$xml->add_nodo('observaciones',$f["observaciones"]);
			$xml->add_nodo('nro_cuenta_banco',$f["nro_cuenta_banco"]);
			$xml->add_nodo('id_institucion',$f["id_institucion"]);
			$xml->add_nodo('desc_institucion',$f["desc_institucion"]);
			$xml->add_nodo('tipo_pago',$f["tipo_pago"]);
			$xml->add_nodo('id_cuenta',$f["id_cuenta"]);
			$xml->add_nodo('desc_cuenta',$f["desc_cuenta"]);
			$xml->add_nodo('id_auxiliar',$f["id_auxiliar"]);
			$xml->add_nodo('desc_auxiliar',$f["desc_auxiliar"]);
			$xml->add_nodo('id_cuenta_bancaria',$f["id_cuenta_bancaria"]);
			$xml->add_nodo('fecha_pago',$f["fecha_pago"]);
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