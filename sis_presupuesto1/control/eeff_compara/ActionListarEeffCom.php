<?php
/**
**********************************************************
Nombre de archivo:	    ActionListarEeff.php
Prop�sito:				Permite realizar el listado en tpr_eeff
Tabla:					tpr_eeff
Par�metros:				$cant
						$puntero
						$sortcol
						$sortdir
						$criterio_filtro

Valores de Retorno:    	Listado de Procesos y total de registros listados
Fecha de Creaci�n:		2015/10/02
Versi�n:				1.0.0
Autor:					Ana  Maria Villegas Quispe.
**********************************************************
*/
session_start();
include_once("../LibModeloPresupuesto.php");

$Custom = new cls_CustomDBPresupuesto();
$nombre_archivo = 'ActionListarEeffCom.php';

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

	if($sort == '') $sortcol = 'id_eeff';
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
	$crit_sort = new cls_criterio_sort($sortcol,$sortdir,'EeffCom');
	$sortcol = $crit_sort->get_criterio_sort();

	//Obtiene el total de los registros
	$res = $Custom -> ContarEeffCom($cant ,$puntero,$sortcol,$sortdir,$criterio_filtro,$hidden_ep_id_financiador,$hidden_ep_id_regional,$hidden_ep_id_programa,$hidden_ep_id_proyecto,$hidden_ep_id_actividad);

	if($res) $total_registros= $Custom->salida;

	//Obtiene el conjunto de datos de la consulta
	$res = $Custom->ListarEeffCom($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$hidden_ep_id_financiador,$hidden_ep_id_regional,$hidden_ep_id_programa,$hidden_ep_id_proyecto,$hidden_ep_id_actividad);
	
	if($res)
	{
		$xml = new cls_manejo_xml('ROOT');
		$xml->add_nodo('TotalCount',$total_registros);
						
		foreach ($Custom->salida as $f)
		{
			$xml->add_rama('ROWS');
			$xml->add_nodo('id_eeff',$f["id_eeff"]);
			$xml->add_nodo('id_gestion_act',$f["id_gestion_act"]);
			$xml->add_nodo('desges_act',$f["desges_act"]);
			$xml->add_nodo('id_gestion_ant',$f["id_gestion_ant"]);
			$xml->add_nodo('desges_ant',$f["desges_ant"]);
			$xml->add_nodo('id_moneda',$f["id_moneda"]);
			$xml->add_nodo('nombre_moneda',$f["nombre_moneda"]);
			$xml->add_nodo('sw_eeff',$f["sw_eeff"]);
			$xml->add_nodo('eeff_fecha',$f["eeff_fecha"]);
			/*$xml->add_nodo('eeff_actual',$f["eeff_actual"]);
			$xml->add_nodo('eeff_fecran',$f["eeff_fecran"]);
			$xml->add_nodo('eeff_nivel',$f["eeff_nivel"]);
			$xml->add_nodo('eeff_texto',$f["eeff_texto"]);
			$xml->add_nodo('mat_contador',$f["mat_contador"]);
			$xml->add_nodo('id_empleado_fc',$f["id_empleado_fc"]);
			$xml->add_nodo('nombre_fc',$f["nombre_fc"]);
			$xml->add_nodo('id_empleado_f1',$f["id_empleado_f1"]);
			$xml->add_nodo('nombre_f1',$f["nombre_f1"]);
			$xml->add_nodo('id_empleado_f2',$f["id_empleado_f2"]);
			$xml->add_nodo('nombre_f2',$f["nombre_f2"]);
			$xml->add_nodo('id_empleado_f3',$f["id_empleado_f3"]);
			$xml->add_nodo('nombre_f3',$f["nombre_f3"]);
			$xml->add_nodo('id_reporte_eeff',$f["id_reporte_eeff"]);
			$xml->add_nodo('nombre_eeff',$f["nombre_eeff"]);
			$xml->add_nodo('eeff_fecha',$f["eeff_fecha"]);
*/			$xml->fin_rama();
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