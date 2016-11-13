<?php
/**
**********************************************************
Nombre de archivo:	    ActionListarTipoUnidadConstructiva.php
Prop�sito:				Permite realizar el listado en tal_tipo_unidad_constructiva
Tabla:					t_tal_tipo_unidad_constructiva
Par�metros:				$cant
						$puntero
						$sortcol
						$sortdir
						$criterio_filtro

Valores de Retorno:    	Listado de Procesos y total de registros listados
Fecha de Creaci�n:		2007-11-07 15:46:18
Versi�n:				1.0.0
Autor:					Generado Automaticamente
**********************************************************
*/
session_start();
include_once('../rcm_LibModeloAlmacenes.php');

$Custom = new cls_CustomDBAlmacenes();
$nombre_archivo = 'ActionListarTipoUnidadConstructiva .php';

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

	if($node=='id'){
		if($sort == '') $sortcol = 'OSUCDE.id_tipo_unidad_constructiva,OSUCDE.descripcion,OSUCDE.id_unidad_constructiva,OSUCDE.id_item';
		else $sortcol = $sort;
	}
	else{
		$sortcol = 'TIPOUC.id_tipo_unidad_constructiva';
	}

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
	if($node=='id')
	{
		$cond->add_criterio_extra("OSUCDE.id_salida",$id_salida);

	}
	$criterio_filtro = $cond -> obtener_criterio_filtro();
	//Obtiene el criterio de orden de columnas
	//$crit_sort = new cls_criterio_sort($sortcol,$sortdir,'OrdenSalidaUCDetalle');
	//$sortcol = $crit_sort->get_criterio_sort();


	//Obtiene el total de los registros
	/*$res = $Custom -> ContarTipoUnidadConstructiva($cant ,$puntero,$sortcol,$sortdir,$criterio_filtro,$hidden_ep_id_financiador,$hidden_ep_id_regional,$hidden_ep_id_programa,$hidden_ep_id_proyecto,$hidden_ep_id_actividad);

	if($res) $total_registros= $Custom->salida;

	*/

	/*echo "tipo:".$node=='id';
	exit;*/

	$nodos['totalCount']=0;
	if($node=='id'){
		//Obtiene el conjunto de datos de la consulta
		/*$res = $Custom->ListarOrdenSalidaUCDetalle($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$hidden_ep_id_financiador,$hidden_ep_id_regional,$hidden_ep_id_programa,$hidden_ep_id_proyecto,$hidden_ep_id_actividad);

		if($res)
		{
		foreach ($Custom->salida as $f)
		{
		//Forma la cadena de la cantidad solicitada
		$cantidad=" [".utf8_encode($f["cantidad"]."]");

		if($f['id_item'] != "")
		{
		//Configura el nodo tipo item
		$tmp['leaf'] = true;
		$tmp['text'] = utf8_encode($f["nombre"]) . "<b>$cantidad</b>";
		$tmp['icon'] = "../../../lib/imagenes/item.png";
		$tmp['tipo'] = "item";
		$tmp['id'] = utf8_encode($f["id_item"]);
		}
		else
		{	//Configura el nodo tipo tipo unidad constructiva
		$tmp['leaf'] = false;
		$tmp['text'] = utf8_encode($f["codigo"]) . "<b>$cantidad</b>";
		$tmp['icon'] = "../../../lib/imagenes/tucr.png";
		$tmp['tipo'] = "raiz";
		$tmp['id'] = utf8_encode($f["id_tipo_unidad_constructiva"]);
		}

		$tmp['repeticion'] = utf8_encode($f["repeticion"])=='si' ? 'true':'false';
		$tmp['id_reg'] = utf8_encode($f["id_orden_salida_uc_detalle"]);
		$tmp['cls']	= 'folder';
		$tmp['allowDelete']	= true;
		$tmp['allowEdit']	= true;
		$tmp['allowDrag']	= false;
		$tmp['codigo'] = utf8_encode($f["codigo"]);
		$tmp['nombre'] = utf8_encode($f["nombre"]);
		$tmp['descripcion'] = utf8_encode($f["descripcion"]);
		$tmp['observaciones'] = utf8_encode($f["observaciones"]);
		$tmp['cantidad'] = utf8_encode($f["cantidad"]);
		$tmp['qtip'] = "Nombre: ".$tmp['nombre']." <br \/>Descripcion: ".$tmp["descripcion"];
		$tmp['qtipTitle']="Codigo: ".$tmp["codigo"];

		$nodes[] = $tmp;
		}

		if(sizeof($nodes)>0){
		echo json_encode($nodes);
		}
		else {
		echo '{}';
		}


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
		}*/
		unset($_SESSION['verif_exist_uc']);
		$_SESSION['verif_exist_uc']=array();
		echo json_encode($_SESSION['verif_exist_uc']);
	}
	else
	{
		//Obtiene el conjunto de datos de la consulta
		//TODO: debe recibirse el id_reg para ejecutar la consulta
		$res = $Custom->ListarOrdenSalidaUCDetalleRamas($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$hidden_ep_id_financiador,$hidden_ep_id_regional,$hidden_ep_id_programa,$hidden_ep_id_proyecto,$hidden_ep_id_actividad,$node,$id_reg);

		if($res)
		{
			foreach ($Custom->salida as $f)
			{
				$cantidad=" [".utf8_encode($f["cantidad"]."]");
				$tmp['text'] = utf8_encode($f["codigo"]).' - '.utf8_encode($f["nombre"])."<b>$cantidad</b>";
				$tmp['id'] = utf8_encode($f["id_tipo_unidad_constructiva"]);
				$tmp['leaf'] = false;
				$tmp['allowDelete']=false;
				$tmp['allowEdit']=utf8_encode($f["opcional"])=='si' ? 'true':'false';
				$tmp['tipo'] = "rama";
				$tmp['id_p'] = utf8_encode($f["id_tuc_padre"]);
				$tmp['id_composicion_tuc'] = utf8_encode($f["id_composicion_tuc"]);
				$tmp['codigo'] = utf8_encode($f["codigo"]);
				$tmp['nombre'] = utf8_encode($f["nombre"]);
				$tmp['descripcion'] = utf8_encode($f["descripcion"]);
				$tmp['observaciones'] = utf8_encode($f["observaciones"]);
				$tmp['cantidad'] = utf8_encode($f["cantidad"]);
				$tmp['opcional'] = utf8_encode($f["opcional"])=='si' ? 'true':'false';
				$tmp['qtip'] = "Nombre: ".$tmp['nombre']." <br \/>Descripcion: ".$tmp["descripcion"];
				$tmp['qtipTitle']="Codigo: ".$tmp["codigo"];
				$tmp['reemp']=$f["reemplazo"];
				$tmp['allowDrag']	= false;

				if($f["reemplazo"]=='si')
				{
					$tmp['icon'] = "../../../lib/imagenes/tucrem.png";
				}
				else
				{
					$tmp['icon'] = "../../../lib/imagenes/tuc.png";
				}
				//Verifica si es opcional
				if($tmp['opcional']=='true')
				{$tmp['text']=$tmp['text']." <FONT COLOR= \"red\"><b><u>Opcional</u></b></FONT>";}

				$nodes[] = $tmp;
			}


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

		//Obtiene el conjunto de datos de la consulta
		$sortcol = 'COMP.id_tipo_unidad_constructiva';
		$res = $Custom->ListarOrdenSalidaUCDetalleItem($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$hidden_ep_id_financiador,$hidden_ep_id_regional,$hidden_ep_id_programa,$hidden_ep_id_proyecto,$hidden_ep_id_actividad,$node,$id_reg);

		/*************LISTA ITEM ************/
		if($res)
		{
			foreach ($Custom->salida as $f)
			{
				if($f["cantidad_padre"]<>'')
				{
					$cant_tot = $f["cantidad_padre"] * $f["cantidad"];
					$cantidad=" [".$cant_tot."]";
				}
				else
				{
					$cantidad=" [".utf8_encode($f["cantidad"]."]");
				}

				$tmp['text'] = utf8_encode($f["nombre_item"] . "<b>$cantidad</b>");
				$tmp['id'] = utf8_encode($f["id_item"]);
				$tmp['leaf']= true;
				$tmp['allowDelete'] = false;
				$tmp['allowEdit'] = false;
				$tmp['icon'] = "../../../lib/imagenes/item.png";
				$tmp['tipo'] = "item";
				$tmp['id_p'] = utf8_encode($f["id_tipo_unidad_constructiva"]);
				$tmp['codigo'] = utf8_encode($f["codigo_item"]);
				$tmp['nombre'] = utf8_encode($f["nombre_item"]);
				$tmp['descripcion'] = utf8_encode($f["descripcion"]);
				$tmp['observaciones'] = utf8_encode($f["observaciones"]);
				$tmp['cantidad'] = utf8_encode($f["cantidad"]);
				$tmp['opcional'] = utf8_encode($f["cosiderar_repeticion"])=='si' ? 'true':'false';
				$tmp['qtip'] = "Nombre: ".$tmp['nombre']." <br \/>Descripcion: ".$tmp["descripcion"]." <br \/>Cantidad por 1 Unidad Constructiva: ".$f["cantidad"];
				$tmp['qtipTitle']="Codigo: ".$tmp["codigo"];
				$tmp['allowDrag']	= false;

				$nodes[] = $tmp;
			}



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


		if(sizeof($nodes)>0){
			echo json_encode($nodes);
		}
		else {
			echo '{}';
		}

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