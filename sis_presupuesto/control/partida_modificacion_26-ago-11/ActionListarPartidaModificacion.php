<?php
/**
**********************************************************
Nombre de archivo:	    ActionListarPartidaModificacion.php
Prop�sito:				Permite realizar el listado en tpr_partida_modificacion
Tabla:					tpr_tpr_partida_modificacion
Par�metros:				$cant
						$puntero
						$sortcol
						$sortdir
						$criterio_filtro

Valores de Retorno:    	Listado de Procesos y total de registros listados
Fecha de Creaci�n:		2010-05-10 18:19:16
Versi�n:				1.0.0
Autor:					Generado Automaticamente
**********************************************************
*/
session_start();
include_once('../LibModeloPresupuesto.php');

$Custom = new cls_CustomDBPresupuesto();
$nombre_archivo = 'ActionListarPartidaModificacion .php';

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

	if($sort == '') $sortcol = 'id_partida_modificacion';
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
	$cond->add_criterio_extra("PARMOD.id_modificacion",$id_modificacion);
	$cond->add_criterio_extra("PARMOD.tipo_modificacion",$tipo_modificacion);
	//echo 'TIPO MODIFICACION: '.$tipo_modificacion;
	//exit();
	$criterio_filtro = $cond -> obtener_criterio_filtro();
	//Obtiene el criterio de orden de columnas
	$crit_sort = new cls_criterio_sort($sortcol,$sortdir,'PartidaModificacion');
	$sortcol = $crit_sort->get_criterio_sort();

	//Obtiene el total de los registros
	$res = $Custom -> ContarPartidaModificacion($cant ,$puntero,$sortcol,$sortdir,$criterio_filtro,$hidden_ep_id_financiador,$hidden_ep_id_regional,$hidden_ep_id_programa,$hidden_ep_id_proyecto,$hidden_ep_id_actividad);

	if($res) $total_registros= $Custom->salida;

	//Obtiene el conjunto de datos de la consulta
	$res = $Custom->ListarPartidaModificacion($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$hidden_ep_id_financiador,$hidden_ep_id_regional,$hidden_ep_id_programa,$hidden_ep_id_proyecto,$hidden_ep_id_actividad);
	
	//echo var_dump($Custom); exit;
			
	$total_importe=0;
	
	if($res)
	{
		$xml = new cls_manejo_xml('ROOT');
		$xml->add_nodo('TotalCount',$total_registros);

		foreach ($Custom->salida as $f)
		{
			$xml->add_rama('ROWS');
			$xml->add_nodo('id_partida_modificacion',$f["id_partida_modificacion"]);
			$xml->add_nodo('id_modificacion',$f["id_modificacion"]);
			$xml->add_nodo('id_partida_presupuesto',$f["id_partida_presupuesto"]);
			$xml->add_nodo('id_usuario_autorizado',$f["id_usuario_autorizado"]);
			$xml->add_nodo('desc_usuario_autorizado',$f["desc_usuario_autorizado"]);
			$xml->add_nodo('id_partida_ejecucion',$f["id_partida_ejecucion"]);
			$xml->add_nodo('tipo_modificacion',$f["tipo_modificacion"]);
			$xml->add_nodo('id_moneda',$f["id_moneda"]);
			$xml->add_nodo('desc_moneda',$f["desc_moneda"]);
			$xml->add_nodo('importe',$f["importe"]);
			//$xml->add_nodo('importe',($f["importe"])*(-1));
			$xml->add_nodo('estado',$f["estado"]);
			$xml->add_nodo('id_usuario_reg',$f["id_usuario_reg"]);
			$xml->add_nodo('desc_usuario_reg',$f["desc_usuario_reg"]);
			$xml->add_nodo('fecha_reg',$f["fecha_reg"]);
			
			$xml->add_nodo('id_partida',$f["id_partida"]);
			$xml->add_nodo('id_partida_gasto',$f["id_partida_gasto"]);
			$xml->add_nodo('desc_partida',$f["desc_partida"]);
			$xml->add_nodo('id_presupuesto',$f["id_presupuesto"]);
			$xml->add_nodo('desc_presupuesto',$f["desc_presupuesto"]);
			$xml->add_nodo('desc_disponibilidad',$f["desc_disponibilidad"]);
			
			$xml->add_nodo('mes_01',$f["mes_01"]);
			$xml->add_nodo('mes_02',$f["mes_02"]);
			$xml->add_nodo('mes_03',$f["mes_03"]);
			$xml->add_nodo('mes_04',$f["mes_04"]);
			$xml->add_nodo('mes_05',$f["mes_05"]);
			$xml->add_nodo('mes_06',$f["mes_06"]);
			$xml->add_nodo('mes_07',$f["mes_07"]);
			$xml->add_nodo('mes_08',$f["mes_08"]);
			$xml->add_nodo('mes_09',$f["mes_09"]);
			$xml->add_nodo('mes_10',$f["mes_10"]);
			$xml->add_nodo('mes_11',$f["mes_11"]);
			$xml->add_nodo('mes_12',$f["mes_12"]);
			$xml->add_nodo('total',$f["total"]);

			$xml->fin_rama();	

			$total_importe = $total_importe+$f["importe"];
			$t_mes_01 = $t_mes_01 + $f["mes_01"];
			$t_mes_02 = $t_mes_02 + $f["mes_02"];
			$t_mes_03 = $t_mes_03 + $f["mes_03"];
			$t_mes_04 = $t_mes_04 + $f["mes_04"];
			$t_mes_05 = $t_mes_05 + $f["mes_05"];
			$t_mes_06 = $t_mes_06 + $f["mes_06"];
			$t_mes_07 = $t_mes_07 + $f["mes_07"];
			$t_mes_08 = $t_mes_08 + $f["mes_08"];
			$t_mes_09 = $t_mes_09 + $f["mes_09"];
			$t_mes_10 = $t_mes_10 + $f["mes_10"];
			$t_mes_11 = $t_mes_11 + $f["mes_11"];
			$t_mes_12 = $t_mes_12 + $f["mes_12"];
			
		}
		
		//adicionamos la ultima fila de totales al listado de la grilla
		if($total_registros >= 0)
		{			
			$xml->add_rama('ROWS');
			$xml->add_nodo('id_partida_modificacion',"");
			$xml->add_nodo('id_modificacion',"");
			$xml->add_nodo('id_partida_presupuesto',"");
			$xml->add_nodo('id_usuario_autorizado',"");
			$xml->add_nodo('desc_usuario_autorizado',"");
			$xml->add_nodo('id_partida_ejecucion',"");
			$xml->add_nodo('tipo_modificacion',"T O T A L E S:");
			$xml->add_nodo('id_moneda',"");
			$xml->add_nodo('desc_moneda',"");
			$xml->add_nodo('importe',$total_importe);
			//$xml->add_nodo('importe',number_format($total_importe,2,',','.'));
			$xml->add_nodo('estado',"");
			$xml->add_nodo('id_usuario_reg',"");
			$xml->add_nodo('desc_usuario_reg',"");
			$xml->add_nodo('fecha_reg',"");
			
			$xml->add_nodo('id_partida',"");
			$xml->add_nodo('desc_partida',"");
			$xml->add_nodo('id_presupuesto',"");
			$xml->add_nodo('desc_presupuesto',"");
			
			$xml->add_nodo('mes_01',$t_mes_01);
			$xml->add_nodo('mes_02',$t_mes_02);
			$xml->add_nodo('mes_03',$t_mes_03);
			$xml->add_nodo('mes_04',$t_mes_04);
			$xml->add_nodo('mes_05',$t_mes_05);
			$xml->add_nodo('mes_06',$t_mes_06);
			$xml->add_nodo('mes_07',$t_mes_07);
			$xml->add_nodo('mes_08',$t_mes_08);
			$xml->add_nodo('mes_09',$t_mes_09);
			$xml->add_nodo('mes_10',$t_mes_10);
			$xml->add_nodo('mes_11',$t_mes_11);
			$xml->add_nodo('mes_12',$t_mes_12);
			
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