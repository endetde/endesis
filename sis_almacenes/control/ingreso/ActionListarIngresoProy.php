<?php
/**
**********************************************************
Nombre de archivo:	    ActionListarIngresoProy.php
Prop�sito:				Permite realizar el listado en tal_ingreso
Tabla:					t_tal_ingreso
Par�metros:				$cant
						$puntero
						$sortcol
						$sortdir
						$criterio_filtro

Valores de Retorno:    	Listado de Procesos y total de registros listados
Fecha de Creaci�n:		02-04-2008 11:53
Versi�n:				1.0.0
Autor:					Rodrigo Chumacero Moscoso
**********************************************************
*/
session_start();
include_once('../rcm_LibModeloAlmacenes.php');
//include_once('../../../lib/FirePHPCore/FirePHP.class.PHP');

$Custom = new cls_CustomDBAlmacenes();
$nombre_archivo = 'ActionListarIngresoProy.php';

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

	if($sort == '') $sortcol = 'id_ingreso';
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

	//Se aumenta el criterio para filtrar solo por el tipo de motivo ingreso, excepto cuando es de la vista General
	if($tipo!="" && $tipo!="General")
	{
		$cond->add_criterio_extra("MOTING.tipo","''$tipo''");
	}
	
	$cond->add_criterio_extra("INGRES.circuito","''Simplificado''");
	$criterio_filtro = $cond -> obtener_criterio_filtro();
	
	$criterio_filtro .= " AND INGRES.estado_ingreso <> ''Finalizado''";
	
	//echo "criterio filtro: ".$criterio_filtro;
	//exit;
	//Obtiene el criterio de orden de columnas
	$crit_sort = new cls_criterio_sort($sortcol,$sortdir,'IngresoSimplificadoProy');
	$sortcol = $crit_sort->get_criterio_sort();


	//Obtiene el total de los registros
	$res = $Custom ->ContarIngresoProy($cant ,$puntero,$sortcol,$sortdir,$criterio_filtro,$hidden_ep_id_financiador,$hidden_ep_id_regional,$hidden_ep_id_programa,$hidden_ep_id_proyecto,$hidden_ep_id_actividad);

	if($res) $total_registros= $Custom->salida;
	
	//Obtiene el conjunto de datos de la consulta
	$res = $Custom->ListarIngresoProy($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$hidden_ep_id_financiador,$hidden_ep_id_regional,$hidden_ep_id_programa,$hidden_ep_id_proyecto,$hidden_ep_id_actividad);

	if($res)
	{
		$xml = new cls_manejo_xml('ROOT');
		$xml->add_nodo('TotalCount',$total_registros);

		foreach ($Custom->salida as $f)
		{
			$xml->add_rama('ROWS');
			$xml->add_nodo('id_ingreso',$f["id_ingreso"]);
			$xml->add_nodo('correlativo_ord_ing',$f["correlativo_ord_ing"]);
			$xml->add_nodo('correlativo_ing',$f["correlativo_ing"]);
			$xml->add_nodo('descripcion',$f["descripcion"]);
			$xml->add_nodo('costo_total',$f["costo_total"]);
			$xml->add_nodo('contabilizar',$f["contabilizar"]);
			$xml->add_nodo('contabilizado',$f["contabilizado"]);
			$xml->add_nodo('estado_ingreso',$f["estado_ingreso"]);
			$xml->add_nodo('estado_registro',$f["estado_registro"]);
			$xml->add_nodo('cod_inf_tec',$f["cod_inf_tec"]);
			$xml->add_nodo('resumen_inf_tec',$f["resumen_inf_tec"]);
			$xml->add_nodo('fecha_borrador',$f["fecha_borrador"]);
			$xml->add_nodo('fecha_pendiente',$f["fecha_pendiente"]);
			$xml->add_nodo('fecha_aprobado_rechazado',$f["fecha_aprobado_rechazado"]);
			$xml->add_nodo('fecha_ing_fisico',$f["fecha_ing_fisico"]);
			$xml->add_nodo('fecha_ing_valorado',$f["fecha_ing_valorado"]);
			$xml->add_nodo('fecha_finalizado_cancelado',$f["fecha_finalizado_cancelado"]);
			$xml->add_nodo('fecha_reg',$f["fecha_reg"]);
			$xml->add_nodo('id_responsable_almacen',$f["id_responsable_almacen"]);
			$xml->add_nodo('desc_responsable_almacen',$f["desc_responsable_almacen"]);
			$xml->add_nodo('id_proveedor',$f["id_proveedor"]);
			$xml->add_nodo('desc_proveedor',$f["desc_proveedor"]);
			$xml->add_nodo('id_contratista',$f["id_contratista"]);
			$xml->add_nodo('desc_contratista',$f["desc_contratista"]);
			$xml->add_nodo('id_empleado',$f["id_empleado"]);
			$xml->add_nodo('desc_empleado',$f["desc_empleado"]);
			$xml->add_nodo('id_almacen_logico',$f["id_almacen_logico"]);
			$xml->add_nodo('desc_almacen_logico',$f["desc_almacen_logico"]);
			$xml->add_nodo('id_firma_autorizada',$f["id_firma_autorizada"]);
			$xml->add_nodo('desc_firma_autorizada',$f["desc_firma_autorizada"]);
			$xml->add_nodo('id_institucion',$f["id_institucion"]);
			$xml->add_nodo('desc_institucion',$f["desc_institucion"]);
			$xml->add_nodo('id_motivo_ingreso_cuenta',$f["id_motivo_ingreso_cuenta"]);
			$xml->add_nodo('desc_motivo_ingreso_cuenta',$f["desc_motivo_ingreso_cuenta"]);
			$xml->add_nodo('nombre_proveedor',$f["nombre_proveedor"]);
			$xml->add_nodo('nombre_contratista',$f["nombre_contratista"]);
			$xml->add_nodo('nro_cuenta',$f["nro_cuenta"]);
			$xml->add_nodo('desc_motivo_ingreso',$f["desc_motivo_ingreso"]);
			$xml->add_nodo('desc_almacen',$f["desc_almacen"]);
			$xml->add_nodo('nombre_financiador',$f["nombre_financiador"]);
			$xml->add_nodo('nombre_regional',$f["nombre_regional"]);
			$xml->add_nodo('nombre_programa',$f["nombre_programa"]);
			$xml->add_nodo('nombre_proyecto',$f["nombre_proyecto"]);
			$xml->add_nodo('nombre_actividad',$f["nombre_actividad"]);
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
			$xml->add_nodo('orden_compra',$f["orden_compra"]);
			$xml->add_nodo('observaciones',$f["observaciones"]);
			$xml->add_nodo('id_usuario',$f["id_usuario"]);
			$xml->add_nodo('contabilizar_tipo_almacen',$f["contabilizar_tipo_almacen"]);
			$xml->add_nodo('num_factura',$f["num_factura"]);
			$xml->add_nodo('fecha_factura',$f["fecha_factura"]);
			$xml->add_nodo('responsable',$f["responsable"]);
			$xml->add_nodo('importacion',$f["importacion"]);
			$xml->add_nodo('flete',$f["flete"]);
			$xml->add_nodo('seguro',$f["seguro"]);
			$xml->add_nodo('gastos_alm',$f["gastos_alm"]);
			$xml->add_nodo('gastos_aduana',$f["gastos_aduana"]);
			$xml->add_nodo('iva',$f["iva"]);
			$xml->add_nodo('rep_form',$f["rep_form"]);
			$xml->add_nodo('peso_neto',$f["peso_neto"]);
			$xml->add_nodo('tot_importacion',$f["tot_importacion"]);
			$xml->add_nodo('tot_nacionaliz',$f["tot_nacionaliz"]);
			$xml->add_nodo('id_moneda_import',$f["id_moneda_import"]);
			$xml->add_nodo('id_moneda_nacionaliz',$f["id_moneda_nacionaliz"]);
			$xml->add_nodo('desc_moneda_import',$f["desc_moneda_import"]);
			$xml->add_nodo('desc_moneda_nacionaliz',$f["desc_moneda_nacionaliz"]);
			$xml->add_nodo('dui',$f["dui"]);
			$xml->add_nodo('monto_tot_factura',$f["monto_tot_factura"]);
			$xml->add_nodo('codigo_mot_ing',$f["codigo_mot_ing"]);
			$xml->add_nodo('gestion',$f["gestion"]);
			$xml->add_nodo('id_motivo_ingreso',$f["id_motivo_ingreso"]);
			$xml->add_nodo('id_almacen',$f["id_almacen"]);
			$xml->add_nodo('tipo_costeo',$f["tipo_costeo"]);
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