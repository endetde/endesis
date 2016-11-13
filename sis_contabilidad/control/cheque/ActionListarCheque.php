<?php
/**
**********************************************************
Nombre de archivo:	    ActionListarCheque.php
Prop�sito:				Permite realizar el listado en tct_cheque
Tabla:					tct_tct_cheque
Par�metros:				$cant
						$puntero
						$sortcol
						$sortdir
						$criterio_filtro

Valores de Retorno:    	Listado de Procesos y total de registros listados
Fecha de Creaci�n:		2008-10-17 11:24:35
Versi�n:				1.0.0
Autor:					Generado Automaticamente
**********************************************************
*/
session_start();
include_once('../LibModeloContabilidad.php');

$Custom = new cls_CustomDBContabilidad();
$nombre_archivo = 'ActionListarCheque.php';

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

	if($sort == '') $sortcol = 'CHEQUE.nro_cheque';
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
	$cond->add_criterio_extra("CUEBAN.id_cuenta_bancaria",$m_id_cuenta_bancaria);
	$cond->add_criterio_extra("CHEVAL.id_moneda",$m_id_moneda);
	$cond->add_criterio_extra("CHEQUE.id_transaccion",$m_id_transaccion);
	
	
	$criterio_filtro = $cond -> obtener_criterio_filtro();
	
	if($sw_conci_banc==1){		
	    if($m_vista_cheque==1) $criterio_filtro=$criterio_filtro." AND CHEQUE.nro_cheque > 0 AND CHEQUE.estado_cheque NOT IN (5) ";
	    if($m_vista_cheque==2) $criterio_filtro=$criterio_filtro." AND CHEQUE.nro_cheque is null AND CHEQUE.estado_cheque NOT IN (5) ";
	    $criterio_filtro=$criterio_filtro." AND CHEQUE.fecha_cheque >= ''".$m_fecha_inicio."'' AND CHEQUE.fecha_cheque <= ''".$m_fecha_fin."''";	
	}
	//Obtiene el criterio de orden de columnas
	$crit_sort = new cls_criterio_sort($sortcol,$sortdir,'Cheque');
	
	$sortcol = $crit_sort->get_criterio_sort();
	
	

	//Obtiene el total de los registros
	$res = $Custom -> ContarCheque($cant ,$puntero,$sortcol,$sortdir,$criterio_filtro,$hidden_ep_id_financiador,$hidden_ep_id_regional,$hidden_ep_id_programa,$hidden_ep_id_proyecto,$hidden_ep_id_actividad);

	if($res) $total_registros= $Custom->salida;

	//Obtiene el conjunto de datos de la consulta
	$res = $Custom->ListarCheque($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$hidden_ep_id_financiador,$hidden_ep_id_regional,$hidden_ep_id_programa,$hidden_ep_id_proyecto,$hidden_ep_id_actividad);
	
	if($res)
	{
		$xml = new cls_manejo_xml('ROOT');
		$xml->add_nodo('TotalCount',$total_registros);

		foreach ($Custom->salida as $f)
		{
			$xml->add_rama('ROWS');
			$xml->add_nodo('id_cheque',$f["id_cheque"]);
			$xml->add_nodo('id_transaccion',$f["id_transaccion"]);
			$xml->add_nodo('desc_comprobante',$f["desc_comprobante"]);
			$xml->add_nodo('desc_transaccion',$f["desc_transaccion"]);
			$xml->add_nodo('nro_cheque',$f["nro_cheque"]);
			$xml->add_nodo('nro_deposito',$f["nro_deposito"]);
			$xml->add_nodo('fecha_cheque',$f["fecha_cheque"]);
			$xml->add_nodo('nombre_cheque',$f["nombre_cheque"]);
			$xml->add_nodo('estado_cheque',$f["estado_cheque"]);
			$xml->add_nodo('id_cuenta_bancaria',$f["id_cuenta_bancaria"]);
			$xml->add_nodo('fecha_cobro',$f["fecha_cobro"]);
            $xml->add_nodo('id_cheque_valor',$f["id_cheque_valor"]);
            $xml->add_nodo('id_moneda',$f["id_moneda"]);
            $xml->add_nodo('nombre_moneda',$f["nombre_moneda"]);
            $xml->add_nodo('importe_cheque',$f["importe_cheque"]);
            $xml->add_nodo('nro_cuenta_banco',$f["nro_cuenta_banco"]);
            $xml->add_nodo('nro_transaccion',$f["nro_transaccion"]);
            $xml->add_nodo('tipo_cheque',$f["tipo_cheque"]);
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