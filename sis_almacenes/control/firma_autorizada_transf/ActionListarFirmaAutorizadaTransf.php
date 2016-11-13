<?php
/**
**********************************************************
Nombre de archivo:	    ActionListarFirmaAutorizadaTransf.php
Prop�sito:				Permite realizar el listado en tal_firma_autorizada_transf
Tabla:					t_tal_firma_autorizada_transf
Par�metros:				$cant
						$puntero
						$sortcol
						$sortdir
						$criterio_filtro

Valores de Retorno:    	Listado de Procesos y total de registros listados
Fecha de Creaci�n:		2007-12-13 10:10:22
Versi�n:				1.0.0
Autor:					Generado Automaticamente
**********************************************************
*/
session_start();
include_once('../arv_LibModeloAlmacenes.php');

$Custom = new cls_CustomDBAlmacenes();
$nombre_archivo = 'ActionListarFirmaAutorizadaTransf .php';

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

	if($sort == '') $sortcol = 'id_firma_autorizada_transf';
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
	$crit_sort = new cls_criterio_sort($sortcol,$sortdir,'FirmaAutorizadaTransf');
	$sortcol = $crit_sort->get_criterio_sort();
	

	//Obtiene el total de los registros
	$res = $Custom -> ContarFirmaAutorizadaTransf($cant ,$puntero,$sortcol,$sortdir,$criterio_filtro,$hidden_ep_id_financiador,$hidden_ep_id_regional,$hidden_ep_id_programa,$hidden_ep_id_proyecto,$hidden_ep_id_actividad);

	if($res) $total_registros= $Custom->salida;

	//Obtiene el conjunto de datos de la consulta
	$res = $Custom->ListarFirmaAutorizadaTransf($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$hidden_ep_id_financiador,$hidden_ep_id_regional,$hidden_ep_id_programa,$hidden_ep_id_proyecto,$hidden_ep_id_actividad);
	
	if($res)
	{
		$xml = new cls_manejo_xml('ROOT');
		$xml->add_nodo('TotalCount',$total_registros);

		foreach ($Custom->salida as $f)
		{
			$xml->add_rama('ROWS');
			$xml->add_nodo('id_firma_autorizada_transf',$f["id_firma_autorizada_transf"]);
			$xml->add_nodo('estado_registro',$f["estado_registro"]);
			$xml->add_nodo('fecha_registro',$f["fecha_registro"]);
			$xml->add_nodo('id_empleado',$f["id_empleado"]);
			$xml->add_nodo('desc_empleado',$f["desc_empleado"]);
			$xml->add_nodo('id_motivo_ingreso',$f["id_motivo_ingreso"]);
			$xml->add_nodo('desc_motivo_ingreso',$f["desc_motivo_ingreso"]);
			$xml->add_nodo('id_motivo_ingreso_cuenta',$f["id_motivo_ingreso_cuenta"]);
			$xml->add_nodo('desc_motivo_ingreso_cuenta',$f["desc_motivo_ingreso_cuenta"]);
			$xml->add_nodo('id_motivo_salida',$f["id_motivo_salida"]);
			$xml->add_nodo('desc_motivo_salida',$f["desc_motivo_salida"]);
			$xml->add_nodo('id_motivo_salida_cuenta',$f["id_motivo_salida_cuenta"]);
			$xml->add_nodo('desc_motivo_salida_cuenta',$f["desc_motivo_salida_cuenta"]);
			$xml->add_nodo('desc_persona',$f["desc_persona"]);
			
			$xml->add_nodo('id_financiador',$f["id_financiador"]);
			$xml->add_nodo('id_regional',$f["id_regional"]);
			$xml->add_nodo('id_programa',$f["id_programa"]);
			$xml->add_nodo('id_proyecto',$f["id_proyecto"]);
			$xml->add_nodo('id_actividad',$f["id_actividad"]);
			
			$xml->add_nodo('codigo_financiador',$f["codigo_financiador"]);
			$xml->add_nodo('codigo_regional',$f["codigo_regional"]);
			$xml->add_nodo('codigo_programa',$f["codigo_programa"]);
			$xml->add_nodo('codigo_proyecto',$f["codigo_proyecto"]);
			$xml->add_nodo('codigo_actividad',$f["codigo_actividad"]);
			
			$xml->add_nodo('id_financiador_sal',$f["id_financiador_sal"]);
			$xml->add_nodo('id_regional_sal',$f["id_regional_sal"]);
			$xml->add_nodo('id_programa_sal',$f["id_programa_sal"]);
			$xml->add_nodo('id_proyecto_sal',$f["id_proyecto_sal"]);
			$xml->add_nodo('id_actividad_sal',$f["id_actividad_sal"]);
			
			$xml->add_nodo('codigo_financiador_sal',$f["codigo_financiador_sal"]);
			$xml->add_nodo('codigo_regional_sal',$f["codigo_regional_sal"]);
			$xml->add_nodo('codigo_programa_sal',$f["codigo_programa_sal"]);
			$xml->add_nodo('codigo_proyecto_sal',$f["codigo_proyecto_sal"]);
			$xml->add_nodo('codigo_actividad_sal',$f["codigo_actividad_sal"]);
			

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