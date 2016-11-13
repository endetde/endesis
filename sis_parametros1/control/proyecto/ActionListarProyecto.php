<?php
/**
**********************************************************
Nombre de archivo:	    ActionListarProyecto.php
Prop�sito:				Permite realizar el listado en tpm_proyecto
Tabla:					t_tpm_proyecto
Par�metros:				$cant
						$puntero
						$sortcol
						$sortdir
						$criterio_filtro

Valores de Retorno:    	Listado de Procesos y total de registros listados
Fecha de Creaci�n:		2007-11-06 15:33:00
Versi�n:				1.0.0
Autor:					Generado Automaticamente
**********************************************************
*/
session_start();
include_once('../LibModeloParametros.php');

$Custom = new cls_CustomDBParametros();
$nombre_archivo = 'ActionListarProyecto .php';

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

	if($sort == '') $sortcol = 'nombre_proyecto';
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
	$crit_sort = new cls_criterio_sort($sortcol,$sortdir,'Proyecto');
	$sortcol = $crit_sort->get_criterio_sort();
	/**
	 * Avillegas 04/05/2011 para filtrar proyectos del reporte formulacion vs ejecucion
	 */
 if ($tipo_vista=='formulario_ejecucion'){	 
      $criterio_filtro=$criterio_filtro." and  PROYEC.id_proyecto in (SELECT distinct pres.id_proyecto
                         			        FROM presto.vpr_presupuesto pres
                                            WHERE
                                                 pres.tipo_press in ($m_tipo_pres)
                                                 and pres.id_parametro=$m_id_parametro and   (SELECT
                                                                                            sum(mes_01)as Enero

                                                                                            FROM presto.tpr_partida_detalle parde
                                                                                            WHERE parde.id_partida_presupuesto in (select id_partida_presupuesto
                                                             																		from presto.tpr_partida_presupuesto parpre
                                                             																		where parpre.id_presupuesto in ( select id_presupuesto
                                                                                                                                                                     from presto.tpr_presupuesto
                                                                                                                                                                     where
                                                                                                                                                                      tipo_pres in ($m_tipo_pres) and
                                                                                            id_parametro=$m_id_parametro and
                                                                                            id_presupuesto like (pres.id_presupuesto))
                                                               ) )>0)
      ";
     }

	 if ($tipo_vista=='ejecucion_fisica_adm')
     {
     	if($id_parametro)
     	{
     	 	$criterio_filtro=$criterio_filtro." and PROYEC.id_proyecto in (SELECT distinct pres.id_proyecto
                         			        FROM presto.vpr_presupuesto pres
                         			        WHERE pres.tipo_press=3 and pres.id_parametro=$id_parametro)";
     	}
     	else 
     	{
			//listamos solo los proyectos asociados a presupuestos de inversion
     		$criterio_filtro=$criterio_filtro." and PROYEC.id_proyecto in (SELECT distinct pres.id_proyecto
                         			        FROM presto.vpr_presupuesto pres
											WHERE pres.tipo_press=3)";
     	}
     }
	 
	  if ($tipo_vista=='ejecucion_fisica')
     {
     	if($id_parametro)
     	{
     	 	$criterio_filtro=$criterio_filtro."and PROYEC.id_proyecto in (SELECT distinct pres.id_proyecto
                         			        FROM presto.vpr_presupuesto pres
                         			        WHERE pres.tipo_press=3 and pres.id_parametro=$id_parametro)";
     	}
     	else 
     	{
			//listamos solo los proyectos asociados a presupuestos de inversion y filtramos por responsable
     		$criterio_filtro=$criterio_filtro." and PROYEC.id_proyecto in (SELECT distinct pres.id_proyecto
                         			        FROM presto.vpr_presupuesto pres
											WHERE pres.tipo_press=3 ) and PROYEC.id_persona in (Select usu.id_persona FROM sss.tsg_usuario usu WHERE usu.id_usuario = ".$_SESSION["ss_id_usuario"]." )";
     	}
     }
     
     
      if ($tipo_vista=='financiadores_ejecucion'){	 
      	
      /*	echo "entra aqui?";
      	exit;*/
      $criterio_filtro=$criterio_filtro." and  PROYEC.id_proyecto in (SELECT distinct pres.id_proyecto
                         			        FROM presto.vpr_presupuesto pres
                                            WHERE
                                            pres.id_parametro=$id_parametro_rfe )
      ";
     }

     
	//Obtiene el total de los registros
	$res = $Custom -> ContarProyecto($cant ,$puntero,$sortcol,$sortdir,$criterio_filtro,$hidden_ep_id_financiador,$hidden_ep_id_regional,$hidden_ep_id_programa,$hidden_ep_id_proyecto,$hidden_ep_id_actividad);

	if($res) $total_registros= $Custom->salida;

	//Obtiene el conjunto de datos de la consulta
	$res = $Custom->ListarProyecto($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$hidden_ep_id_financiador,$hidden_ep_id_regional,$hidden_ep_id_programa,$hidden_ep_id_proyecto,$hidden_ep_id_actividad);
	
	if($res)
	{
		$xml = new cls_manejo_xml('ROOT');
		$xml->add_nodo('TotalCount',$total_registros);
        if($oc=="si"){
         	$xml->add_rama('ROWS');
			$xml->add_nodo('id_proyecto','%');
			$xml->add_nodo('codigo_proyecto','TODOS');
			$xml->add_nodo('nombre_proyecto','TODOS');
			$xml->add_nodo('descripcion_proyecto','TODOS');
			$xml->add_nodo('fecha_registro','TODOS');
			$xml->add_nodo('hora_registro','TODOS');
			$xml->add_nodo('fecha_ultima_modificacion','TODOS');
			$xml->add_nodo('hora_ultima_modificacion','TODOS');
			$xml->add_nodo('login','TODOS');
			$xml->add_nodo('nombre_corto','TODOS');
			$xml->add_nodo('codigo_sisin','TODOS');

			$xml->fin_rama();
         }
		foreach ($Custom->salida as $f)
		{
			$xml->add_rama('ROWS');
			$xml->add_nodo('id_proyecto',$f["id_proyecto"]);
			$xml->add_nodo('codigo_proyecto',$f["codigo_proyecto"]);
			$xml->add_nodo('nombre_proyecto',$f["nombre_proyecto"]);
			$xml->add_nodo('descripcion_proyecto',$f["descripcion_proyecto"]);
			$xml->add_nodo('fecha_registro',$f["fecha_registro"]);
			$xml->add_nodo('hora_registro',$f["hora_registro"]);
			$xml->add_nodo('fecha_ultima_modificacion',$f["fecha_ultima_modificacion"]);
			$xml->add_nodo('hora_ultima_modificacion',$f["hora_ultima_modificacion"]);
			$xml->add_nodo('login',$f["login"]);
			$xml->add_nodo('nombre_corto',$f["nombre_corto"]);
			$xml->add_nodo('codigo_sisin',$f["codigo_sisin"]);
			$xml->add_nodo('fase_proyecto',$f["fase_proyecto"]);
			$xml->add_nodo('tipo_estudio',$f["tipo_estudio"]);
			$xml->add_nodo('desc_usr_mod',$f["desc_usr_mod"]);
			$xml->add_nodo('id_persona',$f["id_persona"]);
			$xml->add_nodo('desc_persona',$f["desc_persona"]);
			$xml->add_nodo('numero', $f["numero"]);
			$xml->add_nodo('extension', $f["extension"]);
			$xml->add_nodo('nombre_foto', $f["nombre_foto"]);
			$xml->add_nodo('id_proyecto_cat_prog',$f["id_proyecto_cat_prog"]);
			$xml->add_nodo('descripcion_pcp',$f["descripcion_pcp"]);
			
			

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