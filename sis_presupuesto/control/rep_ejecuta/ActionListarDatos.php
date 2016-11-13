<?php
/**
**********************************************************
Nombre de archivo:	    ActionListarDatos.php
Prop�sito:				Permite realizar el listado en tt_tct_datos
Tabla:					tt_tct_maydat
Par�metros:				$cant
						$puntero
						$sortcol
						$sortdir
						$criterio_filtro

Valores de Retorno:    	Listado de Procesos y total de registros listados
Fecha de Creaci�n:		2013-09-04 08:54:29
Versi�n:				1.0.0
Autor:					Generado Automaticamente
**********************************************************
*/
session_start();
include_once('../LibModeloPresupuesto.php');

$Custom = new cls_CustomDBPresupuesto();
$nombre_archivo = 'ActionListarDatos.php';

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

	if($sort == '') $sortcol = 'codigo';
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
	
	for($i=0;$i<$_POST['CantFiltros'];$i++){
		$cond->add_condicion_filtro($_POST["filterCol_$i"], $_POST["filterValue_$i"], $_POST["filterAvanzado_$i"]);
	}

	$criterio_filtro = $cond -> obtener_criterio_filtro();
	
	//Obtiene el total de los registros
 	$res = $Custom -> ContarDatos($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad,
 	$_POST['sw_admi'],$_POST['sw_listado'],$_POST['id_parametro'],$_POST['id_tipo_pres']);
  	
	if($res) $total_registros= $Custom->salida;
	//echo $criterio_filtro; exit;
	//Obtiene el conjunto de datos de la consulta
	$res = $Custom->ListarDatos($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad,
	$_POST['sw_admi'],$_POST['sw_listado'],$_POST['id_parametro'],$_POST['id_tipo_pres']);
		
	//echo $Custom -> query;exit;
	if($res)
	{	$contador=0;
		$xml = new cls_manejo_xml('ROOT');
		$xml->add_nodo('TotalCount',$total_registros);
		
		foreach ($Custom->salida as $f)
		{
			$xml->add_rama('ROWS');
			$xml->add_nodo('id_datos',$f["id_datos"]);
			$xml->add_nodo('codigo',$f["codigo"]);
			$xml->add_nodo('nombre',$f["nombre"]);
			$xml->add_nodo('codigo_nombre',$f["codigo"]." - ".$f["nombre"]);
			$xml->fin_rama();
		$contador++;
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
