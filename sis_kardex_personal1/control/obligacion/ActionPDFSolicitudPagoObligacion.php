<?php

session_start();
include_once('../LibModeloKardexPersonal.php');
$Custom = new cls_CustomDBKardexPersonal();

$nombre_archivo = 'ActionPDFSolicitudPago.php';



if (!isset($_SESSION['autentificado']))
{
	$_SESSION['autentificado']="NO";
}
if($_SESSION['autentificado']=="SI")
{
    if($limit == "") $cant = 15;
	else $cant = $limit;

	if($start == "") $puntero = 0;
	else $puntero = $start;

if($sort == '') $sortcol = 'COTIZA.id_cotizacion';
	else $sortcol = $sort;

	if($dir == "") $sortdir = 'asc';
	else $sortdir = $dir;

	//Verifica si se har� o no la decodificaci�n(s�lo pregunta en caso del GET)
	//valores permitidos de $cod -> "si", "no"
	switch ($cod)
	{
		case "si":
			$decodificar = true;
			break;
		case "no":
			$decodificar = false;
			break;
		default:
			$decodificar = true;
			break;
	}

//Verifica si se manda la cantidad de filtros
	if($CantFiltros=="") $CantFiltros = 0;


//Se obtiene el criterio del filtro con formato sql para mandar a la BD
	$cond = new cls_criterio_filtro($decodificar);
	for($i=0;$i<$CantFiltros;$i++)
	{
		$cond->add_condicion_filtro($_POST["filterCol_$i"], $_POST["filterValue_$i"], $_POST["filterAvanzado_$i"]);
	}

	$criterio_filtro = $cond->obtener_criterio_filtro();
//	echo $m_id_plan_pago;
//	exit;
/*echo $id_obligacion;
exit;*/
	$criterio_filtro=$criterio_filtro." AND obliga.id_obligacion=".$id_obligacion;
	
	$Pago= array();
    $Pago = $Custom->SolPagoObligacionCab($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
	$_SESSION['PDF_sol_pago_obligaciones']=$Custom->salida;	 
	
	//Detalle EP de solicitud de pago	
	$DetPagoEP = $Custom->SolPagoObligacionEPDet($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)	;
	$_SESSION['PDF_detalle_pago_ep']=$Custom->salida;	 
			
	/*$Pago_detalle = $Custom-> RepSolicitudPagoDetalle($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$hidden_ep_id_financiador,$hidden_ep_id_regional,$hidden_ep_id_programa,$hidden_ep_id_proyecto,$hidden_ep_id_actividad,$m_id_plan_pago);
			$_SESSION['PDF_EP_solicitud']=$Custom->salida;*/
			header("location:../../vista/_reportes/obligaciones/PDFSolicitudPagoObligacion.php");
	}
else
	{
		header("HTTP/1.0 401 No autorizado");
		header('Content-Type: text/plain; charset=iso-8859-1');
		echo "No tiene los permisos necesarios ";
	}

?>
