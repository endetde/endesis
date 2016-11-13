<?php
/**
**********************************************************
Nombre de archivo:	    ActionListarUnidadOrganizacional.php
Prop�sito:				Permite realizar el listado en tkp_unidad_organizacional
Tabla:					t_tkp_unidad_organizacional
Par�metros:				$cant
						$puntero
						$sortcol
						$sortdir
						$criterio_filtro

Valores de Retorno:    	Listado de Procesos y total de registros listados
Fecha de Creaci�n:		2008-05-12 09:24:17
Versi�n:				1.0.0
Autor:					Generado Automaticamente
**********************************************************
*/
session_start();
include_once('../LibModeloKardexPersonal.php');

$Custom = new cls_CustomDBKardexPersonal();
$nombre_archivo = 'ActionListarUnidadOrganizacional .php';

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

	if($sort == '') $sortcol = 'nombre_unidad'; //'id_unidad_organizacional';
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

	if($centro){
		$cond->add_criterio_extra("UNIORG.centro","''".$centro."''");}


		$criterio_filtro = $cond -> obtener_criterio_filtro();

		if($sw_reg_comp=='si' &&$m_id_fuente_financiamiento && $m_id_fina_regi_prog_proy_acti&&$m_id_parametro_conta){
			$criterio_filtro= $criterio_filtro." and  UNIORG.id_unidad_organizacional  in  (
		select id_unidad_organizacional from presto.tpr_presupuesto where id_fina_regi_prog_proy_acti=". $m_id_fina_regi_prog_proy_acti." 
		and  id_fuente_financiamiento=".$m_id_fuente_financiamiento." 
		and  id_parametro IN( select parame.id_parametro 
												from presto.tpr_parametro parame 
												where id_gestion in (select par.id_gestion 
																	from sci.tct_parametro  
																	par where par.id_parametro =".$m_id_parametro_conta.")))
		 ";

		}
		if($m_sw_presupuesto=='si'){$criterio_filtro= $criterio_filtro." and UNIORG.sw_presto =1	";}

		if($tipo_vista=='reporte_solicitudes_uo'){

			$criterio_filtro=$criterio_filtro." and
					UNIORG.id_unidad_organizacional  in  (select id_unidad_organizacional
               		from presto.tpr_presupuesto where
					id_fina_regi_prog_proy_acti like ''$id_fina_regi_prog_proy_acti'')";   
		}

        if($oc=='si'){
        	$criterio_filtro=$criterio_filtro." AND UNIORG.sw_presto=1";
        }
        
        if ($tipo_vista=='vista_diagrama'){
    	 $criterio_filtro=" sw_presto=1 and cargo_individual=''si'' and uniorg.id_nivel_organizacional=2"; //este es para la vista
    }
		//Obtiene el criterio de orden de columnas
		$crit_sort = new cls_criterio_sort($sortcol,$sortdir,'UnidadOrganizacional');
		$sortcol = $crit_sort->get_criterio_sort();

		//Obtiene el total de los registros
		$res = $Custom -> ContarUnidadOrganizacional($cant ,$puntero,$sortcol,$sortdir,$criterio_filtro,$hidden_ep_id_financiador,$hidden_ep_id_regional,$hidden_ep_id_programa,$hidden_ep_id_proyecto,$hidden_ep_id_actividad);

		if($res) $total_registros= $Custom->salida;

		//Obtiene el conjunto de datos de la consulta
		$res = $Custom->ListarUnidadOrganizacional($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$hidden_ep_id_financiador,$hidden_ep_id_regional,$hidden_ep_id_programa,$hidden_ep_id_proyecto,$hidden_ep_id_actividad);

		if($res)
		{
			$xml = new cls_manejo_xml('ROOT');
			$xml->add_nodo('TotalCount',$total_registros);
			if($oc=='si'){
				$xml->add_rama('ROWS');
			    $xml->add_nodo('id_unidad_organizacional', '%');
			    $xml->add_nodo('nombre_unidad', "Todas");
			    $xml->add_nodo('nombre_cargo', "Todos");
			    $xml->add_nodo('centro', "Todos");
			    $xml->add_nodo('cargo_individual', "Todos");
			    $xml->add_nodo('descripcion', "Todos");
			    $xml->add_nodo('fecha_reg', "Todos");
			    $xml->add_nodo('id_nivel_organizacional', "Todos");
			    $xml->add_nodo('nombre_nivel', "Todos");
			    $xml->add_nodo('estado_reg', "Todos");
			    $xml->fin_rama();
			}

			foreach ($Custom->salida as $f)
			{
				$xml->add_rama('ROWS');
				$xml->add_nodo('id_unidad_organizacional',$f["id_unidad_organizacional"]);
				$xml->add_nodo('nombre_unidad',$f["nombre_unidad"]);
				$xml->add_nodo('nombre_cargo',$f["nombre_cargo"]);
				$xml->add_nodo('centro',$f["centro"]);
				$xml->add_nodo('cargo_individual',$f["cargo_individual"]);
				$xml->add_nodo('descripcion',$f["descripcion"]);
				$xml->add_nodo('fecha_reg',$f["fecha_reg"]);
				$xml->add_nodo('id_nivel_organizacional',$f["id_nivel_organizacional"]);
				$xml->add_nodo('nombre_nivel',$f["nombre_nivel"]);
				$xml->add_nodo('estado_reg',$f["estado_reg"]);

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