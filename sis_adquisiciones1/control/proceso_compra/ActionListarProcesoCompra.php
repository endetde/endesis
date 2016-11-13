<?php
/**
**********************************************************
Nombre de archivo:	    ActionListarProcesoCompra.php
Prop�sito:				Permite realizar el listado en tad_proceso_compra
Tabla:					t_tad_proceso_compra
Par�metros:				$cant
						$puntero
						$sortcol
						$sortdir
						$criterio_filtro

Valores de Retorno:    	Listado de Procesos y total de registros listados
Fecha de Creaci�n:		2008-05-13 18:03:04
Versi�n:				1.0.0
Autor:					Generado Automaticamente
**********************************************************
*/
session_start();
include_once('../LibModeloAdquisiciones.php');

$Custom = new cls_CustomDBAdquisiciones();
$nombre_archivo = 'ActionListarProcesoCompra .php';

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

	if($sort == '') $sortcol = 'PROCOM.id_proceso_compra';
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

	$criterio_filtro = $cond -> obtener_criterio_filtro();

	

	$tipo_filtro='';

	if($estado!='')//para filtrar los procesos por estado_vigente
	{ 
        if($estado=='finalizado'){
	       $criterio_filtro=$criterio_filtro." AND (PROCOM.estado_vigente=''finalizado'' OR PROCOM.estado_vigente=''anulado'')";	
	   }else{
		    $criterio_filtro=$criterio_filtro." AND (PROCOM.estado_vigente=''$estado'')";
	   }
	   
	   	$tipo_filtro.=$estado;
	   
	}
	
	//Obtiene el criterio de orden de columnas
	
	if($directo!=''){
	    $criterio_filtro=$criterio_filtro." AND PROCOM.id_comprador>0 and PROCOM.compra_simplificada=1";
	}else{
	    $criterio_filtro=$criterio_filtro." AND PROCOM.id_comprador is null and PROCOM.compra_simplificada=0";
	}
	
	if($estado_proceso=='inicio'){// para listar los procesos cuya cotizacion se encuentra en pendiente, invitado, aperturado, finalizado o anulado : utilizado en vista proceso_compra.js
	    
	   $criterio_filtro = $criterio_filtro." AND (PROCOM.id_proceso_compra not in (select id_proceso_compra from compro.tad_cotizacion) OR (PROCOM.id_proceso_compra in (select id_proceso_compra from compro.tad_cotizacion where (estado_vigente =''invitado'') or (estado_vigente=''pendiente'') or (estado_vigente=''aperturado'') or (estado_vigente=''finalizado'')  or (estado_vigente=''cotizado'') or (estado_vigente=''anulado'')  or (estado_vigente=''adjudicado'')  or (estado_vigente=''orden_compra'') or (estado_vigente=''en_pago'') or (estado_vigente=''formulacion_pp''))))";	
	}
		
	if($estado_cotizacion=='cotizado'){//para listar los procesos que estan listos para adjudicar==> util para vista: proceso_adjudicacion
		
	    $criterio_filtro=$criterio_filtro." AND PROCOM.id_proceso_compra in (select id_proceso_compra from compro.tad_cotizacion where estado_vigente=''$estado_cotizacion'')";
	}
	
	if($adjudicacion!=''){//para listar los procesos a los cuales se les va a emitir la orden de compra
		$tipo_filtro='adjudicacion_si';//RAC
	   
	  // $criterio_filtro = $criterio_filtro." and PROCOM.estado_vigente!=''finalizado'' ";	
	    
	   
	    $criterio_filtro = $criterio_filtro." AND PROCOM.id_proceso_compra in 
	       
	    ( select id_proceso_compra 
	      from compro.tad_cotizacion 
	      where 
	      --id_proceso_compra=PROCOM.id_proceso_compra and 
	      
	      (
	      estado_vigente =''adjudicado'' 
	      or estado_vigente=''orden_compra'' 
	      or estado_vigente=''en_pago''  
	      or estado_vigente=''formulacion_pp'') 
	      
	     ) 
	     and PROCOM.estado_vigente!=''finalizado''
	     ";
	
	
	}
	
	if($id_proceso_compra>0){//para listar los datos en el maestro de cotizacion
		$criterio_filtro=$criterio_filtro." AND PROCOM.id_proceso_compra=''$id_proceso_compra''";
	}
//esta restriccion es para listar solo los procesos que tengan detalles que esten  en grupo "activo"
    if($tipo=='bien'){//para separar en la vista los procesos de bienes y los de servicios
       $criterio_filtro=$criterio_filtro. " AND  PROCOM.id_tipo_adq =4 ";
    } elseif($tipo=='servicio'){
		$criterio_filtro=$criterio_filtro. " AND  PROCOM.id_tipo_adq !=4 ";  
	}    

    if($estado!='finalizado'){
       
       // if($estado_proceso=='inicio'){
        //$criterio_filtro=$criterio_filtro ."AND PROCOM.id_proceso_compra in (select id_proceso_compra from compro.tad_proceso_compra_det where id_proceso_compra_det in(select id_proceso_compra_det from compro.tad_grupo_sp_det)) ";
        //}else{
           $criterio_filtro=$criterio_filtro ." AND PROCOM.id_proceso_compra in (select id_proceso_compra from compro.tad_proceso_compra_det where id_proceso_compra_det in(select id_proceso_compra_det from compro.tad_grupo_sp_det )) ";
    //}
     }
     
    //echo $criterio_filtro; exit;
     
     
	if($sort=='numeracion_periodo_proceso'){
		$sortcol="PROCOM.periodo $sortdir, PROCOM.num_proceso $sortdir";
	}
	elseif($sort=='numeracion_periodo_cotizacion'){
		$sortcol="PROCOM.periodo $sortdir, PROCOM.num_cotizacion $sortdir";
	}else{
	$crit_sort = new cls_criterio_sort($sortcol,$sortdir,'PROCOM.periodo');
	$sortcol = $crit_sort->get_criterio_sort();
	}
 
	
	
	
	//Obtiene el total de los registros
	
	
	$res = $Custom -> ContarProcesoCompra($cant ,$puntero,$sortcol,$sortdir,$criterio_filtro,$hidden_ep_id_financiador,$hidden_ep_id_regional,$hidden_ep_id_programa,$hidden_ep_id_proyecto,$hidden_ep_id_actividad,$tipo_filtro);

	if($res) $total_registros= $Custom->salida;

	//Obtiene el conjunto de datos de la consulta
	$res = $Custom->ListarProcesoCompra($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$hidden_ep_id_financiador,$hidden_ep_id_regional,$hidden_ep_id_programa,$hidden_ep_id_proyecto,$hidden_ep_id_actividad,$tipo_filtro);
	
	if($res)
	{
		$xml = new cls_manejo_xml('ROOT');
		$xml->add_nodo('TotalCount',$total_registros);

		foreach ($Custom->salida as $f)
		{
			$xml->add_rama('ROWS');
			$xml->add_nodo('id_proceso_compra',$f["id_proceso_compra"]);
			$xml->add_nodo('observaciones',$f["observaciones"]);
			$xml->add_nodo('codigo_proceso',$f["codigo_proceso"]);
			$xml->add_nodo('fecha_reg',$f["fecha_reg"]);
			$xml->add_nodo('estado_vigente',$f["estado_vigente"]);
			$xml->add_nodo('id_tipo_categoria_adq',$f["id_tipo_categoria_adq"]);
			$xml->add_nodo('desc_tipo_categoria_adq',$f["desc_tipo_categoria_adq"]);
			$xml->add_nodo('id_categoria_adq',$f["id_categoria_adq"]);
			$xml->add_nodo('desc_categoria_adq',$f["desc_categoria_adq"]);
			$xml->add_nodo('id_moneda',$f["id_moneda"]);
			$xml->add_nodo('desc_moneda',$f["desc_moneda"]);
			$xml->add_nodo('num_cotizacion',$f["num_cotizacion"]);
			$xml->add_nodo('num_proceso',$f["num_proceso"]);
			$xml->add_nodo('siguiente_estado',$f["siguiente_estado"]);
			$xml->add_nodo('periodo',$f["periodo"]);
			$xml->add_nodo('gestion',$f["gestion"]);
			$xml->add_nodo('num_cotizacion_sis',$f["num_cotizacion_sis"]);
			$xml->add_nodo('num_proceso_sis',$f["num_proceso_sis"]);
			$xml->add_nodo('fecha_proc',$f["fecha_proc"]);
			$xml->add_nodo('id_tipo_adq',$f["id_tipo_adq"]);
			$xml->add_nodo('desc_tipo_adq',$f["desc_tipo_adq"]);
			$xml->add_nodo('tipo_adq',$f["tipo_adq"]);
			$xml->add_nodo('lugar_entrega',$f["lugar_entrega"]);
			$xml->add_nodo('id_proceso_compra_ant',$f["id_proceso_compra_ant"]);
			$xml->add_nodo('num_convocatoria',$f["num_convocatoria"]);
			//$xml->add_nodo('num_proceso_sis',$f["num_proceso_sis"]);
			//$xml->add_nodo('num_cotizacion_sis',$f["num_cotizacion_sis"]);
			$xml->add_nodo('id_cotizacion',$f["id_cotizacion"]);
			$xml->add_nodo('id_moneda_base',$f["id_moneda_base"]);
			$xml->add_nodo('proceso_cotizado',$f["proceso_cotizado"]);
			$xml->add_nodo('proceso_adjudicado',$f["proceso_adjudicado"]);
			$xml->add_nodo('ejecutado',$f["ejecutado"]);
			$xml->add_nodo('observaciones_acta',$f["observaciones_acta"]);
			$xml->add_nodo('cantidad_sol',$f["cantidad_sol"]);
			$xml->add_nodo('cant_se_adjudica',$f["cant_se_adjudica"]);
			$xml->add_nodo('num_sol_por_proc',$f["num_sol_por_proc"]);
			$xml->add_nodo('id_depto',$f["id_depto"]);
			$xml->add_nodo('numeracion_periodo_proceso',$f["periodo"]."/".$f["num_proceso"]);
			$xml->add_nodo('numeracion_periodo_cotizacion',$f["periodo"]."/".$f["num_cotizacion"]);
			$xml->add_nodo('avance',$f["avance"]);
			$xml->add_nodo('pago_variable',$f["pago_variable"]);
			$xml->add_nodo('sgte_gestion',$f["sgte_gestion"]);
			$xml->add_nodo('con_ppto_sgte_gestion',$f["con_ppto_sgte_gestion"]);
			$xml->add_nodo('gestion_ppto',$f["gestion_ppto"]);
			
			
			$xml->add_nodo('usuario_reg',$f["usuario_reg"]);
			$xml->add_nodo('hora_reg',$f["hora_reg"]);
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