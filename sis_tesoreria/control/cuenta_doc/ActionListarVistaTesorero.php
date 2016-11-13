<?php
/**
**********************************************************
Nombre de archivo:	    ActionListarSolicitudViaticos2.php
Prop�sito:				Permite realizar el listado en tts_cuenta_doc
Tabla:					tts_tts_cuenta_doc
Par�metros:				$cant
						$puntero
						$sortcol
						$sortdir
						$criterio_filtro

Valores de Retorno:    	Listado de Procesos y total de registros listados
Fecha de Creaci�n:		2009-10-27 10:40:41
Versi�n:				1.0.0
Autor:					Generado Automaticamente
**********************************************************
*/
session_start();
include_once('../LibModeloTesoreria.php');
include_once('../../../lib/lib_control/GestionarExcel.php');

$Custom = new cls_CustomDBTesoreria();
$nombre_archivo = 'ActionListarVistaTesorero.php';

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

	if($sort == '') $sortcol = 'id_cuenta_doc';
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

	//--jgl inicio
	$cond = new cls_criterio_filtro($decodificar);
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
	//--jgl fin
	
	//Se obtiene el criterio del filtro con formato sql para mandar a la BD
	$cond = new cls_criterio_filtro($decodificar);
	for($i=0;$i<$CantFiltros;$i++)
	{
		$cond->add_condicion_filtro($_POST["filterCol_$i"], $_POST["filterValue_$i"], $_POST["filterAvanzado_$i"]);
	}
	$criterio_filtro = $cond -> obtener_criterio_filtro();
	
	//Obtiene el criterio de orden de columnas
	$crit_sort = new cls_criterio_sort($sortcol,$sortdir,'CuentaDoc_123345g');
	$sortcol = $crit_sort->get_criterio_sort();

	//--jgl inicio
 	if ($reporte_excel=='si')
	{	//recupera los valores de las columnas
		for($i=0;$i<$nro_columnas;$i++){
			$datosCabecera['valor'][$i]=$_GET["valor_$i"];
			$datosCabecera['columna'][$i]=$_GET["columna_$i"];
			$datosCabecera['align'][$i]=$_GET["align_$i"];
			$datosCabecera['width'][$i]=$_GET["width_$i"];		
		}	
		$Excel = new GestionarExcel();
		$Excel->SetNombreReporte("Cuenta Documentada");
		//echo $titulo_reporte_excel; exit();
		$Excel->SetHoja("Hoja 1 Datos");
		$Excel->SetFila(3);
		$cant=100000000;
		$puntero=0;
		 
		$Excel->SetTitulo("Cuenta Documentada",0,3,$nro_columnas); //Colocamos el titulo al reporte
		$Excel->SetCabeceraDetalle($datosCabecera);//Colocamos el nombre de las columnas
		
		                
		$res = $Custom->ListarDatosTesorero($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$hidden_ep_id_financiador,$hidden_ep_id_regional,$hidden_ep_id_programa,$hidden_ep_id_proyecto,$hidden_ep_id_actividad); 
	 
		$Excel->setDetalle($Custom->salida);
		$Excel->setFin();		
		}
	else {
	//--jgl fin
	//Obtiene el total de los registros
	$res = $Custom -> ContarDatosTesorero($cant ,$puntero,$sortcol,$sortdir,$criterio_filtro,$hidden_ep_id_financiador,$hidden_ep_id_regional,$hidden_ep_id_programa,$hidden_ep_id_proyecto,$hidden_ep_id_actividad);

	if($res) $total_registros= $Custom->salida;

	//Obtiene el conjunto de datos de la consulta
	$res = $Custom->ListarDatosTesorero($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$hidden_ep_id_financiador,$hidden_ep_id_regional,$hidden_ep_id_programa,$hidden_ep_id_proyecto,$hidden_ep_id_actividad);
	
	if($res)
	{
		$xml = new cls_manejo_xml('ROOT');
		$xml->add_nodo('TotalCount',$total_registros);

		foreach ($Custom->salida as $f)
		{
			$xml->add_rama('ROWS');
			$xml->add_nodo('id_cuenta_doc',$f["id_cuenta_doc"]);
			$xml->add_nodo('id_depto',$f["id_depto"]);
			$xml->add_nodo('desc_depto',$f["desc_depto"]);
			$xml->add_nodo('desc_empleado',$f["desc_empleado"]);
			$xml->add_nodo('tipo_pago',$f["tipo_pago"]);
			$xml->add_nodo('tipo_cuenta_doc',$f["tipo_cuenta_doc"]);
			$xml->add_nodo('estado',$f["estado"]);
			$xml->add_nodo('nro_documento',$f["nro_documento"]);
			$xml->add_nodo('fecha_sol',$f["fecha_sol"]);
			$xml->add_nodo('motivo',$f["motivo"]);
			$xml->add_nodo('observaciones',$f["observaciones"]);
			$xml->add_nodo('id_moneda',$f["id_moneda"]);
			$xml->add_nodo('desc_moneda',$f["desc_moneda"]);
			$xml->add_nodo('saldo_solicitante',$f["saldo_solicitante"]);
			$xml->add_nodo('importe',$f["importe"]);
			$xml->add_nodo('tipo_pago_fin',$f["tipo_pago_fin"]);
			$xml->add_nodo('id_cuenta_bancaria_fin',$f["id_cuenta_bancaria_fin"]);
			$xml->add_nodo('id_caja_fin',$f["id_caja_fin"]);
			$xml->add_nodo('id_cajero_fin',$f["id_cajero_fin"]);
			$xml->add_nodo('nro_deposito',$f["nro_deposito"]);
			$xml->add_nodo('desc_cuenta_bancaria',$f["desc_cuenta_bancaria"]);
			$xml->add_nodo('desc_cuenta_bancaria_fin',$f["desc_cuenta_bancaria_fin"]);
			$xml->add_nodo('desc_caja_fin',$f["desc_caja_fin"]);
			$xml->add_nodo('desc_cajero_fin',$f["desc_cajero_fin"]);
			$xml->add_nodo('nombre_cheque',$f["nombre_cheque"]);
						
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
	//--jgl inicio 
   }
	//--jgl fin
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