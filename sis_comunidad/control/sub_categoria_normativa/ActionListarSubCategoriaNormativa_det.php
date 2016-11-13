<?php
/**
**********************************************************
Nombre de archivo:	    ActionListarSubCategoriaNormativa_det.php
Prop�sito:				Permite realizar el listado en comunidad.com_detalle_normativa
Tabla:					comunidad.com_detalle_normativa
Par�metros:				$cant
						$puntero
						$sortcol
						$sortdir
						$criterio_filtro

Valores de Retorno:    	Listado de Procesos y total de registros listados
Fecha de Creaci�n:		2013-05-16 14:58:48
Versi�n:				1.0.0
Autor:					Morgan Huascar Checa Lopez
**********************************************************
*/
session_start();
include_once('../LibModeloAdministracionComunidad.php');

$Custom = new cls_CustomDBComunidad();
$nombre_archivo = 'ActionListarSubCategoriaNormativa_det .php';

if (!isset($_SESSION['autentificado']))
{
	$_SESSION['autentificado']='NO';
}
if($_SESSION['autentificado']=='SI')
{
//Par�metros del filtro
	if($limit == '') $cant = 30;
	else $cant = $limit;

	if($start == '') $puntero = 0;
	else $puntero = $start;

	if($sort == '') $sortcol = 'DN.id_detalle_normativa';
	else $sortcol = $sort;

	if($dir == '') $sortdir = 'ASC';
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
	
	$cond->add_criterio_extra("DN.id_normativa_interna",$m_id_normativa_interna);
	
	$criterio_filtro = $cond -> obtener_criterio_filtro();
	
	//$valor=$_POST['m_id_normativa_interna'];
	$criterio_filtro=$criterio_filtro." AND DN.estado_registro=''activo'' ";
	//Obtiene el total de los registros1
	$res = $Custom -> ContarDetalleNormativa($cant ,$puntero,$sortcol,$sortdir,$criterio_filtro);

	if($res) $total_registros= $Custom->salida;
	$_SESSION['id_normativa_interna']=$m_id_normativa_interna;
	//Obtiene el conjunto de datos de la consulta
	$res = $Custom->ListarDetalleNormativa($cant,$puntero,$sortcol,$sortdir,$criterio_filtro);
	
	if($res)
	{
		$xml = new cls_manejo_xml('ROOT');
		$xml->add_nodo('TotalCount',$total_registros);

		foreach ($Custom->salida as $f)
		{
			$xml->add_rama('ROWS');
			$xml->add_nodo('id_detalle_normativa',$f["id_detalle_normativa"]);
			$xml->add_nodo('nombre_subcategoria',$f["nombre_subcategoria"]);
			$xml->add_nodo('descripcion_subcategoria',$f["descripcion_subcategoria"]);
			$xml->add_nodo('fecha_registro',$f["fecha_registro"]);
			$xml->add_nodo('id_normativa_interna',$f["id_normativa_interna"]);
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