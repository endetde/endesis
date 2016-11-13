<?php
/**
**********************************************************
Nombre de archivo:	    ActionListarSietTraspasos.php
Prop�sito:				Permite realizar el listado en tsi_siet_cbte
Tabla:					tsi_siet_cbte_partida
Par�metros:				$cant
						$puntero
						$sortcol
						$sortdir
						$criterio_filtro

Valores de Retorno:    	Listado de Procesos y total de registros listados
Fecha de Creaci�n:		01/11/2015
Versi�n:				1.0.0
Autor:					A.V.Q
**********************************************************
*/
session_start();
include_once('../LibModeloPresupuesto.php');
include_once('../../../lib/lib_control/GestionarExcel.php');

$Custom = new cls_CustomDBPresupuesto();
$nombre_archivo = 'ActionListarSietTraspasos.php';

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

	if($sort == '') $sortcol = 'id_siet_traspaso';
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
	
	if ($get)
		{
		$id_siet_declara= $_GET["m_id_siet_declara"];
		}
	else
		{  
			$id_siet_declara= $_POST["m_id_siet_declara"];
		}
		
		
		/*echo $m_id_siet_declara;
	    exit;
	*/
	$criterio_filtro=$criterio_filtro." AND TRASP.id_siet_declara =$id_siet_declara ";
	
	
	//Obtiene el criterio de orden de columnas
	$crit_sort = new cls_criterio_sort($sortcol,$sortdir,'SietTraspasos');
	$sortcol = $crit_sort->get_criterio_sort();
	
	if (sizeof($_GET) > 0){
	
		$CantFiltros=$_GET["CantFiltros"];
		$nro_columnas=$_GET["nro_columnas"];
		$titulo_reporte_excel=$_GET["titulo_reporte_excel"];
		$get=true;
	}
	if (sizeof($_POST) > 0){
		$CantFiltros=$_POST["CantFiltros"];
		$nro_columnas=$_POST["nro_columnas"];
		$titulo_reporte_excel=$_POST["titulo_reporte_excel"];
		$get=false;
	}
	
	for($i=0;$i<$CantFiltros;$i++){
		$cond->add_condicion_filtro($_GET["filterCol_$i"], $_GET["filterValue_$i"], $_GET["filterAvanzado_$i"]);
		$cond->add_condicion_filtro($_POST["filterCol_$i"], $_POST["filterValue_$i"], $_POST["filterAvanzado_$i"]);
	}
	
	//$criterio_filtro = $cond -> obtener_criterio_filtro();
	if ($reporte_excel=='si')
	{	
		$criterio_filtro=" TRASP.id_siet_declara =$m_id_siet_declara ";
	for($i=0;$i<$nro_columnas;$i++){
		$datosCabecera['valor'][$i]=$_GET["valor_$i"];
		$datosCabecera['columna'][$i]=$_GET["columna_$i"];
		$datosCabecera['align'][$i]=$_GET["align_$i"];
		$datosCabecera['width'][$i]=$_GET["width_$i"];
	}
	$Excel = new GestionarExcel();
	$Excel->SetNombreReporte("Traspasos");
	//echo $titulo_reporte_excel; exit();
	$Excel->SetHoja("Traspasos");
	$Excel->SetFila(0);
	$cant=100000000;
	$puntero=0;
		
	//$Excel->SetTitulo($titulo_reporte_excel,0,3,$nro_columnas); //Colocamos el titulo al reporte
	$Excel->SetCabeceraDetalle($datosCabecera);//Colocamos el nombre de las columnas
	/*echo $sortcol;
	echo $sortdir;
	exit;	*/
	
	$res = $Custom->ListarSietTraspaso($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$hidden_ep_id_financiador,$hidden_ep_id_regional,$hidden_ep_id_programa,$hidden_ep_id_proyecto,$hidden_ep_id_actividad);
		
	$Excel->setDetalle($Custom->salida);
	$Excel->setFin();
	}
	else {

	//Obtiene el total de los registros
	$res = $Custom -> ContarSietTraspaso($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$hidden_ep_id_financiador,$hidden_ep_id_regional,$hidden_ep_id_programa,$hidden_ep_id_proyecto,$hidden_ep_id_actividad);

	if($res) $total_registros= $Custom->salida;

	//Obtiene el conjunto de datos de la consulta
	$res = $Custom->ListarSietTraspaso($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$hidden_ep_id_financiador,$hidden_ep_id_regional,$hidden_ep_id_programa,$hidden_ep_id_proyecto,$hidden_ep_id_actividad);
	
	if($res)
	{
		$xml = new cls_manejo_xml('ROOT');
		$xml->add_nodo('TotalCount',$total_registros);

		foreach ($Custom->salida as $f)
		{
			$xml->add_rama('ROWS');
			$xml->add_nodo('id_siet_traspaso',$f["id_siet_traspaso"]);
			$xml->add_nodo('id_siet_declara',$f["id_siet_declara"]);
			$xml->add_nodo('id_siet_cbte_origen',$f["id_cbte_origen"]);
			$xml->add_nodo('id_siet_cbte_destino',$f["id_cbte_destino"]);
			$xml->add_nodo('nro_cbte_origen',$f["nro_cbte_origen"]);
			$xml->add_nodo('nro_cbte_destino',$f["nro_cbte_destino"]);
			$xml->add_nodo('nro_cuenta_bancaria_origen',$f["nro_cuenta_bancaria_origen"]);
			$xml->add_nodo('nro_cuenta_bancaria_destino',$f["nro_cuenta_bancaria_destino"]);
			$xml->add_nodo('importe_origen',$f["importe_origen"]);
			$xml->add_nodo('importe_destino',$f["importe_destino"]);
			$xml->add_nodo('id_cbte',$f["id_cbte"]);
			$xml->add_nodo('glosa',$f["glosa"]);
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