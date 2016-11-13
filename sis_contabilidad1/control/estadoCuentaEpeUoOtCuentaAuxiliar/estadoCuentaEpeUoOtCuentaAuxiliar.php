<?php
/**
**********************************************************
Nombre de archivo:	    ActionListarDestino.php
Prop�sito:				Permite realizar el listado en tpr_destino
Tabla:					t_tpr_destino
Par�metros:				$cant
						$puntero
						$sortcol
						$sortdir
						$criterio_filtro

Valores de Retorno:    	Listado de Procesos y total de registros listados
Fecha de Creaci�n:		2008-07-04 08:54:29
Versi�n:				1.0.0
Autor:					Generado Automaticamente
**********************************************************
*/
session_start();
include_once('../LibModeloContabilidad.php');
include_once('../../../lib/lib_control/GestionarExcel.php'); //--jgl
$Custom = new cls_CustomDBContabilidad();
$nombre_archivo = 'ActionListarEEFF.php';

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

	if($sort == '') $sortcol = 'id_reporte';
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
	
	$criterio_filtro = $cond -> obtener_criterio_filtro();
	
	//$criterio_filtro=$criterio_filtro." and  id_transaccion=33455";
	
 //echo 	$_POST['id_reporte_eeff'].$_POST['id_parametro'],.$_POST['id_moneda'].$_POST['fecha_trans'].$_POST['nivel'];  exit ();
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
		$Excel->SetNombreReporte($titulo_reporte_excel);
		//echo $titulo_reporte_excel; exit();
		$Excel->SetHoja("Hoja 1 Datos");
		$Excel->SetFila(3);
		$cant=100000000;
		$puntero=0;
		 
		$Excel->SetTitulo($titulo_reporte_excel,0,3,$nro_columnas); //Colocamos el titulo al reporte
		$Excel->SetCabeceraDetalle($datosCabecera);//Colocamos el nombre de las columnas
		
		 
		$res = $Custom->ListarEstadoEpeUoOtCuentaAuxiliar($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad,
						$_GET['id_gestion'],$_GET['id_depto'],$_GET['fecha_inicio'],$_GET['fecha_final'],$_GET['sw_cuenta'],$_GET['sw_auxiliar'],$_GET['sw_epe'],$_GET['sw_uo'],$_GET['sw_ot'],$_GET['id_cuenta_inicial'],$_GET['id_cuenta_final'],$_GET['id_auxiliar_inicial'],
						$_GET['id_auxiliar_final'],$_GET['id_epe_inicial'],$_GET['id_epe_final'],$_GET['id_uo_inicial'],$_GET['id_uo_final'],$_GET['id_ot_inicial'],$_GET['id_ot_final'],$_GET['sw_estado_cbte'],$_GET['sw_listado'],$_GET['id_moneda'],$_GET['sw_actualizacion'] );
	 
	 
		$Excel->setDetalle($Custom->salida);
		$Excel->setFin();		
		}
	else {
//--jgl fin
//echo $_POST['id_depto']; exit();
	//Obtiene el total de los registros
 $res = $Custom->ContarEstadoEpeUoOtCuentaAuxiliar($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad,
 	$_POST['id_gestion'],$_POST['id_depto'],$_POST['fecha_inicio'],$_POST['fecha_final'],$_POST['sw_cuenta'],$_POST['sw_auxiliar'],$_POST['sw_epe'],$_POST['sw_uo'],$_POST['sw_ot'],$_POST['id_cuenta_inicial'],$_POST['id_cuenta_final'],$_POST['id_auxiliar_inicial'],
	$_POST['id_auxiliar_final'],$_POST['id_epe_inicial'],$_POST['id_epe_final'],$_POST['id_uo_inicial'],$_POST['id_uo_final'],$_POST['id_ot_inicial'],$_POST['id_ot_final'],$_POST['sw_estado_cbte'],$_POST['sw_listado'],$_POST['id_moneda'] ,$_POST['sw_actualizacion'] );
 //echo $Custom -> query;exit;
 //$res=true;
	if($res) $total_registros= $Custom->salida;

	/*echo $ids_fuente_financiamiento;
	exit();*/
	//exit()




	//Obtiene el conjunto de datos de la consulta
	$res = $Custom->ListarEstadoEpeUoOtCuentaAuxiliar($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad,
	$_POST['id_gestion'],$_POST['id_depto'],$_POST['fecha_inicio'],$_POST['fecha_final'],$_POST['sw_cuenta'],$_POST['sw_auxiliar'],$_POST['sw_epe'],$_POST['sw_uo'],$_POST['sw_ot'],$_POST['id_cuenta_inicial'],$_POST['id_cuenta_final'],$_POST['id_auxiliar_inicial'],
	$_POST['id_auxiliar_final'],$_POST['id_epe_inicial'],$_POST['id_epe_final'],$_POST['id_uo_inicial'],$_POST['id_uo_final'],$_POST['id_ot_inicial'],$_POST['id_ot_final'],$_POST['sw_estado_cbte'],$_POST['sw_listado'],$_POST['id_moneda'],$_POST['sw_actualizacion'] );
	 //echo $Custom -> query;exit;
	if($res)
	{	$contador=0;
		$xml = new cls_manejo_xml('ROOT');
		$xml->add_nodo('TotalCount',$total_registros);
		
		foreach ($Custom->salida as $f)
		{
			$xml->add_rama('ROWS');
				$xml->add_nodo('id_tt_tct_reporte_uo_epe_ot_cta_aux',$f["id_tt_tct_reporte_uo_epe_ot_cta_aux"]);//1
				$xml->add_nodo('id_reporte',$f["id_reporte"]);//2
				$xml->add_nodo('id_transaccion',$f["id_transaccion"]);//3
				$xml->add_nodo('fecha_cbte',$f["fecha_cbte"]);//4
				$xml->add_nodo('nro_cbte',$f["nro_cbte"]);//5
				$xml->add_nodo('concepto_cbte',$f["concepto_cbte"]);//6
				$xml->add_nodo('desc_componentes',$f["desc_componentes"]);//7
				$xml->add_nodo('importe_debe',$f["importe_debe"]);//8
				$xml->add_nodo('importe_haber',$f["importe_haber"]);//9
				$xml->add_nodo('saldo',$f["saldo"]);//10
				
			 
				
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
