<?php
/**
**********************************************************
Nombre de archivo:	    ActionListarSolicitudLicenciaDet.php
Prop�sito:				Permite realizar el listado en tkp_vacacion
Tabla:					tkp_tkp_vacacion
Par�metros:				$cant
						$puntero
						$sortcol
						$sortdir
						$criterio_filtro

Valores de Retorno:    	Listado de Procesos y total de registros listados
Fecha de Creaci�n:		2010-08-17 09:25:59
Versi�n:				1.0.0
Autor:					Generado Automaticamente
**********************************************************
*/
session_start();
include_once('../LibModeloKardexPersonal.php');

$Custom = new cls_CustomDBKardexPersonal();
$nombre_archivo = 'ActionListarSolicitudLicencia.php';

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

	if($sort == '') $sortcol = 'HORARI.id_tipo_horario';
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
	if($tipo=='preaprobar'){
		if($_SESSION["ss_rol_adm"]==1){
			$criterio_filtro=$criterio_filtro." AND HORARI.estado_reg=''pendiente_preaprobacion''   
		                                        GROUP BY HORARI.id_tipo_horario,VACACI.id_empleado,EMPLEA.nombre_completo,TIPHOR.nombre,HORARI.id_empleado_aprobacion,HORARI.id_vacacion,HORARI.num_solicitud,HORARI.estado_reg,CONTRA.tipo_contrato";
		}
		else{
			$criterio_filtro=$criterio_filtro." AND HORARI.id_empleado_aprobacion=".$_SESSION["ss_id_empleado"]." AND HORARI.estado_reg=''pendiente_preaprobacion''   
		                                        GROUP BY HORARI.id_tipo_horario,VACACI.id_empleado,EMPLEA.nombre_completo,TIPHOR.nombre,HORARI.id_empleado_aprobacion,HORARI.id_vacacion,HORARI.num_solicitud,HORARI.estado_reg,CONTRA.tipo_contrato";
		}
		
	}
	if($tipo=='aprobar'){	
		    if($m_tipo_contrato_rrhh=="planta"){
		    	$criterio_filtro=$criterio_filtro." AND CONTRA.tipo_contrato=''$m_tipo_contrato_rrhh''";
		    }
		    else{
		    	$criterio_filtro=$criterio_filtro." AND CONTRA.tipo_contrato!=''planta''";
		    }
			$criterio_filtro=$criterio_filtro." AND HORARI.estado_reg=''pendiente_aprobacion''   
		                                        GROUP BY HORARI.id_tipo_horario,VACACI.id_empleado,EMPLEA.nombre_completo,TIPHOR.nombre,HORARI.id_empleado_aprobacion,HORARI.id_vacacion,HORARI.num_solicitud,HORARI.estado_reg,CONTRA.tipo_contrato";
		
	}
	if($tipo=='procesar'){
		if($m_tipo_contrato_proc=="planta"){
		    	$criterio_filtro=$criterio_filtro." AND CONTRA.tipo_contrato=''$m_tipo_contrato_proc''";
		    }
		    else{
		    	$criterio_filtro=$criterio_filtro." AND CONTRA.tipo_contrato!=''planta''";
		    }
		$criterio_filtro=$criterio_filtro." AND (HORARI.estado_reg=''aprobado'' OR HORARI.estado_reg=''en_proceso'' OR HORARI.estado_reg=''reformulado'')   
		                                    GROUP BY HORARI.num_solicitud,HORARI.id_tipo_horario,VACACI.id_empleado,EMPLEA.nombre_completo,TIPHOR.nombre,HORARI.id_empleado_aprobacion,HORARI.id_vacacion,HORARI.estado_reg,CONTRA.tipo_contrato";
	}
	
	//Obtiene el criterio de orden de columnas
	$crit_sort = new cls_criterio_sort($sortcol,$sortdir,'AprobarSolicitudLicencia');
	$sortcol = $crit_sort->get_criterio_sort();
	

	//Obtiene el total de los registros
	$res = $Custom -> ContarAprobarSolicitudLicencia($cant ,$puntero,$sortcol,$sortdir,$criterio_filtro,$hidden_ep_id_financiador,$hidden_ep_id_regional,$hidden_ep_id_programa,$hidden_ep_id_proyecto,$hidden_ep_id_actividad);

	if($res) $total_registros= $Custom->salida;

	//Obtiene el conjunto de datos de la consulta
	$res = $Custom->ListarAprobarSolicitudLicencia($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$hidden_ep_id_financiador,$hidden_ep_id_regional,$hidden_ep_id_programa,$hidden_ep_id_proyecto,$hidden_ep_id_actividad);
	
	if($res)
	{
		$xml = new cls_manejo_xml('ROOT');
		$xml->add_nodo('TotalCount',$total_registros);

		foreach ($Custom->salida as $f)
		{
			$xml->add_rama('ROWS');
			$xml->add_nodo('id_empleado',$f["id_empleado"]);
			$xml->add_nodo('nombre_completo',$f["nombre_completo"]);
			$xml->add_nodo('id_tipo_horario',$f["id_tipo_horario"]);
			$xml->add_nodo('nombre_tipo_horario',$f["nombre_tipo_horario"]);
			$xml->add_nodo('id_vacacion',$f["id_vacacion"]);
			$xml->add_nodo('id_empleado_aprobacion',$f["id_empleado_aprobacion"]);
			$xml->add_nodo('num_solicitud',$f["num_solicitud"]);
			$xml->add_nodo('estado_reg',$f["estado_reg"]);
			$xml->add_nodo('tipo_contrato',$f["tipo_contrato"]);
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